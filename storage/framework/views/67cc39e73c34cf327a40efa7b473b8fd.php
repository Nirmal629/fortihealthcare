<?php
  $defaultAddresses = $addresses->where('primary', 1)->sortByDesc('id')->take(1);
  $otherAddresses = $addresses->where('primary', 0);
?>

<!-- Default Address Section -->
<div class="address_section_block mb-4">
  <div class="d-flex align-items-center gap-2 mb-3">
    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 28px; height: 28px; background: rgba(240, 179, 52, 0.15); color: #f0b334;">
      <span class="material-symbols-outlined" style="font-size: 18px;">home</span>
    </div>
    <h3 class="font16 fw-bold text-dark m-0">Default Address</h3>
  </div>

  <?php $__empty_1 = true; $__currentLoopData = $defaultAddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
      $addressData = array_merge($address->toArray(request()), [
        'encoded_state_id' => Hashids::encode($address->state_id),
        'pincode' => $address->pin,
        'address_line_1' => $address->address_1,
        'city_name' => $address->city,
      ]);
    ?>
    <div class="modern_address_card is-default">
      <div>
        <div class="modern_address_card_header">
          <div class="d-flex align-items-center gap-2">
            <div class="address_card_icon_wrap">
              <span class="material-symbols-outlined">home_pin</span>
            </div>
            <div>
              <h4 class="address_recipient_name"><?php echo e($address->name); ?></h4>
              <span class="text-muted font12">Primary Shipping Address</span>
            </div>
          </div>
          <span class="user-member-badge d-inline-flex align-items-center gap-1">
            <span class="material-symbols-outlined" style="font-size: 13px;">verified</span>
            Default
          </span>
        </div>

        <div class="address_body_text">
          <div><?php echo e($address->address_1 ? truncateNoWordBreak($address->address_1, 120) : ''); ?></div>
          <?php if($address->landmark): ?>
            <div class="text-muted font12 mt-1"><strong>Landmark:</strong> <?php echo e($address->landmark); ?></div>
          <?php endif; ?>
          <div class="mt-1 font13"><strong><?php echo e($address->city); ?></strong> - <?php echo e($address->pin); ?>, <?php echo e($address->state->name ?? ''); ?></div>
        </div>

        <?php if($address->phone): ?>
          <div class="address_phone_info">
            <span class="material-symbols-outlined">phone_iphone</span>
            <span class="fw-semibold text-dark"><?php echo e($address->phone); ?></span>
          </div>
        <?php endif; ?>
      </div>

      <div class="modern_address_actions">
        <a href="javascript:void(0);"
          class="btn modern_address_btn edit-btn create-or-edit-address"
          title="Edit Address"
          data-address='<?php echo json_encode($addressData, 15, 512) ?>'
          data-address-id="<?php echo e(Hashids::encode($address->id ?? '')); ?>">
          <span class="material-symbols-outlined font16">edit</span>
          <span>Edit</span>
        </a>

        <a href="javascript:void(0);"
          class="btn modern_address_btn delete-btn delete-default-address"
          title="Remove Address"
          data-address-id="<?php echo e($address->id ?? ''); ?>">
          <span class="material-symbols-outlined font16">delete</span>
          <span>Remove</span>
        </a>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="modern_empty_address_box">
      <div class="empty-icon-wrap">
        <span class="material-symbols-outlined">location_off</span>
      </div>
      <h5 class="fw-bold font15 text-dark mb-1">No Default Address</h5>
      <p class="text-muted font13 mb-0">You don't have a default delivery address set yet.</p>
    </div>
  <?php endif; ?>
</div>

<!-- Other Addresses Section -->
<div class="address_section_block mt-4 pt-2">
  <div class="d-flex align-items-center gap-2 mb-3">
    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 28px; height: 28px; background: #f1f5f9; color: #64748b;">
      <span class="material-symbols-outlined" style="font-size: 18px;">domain</span>
    </div>
    <h3 class="font16 fw-bold text-dark m-0">Other Addresses</h3>
    <span class="badge bg-light text-secondary border rounded-pill px-2 py-1 font11"><?php echo e($otherAddresses->count()); ?></span>
  </div>

  <?php if($otherAddresses->count() > 0): ?>
    <div class="modern_address_grid">
      <?php $__currentLoopData = $otherAddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $addressData = array_merge($address->toArray(request()), [
            'encoded_state_id' => Hashids::encode($address->state_id),
            'pincode' => $address->pin,
            'address_line_1' => $address->address_1,
            'city_name' => $address->city,
          ]);
        ?>
        <div class="modern_address_card">
          <div>
            <div class="modern_address_card_header">
              <div class="d-flex align-items-center gap-2">
                <div class="address_card_icon_wrap" style="background: #f8fafc; color: #64748b;">
                  <span class="material-symbols-outlined">location_on</span>
                </div>
                <div>
                  <h4 class="address_recipient_name"><?php echo e($address->name); ?></h4>
                  <span class="text-muted font12">Additional Address</span>
                </div>
              </div>
            </div>

            <div class="address_body_text">
              <div><?php echo e($address->address_1 ? truncateNoWordBreak($address->address_1, 120) : ''); ?></div>
              <?php if($address->landmark): ?>
                <div class="text-muted font12 mt-1"><strong>Landmark:</strong> <?php echo e($address->landmark); ?></div>
              <?php endif; ?>
              <div class="mt-1 font13"><strong><?php echo e($address->city); ?></strong> - <?php echo e($address->pin); ?>, <?php echo e($address->state->name ?? ''); ?></div>
            </div>

            <?php if($address->phone): ?>
              <div class="address_phone_info">
                <span class="material-symbols-outlined">phone_iphone</span>
                <span class="fw-semibold text-dark"><?php echo e($address->phone); ?></span>
              </div>
            <?php endif; ?>
          </div>

          <div class="modern_address_actions">
            <a href="javascript:void(0);"
              class="btn modern_address_btn edit-btn create-or-edit-address"
              title="Edit Address"
              data-address='<?php echo json_encode($addressData, 15, 512) ?>'
              data-address-id="<?php echo e(Hashids::encode($address->id ?? '')); ?>">
              <span class="material-symbols-outlined font16">edit</span>
              <span>Edit</span>
            </a>

            <a href="javascript:void(0);"
              class="btn modern_address_btn delete-btn delete-default-address"
              title="Remove Address"
              data-address-id="<?php echo e($address->id ?? ''); ?>">
              <span class="material-symbols-outlined font16">delete</span>
              <span>Remove</span>
            </a>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  <?php else: ?>
    <div class="modern_empty_address_box">
      <div class="empty-icon-wrap" style="background: #f1f5f9; color: #94a3b8;">
        <span class="material-symbols-outlined">domain_disabled</span>
      </div>
      <h5 class="fw-bold font15 text-dark mb-1">No Additional Addresses</h5>
      <p class="text-muted font13 mb-0">You have no other saved addresses. Click "Add New Address" above to save another location.</p>
    </div>
  <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/list-of-profile-address.blade.php ENDPATH**/ ?>