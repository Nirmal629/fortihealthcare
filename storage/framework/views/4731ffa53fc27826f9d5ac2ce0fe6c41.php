<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="format-detection" content="telephone=no, date=no, address=no, email=no" />
  <meta name="color-scheme" content="light" />
  <title><?php echo e(config('app.name', 'Maroon Crane')); ?></title>
  <!--[if mso]>
  <style type="text/css">
    body, table, td, p, a, span { font-family: Arial, Helvetica, sans-serif !important; }
  </style>
  <![endif]-->
  <style type="text/css">
    /* Email Resets */
    body, table, td, p, a, li, blockquote {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }
    table, td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }
    img {
      -ms-interpolation-mode: bicubic;
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
    }
    body {
      margin: 0 !important;
      padding: 0 !important;
      width: 100% !important;
      background-color: #f1f5f9;
      color: #334155;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      line-height: 1.6;
    }
    @media only screen and (max-width: 640px) {
      .email-container {
        width: 100% !important;
        max-width: 100% !important;
        border-radius: 0 !important;
      }
      .mobile-padding {
        padding-left: 20px !important;
        padding-right: 20px !important;
      }
      .mobile-stack {
        display: block !important;
        width: 100% !important;
        text-align: center !important;
      }
      .mobile-hide {
        display: none !important;
      }
    }
  </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; -webkit-font-smoothing: antialiased;">
  <?php
    $siteLogoUrl = function_exists('siteLogo') ? siteLogo() : null;
    $appName = config('app.name', 'Maroon Crane');
    $supportEmail = config('app.support_email', 'support@marooncrane.com');
    $appUrl = config('app.url', '#');
  ?>

  <!-- Full Background Wrapper -->
  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; table-layout: fixed;">
    <tr>
      <td align="center" style="padding: 32px 16px 40px;">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->

        <!-- Main Email Container -->
        <table class="email-container" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(15, 23, 42, 0.06); border: 1px solid #e2e8f0; margin: 0 auto;">
          <!-- Header -->
          <tr>
            <td style="padding: 36px 40px 24px; text-align: center; background: #ffffff; border-bottom: 1px solid #f1f5f9;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td align="center">
                    <a href="<?php echo e($appUrl); ?>" target="_blank" style="text-decoration: none; display: inline-block;">
                      <?php if(!empty($siteLogoUrl) && !str_contains($siteLogoUrl, '.svg')): ?>
                        <img src="<?php echo e($siteLogoUrl); ?>" alt="<?php echo e($appName); ?>" style="max-height: 48px; max-width: 220px; height: auto; border: 0; outline: none; text-decoration: none; vertical-align: middle;" />
                      <?php else: ?>
                        <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                          <tr>
                            <td style="background: linear-gradient(135deg, #2563eb, #1d4ed8); width: 42px; height: 42px; border-radius: 10px; text-align: center; vertical-align: middle; color: #ffffff; font-size: 22px; font-weight: 800; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                              <?php echo e(strtoupper(substr($appName, 0, 1))); ?>

                            </td>
                            <td style="padding-left: 12px; text-align: left; vertical-align: middle;">
                              <span style="font-size: 22px; font-weight: 800; color: #0f172a; letter-spacing: -0.5px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; display: block; line-height: 1.2;"><?php echo e($appName); ?></span>
                              <span style="font-size: 11px; font-weight: 600; color: #64748b; letter-spacing: 0.5px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; display: block;">Official E-Commerce Store</span>
                            </td>
                          </tr>
                        </table>
                      <?php endif; ?>
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Dynamic Body Content -->
          <?php echo $__env->yieldContent('content'); ?>

          <!-- Value / Trust Badges Strip -->
          <tr>
            <td style="padding: 20px 30px; background: #f8fafc; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td align="center" style="font-size: 12px; font-weight: 600; color: #64748b; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                    <span style="display: inline-block; margin: 4px 10px;">🔒 100% Secure Checkout</span>
                    <span style="display: inline-block; margin: 4px 10px;">📦 Fast Delivery</span>
                    <span style="display: inline-block; margin: 4px 10px;">💬 24/7 Support</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding: 28px 40px 36px; background: #ffffff;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td style="padding-bottom: 20px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td class="mobile-stack" style="vertical-align: top; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                          <p style="margin: 0 0 4px; font-size: 14px; font-weight: 500; color: #64748b;">Warm regards,</p>
                          <p style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">The <?php echo e($appName); ?> Team</p>
                        </td>
                        <td class="mobile-stack" style="vertical-align: top; text-align: right; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; padding-top: 10px;">
                          <a href="mailto:<?php echo e($supportEmail); ?>" style="display: inline-block; font-size: 13px; font-weight: 600; color: #2563eb; text-decoration: none; padding: 6px 14px; background: #eff6ff; border-radius: 6px;">
                            Contact Customer Support
                          </a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="border-top: 1px dashed #e2e8f0; padding-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                    <p style="margin: 0 0 8px; font-size: 12px; line-height: 18px; color: #94a3b8; text-align: center;">
                      You received this email because of activity associated with your account on 
                      <a href="<?php echo e($appUrl); ?>" target="_blank" style="color: #64748b; text-decoration: underline;"><?php echo e($appName); ?></a>.
                    </p>
                    <p style="margin: 0; font-size: 12px; color: #94a3b8; text-align: center;">
                      &copy; <?php echo e(date('Y')); ?> <?php echo e($appName); ?>. All rights reserved.
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>

        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
  </table>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/emails/frontend/includes/layout.blade.php ENDPATH**/ ?>