<?php $__env->startPush('styles'); ?>
  <style>
    .tooltip-inner {
      background-color: #333;
      color: #fff;
      font-size: 14px;
      padding: 8px 12px;
      border-radius: 6px;
    }

    .tooltip.bs-tooltip-top .tooltip-arrow::before {
      border-top-color: #333;
    }
  </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title', @$title); ?>

<?php $__env->startSection('content'); ?>
  <section class="furniture_cart_wrap">
    <div class="container-xxl">

      
      <div class="cart_stepper_wrap">
        <a href="<?php echo e(route('cart.index')); ?>" class="cart_stepper_item text-decoration-none">
          <span class="step_num">1</span>
          <span class="step_text">Shopping Cart</span>
        </a>
        <div class="cart_stepper_divider"></div>
        <div class="cart_stepper_item active">
          <span class="step_num">2</span>
          <span class="step_text">Checkout & Address</span>
        </div>
        <div class="cart_stepper_divider"></div>
        <div class="cart_stepper_item">
          <span class="step_num">3</span>
          <span class="step_text">Confirmation</span>
        </div>
      </div>

      <div class="cart-page-header">
        <h1 class="cart-title">
          Checkout & Address
        </h1>
        <p class="text-muted font15 m-0">Select shipping & billing address and complete your order.</p>
      </div>

      <div class="furniture_cart_inside_wrap">
        <?php if (isset($component)) { $__componentOriginal668c7a20207a57df30a8baa989f6e034 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal668c7a20207a57df30a8baa989f6e034 = $attributes; } ?>
<?php $component = App\View\Components\CartItems::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cart-items'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CartItems::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['c_items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cart_items),'display_quantity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal668c7a20207a57df30a8baa989f6e034)): ?>
<?php $attributes = $__attributesOriginal668c7a20207a57df30a8baa989f6e034; ?>
<?php unset($__attributesOriginal668c7a20207a57df30a8baa989f6e034); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal668c7a20207a57df30a8baa989f6e034)): ?>
<?php $component = $__componentOriginal668c7a20207a57df30a8baa989f6e034; ?>
<?php unset($__componentOriginal668c7a20207a57df30a8baa989f6e034); ?>
<?php endif; ?>
        <div class="furniture__cartsummery-right">
          <input type="hidden" id="address_count" value="<?php echo e(!empty($addresses) ? count($addresses) : 0); ?>">
          <?php if (isset($component)) { $__componentOriginaldd4781ad1ce0ba0698145d511a16144e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd4781ad1ce0ba0698145d511a16144e = $attributes; } ?>
<?php $component = App\View\Components\CheckoutSummary::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('checkout-summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CheckoutSummary::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['cart_items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cart_items),'shipping_address' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($shipping_address),'billing_address' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($billing_address)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldd4781ad1ce0ba0698145d511a16144e)): ?>
<?php $attributes = $__attributesOriginaldd4781ad1ce0ba0698145d511a16144e; ?>
<?php unset($__attributesOriginaldd4781ad1ce0ba0698145d511a16144e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldd4781ad1ce0ba0698145d511a16144e)): ?>
<?php $component = $__componentOriginaldd4781ad1ce0ba0698145d511a16144e; ?>
<?php unset($__componentOriginaldd4781ad1ce0ba0698145d511a16144e); ?>
<?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <?php if (isset($component)) { $__componentOriginal8bf843e970f070ff9dd920c4b88ca96c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8bf843e970f070ff9dd920c4b88ca96c = $attributes; } ?>
<?php $component = App\View\Components\AddressModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('address-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AddressModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['addresses' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($addresses ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8bf843e970f070ff9dd920c4b88ca96c)): ?>
<?php $attributes = $__attributesOriginal8bf843e970f070ff9dd920c4b88ca96c; ?>
<?php unset($__attributesOriginal8bf843e970f070ff9dd920c4b88ca96c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8bf843e970f070ff9dd920c4b88ca96c)): ?>
<?php $component = $__componentOriginal8bf843e970f070ff9dd920c4b88ca96c; ?>
<?php unset($__componentOriginal8bf843e970f070ff9dd920c4b88ca96c); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginalea6fe2fe4d3e3f881548dd688632de63 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea6fe2fe4d3e3f881548dd688632de63 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.checkout-create-address-modal','data' => ['states' => $states]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('checkout-create-address-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['states' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($states)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalea6fe2fe4d3e3f881548dd688632de63)): ?>
<?php $attributes = $__attributesOriginalea6fe2fe4d3e3f881548dd688632de63; ?>
<?php unset($__attributesOriginalea6fe2fe4d3e3f881548dd688632de63); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalea6fe2fe4d3e3f881548dd688632de63)): ?>
<?php $component = $__componentOriginalea6fe2fe4d3e3f881548dd688632de63; ?>
<?php unset($__componentOriginalea6fe2fe4d3e3f881548dd688632de63); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    $('#payNowBtn').click(function(e) {
      e.preventDefault();
      if (!$('#billing_address').val() || !$('#shipping_address').val()) {
        iziNotify("", 'Please add both billing and shipping address', "error");
        return;
      }
      $(this).prop('disabled', true).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...'
      );

      $.ajax({
        url: '<?php echo e(route('checkout.process')); ?>',
        method: 'POST',
        data: {
          _token: '<?php echo e(csrf_token()); ?>',
          billing_address: $('#billing_address').val(),
          shipping_address: $('#shipping_address').val(),
          coupon_id: $('#coupon_id').val(),
          coupon_discount: $('#coupon_discount').val(),
          payment_method: $('input[name="paymentmode"]:checked').val(),
        },
        success: function({
          success,
          message,
          redirect
        }) {
          if (success) {
            // iziNotify("", message, "success");
            setTimeout(() => window.location.href = `${redirect}`, 1000);
          } else {
            iziNotify("Oops!", message, "error");
            $('#payNowBtn').prop('disabled', false).html('Pay Now');
          }
        },
        error: function(xhr) {
          let errorMessage = xhr.responseJSON?.message || 'An error occurred during payment processing';
          iziNotify("Oops!", errorMessage, "error");
          $('#payNowBtn').prop('disabled', false).html('Pay Now');
        }
      });
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/pages/checkout/index.blade.php ENDPATH**/ ?>