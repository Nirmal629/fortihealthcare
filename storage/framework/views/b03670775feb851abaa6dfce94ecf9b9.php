<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'userAddress', 'addressType', 'selectedId']));

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

foreach (array_filter((['title', 'userAddress', 'addressType', 'selectedId']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="individual_blocks flow-rootX border-bottom border-secondery">
  <h3 class="font25 c--blackc fw-normal"><strong><?php echo e($title); ?></strong></h3>
  <div class="<?php echo e(str_replace('_address', '', $addressType)); ?>">
    <?php if(isset($userAddress) && !empty($userAddress)): ?>
      <?php if(isset($userAddress->name)): ?>
        <h4 class="fw-medium font20"><?php echo e($userAddress->name ?? ''); ?></h4>
        <p class="mb-0 font16"><?php echo e($userAddress->address_1 ? truncateNoWordBreak($userAddress->address_1,100) : ''); ?>,
          <?php echo e($userAddress->city ?? ''); ?> <br>
          <?php echo e($userAddress->landmark ?? ''); ?><br>
          <?php echo e($userAddress->state->name ?? ''); ?> - <?php echo e($userAddress->pin ?? ''); ?>,<br>
          <?php echo e($userAddress->state->country->name ?? ''); ?><br>
          Phone: <?php echo e($userAddress->phone ?? ''); ?></p>
      <?php endif; ?>
      <a href="javascript:void(0);" class="font16 change-address-btn" data-address-type="<?php echo e($addressType); ?>">Change
        <?php echo e($title); ?></a>
    <?php else: ?>
      <p class="mb-0 text-muted">No <?php echo e($title); ?> provided</p>
         <a href="javascript:void(0);" class="font16 change-address-btn" data-address-type="<?php echo e($addressType); ?>">Add
        <?php echo e($title); ?></a>
    <?php endif; ?>
  </div>
</div>
<?php $__env->startPush('component-scripts'); ?>
  <script>
    $(document).ready(function () {
      $(document).off('click', '.change-address-btn'); // Prevent duplicate binding
      $(document).on('click', '.change-address-btn', function (e) {

        e.preventDefault();
        let addressType = $(this).data('address-type');
        var addressCount = $('#address_count').val();
        if (addressCount == 0){
          $('#AddNewAddressModal').modal('show');
        }
        else{
          if (addressType === 'shipping') {
            $('input[name="default_address"]').attr('data-attr-type2', addressType);
            if(selectedShippingAddress){
              $(`#default_address_${selectedShippingAddress}`).prop('checked', true);
            }
          }
          if (addressType === 'billing') {
            $('input[name="default_address"]').attr('data-attr-type2', addressType);
            if(selectedBillingAddress){
              $(`#default_address_${selectedBillingAddress}`).prop('checked', true);
            }
          }
          $('#AddressModal').modal('show');
        }
      });
    });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/components/address-display.blade.php ENDPATH**/ ?>