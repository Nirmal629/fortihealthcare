<?php $__env->startSection('content'); ?>
<?php
  $customerName = !empty(trim($user->name ?? '')) ? $user->name : (!empty(trim($user->first_name ?? '')) ? trim($user->first_name . ' ' . ($user->last_name ?? '')) : 'Valued Customer');
?>
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Cancellation Initiated Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #fffbeb; border: 1px solid #fef3c7; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #d97706; text-transform: uppercase; letter-spacing: 0.8px;">
            ⏳ Cancellation Initiated
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Cancellation Request Received
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;"><?php echo e($customerName); ?></strong>,
    </p>
    <p style="margin: 0 0 24px; font-size: 15px; line-height: 24px; color: #475569;">
      We have received your cancellation request for order <strong style="color: #0f172a;">#<?php echo e($order->order_number); ?></strong>. Our operations team is currently reviewing your order status to process this request.
    </p>

    <!-- Order Summary Card -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
      <tr>
        <td style="padding: 16px 20px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td>
                <span style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Order Number</span>
                <span style="display: block; font-size: 16px; font-weight: 800; color: #0f172a;">#<?php echo e($order->order_number); ?></span>
              </td>
              <td align="right">
                <span style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Order Amount</span>
                <span style="display: block; font-size: 18px; font-weight: 800; color: #2563eb;">
                  <?php echo e(function_exists('displayPrice') ? displayPrice($order->net_total) : ('₹' . number_format($order->net_total, 2))); ?>

                </span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9;">
          <table border="0" cellpadding="2" cellspacing="0" width="100%">
            <tr>
              <td style="font-size: 13px; color: #64748b; width: 40%;">Original Order Date:</td>
              <td style="font-size: 13px; font-weight: 600; color: #0f172a;">
                <?php echo e($order->created_at ? $order->created_at->format('d M Y, h:i A') : date('d M Y')); ?>

              </td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b;">Request Status:</td>
              <td style="font-size: 13px; font-weight: 700; color: #d97706;">
                Cancellation In Progress
              </td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b;">Payment Method:</td>
              <td style="font-size: 13px; font-weight: 600; color: #0f172a;">
                <?php echo e($order->payment_method == 0 ? 'Cash on Delivery (COD)' : 'Online Payment'); ?>

              </td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- Order Items Summary -->
      <?php if(!empty($order->orderProducts) && count($order->orderProducts)): ?>
      <tr>
        <td style="padding: 16px 20px;">
          <span style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
            Order Items
          </span>
          <table border="0" cellpadding="6" cellspacing="0" width="100%">
            <?php $__currentLoopData = $order->orderProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $itemName = $item->variant->name ?? ($item->variant->product->name ?? ($item->sku ?? 'Product Item'));
              $unitPrice = $item->sell_price ?? ($item->regular_price ?? 0);
              $lineTotal = $unitPrice * ($item->quantity ?? 1);
            ?>
            <tr>
              <td style="font-size: 14px; font-weight: 600; color: #1e293b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">
                <?php echo e($itemName); ?>

                <span style="font-size: 12px; font-weight: 400; color: #64748b;">&times; <?php echo e($item->quantity ?? 1); ?></span>
              </td>
              <td align="right" style="font-size: 14px; font-weight: 600; color: #1e293b; padding: 6px 0; border-bottom: 1px solid #f1f5f9;">
                <?php echo e(function_exists('displayPrice') ? displayPrice($lineTotal) : ('₹' . number_format($lineTotal, 2))); ?>

              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
        </td>
      </tr>
      <?php endif; ?>
    </table>

    <!-- Advisory / Process Card -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px 20px;">
      <tr>
        <td>
          <span style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
            What to expect:
          </span>
          <p style="margin: 0 0 6px; font-size: 13px; line-height: 20px; color: #475569;">
            • If your package has not left our dispatch center, the cancellation will be finalized immediately.
          </p>
          <p style="margin: 0 0 6px; font-size: 13px; line-height: 20px; color: #475569;">
            • If you paid online via Stripe or PayPal, your refund will be automatically scheduled to your original payment method once cancellation is confirmed.
          </p>
          <p style="margin: 0; font-size: 13px; line-height: 20px; color: #475569;">
            • You will receive another notification as soon as the cancellation status is finalized.
          </p>
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
                <a href="<?php echo e(route('order.details', ['order_number' => $order->order_number])); ?>" target="_blank" style="display: inline-block; padding: 14px 36px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  Check Order Status &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Support Help -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      Need urgent assistance regarding this cancellation? Contact our customer support team directly at 
      <a href="mailto:<?php echo e(config('app.support_email', 'fortiercustomersupport@gmail.com')); ?>" style="color: #2563eb; text-decoration: underline;"><?php echo e(config('app.support_email', 'fortiercustomersupport@gmail.com')); ?></a>.
    </p>
  </td>
</tr>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.frontend.includes.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/emails/frontend/order-cancellation-initiated.blade.php ENDPATH**/ ?>