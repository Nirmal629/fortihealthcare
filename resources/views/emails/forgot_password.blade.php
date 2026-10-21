@extends('backend.layouts.mail-layout')

@section('content')
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Security Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #eff6ff; border: 1px solid #dbeafe; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 0.8px;">
            🔑 Password Assistance
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Reset Your Password
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;">{{ $name ?? 'there' }}</strong>,
    </p>
    <p style="margin: 0 0 28px; font-size: 15px; line-height: 24px; color: #475569;">
      We received a request to reset the password for your account on <strong>{{ config('app.name') }}</strong>. Click the button below to choose a new password:
    </p>

    <!-- Action Button -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; text-align: center;">
      <tr>
        <td align="center">
          <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
            <tr>
              <td align="center" style="background: #2563eb; border-radius: 8px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);">
                <a href="{{ $resetUrl }}" target="_blank" style="display: inline-block; padding: 14px 36px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  Reset Password Now &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Expiry info -->
    <p style="margin: 0 0 28px; font-size: 13px; line-height: 20px; color: #64748b; text-align: center;">
      ⏳ This password reset link is valid for <strong>60 minutes</strong>.
    </p>

    <!-- Security Activity Details Card -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
      <tr>
        <td style="padding: 14px 20px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
          <span style="font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px;">
            Request Activity Details
          </span>
        </td>
      </tr>
      <tr>
        <td style="padding: 12px 20px;">
          <table border="0" cellpadding="6" cellspacing="0" width="100%">
            <tr>
              <td style="font-size: 13px; color: #64748b; width: 38%; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">Date &amp; Time</td>
              <td style="font-size: 13px; font-weight: 600; color: #1e293b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">{{ $date_time }} (UTC)</td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">Device &amp; OS</td>
              <td style="font-size: 13px; font-weight: 600; color: #1e293b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">{{ ucfirst($device ?? 'Unknown') }} ({{ $os ?? 'Unknown' }})</td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">Browser</td>
              <td style="font-size: 13px; font-weight: 600; color: #1e293b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">{{ $browser ?? 'Unknown' }}</td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b; padding: 6px 0; {{ !empty($location) ? 'border-bottom: 1px solid #f1f5f9;' : '' }}">IP Address</td>
              <td style="font-size: 13px; font-weight: 600; color: #1e293b; padding: 6px 0; {{ !empty($location) ? 'border-bottom: 1px solid #f1f5f9;' : '' }}">
                <span style="font-family: monospace; background: #e2e8f0; padding: 2px 6px; border-radius: 4px; font-size: 12px;">{{ $ip_address }}</span>
              </td>
            </tr>
            @if(!empty($location))
            <tr>
              <td style="font-size: 13px; color: #64748b; padding: 6px 0;">Location</td>
              <td style="font-size: 13px; font-weight: 600; color: #1e293b; padding: 6px 0;">{{ $location }}</td>
            </tr>
            @endif
          </table>
        </td>
      </tr>
    </table>

    <!-- Direct URL fallback -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px;">
      <tr>
        <td style="border-top: 1px solid #f1f5f9; padding-top: 18px;">
          <p style="margin: 0 0 6px; font-size: 12px; color: #94a3b8;">
            Having trouble clicking the button? Copy and paste this URL into your web browser:
          </p>
          <p style="margin: 0; font-size: 12px; word-break: break-all; color: #2563eb; font-family: monospace;">
            <a href="{{ $resetUrl }}" style="color: #2563eb; text-decoration: underline;">{{ $resetUrl }}</a>
          </p>
        </td>
      </tr>
    </table>

    <!-- Security Warning -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      If you did not request a password reset, you can safely ignore this email; your account remains secure. If you suspect unauthorized access, please reach out immediately to 
      <a href="mailto:{{ config('app.support_email') }}" style="color: #2563eb; text-decoration: underline;">{{ config('app.support_email') }}</a>.
    </p>
  </td>
</tr>
@endsection
