<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['cart_items', 'shipping_address', 'billing_address']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['cart_items', 'shipping_address', 'billing_address']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="furniture__cartsummery-inside">
  <input type="hidden" name="coupon_id" id="coupon_id" value="">
  <input type="hidden" name="coupon_discount" id="coupon_discount" value="">
  <input type="hidden" name="shipping_address" id="shipping_address" value="<?php echo e($shipping_address->id ?? ''); ?>">
  <input type="hidden" name="billing_address" id="billing_address" value="<?php echo e($billing_address->id ?? ''); ?>">
  <?php if (isset($component)) { $__componentOriginal9a473bf320fc04abbd814d95f6102632 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a473bf320fc04abbd814d95f6102632 = $attributes; } ?>
<?php $component = App\View\Components\AddressDisplay::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('address-display'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AddressDisplay::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Shipping Address','userAddress' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($shipping_address),'addressType' => 'shipping']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a473bf320fc04abbd814d95f6102632)): ?>
<?php $attributes = $__attributesOriginal9a473bf320fc04abbd814d95f6102632; ?>
<?php unset($__attributesOriginal9a473bf320fc04abbd814d95f6102632); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a473bf320fc04abbd814d95f6102632)): ?>
<?php $component = $__componentOriginal9a473bf320fc04abbd814d95f6102632; ?>
<?php unset($__componentOriginal9a473bf320fc04abbd814d95f6102632); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginal9a473bf320fc04abbd814d95f6102632 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a473bf320fc04abbd814d95f6102632 = $attributes; } ?>
<?php $component = App\View\Components\AddressDisplay::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('address-display'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AddressDisplay::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Billing Address','userAddress' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($billing_address),'addressType' => 'billing']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a473bf320fc04abbd814d95f6102632)): ?>
<?php $attributes = $__attributesOriginal9a473bf320fc04abbd814d95f6102632; ?>
<?php unset($__attributesOriginal9a473bf320fc04abbd814d95f6102632); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a473bf320fc04abbd814d95f6102632)): ?>
<?php $component = $__componentOriginal9a473bf320fc04abbd814d95f6102632; ?>
<?php unset($__componentOriginal9a473bf320fc04abbd814d95f6102632); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginalc4aa1d63f0f8dbeec2ec2f57b2fc28be = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc4aa1d63f0f8dbeec2ec2f57b2fc28be = $attributes; } ?>
<?php $component = App\View\Components\CartSummary::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cart-summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CartSummary::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['cart_items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cart_items),'coupon' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc4aa1d63f0f8dbeec2ec2f57b2fc28be)): ?>
<?php $attributes = $__attributesOriginalc4aa1d63f0f8dbeec2ec2f57b2fc28be; ?>
<?php unset($__attributesOriginalc4aa1d63f0f8dbeec2ec2f57b2fc28be); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc4aa1d63f0f8dbeec2ec2f57b2fc28be)): ?>
<?php $component = $__componentOriginalc4aa1d63f0f8dbeec2ec2f57b2fc28be; ?>
<?php unset($__componentOriginalc4aa1d63f0f8dbeec2ec2f57b2fc28be); ?>
<?php endif; ?>
  <?php if(cartCount() > 0): ?>
    <?php if (isset($component)) { $__componentOriginal807d932fac8acf174d1b8462f1c369fd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal807d932fac8acf174d1b8462f1c369fd = $attributes; } ?>
<?php $component = App\View\Components\PaymentMethods::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('payment-methods'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\PaymentMethods::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal807d932fac8acf174d1b8462f1c369fd)): ?>
<?php $attributes = $__attributesOriginal807d932fac8acf174d1b8462f1c369fd; ?>
<?php unset($__attributesOriginal807d932fac8acf174d1b8462f1c369fd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal807d932fac8acf174d1b8462f1c369fd)): ?>
<?php $component = $__componentOriginal807d932fac8acf174d1b8462f1c369fd; ?>
<?php unset($__componentOriginal807d932fac8acf174d1b8462f1c369fd); ?>
<?php endif; ?>
    <div class="cart_summary_action_area pt-2">
      <div class="cart_action">
        <button id="payNowBtn" class="btn learnmore_btn cart_checkout_btn w-100">Pay Now</button>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/components/checkout-summary.blade.php ENDPATH**/ ?>