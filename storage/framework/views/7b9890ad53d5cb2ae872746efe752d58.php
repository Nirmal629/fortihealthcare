<!-- resources/views/frontend/includes/list-of-address.blade.php -->
<div class="address_block flow-rootX">
    <?php $__empty_1 = true; $__currentLoopData = $userAddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <label class="d-flex border py-2 address-item" for="user_default_address_<?php echo e($item->id ?? ''); ?>">
            <input type="radio"
                   name="user_default_address"
                   id="user_default_address_<?php echo e($item->id ?? ''); ?>"
                   value="<?php echo e($item->id ?? ''); ?>"
                   class="mx-3 select-address-radio"
                   data-address-id="<?php echo e($item->id ?? ''); ?>"
                   data-attr-type="<?php echo e($item->type ?? ''); ?>"
                   <?php echo e(!empty($item) && $item->primary == 1 ? 'checked' : ''); ?>>
            <div id="address_<?php echo e($item->id ?? ''); ?>">
                <h4 class="fw-medium font20"><?php echo e($item->name ?? ''); ?></h4>
                <p class="mb-0 font16">
                    <?php echo e($item->address_1 ? truncateNoWordBreak($item->address_1,100) : ''); ?>,
                    <?php echo e($item->city ?? ''); ?> - <?php echo e($item->pin ?? ''); ?>, <br>
                    <?php echo e($item->landmark ?? ''); ?><br>
                    <?php echo e($item->state_name ?? ($item->state->name ?? '')); ?><br>
                    <?php echo e($item->country_name ?? ($item->state->country->name ?? '')); ?><br>
                    Phone: <?php echo e($item->phone ?? ''); ?>

                </p>
                
            </div>
        </label>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p id="no-address">No addresses available.</p>
    <?php endif; ?>
    <input type="button"
           class="btn btn-dark w-100 py-3 mt-3 submit-default-address-btn"
           value="Submit"
           <?php echo e($userAddresses->isEmpty() ? 'disabled' : ''); ?>>
</div>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/list-of-address.blade.php ENDPATH**/ ?>