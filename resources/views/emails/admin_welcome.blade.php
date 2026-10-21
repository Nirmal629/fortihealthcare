@extends('backend.layouts.mail-layout')

@section('content')
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Welcome Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #eff6ff; border: 1px solid #dbeafe; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 0.8px;">
            🎉 Welcome to the Team
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Your Account is Ready
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;">{{ $name }}</strong>,
    </p>
    <p style="margin: 0 0 28px; font-size: 15px; line-height: 24px; color: #475569;">
      An administrative account has been created for you on the <strong>{{ config('app.name') }}</strong> administration portal. Below are your initial login credentials:
    </p>

    <!-- Credentials Card -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
      <tr>
        <td style="padding: 14px 20px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
          <span style="font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px;">
            Account Credentials
          </span>
        </td>
      </tr>
      <tr>
        <td style="padding: 18px 20px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td style="padding-bottom: 12px;">
                <span style="display: block; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 4px;">
                  Login Email
                </span>
                <span style="font-size: 15px; font-weight: 600; color: #0f172a;">
                  {{ $email }}
                </span>
              </td>
            </tr>
            <tr>
              <td style="border-top: 1px dashed #e2e8f0; padding-top: 12px;">
                <span style="display: block; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 4px;">
                  Temporary Password
                </span>
                <span style="font-family: ui-monospace, Menlo, Monaco, Consolas, monospace; font-size: 16px; font-weight: 700; color: #1e40af; background: #e0e7ff; padding: 4px 10px; border-radius: 6px; display: inline-block;">
                  {{ $password }}
                </span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 20px; background: #fffbeb; border-top: 1px solid #fef3c7;">
          <span style="font-size: 12px; font-weight: 600; color: #92400e;">
            ⚠️ For security purposes, please change this temporary password immediately after logging in.
          </span>
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
                <a href="{{ url('admin/login') }}" target="_blank" style="display: inline-block; padding: 14px 36px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  Login to Admin Portal &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Next Steps Checklist -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px;">
      <tr>
        <td style="padding: 16px 20px;">
          <span style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">
            Next Steps for Getting Started:
          </span>
          <table border="0" cellpadding="3" cellspacing="0" width="100%">
            <tr>
              <td style="font-size: 13px; color: #475569; vertical-align: top; width: 24px;">1.</td>
              <td style="font-size: 13px; color: #475569;">Sign in to the portal using your temporary credentials above.</td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #475569; vertical-align: top;">2.</td>
              <td style="font-size: 13px; color: #475569;">Navigate to <strong>Profile &rarr; Change Password</strong> to set your unique password.</td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #475569; vertical-align: top;">3.</td>
              <td style="font-size: 13px; color: #475569;">Review your notification and two-factor authentication settings.</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Support Help -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      If you have questions or experience any issues accessing your account, please reach out to the system administrator at 
      <a href="mailto:{{ config('app.support_email') }}" style="color: #2563eb; text-decoration: underline;">{{ config('app.support_email') }}</a>.
    </p>
  </td>
</tr>
@endsection
