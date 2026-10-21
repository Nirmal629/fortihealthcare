@extends('emails.frontend.includes.layout')

@section('content')
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Threshold Warning Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #fffbeb; border: 1px solid #fef3c7; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #b45309; text-transform: uppercase; letter-spacing: 0.8px;">
            ⚠️ Low Stock Threshold Alert
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Inventory Action Required
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;">Administrator</strong>,
    </p>
    <p style="margin: 0 0 28px; font-size: 15px; line-height: 24px; color: #475569;">
      This automated alert notifies you that an inventory item on <strong>{{ config('app.name') }}</strong> has reached or dropped below its low-stock threshold limit.
    </p>

    <!-- Inventory Details Card -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
      <tr>
        <td style="padding: 14px 20px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
          <span style="font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px;">
            Affected Item Details
          </span>
        </td>
      </tr>
      <tr>
        <td style="padding: 18px 20px;">
          <table border="0" cellpadding="6" cellspacing="0" width="100%">
            <tr>
              <td style="font-size: 13px; color: #64748b; width: 38%; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">Product</td>
              <td style="font-size: 14px; font-weight: 700; color: #0f172a; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">
                {{ $inventory->product->name ?? 'N/A' }}
              </td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">Variant</td>
              <td style="font-size: 14px; font-weight: 600; color: #1e293b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">
                {{ $inventory->variant->name ?? 'Default' }}
              </td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">SKU</td>
              <td style="font-size: 13px; font-weight: 600; font-family: monospace; color: #1e40af; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">
                {{ $inventory->variant->sku ?? '-' }}
              </td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b; padding: 6px 0;">Current Stock</td>
              <td style="padding: 6px 0;">
                <span style="display: inline-block; background: #fee2e2; color: #b91c1c; font-size: 14px; font-weight: 800; padding: 3px 10px; border-radius: 6px;">
                  {{ $inventory->quantity }} Remaining
                </span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Action Button -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; text-align: center;">
      <tr>
        <td align="center">
          <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
            <tr>
              <td align="center" style="background: #2563eb; border-radius: 8px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);">
                <a href="{{ url('admin/inventory') }}" target="_blank" style="display: inline-block; padding: 14px 36px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  Update Stock in Inventory &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      Please replenish stock or adjust availability to prevent backorders or checkout interruptions.
    </p>
  </td>
</tr>
@endsection
