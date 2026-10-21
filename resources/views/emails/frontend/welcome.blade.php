@extends('emails.frontend.includes.layout')

@section('content')
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Welcome Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #eff6ff; border: 1px solid #dbeafe; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 0.8px;">
            🎉 Welcome Aboard
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Welcome to {{ config('app.name', 'Maroon Crane') }}!
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;">{{ $user->name }}</strong>,
    </p>
    <p style="margin: 0 0 24px; font-size: 15px; line-height: 24px; color: #475569;">
      Thank you for creating an account with us. We're thrilled to have you as part of our community. Your account is now active and ready to use!
    </p>

    <!-- Value Highlights Box -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;">
      <tr>
        <td style="padding: 20px;">
          <span style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
            What you can do with your account:
          </span>
          <table border="0" cellpadding="4" cellspacing="0" width="100%">
            <tr>
              <td style="font-size: 14px; color: #334155; vertical-align: top; width: 28px;">🛍️</td>
              <td style="font-size: 14px; color: #334155;"><strong>Curated Catalog:</strong> Explore exclusive collections and latest arrivals.</td>
            </tr>
            <tr>
              <td style="font-size: 14px; color: #334155; vertical-align: top;">🚚</td>
              <td style="font-size: 14px; color: #334155;"><strong>Real-time Tracking:</strong> Follow your orders from dispatch right to your doorstep.</td>
            </tr>
            <tr>
              <td style="font-size: 14px; color: #334155; vertical-align: top;">🎁</td>
              <td style="font-size: 14px; color: #334155;"><strong>Exclusive Rewards:</strong> Earn rewards and redeem special promotional discounts.</td>
            </tr>
          </table>
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
                <a href="{{ route('signuplogin') }}" target="_blank" style="display: inline-block; padding: 14px 36px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  Sign In &amp; Start Shopping &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Support Help -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      Have questions or need help getting started? Check out our online store or contact our customer support team at 
      <a href="mailto:{{ config('app.support_email') }}" style="color: #2563eb; text-decoration: underline;">{{ config('app.support_email') }}</a>.
    </p>
  </td>
</tr>
@endsection
