@php
  $siteLogoUrl = function_exists('siteLogo') ? siteLogo() : null;
  $rawAppName = config('app.name', 'Fortier Healthcare');
  $appName = ($rawAppName === 'Laravel' || $rawAppName === 'Maroon Crane') ? 'Fortier Healthcare' : ucwords(strtolower($rawAppName));
  $appUrl = config('app.url', '#');
@endphp

<!-- Header Row with Theme-Based Background & Properly Centered Website-Type Logo -->
<tr>
  <td align="center" bgcolor="#f0b334" style="padding: 26px 20px; text-align: center; background-color: #f0b334; background: linear-gradient(135deg, #f0b334 0%, #e09e1f 100%); border-top-left-radius: 12px; border-top-right-radius: 12px; border-bottom: 3px solid #d99316;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto; text-align: center;">
      <tr>
        <td align="center" style="text-align: center;">
          <a href="{{ $appUrl }}" target="_blank" style="text-decoration: none; display: inline-block;">
            <!-- Website-Style Logo Card (matching website furniture__headerlogo design) -->
            <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12); border: 1px solid rgba(255, 255, 255, 0.5);">
              <tr>
                <td style="padding: 8px 18px; vertical-align: middle;">
                  <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                    <tr>
                      @if(!empty($siteLogoUrl) && !str_contains($siteLogoUrl, '.svg'))
                        <td style="vertical-align: middle; padding-right: 12px;">
                          <img src="{{ $siteLogoUrl }}" alt="{{ $appName }}" height="44" style="height: 44px; max-height: 44px; max-width: 130px; width: auto; display: block; border: 0; outline: none; text-decoration: none; border-radius: 4px; object-fit: contain;" />
                        </td>
                      @else
                        <td style="vertical-align: middle; padding-right: 12px;">
                          <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td style="background-color: #f0b334; width: 38px; height: 38px; border-radius: 6px; text-align: center; vertical-align: middle; color: #ffffff; font-size: 20px; font-weight: 800; font-family: 'Poppins', -apple-system, BlinkMacSystemFont, Arial, sans-serif;">
                                {{ strtoupper(substr($appName, 0, 1)) }}
                              </td>
                            </tr>
                          </table>
                        </td>
                      @endif
                      <td style="vertical-align: middle; text-align: left;">
                        <span style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; font-size: 19px; font-weight: 800; color: #111827; letter-spacing: -0.4px; line-height: 1.15; display: block; margin: 0;">
                          {{ $appName }}
                        </span>
                        <span style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; font-size: 10px; font-weight: 700; color: #f0b334; letter-spacing: 1.5px; text-transform: uppercase; display: block; margin-top: 2px;">
                          Administration Portal
                        </span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </a>
        </td>
      </tr>
    </table>
  </td>
</tr>
