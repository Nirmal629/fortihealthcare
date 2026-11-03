<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([]));

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

foreach (array_filter(([]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="individual_blocks flow-rootX paymentMmethod">
  <h2 class="fw-normal m-0 font25 c--blackc">Select Payment Method</h2>
  <div class="suggested_accordionwrap flow-rootX">
    <h4 class="fw-normal m-0 font18 c--blackc">Suggested For You</h4>
    <form class="flow-rootx">

      <?php if(!empty($siteSettings['payment_gateway'])): ?>
        <?php if($siteSettings['payment_gateway'] == 1): ?>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paymentmode" id="stripe"
                value="<?php echo e('P' . Hashids::encode(1)); ?>">
              <label class="form-check-label" for="stripe">Pay Via Stripe</label>
            </div>
            <div class="icon" style="top: 8px;">
              <img src="<?php echo e(asset('public/common/images/gateway_logos/stripe.png')); ?>" class="img-fluid" alt="Stripe"
                title="Stripe" style="height: 50px;">
            </div>
          </div>
        <?php elseif($siteSettings['payment_gateway'] == 2): ?>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paymentmode" id="paypal"
                value="<?php echo e('P' . Hashids::encode(2)); ?>">
              <label class="form-check-label" for="paypal">Pay Via Paypal</label>
            </div>
            <div class="icon" style="top: 8px;">
              <img src="<?php echo e(asset('public/common/images/gateway_logos/paypal.png')); ?>" class="img-fluid" alt="paypal"
                title="Paypal" style="height: 50px;">
            </div>
          </div>
          <?php endif; ?>
      <?php endif; ?>

      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="paymentmode" id="cod"
            value="<?php echo e('P' . Hashids::encode(0)); ?>" checked>
          <label class="form-check-label" for="cod">Cash On Delivery</label>
        </div>
        <div class="icon" style="top: 8px;">
          <img src="<?php echo e(asset('public/common/images/gateway_logos/cod.png')); ?>" class="img-fluid" alt="Cash on Delivery"
            title="Cash on Delivery" style="height: 50px;">
        </div>
      </div>
    </form>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/components/payment-methods.blade.php ENDPATH**/ ?>