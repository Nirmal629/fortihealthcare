

<label class="modern_address_card address-item" for="default_address_<?php echo e($singleAddress->id ?? ''); ?>">
  <div class="card_radio_wrap">
    <input type="radio" name="default_address" id="default_address_<?php echo e($singleAddress->id ?? ''); ?>" value="<?php echo e($singleAddress->id ?? ''); ?>"
      class="modern_addr_radio" data-attr-type="<?php echo e($singleAddress->type ?? ''); ?>" <?php echo e(!empty($singleAddress) && $singleAddress->primary == 1 ? 'checked' : ''); ?>>
  </div>
  <div class="card_content_wrap" id="address_<?php echo e($singleAddress->id ?? ''); ?>">
    <div class="d-flex align-items-center justify-content-between mb-1">
      <h4 class="addr_name"><?php echo e($singleAddress->name ?? ''); ?></h4>
      <?php if(!empty($singleAddress) && $singleAddress->primary == 1): ?>
        <span class="default_badge">Default</span>
      <?php endif; ?>
    </div>
    <p class="addr_details mb-1">
      <?php echo e($singleAddress->address_1 ? truncateNoWordBreak($singleAddress->address_1,100) : ''); ?>,
      <?php echo e($singleAddress->city ?? ''); ?><?php if(!empty($singleAddress->landmark)): ?>, <?php echo e($singleAddress->landmark); ?><?php endif; ?><br>
      <?php echo e($singleAddress->state_name ?? ($singleAddress->state->name ?? '')); ?> - <?php echo e($singleAddress->pin ?? ''); ?>,
      <?php echo e($singleAddress->country_name ?? ($singleAddress->state->country->name ?? '')); ?>

    </p>
    <div class="addr_phone">
      <span class="material-symbols-outlined font15 text-muted me-1">call</span>
      <span><?php echo e($singleAddress->phone ?? ''); ?></span>
    </div>
  </div>
</label>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/includes/address-block.blade.php ENDPATH**/ ?>