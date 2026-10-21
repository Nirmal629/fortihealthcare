@extends('backend.layouts.mail-layout')

@section('content')
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Security Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #eff6ff; border: 1px solid #dbeafe; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 0.8px;">
            🔒 Security Verification
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Your One-Time Password
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;">{{ $name ?? 'there' }}</strong>,
    </p>
    <p style="margin: 0 0 28px; font-size: 15px; line-height: 24px; color: #475569;">
      We received a request to log into your account. To proceed, please use the verification code below:
    </p>

    <!-- OTP Card Box -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center;">
      <tr>
        <td style="padding: 28px 20px;">
          <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; color: #64748b; margin-bottom: 10px;">
            One-Time Password (OTP)
          </div>
          <div style="font-family: ui-monospace, 'SFMono-Regular', Menlo, Monaco, Consolas, monospace; font-size: 38px; font-weight: 800; letter-spacing: 10px; color: #1e40af; line-height: 1.2;">
            {{ $otp }}
          </div>
          <div style="margin-top: 10px; font-size: 13px; color: #64748b; font-weight: 500;">
            ⏳ Valid for the next <strong>10 minutes</strong>
          </div>
        </td>
      </tr>
    </table>

    <!-- Security Advisory Box -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 8px;">
      <tr>
        <td style="padding: 14px 18px;">
          <p style="margin: 0; font-size: 13px; line-height: 20px; color: #92400e;">
            <strong>Security Notice:</strong> Never share this code with anyone. Our support team will never ask for your verification code or password.
          </p>
        </td>
      </tr>
    </table>

    <!-- Fallback / Assistance -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      If you did not initiate this login attempt, please ignore this email or notify us immediately at 
      <a href="mailto:{{ config('app.support_email') }}" style="color: #2563eb; text-decoration: underline;">{{ config('app.support_email') }}</a>.
    </p>
  </td>
</tr>
@endsection
