@extends('emails.frontend.includes.layout')

@section('content')
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Newsletter Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #eff6ff; border: 1px solid #dbeafe; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 0.8px;">
            📬 Newsletter Confirmation
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Please Confirm Your Subscription
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello there,
    </p>
    <p style="margin: 0 0 24px; font-size: 15px; line-height: 24px; color: #475569;">
      Thank you for subscribing to the <strong>{{ config('app.name') }}</strong> newsletter! To ensure we have the correct email address and comply with privacy standards, please confirm your subscription below:
    </p>

    <!-- Value Highlights -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px 20px;">
      <tr>
        <td>
          <span style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
            What to expect in your inbox:
          </span>
          <p style="margin: 0 0 4px; font-size: 13px; color: #475569;">✨ First look at newly released collections and catalog arrivals</p>
          <p style="margin: 0 0 4px; font-size: 13px; color: #475569;">🏷️ Subscriber-only coupon codes and flash sale discounts</p>
          <p style="margin: 0; font-size: 13px; color: #475569;">🎁 Birthday surprises and customer loyalty point drops</p>
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
                <a href="{{ $confirmationUrl }}" target="_blank" style="display: inline-block; padding: 14px 36px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  Confirm My Subscription &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Expiry info -->
    <p style="margin: 0 0 24px; font-size: 13px; line-height: 20px; color: #64748b; text-align: center;">
      ⏳ This confirmation link will expire in <strong>60 minutes</strong>.
    </p>

    <!-- Fallback URL -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px;">
      <tr>
        <td style="border-top: 1px solid #f1f5f9; padding-top: 18px;">
          <p style="margin: 0 0 6px; font-size: 12px; color: #94a3b8;">
            Button not working? Copy and paste this URL into your browser:
          </p>
          <p style="margin: 0; font-size: 12px; word-break: break-all; color: #2563eb; font-family: monospace;">
            <a href="{{ $confirmationUrl }}" style="color: #2563eb; text-decoration: underline;">{{ $confirmationUrl }}</a>
          </p>
        </td>
      </tr>
    </table>

    <!-- Unsubscribe / Ignored note -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      If you did not request this newsletter subscription, you can safely ignore this email; you will not be added to our mailing list.
    </p>
  </td>
</tr>
@endsection
