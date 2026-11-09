<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fortier Healthcare Pvt. LTD.</title>
  <style type="text/css">
    @page {
      size: A4 portrait;
      margin: 16mm 14mm 16mm 14mm;
    }
    body {
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
      font-size: 10px;
      line-height: 1.45;
      color: #1e293b;
      margin: 0;
      padding: 0;
      background-color: #ffffff;
      -webkit-font-smoothing: antialiased;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
    }
    td, th {
      vertical-align: top;
      padding: 0;
    }
    tr {
      page-break-inside: avoid;
    }
    .header-table {
      margin-bottom: 20px;
      border-bottom: 2px solid #0f172a;
      padding-bottom: 16px;
    }
    .brand-title {
      font-size: 21px;
      font-weight: 700;
      color: #0f172a;
      letter-spacing: -0.5px;
      line-height: 1.1;
    }
    .brand-subtitle {
      font-size: 10.5px;
      font-weight: 700;
      color: #d97706;
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-top: 2px;
    }
    .company-meta {
      font-size: 9px;
      color: #64748b;
      line-height: 1.4;
      margin-top: 6px;
    }
    .invoice-title {
      font-size: 22px;
      font-weight: 800;
      color: #0f172a;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      text-align: right;
      line-height: 1;
      margin-bottom: 8px;
    }
    .meta-box {
      background-color: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 6px;
      padding: 8px 12px;
      width: 235px;
      margin-left: auto;
    }
    .meta-row td {
      padding: 2px 0;
      font-size: 9.5px;
    }
    .meta-label {
      color: #64748b;
      font-weight: 500;
      width: 105px;
    }
    .meta-val {
      color: #0f172a;
      font-weight: 700;
      text-align: right;
    }
    .badge-pending {
      display: inline-block;
      padding: 2px 8px;
      background-color: #fef3c7;
      color: #92400e;
      border: 1px solid #fde68a;
      border-radius: 4px;
      font-size: 8.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.4px;
    }
    .badge-paid {
      display: inline-block;
      padding: 2px 8px;
      background-color: #ecfdf5;
      color: #065f46;
      border: 1px solid #a7f3d0;
      border-radius: 4px;
      font-size: 8.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.4px;
    }
    .addresses-table {
      margin-bottom: 18px;
    }
    .address-card {
      background-color: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 6px;
      padding: 10px 14px;
    }
    .address-title {
      font-size: 9.5px;
      font-weight: 700;
      color: #475569;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      margin-bottom: 6px;
      border-bottom: 1px solid #e2e8f0;
      padding-bottom: 4px;
    }
    .address-name {
      font-size: 11.5px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 3px;
    }
    .address-text {
      font-size: 9.5px;
      color: #475569;
      line-height: 1.45;
    }
    .items-table {
      margin-bottom: 18px;
      border: 1px solid #e2e8f0;
      border-radius: 6px;
      overflow: hidden;
    }
    .items-table th {
      background-color: #0f172a;
      color: #ffffff;
      font-size: 9px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 8px 10px;
      border: none;
    }
    .items-table td {
      padding: 8px 10px;
      border-bottom: 1px solid #f1f5f9;
      font-size: 9.5px;
      color: #334155;
    }
    .items-table tr.even td {
      background-color: #f8fafc;
    }
    .summary-table {
      margin-bottom: 20px;
    }
    .summary-card {
      width: 250px;
      margin-left: auto;
      border: 1px solid #e2e8f0;
      border-radius: 6px;
      overflow: hidden;
    }
    .summary-card td {
      padding: 5px 12px;
      font-size: 9.5px;
    }
    .summary-card .grand-total-row {
      background-color: #0f172a;
      color: #ffffff;
    }
    .summary-card .grand-total-row td {
      padding: 9px 12px;
      color: #ffffff;
      font-size: 11px;
      font-weight: 800;
    }
    .notes-box {
      background-color: #f8fafc;
      border-left: 3px solid #0f172a;
      border-radius: 0 4px 4px 0;
      padding: 10px 14px;
      font-size: 9px;
      color: #475569;
      line-height: 1.45;
    }
    .footer-strip {
      border-top: 1px solid #e2e8f0;
      padding-top: 10px;
      margin-top: 16px;
      text-align: center;
      font-size: 8.5px;
      color: #94a3b8;
    }
  </style>
