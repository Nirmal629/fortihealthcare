@extends('emails.frontend.includes.layout')

@section('content')
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Order Notification Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #eff6ff; border: 1px solid #dbeafe; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 0.8px;">
            🛍️ New Customer Order
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Order #{{ $order->order_number }} Received
    </h1>

    <p style="margin: 0 0 24px; font-size: 15px; line-height: 24px; color: #475569;">
      A new order has been placed on <strong>{{ config('app.name') }}</strong> and is awaiting fulfillment.
    </p>

    <!-- Customer & Order Meta Card -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
      <tr>
        <td style="padding: 14px 20px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
          <span style="font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px;">
            Customer &amp; Order Information
          </span>
        </td>
      </tr>
      <tr>
        <td style="padding: 16px 20px;">
          <table border="0" cellpadding="4" cellspacing="0" width="100%">
            <tr>
              <td style="font-size: 13px; color: #64748b; width: 35%;">Customer Name:</td>
              <td style="font-size: 14px; font-weight: 600; color: #0f172a;">{{ $customer->name ?? 'Guest' }}</td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b;">Customer Email:</td>
              <td style="font-size: 14px; font-weight: 600; color: #0f172a;">{{ $customer->email ?? '-' }}</td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b;">Order Date:</td>
              <td style="font-size: 14px; font-weight: 600; color: #0f172a;">
                {{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : date('d M Y, h:i A') }}
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Line Items Table -->
    @if(isset($order->items) && count($order->items))
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
      <thead>
        <tr style="background: #f1f5f9;">
          <th align="left" style="padding: 12px 16px; font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Item</th>
          <th align="center" style="padding: 12px 16px; font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Qty</th>
          <th align="right" style="padding: 12px 16px; font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->items as $item)
        <tr>
          <td style="padding: 12px 16px; font-size: 14px; font-weight: 600; color: #1e293b; border-top: 1px solid #f1f5f9;">
            {{ $item->name ?? '-' }}
          </td>
          <td align="center" style="padding: 12px 16px; font-size: 14px; color: #475569; border-top: 1px solid #f1f5f9;">
            {{ $item->quantity ?? 1 }}
          </td>
          <td align="right" style="padding: 12px 16px; font-size: 14px; font-weight: 600; color: #1e293b; border-top: 1px solid #f1f5f9;">
            {{ function_exists('displayPrice') ? displayPrice($item->price ?? 0) : number_format($item->price ?? 0, 2) }}
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr style="background: #f8fafc;">
          <td colspan="2" style="padding: 14px 16px; font-size: 14px; font-weight: 700; color: #0f172a; border-top: 2px solid #e2e8f0;">
            Total Order Amount
          </td>
          <td align="right" style="padding: 14px 16px; font-size: 16px; font-weight: 800; color: #2563eb; border-top: 2px solid #e2e8f0;">
            {{ function_exists('displayPrice') ? displayPrice($order->total ?? 0) : number_format($order->total ?? 0, 2) }}
          </td>
        </tr>
      </tfoot>
    </table>
    @else
    <!-- Total Amount Strip -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px 20px;">
      <tr>
        <td style="font-size: 14px; font-weight: 700; color: #0f172a;">Total Order Amount:</td>
        <td align="right" style="font-size: 18px; font-weight: 800; color: #2563eb;">
          {{ function_exists('displayPrice') ? displayPrice($order->total ?? 0) : number_format($order->total ?? 0, 2) }}
        </td>
      </tr>
    </table>
    @endif

    <!-- Shipping Address Card -->
    @if(!empty($order->shipping_address))
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
      <tr>
        <td style="padding: 12px 20px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">
            Shipping Address
          </span>
        </td>
      </tr>
      <tr>
        <td style="padding: 14px 20px; font-size: 14px; line-height: 22px; color: #334155;">
          {!! nl2br(e($order->shipping_address)) !!}
        </td>
      </tr>
    </table>
    @endif

    <!-- Action Button -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; text-align: center;">
      <tr>
        <td align="center">
          <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
            <tr>
              <td align="center" style="background: #2563eb; border-radius: 8px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);">
                <a href="{{ url('admin/orders') }}" target="_blank" style="display: inline-block; padding: 14px 36px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  Open Order in Admin Panel &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>
@endsection
