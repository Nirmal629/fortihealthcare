@php
  $appName = config('app.name', 'Maroon Crane');
  $supportEmail = config('app.support_email', 'support@marooncrane.com');
  $appUrl = config('app.url', '#');
@endphp

<!-- Footer Row -->
<tr>
  <td style="padding: 28px 40px 36px; background: #ffffff; border-top: 1px solid #f1f5f9;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td style="padding-bottom: 20px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td style="vertical-align: top; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                <p style="margin: 0 0 4px; font-size: 14px; font-weight: 500; color: #64748b;">Warm regards,</p>
                <p style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">The {{ $appName }} Team</p>
              </td>
              <td style="vertical-align: top; text-align: right; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                <a href="mailto:{{ $supportEmail }}" style="display: inline-block; font-size: 13px; font-weight: 600; color: #2563eb; text-decoration: none; padding: 6px 14px; background: #eff6ff; border-radius: 6px;">
                  Need Help? Contact Support
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="border-top: 1px dashed #e2e8f0; padding-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
          <p style="margin: 0 0 8px; font-size: 12px; line-height: 18px; color: #94a3b8; text-align: center;">
            This is an automated system notification regarding your account on <a href="{{ $appUrl }}" target="_blank" style="color: #64748b; text-decoration: underline;">{{ $appName }}</a>.
            Please do not reply directly to this email.
          </p>
          <p style="margin: 0; font-size: 12px; color: #94a3b8; text-align: center;">
            &copy; {{ date('Y') }} {{ $appName }}. All rights reserved.
          </p>
        </td>
      </tr>
    </table>
  </td>
</tr>