</head>
<body>

<?php
  // Safe decoding of address and charges
  $shippingAddress = is_array($order->shipping_address ?? null)
    ? (object)$order->shipping_address
    : (is_string($order->shipping_address ?? null) ? json_decode($order->shipping_address) : null);

  $billingAddress = is_array($order->billing_address ?? null)
    ? (object)$order->billing_address
    : (is_string($order->billing_address ?? null) ? json_decode($order->billing_address) : null);

  $otherCharges = is_array($order->other_charges ?? null)
    ? $order->other_charges
    : (is_string($order->other_charges ?? null) ? json_decode($order->other_charges, true) : []);

  // Base64 encode logo from disk for reliable rendering in DomPDF
  $logoBase64 = null;
  $logoFilePath = public_path('uploads/site/logo/6a8202159bcb6.webp');
  if (file_exists($logoFilePath)) {
    try {
      $gdImg = @imagecreatefromstring(file_get_contents($logoFilePath));
      if ($gdImg) {
        ob_start();
        imagepng($gdImg);
        $pngContent = ob_get_clean();
        imagedestroy($gdImg);
        if ($pngContent) {
          $logoBase64 = 'data:image/png;base64,' . base64_encode($pngContent);
        }
      }
    } catch (\Throwable $e) {}
  }

  // Payment method & status logic
  $isCod = ($order->payment_method === 0 || $order->payment_method === '0' || strcasecmp((string)$order->payment_method, 'cod') === 0);
  $isPaid = (!$isCod && (int)($order->payment_status ?? 0) === 1);
  $paymentMethodText = $isCod ? 'Cash on Delivery' : ($order->payment_method_display ?? 'Online Payment');
  $paymentStatusText = $isPaid ? 'Paid' : 'Payment Pending';
