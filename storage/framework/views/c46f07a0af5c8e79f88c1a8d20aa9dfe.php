<?php $__env->startSection('content'); ?>
<?php
  $shipping = is_array($order->shipping_address) ? $order->shipping_address : json_decode($order->shipping_address, true);
  $resolvedCustomerName = (!empty($customerName) && strcasecmp(trim($customerName), 'guest') !== 0)
    ? $customerName
    : ((!empty($user->name) && strcasecmp(trim($user->name), 'guest') !== 0)
      ? $user->name
      : ((!empty($user->first_name) && strcasecmp(trim($user->first_name), 'guest') !== 0)
        ? trim($user->first_name . ' ' . ($user->last_name ?? ''))
        : ((!empty($shipping['name']) && strcasecmp(trim($shipping['name']), 'guest') !== 0)
          ? $shipping['name']
          : 'Valued Customer')));
?>
<tr>
  <td class="mobile-padding" style="padding: 36px 40px 32px;">
    <!-- Confirmation Badge -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
      <tr>
        <td style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 20px; padding: 4px 14px;">
          <span style="font-size: 12px; font-weight: 700; color: #059669; text-transform: uppercase; letter-spacing: 0.8px;">
            ✓ Order Confirmed
          </span>
        </td>
      </tr>
    </table>

    <!-- Title -->
    <h1 style="margin: 0 0 16px; font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; letter-spacing: -0.4px;">
      Thank You for Your Order!
    </h1>

    <!-- Greeting & Message -->
    <p style="margin: 0 0 16px; font-size: 15px; line-height: 24px; color: #334155;">
      Hello <strong style="color: #0f172a;"><?php echo e($resolvedCustomerName); ?></strong>,
    </p>
    <p style="margin: 0 0 28px; font-size: 15px; line-height: 24px; color: #475569;">
      Great news! We have received your order and our fulfillment team is preparing it with care. You can find your order overview and tracking link below:
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
                <span style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Order Total</span>
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
              <td style="font-size: 13px; color: #64748b; width: 40%;">Order Date:</td>
              <td style="font-size: 13px; font-weight: 600; color: #0f172a;">
                <?php echo e($order->created_at ? $order->created_at->format('d M Y, h:i A') : date('d M Y, h:i A')); ?>

              </td>
            </tr>
            <?php
              $isCod = ($order->payment_method == 0 || strcasecmp((string)$order->payment_method, 'cod') === 0);
              $isPaid = (!$isCod && (int)$order->payment_status === 1);
            ?>
            <tr>
              <td style="font-size: 13px; color: #64748b;">Payment Method:</td>
              <td style="font-size: 13px; font-weight: 600; color: #0f172a;">
                <?php echo e($isCod ? 'Cash on Delivery' : 'Online Payment'); ?>

              </td>
            </tr>
            <tr>
              <td style="font-size: 13px; color: #64748b;">Payment Status:</td>
              <td style="font-size: 13px; font-weight: 600; color: <?php echo e($isPaid ? '#059669' : '#d97706'); ?>;">
                <?php echo e($isPaid ? 'Paid' : 'Payment Pending'); ?>

              </td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- Order Items -->
      <?php if(!empty($order->orderProducts) && count($order->orderProducts)): ?>
      <tr>
        <td style="padding: 16px 20px;">
          <span style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
            Purchased Items
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

      <!-- Shipping Address Preview -->
      <?php if(!empty($shipping['address'])): ?>
      <tr>
        <td style="padding: 14px 20px; background: #ffffff; border-top: 1px solid #e2e8f0;">
          <span style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
            Shipping Address
          </span>
          <p style="margin: 0; font-size: 13px; line-height: 18px; color: #475569;">
            <?php echo e($shipping['name'] ?? $customerName); ?><br/>
            <?php echo e($shipping['address']); ?>

            <?php if(!empty($shipping['phone'])): ?><br/>Phone: <?php echo e($shipping['phone']); ?><?php endif; ?>
          </p>
        </td>
      </tr>
      <?php endif; ?>
    </table>

    <!-- Action Button -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 28px; text-align: center;">
      <tr>
        <td align="center">
          <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
            <tr>
              <td align="center" style="background: #2563eb; border-radius: 8px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);">
                <a href="<?php echo e(route('order.details', ['order_number' => $order->order_number])); ?>" target="_blank" style="display: inline-block; padding: 14px 36px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px;">
                  View &amp; Track Order Details &rarr;
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Order Timeline / Next Steps -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 0 24px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px;">
      <tr>
        <td>
          <span style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px;">
            What happens next?
          </span>
          <p style="margin: 0 0 6px; font-size: 13px; color: #475569;">
            <strong>1. Order Processing:</strong> Our pharmaceutical logistics team is verifying and preparing your medicines.
          </p>
          <p style="margin: 0 0 6px; font-size: 13px; color: #475569;">
            <strong>2. Shipping Notification:</strong> You will receive an email update with tracking details once your package is dispatched.
          </p>
          <p style="margin: 0; font-size: 13px; color: #475569;">
            <strong>3. Delivery:</strong> Inspect your package upon arrival and reach out if you have any questions.
          </p>
        </td>
      </tr>
    </table>

    <!-- Support Help -->
    <p style="margin: 0; font-size: 13px; line-height: 20px; color: #64748b;">
      Need to modify your order or have questions? Contact our customer support team at 
      <a href="mailto:<?php echo e(config('app.support_email', 'fortiercustomersupport@gmail.com')); ?>" style="color: #2563eb; text-decoration: underline;"><?php echo e(config('app.support_email', 'fortiercustomersupport@gmail.com')); ?></a>.
    </p>
  </td>
</tr>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.frontend.includes.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/emails/frontend/order-confirmation.blade.php ENDPATH**/ ?>