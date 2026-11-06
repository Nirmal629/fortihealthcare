@extends('emails.frontend.includes.layout')

@section('content')
@php
  $resolvedCustomerName = (!empty($customerName) && strcasecmp(trim($customerName), 'guest') !== 0)
    ? $customerName
    : ((!empty($user->name) && strcasecmp(trim($user->name), 'guest') !== 0)
      ? $user->name
      : ((!empty($user->first_name) && strcasecmp(trim($user->first_name), 'guest') !== 0)
        ? trim($user->first_name . ' ' . ($user->last_name ?? ''))
        : 'Valued Customer'));

  $displayTime = $changedAt ?? now()->timezone(config('app.timezone', 'Asia/Kolkata'))->format('d M Y, h:i A T');
  $userEmail = $user->email ?? 'your registered email';
  $siteName = config('app.name', 'Fortier Healthcare');
  $loginLink = !empty($loginUrl) ? $loginUrl : route('signuplogin');
  $resetLink = !empty($resetUrl) ? $resetUrl : route('password.request');
  $contactEmail = config('app.support_email', 'fortiercustomersupport@gmail.com');
@endphp

<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Security Success Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 20px; padding: 5px 16px;">
          <span style="font-size: 12px; font-weight: 700; color: #059669; text-transform: uppercase; letter-spacing: 0.8px;">
            ✓ Security Notice
          </span>
        </td>
      </tr>
    </table>

    <!-- Main Heading -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Password Changed Successfully
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;">{{ $resolvedCustomerName }}</strong>,
    </p>
    <p style="margin: 0 0 24px; font-size: 15px; line-height: 24px; color: #475569;">
      This is a confirmation that the password for your <strong>{{ $siteName }}</strong> account has been updated successfully.
    </p>

    <!-- Activity Details Card -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
      <tr>
        <td style="padding: 14px 20px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.6px;">
            Security Event Summary
          </span>
        </td>
      </tr>
      <tr>
        <td style="padding: 18px 20px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td style="padding: 6px 0; font-size: 14px; color: #64748b; width: 140px; vertical-align: top;">Account Email:</td>
              <td style="padding: 6px 0; font-size: 14px; color: #0f172a; font-weight: 600;">{{ $userEmail }}</td>
            </tr>
            <tr>
              <td style="padding: 6px 0; font-size: 14px; color: #64748b; vertical-align: top;">Date &amp; Time:</td>
              <td style="padding: 6px 0; font-size: 14px; color: #0f172a; font-weight: 600;">{{ $displayTime }}</td>
            </tr>
            @if(!empty($deviceInfo))
            <tr>
              <td style="padding: 6px 0; font-size: 14px; color: #64748b; vertical-align: top;">Device / Agent:</td>
              <td style="padding: 6px 0; font-size: 13px; color: #475569; word-break: break-all;">{{ \Illuminate\Support\Str::limit($deviceInfo, 90) }}</td>
            </tr>
            @endif
            <tr>
              <td style="padding: 6px 0; font-size: 14px; color: #64748b; vertical-align: top;">Status:</td>
              <td style="padding: 6px 0; font-size: 14px; color: #059669; font-weight: 700;">
                <span style="display: inline-block; background: #d1fae5; color: #065f46; border-radius: 4px; padding: 2px 8px; font-size: 12px;">Active &amp; Secured</span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Security Warning Box if User Didn't Initiate -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; background: #fffbeb; border: 1px solid #fef3c7; border-left: 4px solid #f59e0b; border-radius: 8px;">
      <tr>
        <td style="padding: 16px 18px;">
          <p style="margin: 0 0 6px; font-size: 14px; font-weight: 700; color: #92400e;">
            ⚠️ Did you make this change?
          </p>
          <p style="margin: 0; font-size: 13px; line-height: 20px; color: #78350f;">
            If you made this change, no further action is required and you can safely disregard this email.<br />
            <strong>If you did NOT change your password</strong>, someone else may have gained access to your account. Please reset your password immediately or contact our customer support team right away.
          </p>
        </td>
      </tr>
    </table>

    <!-- Action Buttons -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; text-align: center;">
      <tr>
        <td align="center">
          <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
            <tr>
              <td align="center" style="background: #0f172a; border-radius: 8px; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);">
                <a href="{{ $loginLink }}" target="_blank" style="display: inline-block; padding: 14px 34px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 14px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  Sign In to Your Account &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Urgent Security Help Link -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px;">
      <tr>
        <td style="border-top: 1px solid #f1f5f9; padding-top: 18px; text-align: center;">
          <p style="margin: 0; font-size: 13px; color: #64748b;">
            Didn't authorize this update? 
            <a href="{{ $resetLink }}" style="color: #dc2626; font-weight: 700; text-decoration: underline;">
              Reset your password now
            </a>
          </p>
        </td>
      </tr>
    </table>

    <!-- Best Practices / Security Tips -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;">
      <tr>
        <td style="padding: 18px 20px;">
          <span style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px;">
            Security Recommendations:
          </span>
          <table border="0" cellpadding="4" cellspacing="0" width="100%">
            <tr>
              <td style="font-size: 13px; color: #334155; vertical-align: top; width: 24px;">•</td>
              <td style="font-size: 13px; color: #475569;">Use a unique password that you do not use on any other website.</td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #334155; vertical-align: top;">•</td>
              <td style="font-size: 13px; color: #475569;">Never share your password, login credentials, or verification OTP with anyone.</td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #334155; vertical-align: top;">•</td>
              <td style="font-size: 13px; color: #475569;">Regularly review your recent orders and delivery addresses in your account.</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Support Information -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      Need immediate assistance? Our support team is here to help. Contact us anytime at 
      <a href="mailto:{{ $contactEmail }}" style="color: #2563eb; text-decoration: underline; font-weight: 600;">{{ $contactEmail }}</a>.
    </p>
  </td>
</tr>
@endsection