?>

  <!-- Header Section with Website-Style Branding -->
  <table class="header-table">
    <tr>
      <td style="width: 55%; vertical-align: middle;">
        <table>
          <tr>
            <?php if(!empty($logoBase64)): ?>
              <td style="width: 54px; vertical-align: middle; padding-right: 12px;">
                <img src="<?php echo e($logoBase64); ?>" style="height: 48px; max-width: 54px; object-fit: contain; border-radius: 4px;" alt="Fortier Healthcare">
              </td>
            <?php endif; ?>
            <td style="vertical-align: middle;">
              <div class="brand-title">Fortier Healthcare</div>
              <div class="brand-subtitle">Pvt. Ltd.</div>
              <div class="company-meta">
                Licensed Pharmaceutical &amp; Healthcare Distribution<br>
                Support: <?php echo e(config('app.support_email', 'fortiercustomersupport@gmail.com')); ?> &bull; Web: <?php echo e(config('app.url', 'www.fortihealthcare.com')); ?>

              </div>
            </td>
          </tr>
        </table>
      </td>
      <td style="width: 45%; vertical-align: top; text-align: right;">
        <div class="invoice-title">Tax Invoice</div>
        <table class="meta-box">
          <tr class="meta-row">
            <td class="meta-label">Invoice No:</td>
            <td class="meta-val">#<?php echo e($order->order_number); ?></td>
          </tr>
          <tr class="meta-row">
            <td class="meta-label">Invoice Date:</td>
            <td class="meta-val"><?php echo e(date('d M Y', strtotime($order->created_at))); ?></td>
          </tr>
          <tr class="meta-row">
            <td class="meta-label">Order Status:</td>
            <td class="meta-val"><?php echo e($order->order_status_text ?? 'Confirmed'); ?></td>
          </tr>
          <tr class="meta-row">
            <td class="meta-label">Payment Mode:</td>
            <td class="meta-val"><?php echo e($paymentMethodText); ?></td>
          </tr>
          <tr class="meta-row">
            <td class="meta-label">Payment Status:</td>
            <td class="meta-val">
              <span class="<?php echo e($isPaid ? 'badge-paid' : 'badge-pending'); ?>">
                <?php echo e($paymentStatusText); ?>

              </span>
            </td>
          </tr>
          <?php if(!empty($order->transaction_id)): ?>
          <tr class="meta-row">
            <td class="meta-label">Txn Ref:</td>
            <td class="meta-val" style="font-family: monospace; font-size: 8.5px;"><?php echo e($order->transaction_id); ?></td>
          </tr>
          <?php endif; ?>
        </table>
      </td>
    </tr>
  </table>

  <!-- Billing & Shipping Information -->
  <table class="addresses-table">
    <tr>
      <td style="width: 48%; vertical-align: top;">
        <div class="address-card">
          <div class="address-title">Billed To</div>
          <div class="address-name"><?php echo e($billingAddress->name ?? ($order->user->name ?? 'Valued Customer')); ?></div>
          <div class="address-text">
            <?php if(!empty($billingAddress->phone)): ?>
              Phone: <?php echo e($billingAddress->phone); ?><br>
            <?php endif; ?>
            <?php if(!empty($billingAddress->address)): ?>
              <?php echo e($billingAddress->address); ?>

            <?php elseif(!empty($order->user->email)): ?>
              Email: <?php echo e($order->user->email); ?>

            <?php endif; ?>
          </div>
        </div>
      </td>
      <td style="width: 4%;"></td>
      <td style="width: 48%; vertical-align: top;">
        <div class="address-card">
          <div class="address-title">Shipped To</div>
          <div class="address-name"><?php echo e($shippingAddress->name ?? ($billingAddress->name ?? ($order->user->name ?? 'Valued Customer'))); ?></div>
          <div class="address-text">
            <?php if(!empty($shippingAddress->phone)): ?>
              Phone: <?php echo e($shippingAddress->phone); ?><br>
            <?php elseif(!empty($billingAddress->phone)): ?>
              Phone: <?php echo e($billingAddress->phone); ?><br>
            <?php endif; ?>
            <?php echo e($shippingAddress->address ?? ($billingAddress->address ?? 'Standard Delivery Destination')); ?>

          </div>
        </div>
      </td>
    </tr>
  </table>

  <!-- Purchased Products Table -->
  <table class="items-table">
    <thead>
      <tr>
        <th style="width: 5%; text-align: center;">#</th>
        <th style="width: 43%; text-align: left;">Product Item &amp; Description</th>
        <th style="width: 14%; text-align: left;">SKU</th>
        <th style="width: 12%; text-align: right;">Unit Price</th>
        <th style="width: 8%; text-align: center;">Qty</th>
        <th style="width: 8%; text-align: right;">Tax</th>
        <th style="width: 10%; text-align: right;">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($order->orderProducts) && count($order->orderProducts)): ?>
        <?php $__currentLoopData = $order->orderProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $productVariant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $itemTotal = ($productVariant->sell_price * $productVariant->quantity) + $productVariant->tax_amount;
            $defaultImage = $productVariant->variant->images[0]->gallery->file_name ?? null;
            $itemImgSrc = null;
            if (!empty($defaultImage)) {
              $imgCheck = public_path('uploads/media/products/images/' . $defaultImage);
              if (file_exists($imgCheck)) {
                $itemImgSrc = $imgCheck;
              }
            }
          ?>
          <tr class="<?php echo e($index % 2 === 1 ? 'even' : ''); ?>">
            <td style="text-align: center; color: #64748b;"><?php echo e($index + 1); ?></td>
            <td>
              <table>
                <tr>
                  <?php if(!empty($itemImgSrc)): ?>
                    <td style="width: 32px; padding-right: 8px; vertical-align: middle;">
                      <img src="<?php echo e($itemImgSrc); ?>" style="width: 28px; height: 28px; object-fit: contain; border-radius: 3px; border: 1px solid #e2e8f0;">
                    </td>
                  <?php endif; ?>
                  <td style="vertical-align: middle;">
                    <div style="font-weight: 700; color: #0f172a;">
                      <?php echo e($productVariant->variant->name ?? ($productVariant->variant->product->name ?? 'Product Item')); ?>

                    </div>
                  </td>
                </tr>
              </table>
            </td>
            <td style="color: #64748b; font-size: 9px;"><?php echo e($productVariant->variant->sku ?? '-'); ?></td>
            <td style="text-align: right;">
              <?php echo e(function_exists('displayPrice') ? displayPrice($productVariant->sell_price) : ('₹' . number_format($productVariant->sell_price, 2))); ?>

            </td>
            <td style="text-align: center; font-weight: 700;"><?php echo e($productVariant->quantity); ?></td>
            <td style="text-align: right; color: #64748b;">
              <?php echo e(function_exists('displayPrice') ? displayPrice($productVariant->tax_amount) : ('₹' . number_format($productVariant->tax_amount, 2))); ?>

            </td>
            <td style="text-align: right; font-weight: 700; color: #0f172a;">
              <?php echo e(function_exists('displayPrice') ? displayPrice($itemTotal) : ('₹' . number_format($itemTotal, 2))); ?>

            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        <tr>
          <td colspan="7" style="text-align: center; padding: 18px; color: #94a3b8;">
            No items recorded for this order.
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- Order Financial Summary & Notes -->
  <table class="summary-table">
    <tr>
      <td style="width: 52%; vertical-align: top; padding-right: 15px;">
        <div class="notes-box">
          <strong style="color: #0f172a; text-transform: uppercase; font-size: 9px; letter-spacing: 0.5px; display: block; margin-bottom: 4px;">
            Order &amp; Payment Details
          </strong>
          <?php if($isCod): ?>
            This order was booked under <strong>Cash on Delivery (COD)</strong>. Please collect the exact payable amount of <strong><?php echo e(function_exists('displayPrice') ? displayPrice($order->net_total) : ('₹' . number_format($order->net_total, 2))); ?></strong> upon delivery of the package.
          <?php else: ?>
            <?php if($isPaid): ?>
              Payment received successfully via <strong><?php echo e($paymentMethodText); ?></strong>. Thank you for your business.
            <?php else: ?>
              Payment is currently <strong>Pending</strong> for this order.
            <?php endif; ?>
          <?php endif; ?>
          <div style="margin-top: 8px; font-size: 8px; color: #64748b; border-top: 1px dashed #cbd5e1; padding-top: 6px;">
            This is a computer-generated tax invoice. No signature is required.<br>
            For customer support or order inquiries: <strong><?php echo e(config('app.support_email', 'fortiercustomersupport@gmail.com')); ?></strong>
          </div>
        </div>
      </td>
      <td style="width: 48%; vertical-align: top;">
        <table class="summary-card">
          <tr>
            <td style="color: #64748b;">Subtotal (Items):</td>
            <td style="text-align: right; font-weight: 600; color: #0f172a;">
              <?php echo e(function_exists('displayPrice') ? displayPrice($order->order_total) : ('₹' . number_format($order->order_total, 2))); ?>

            </td>
          </tr>
          <tr>
            <td style="color: #64748b;">Total Tax (GST):</td>
            <td style="text-align: right; font-weight: 600; color: #0f172a;">
              <?php echo e(function_exists('displayPrice') ? displayPrice($order->total_tax) : ('₹' . number_format($order->total_tax, 2))); ?>

            </td>
          </tr>
          <?php if(!empty($order->coupon_discount) && $order->coupon_discount > 0): ?>
          <tr>
            <td style="color: #64748b;">Coupon Discount:</td>
            <td style="text-align: right; font-weight: 600; color: #dc2626;">
              -<?php echo e(function_exists('displayPrice') ? displayPrice($order->coupon_discount) : ('₹' . number_format($order->coupon_discount, 2))); ?>

            </td>
          </tr>
          <?php endif; ?>
          <?php if(!empty($otherCharges) && count($otherCharges) > 0): ?>
            <?php $__currentLoopData = $otherCharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($value > 0): ?>
              <tr>
                <td style="color: #64748b;"><?php echo e(ucwords(str_replace('_', ' ', $key))); ?>:</td>
                <td style="text-align: right; font-weight: 600; color: #0f172a;">
                  <?php echo e(function_exists('displayPrice') ? displayPrice($value) : ('₹' . number_format($value, 2))); ?>

                </td>
              </tr>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          <tr class="grand-total-row">
            <td>Grand Total:</td>
            <td style="text-align: right;">
              <?php echo e(function_exists('displayPrice') ? displayPrice($order->net_total) : ('₹' . number_format($order->net_total, 2))); ?>

            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <!-- Footer Branding Strip -->
  <div class="footer-strip">
    Thank you for choosing <strong>Fortier Healthcare Pvt. Ltd.</strong> &bull; Delivering Trusted Quality Healthcare &bull; <?php echo e(config('app.url', 'www.fortihealthcare.com')); ?>

  </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/backend/pages/order-manage/orders/invoice-order.blade.php ENDPATH**/ ?>