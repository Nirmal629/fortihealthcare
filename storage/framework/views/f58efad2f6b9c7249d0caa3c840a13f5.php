<?php $__env->startSection('content'); ?>
<?php
  $resetUrl = url('/reset-password/' . $token) . '?email=' . urlencode($user->email);
?>

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

<?php
  $customerName = (!empty($user->name) && strcasecmp(trim($user->name), 'guest') !== 0)
    ? $user->name
    : ((!empty($user->first_name) && strcasecmp(trim($user->first_name), 'guest') !== 0)
      ? trim($user->first_name . ' ' . ($user->last_name ?? ''))
      : 'Valued Customer');
?>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;"><?php echo e($customerName); ?></strong>,
    </p>
    <p style="margin: 0 0 28px; font-size: 15px; line-height: 24px; color: #475569;">
      We received a request to reset the password for your customer account on <strong><?php echo e(config('app.name')); ?></strong>. Click the button below to choose your new password:
    </p>

    <!-- Action Button -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; text-align: center;">
      <tr>
        <td align="center">
          <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
            <tr>
              <td align="center" style="background: #2563eb; border-radius: 8px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);">
                <a href="<?php echo e($resetUrl); ?>" target="_blank" style="display: inline-block; padding: 14px 36px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  Reset Password &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Expiry Box -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 8px;">
      <tr>
        <td style="padding: 14px 18px;">
          <p style="margin: 0; font-size: 13px; line-height: 20px; color: #92400e;">
            ⏳ <strong>Notice:</strong> This password reset link is strictly confidential and will expire in <strong>60 minutes</strong>.
          </p>
        </td>
      </tr>
    </table>

    <!-- Direct URL fallback -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px;">
      <tr>
        <td style="border-top: 1px solid #f1f5f9; padding-top: 18px;">
          <p style="margin: 0 0 6px; font-size: 12px; color: #94a3b8;">
            Button not working? Copy and paste the link below directly into your web browser:
          </p>
          <p style="margin: 0; font-size: 12px; word-break: break-all; color: #2563eb; font-family: monospace;">
            <a href="<?php echo e($resetUrl); ?>" style="color: #2563eb; text-decoration: underline;"><?php echo e($resetUrl); ?></a>
          </p>
        </td>
      </tr>
    </table>

    <!-- Security Info -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      If you did not request this password reset, no action is required and your account remains secure. If you have concerns, please contact us at 
      <a href="mailto:<?php echo e(config('app.support_email')); ?>" style="color: #2563eb; text-decoration: underline;"><?php echo e(config('app.support_email')); ?></a>.
    </p>
  </td>
</tr>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.frontend.includes.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/emails/frontend/custom-reset-password.blade.php ENDPATH**/ ?>