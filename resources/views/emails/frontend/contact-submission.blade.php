@extends('emails.frontend.includes.layout')

@section('content')
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Inbound Inquiry Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #059669; text-transform: uppercase; letter-spacing: 0.8px;">
            💬 Inquiry Received
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Thank You for Reaching Out!
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;">{{ $data['name'] ?? 'Friend' }}</strong>,
    </p>
    <p style="margin: 0 0 28px; font-size: 15px; line-height: 24px; color: #475569;">
      We have received your message and appreciate you contacting <strong>{{ config('app.name') }}</strong>. Our support team is actively reviewing your request and will follow up with you as quickly as possible.
    </p>

    <!-- Inquiry Details Card -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
      <tr>
        <td style="padding: 14px 20px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
          <span style="font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px;">
            Your Message Summary
          </span>
        </td>
      </tr>
      <tr>
        <td style="padding: 18px 20px;">
          @if(!empty($data['phone']))
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 14px;">
            <tr>
              <td style="font-size: 13px; color: #64748b; width: 120px;">Contact Number:</td>
              <td style="font-size: 14px; font-weight: 600; color: #0f172a;">{{ $data['phone'] }}</td>
            </tr>
          </table>
          @endif

          @if(!empty($data['message']))
          <div>
            <span style="display: block; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 8px;">
              Submitted Message:
            </span>
            <div style="background: #ffffff; border-left: 3px solid #2563eb; padding: 14px 16px; border-radius: 0 8px 8px 0; font-size: 14px; line-height: 22px; color: #334155; font-style: italic;">
              "{{ $data['message'] }}"
            </div>
          </div>
          @endif
        </td>
      </tr>
      <tr>
        <td style="padding: 12px 20px; background: #eff6ff; border-top: 1px solid #dbeafe;">
          <span style="font-size: 12px; font-weight: 600; color: #1e40af;">
            ⚡ Average response time: Within 24 business hours (Monday – Friday).
          </span>
        </td>
      </tr>
    </table>

    <!-- Additional Info -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      If you have additional information to add or urgent questions, please feel free to email our customer care team directly at 
      <a href="mailto:{{ config('app.support_email') }}" style="color: #2563eb; text-decoration: underline;">{{ config('app.support_email') }}</a>.
    </p>
  </td>
</tr>
@endsection
