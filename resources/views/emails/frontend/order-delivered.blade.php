@extends('emails.frontend.includes.layout')

@section('content')
@php
  $shipping = is_array($order->shipping_address) ? $order->shipping_address : json_decode($order->shipping_address, true);
  $resolvedCustomerName = (!empty($customerName) && strcasecmp(trim($customerName), 'guest') !== 0)
    ? $customerName
    : ((!empty($user->name) && strcasecmp(trim($user->name), 'guest') !== 0)
      ? $user->name
      : ((!empty($user->first_name) && strcasecmp(trim($user->first_name), 'guest') !== 0)
        ? trim($user->first_name . ' ' . ($user->last_name ?? ''))
        : ((!empty($shipping['name']) && strcasecmp(trim($shipping['name']), 'guest') !== 0)
          ? $shipping['name']
          : 'Valued Customer')));
@endphp
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Order Delivered Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #059669; text-transform: uppercase; letter-spacing: 0.8px;">
            📦 Order Delivered
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Your Order Has Been Delivered!
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;">{{ $resolvedCustomerName }}</strong>,
    </p>
    <p style="margin: 0 0 24px; font-size: 15px; line-height: 24px; color: #475569;">
      Your package for order <strong style="color: #0f172a;">#{{ $order->order_number }}</strong> has been delivered. We hope everything arrived in perfect condition and meets your health &amp; wellness needs!
    </p>

    <!-- Delivery Summary Card -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
      <tr>
        <td style="padding: 16px 20px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td>
                <span style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Order Number</span>
                <span style="display: block; font-size: 16px; font-weight: 800; color: #0f172a;">#{{ $order->order_number }}</span>
              </td>
              <td align="right">
                <span style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Status</span>
                <span style="display: block; font-size: 16px; font-weight: 800; color: #059669;">
                  Delivered
                </span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9;">
          <table border="0" cellpadding="2" cellspacing="0" width="100%">
            <tr>
              <td style="font-size: 13px; color: #64748b; width: 40%;">Delivery Date:</td>
              <td style="font-size: 13px; font-weight: 600; color: #0f172a;">
                {{ date('d M Y, h:i A') }}
              </td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b;">Total Amount:</td>
              <td style="font-size: 13px; font-weight: 700; color: #0f172a;">
                {{ function_exists('displayPrice') ? displayPrice($order->net_total) : ('₹' . number_format($order->net_total, 2)) }}
              </td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b;">Payment Status:</td>
              <td style="font-size: 13px; font-weight: 600; color: #059669;">
                Completed
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- Delivered Items -->
      @if(!empty($order->orderProducts) && count($order->orderProducts))
      <tr>
        <td style="padding: 16px 20px;">
          <span style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
            Delivered Items
          </span>
          <table border="0" cellpadding="6" cellspacing="0" width="100%">
            @foreach($order->orderProducts as $item)
            @php
              $itemName = $item->variant->name ?? ($item->variant->product->name ?? ($item->sku ?? 'Product Item'));
              $unitPrice = $item->sell_price ?? ($item->regular_price ?? 0);
              $lineTotal = $unitPrice * ($item->quantity ?? 1);
            @endphp
            <tr>
              <td style="font-size: 14px; font-weight: 600; color: #1e293b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">
                {{ $itemName }}
                <span style="font-size: 12px; font-weight: 400; color: #64748b;">&times; {{ $item->quantity ?? 1 }}</span>
              </td>
              <td align="right" style="font-size: 14px; font-weight: 600; color: #1e293b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">
                {{ function_exists('displayPrice') ? displayPrice($lineTotal) : ('₹' . number_format($lineTotal, 2)) }}
              </td>
            </tr>
            @endforeach
          </table>
        </td>
      </tr>
      @endif

      <!-- Delivered To Address -->
      @if(!empty($shipping['address']))
      <tr>
        <td style="padding: 14px 20px; background: #ffffff; border-top: 1px solid #e2e8f0;">
          <span style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
            Delivered To
          </span>
          <p style="margin: 0; font-size: 13px; line-height: 18px; color: #475569;">
            {{ $shipping['name'] ?? $customerName }}<br/>
            {{ $shipping['address'] }}
          </p>
        </td>
      </tr>
      @endif
    </table>

    <!-- Review Invitation Card -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #fefce8; border: 1px solid #fef08a; border-radius: 10px; padding: 18px 20px;">
      <tr>
        <td>
          <span style="display: block; font-size: 13px; font-weight: 700; color: #854d0e; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">
            ⭐ How Was Your Experience?
          </span>
          <p style="margin: 0; font-size: 13px; line-height: 20px; color: #713f12;">
            Your feedback helps us continuously improve our pharmaceutical services and healthcare products. Please take a moment to review the items you received!
          </p>
        </td>
      </tr>
    </table>

    <!-- Action Button -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; text-align: center;">
      <tr>
        <td align="center">
          <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
            <tr>
              <td align="center" style="background: #2563eb; border-radius: 8px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);">
                <a href="{{ route('order.details', ['order_number' => $order->order_number]) }}" target="_blank" style="display: inline-block; padding: 14px 36px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  View Order &amp; Leave a Review &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Support Help -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      Have an issue with the delivered products or need a return? Contact our support desk at 
      <a href="mailto:{{ config('app.support_email', 'fortiercustomersupport@gmail.com') }}" style="color: #2563eb; text-decoration: underline;">{{ config('app.support_email', 'fortiercustomersupport@gmail.com') }}</a>.
    </p>
  </td>
</tr>
@endsection
