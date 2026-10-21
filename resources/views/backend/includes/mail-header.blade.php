@php
  $siteLogoUrl = function_exists('siteLogo') ? siteLogo() : null;
  $appName = config('app.name', 'Maroon Crane');
@endphp

<!-- Header Row -->
<tr>
  <td style="padding: 36px 40px 24px; text-align: center; background: #ffffff; border-bottom: 1px solid #f1f5f9;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td align="center">
          <a href="{{ config('app.url', '#') }}" target="_blank" style="text-decoration: none; display: inline-block;">
            @if(!empty($siteLogoUrl) && !str_contains($siteLogoUrl, '.svg'))
              <img src="{{ $siteLogoUrl }}" alt="{{ $appName }}" style="max-height: 48px; max-width: 220px; height: auto; border: 0; outline: none; text-decoration: none; vertical-align: middle;" />
            @else
              <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                <tr>
                  <td style="background: linear-gradient(135deg, #2563eb, #1d4ed8); width: 42px; height: 42px; border-radius: 10px; text-align: center; vertical-align: middle; color: #ffffff; font-size: 22px; font-weight: 800; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                    {{ strtoupper(substr($appName, 0, 1)) }}
                  </td>
                  <td style="padding-left: 12px; text-align: left; vertical-align: middle;">
                    <span style="font-size: 22px; font-weight: 800; color: #0f172a; letter-spacing: -0.5px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; display: block; line-height: 1.2;">{{ $appName }}</span>
                    <span style="font-size: 11px; font-weight: 600; color: #64748b; letter-spacing: 1px; text-transform: uppercase; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; display: block;">Administration Portal</span>
                  </td>
                </tr>
              </table>
            @endif
          </a>
        </td>
      </tr>
    </table>
  </td>
</tr>
