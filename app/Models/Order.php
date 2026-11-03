<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\Log;

class Order extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'user_id',
    'user_notes',
    'order_number',
    'transaction_id',
    'payment_method',
    'payment_status',
    'payment_failure_reason',
    'payment_details',
    'coupon_type',
    'coupon_id',
    'coupon_discount',
    'order_total',
    'shipping_charge',
    'net_total',
    'total_tax',
    'order_status',
    'shipping_address',
    'billing_address',
    'other_charges',
    'created_by',
    'updated_by',
    'deleted_by',
  ];

  protected $casts = [
    'coupon_discount' => 'decimal:2',
    'order_total' => 'decimal:2',
    'shipping_charge' => 'decimal:2',
    'net_total' => 'decimal:2',
  ];
  protected $appends = ['order_status_text', 'payment_method_display'];

  public function getPaymentMethodDisplayAttribute(): string
  {
    $payment_method = array(
      0 => 'Cash On Delivery (COD)',
      1 => 'Online Payment',
    );

    return $payment_method[$this->payment_method];
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function orderProducts()
  {
    return $this->hasMany(OrderProduct::class);
  }

  public function coupon()
  {
    return $this->belongsTo(Coupon::class);
  }

  public function createdBy()
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  public function updatedBy()
  {
    return $this->belongsTo(User::class, 'updated_by');
  }

  public function requests()
  {
    return $this->hasMany(OrderReturn::class);
  }


  public static function scopeSearch($query, $search)
  {
    return $query->where('order_number', 'like', '%' . $search . '%')
      ->orWhere('order_total', 'like', '%' . $search . '%');
  }
  public function orderHistories()
  {
    return $this->hasMany(OrderHistory::class, 'order_id');
  }


  public static function orderStatusUpdate($data, int $id = 0)
  {
    $statuses = [
      0 => 'Awaiting Confirmation',
      1 => 'Confirmed',
      2 => 'Cancellation Initiated',
      3 => 'Cancelled',
      4 => 'Shipped',
      5 => 'Delivered',
      6 => 'Return Accepted',
      7 => 'Refund Done',
    ];
    $order = self::find($id);

    if (!$order) {
      return response()->json([
        'success' => false,
        'message' => __('response.not_found', ['item' => 'Order'])
      ]);
    }

    $decodedStatus = Hashids::decode($data->order_status)[0] ?? null;

    if ($decodedStatus === null) {
      return response()->json([
        'success' => false,
        'message' => __('response.not_found', ['item' => 'Order Status'])
      ]);
    }

    // Get last status (from history or current)
    $lastStatus = $order->orderHistories()
      ->orderByDesc('created_at')
      ->value('status') ?? $order->order_status;

    // Define valid transitions
    $validTransitions = [
      0 => [1, 2],     // Awaiting Confirmation → Confirmed or Cancel Initiated
      1 => [4, 2],     // Confirmed → Shipped or Cancel Initiated
      2 => [3],        // Cancel Initiated → Cancelled
      4 => [5],        // Shipped → Delivered
      5 => [6],        // Delivered → Return Accepted
      6 => [7],        // Return Accepted → Refund Done
    ];


    $finalStates = [3, 7];
    if (in_array($lastStatus, $finalStates)) {
      return response()->json([
        'success' => false,
        'message' => 'No further updates allowed after order is ' . __($statuses[$lastStatus]) . '.'
      ]);
    }


    if (!in_array($decodedStatus, $validTransitions[$lastStatus] ?? [])) {
      return response()->json([
        'success' => false,
        'message' => 'Invalid transition from ' . __($statuses[$lastStatus]) . ' to ' . __($statuses[$decodedStatus]) . '.'
      ]);
    }

    $existingHistory = $order->orderHistories()
      ->where('status', $decodedStatus)
      ->first();

    if ($existingHistory) {
      return response()->json([
        'success' => false,
        'message' => 'This status has already been recorded.'
      ]);
    }

    // ✅ Update Order & History
    $order->update([
      'order_status' => $decodedStatus,
      'updated_by' => user('admin')->id,
    ]);

    $orderHistory = $order->orderHistories()->create([
      'scheduled_date' => formatDate($data->scheduled_date),
      'scheduled_time' => $data->scheduled_time ?? null,
      'description' => $data->description ?? '',
      'status' => $decodedStatus,
    ]);

    // Send order status email to customer
    $order->sendStatusNotificationEmail($decodedStatus, [
      'history' => $orderHistory,
      'note' => $data->description ?? null,
    ]);

    return response()->json([
      'success' => true,
      'message' => __('response.success.update', ['item' => 'Order Status']),
      'value' => Hashids::encode($order->id)
    ]);
  }

  /**
   * Sends an order status update email notification to the customer.
   *
   * @param int|null $status
   * @param array $extraData
   * @return bool
   */
  public function sendStatusNotificationEmail(?int $status = null, array $extraData = []): bool
  {
    $status = $status ?? $this->order_status;
    $this->loadMissing(['user', 'orderProducts.variant.product']);

    $user = $this->user;
    if (!$user || empty($user->email)) {
      Log::warning("Order #{$this->order_number} has no associated user email for status notification.");
      return false;
    }

    $templateMap = [
      OrderStatus::CONFIRMED => [
        'view' => 'emails.frontend.order-confirmation',
        'subject' => "Your Order Confirmation - #{$this->order_number}",
      ],
      OrderStatus::CANCELLATION_INITIATED => [
        'view' => 'emails.frontend.order-cancellation-initiated',
        'subject' => "Order Cancellation Request Initiated - #{$this->order_number}",
      ],
      OrderStatus::CANCELLED => [
        'view' => 'emails.frontend.order-cancelled',
        'subject' => "Your Order Has Been Cancelled - #{$this->order_number}",
      ],
      OrderStatus::SHIPPED => [
        'view' => 'emails.frontend.order-shipped',
        'subject' => "Your Order Has Been Shipped - #{$this->order_number}",
      ],
      OrderStatus::DELIVERED => [
        'view' => 'emails.frontend.order-delivered',
        'subject' => "Your Order Has Been Delivered - #{$this->order_number}",
      ],
      OrderStatus::RETURN_ACCEPTED => [
        'view' => 'emails.frontend.refund-accepted',
        'subject' => "Return & Refund Request Accepted - #{$this->order_number}",
      ],
      OrderStatus::REFUND_DONE => [
        'view' => 'emails.frontend.refund-done',
        'subject' => "Your Refund Has Been Completed - #{$this->order_number}",
      ],
    ];

    if (!isset($templateMap[$status])) {
      return false;
    }

    $view = $templateMap[$status]['view'];
    $subject = $templateMap[$status]['subject'];

    // Resolve the customer's registered name filled upon registration
    $registeredName = (!empty($user->name) && strcasecmp(trim($user->name), 'guest') !== 0)
      ? $user->name
      : ((!empty($user->first_name) && strcasecmp(trim($user->first_name), 'guest') !== 0)
        ? trim($user->first_name . ' ' . ($user->last_name ?? ''))
        : null);

    if (empty($registeredName)) {
      $shipping = is_array($this->shipping_address) ? $this->shipping_address : json_decode($this->shipping_address, true);
      $shippingName = (!empty($shipping['name']) && strcasecmp(trim($shipping['name']), 'guest') !== 0) ? $shipping['name'] : null;
      $registeredName = $shippingName ?: 'Valued Customer';
    }

    $data = array_merge([
      'user' => $user,
      'order' => $this,
      'customerName' => $registeredName,
      'status_label' => OrderStatus::label($status),
      'history' => $extraData['history'] ?? $this->orderHistories()->latest()->first(),
      'note' => $extraData['note'] ?? null,
    ], $extraData);

    try {
      $bcc = [];
      if ($status === OrderStatus::CONFIRMED && function_exists('adminMailsByRoleID')) {
        $bcc = adminMailsByRoleID([SiteSetting::where('key', 'order_copy_to_id')->value('value') ?? 1]);
      }

      app('EmailService')->sendEmail(
        $user->email,
        $subject,
        $view,
        $data,
        [],
        $bcc
      );

      return true;
    } catch (\Throwable $e) {
      Log::error("Failed to send order status notification email for order #{$this->order_number} (status {$status}): " . $e->getMessage());
      return false;
    }
  }


  public function getOrderStatusTextAttribute()
  {
    $statuses = [
      0 => 'Awaiting Confirmation',
      1 => 'Confirmed',
      2 => 'Cancellation Initiated',
      3 => 'Cancelled',
      4 => 'Shipped',
      5 => 'Delivered',
      6 => 'Return Accepted',
      7 => 'Refund Done',
    ];

    return $statuses[$this->order_status] ?? 'N/A';
  }

  public function getVariantSkusAttribute()
  {
    return $this->orderProducts
      ->map(fn($op) => optional($op->variant)->sku)
      ->filter()
      ->implode(', ');
  }

  public function variant()
  {
    return $this->belongsTo(ProductVariant::class);
  }

  public static function saleStatus($daterange = null)
  {
    return self::query()
      ->selectRaw('MONTH(created_at) as month')
      ->selectRaw('MONTHNAME(created_at) as month_name')
      ->selectRaw('COUNT(*) as order_count')
      ->selectRaw('SUM(net_total) as total_sales')
      ->where('payment_status', 1)
      ->groupByRaw('MONTH(created_at), MONTHNAME(created_at)')
      ->orderByRaw('MONTH(created_at)')
      ->when($daterange, function ($query) use ($daterange) {
        return $query->whereBetween('created_at', $daterange);
      })
      ->get();
  }

  public static function revenueGenerate($daterange = null)
  {
    return self::query()
      ->selectRaw('MONTH(created_at) as month')
      ->selectRaw('MONTHNAME(created_at) as month_name')
      ->selectRaw('COUNT(*) as order_count')
      ->selectRaw('SUM(net_total) as total_sales')
      ->where('payment_status', 1)
      ->whereIn('order_status', [1, 5])
      ->groupByRaw('MONTH(created_at), MONTHNAME(created_at)')
      ->orderByRaw('MONTH(created_at)')
      ->when($daterange, function ($query) use ($daterange) {
        return $query->whereBetween('created_at', $daterange);
      })
      ->get();
  }

  public static function topSellingProducts($daterange = null)
  {
    return OrderProduct::with('variant.product')
      ->join('product_variants', 'order_products.variant_id', '=', 'product_variants.id')
      ->join('products', 'product_variants.product_id', '=', 'products.id')
      ->whereHas('order', function ($query) use ($daterange) {
        $query->where('payment_status', 1)
          ->when($daterange && count($daterange) === 2, function ($q) use ($daterange) {
            $q->whereBetween('created_at', $daterange);
          });
      })
      ->selectRaw('products.name as product_name, COUNT(*) as order_count')
      ->groupBy('products.name')
      ->orderByDesc('order_count')
      ->limit(10)
      ->get();
  }
}
