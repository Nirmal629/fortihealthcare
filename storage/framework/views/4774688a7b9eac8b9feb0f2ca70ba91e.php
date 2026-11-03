<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['c_items' => [], 's_items' => [], 'cart_action' => true, 'display_quantity']));

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

foreach (array_filter((['c_items' => [], 's_items' => [], 'cart_action' => true, 'display_quantity']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="furniture_cart_left">
  <div class="inside">
    <div class="cart_block">
      <div class="cart_grid">
        
        <div id="cart-items-wrapper">
          <?php echo $__env->make('frontend.includes.cart_items', ['items' => $c_items, 'display_quantity' => $display_quantity], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        
        <div id="wishlist-items-wrapper" class="d-none"></div>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/components/cart-items.blade.php ENDPATH**/ ?>