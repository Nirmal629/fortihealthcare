<div>
  <div class="d-flex filter-small justify-content-end align-items-center mb-2">
    <?php echo $__env->make('livewire.includes.datatable-search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  </div>
  <?php echo $__env->make('livewire.includes.datatable-pagecount', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="table-responsive">
    <table class="table table-centered mb-0">
      <?php
        // $canEdit = true;
        $canEdit = hasUserPermission('admin.pincode.edit');
        $canDelete = hasUserPermission('admin.pincode.delete');
      ?>
      <thead>
        <tr>
          <th class="sl-col">
            
          </th>
          <th class="">Sl.</th>
          <th class="">Action</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'code',
              'displayName' => 'Pincode',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'estimate_days',
              'displayName' => 'Estimate Days',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'status',
              'displayName' => 'Status',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <th class="">Added On</th>
        </tr>

      </thead>
      <tbody>
        <?php $sl = 1; ?>
        <!--[if BLOCK]><![endif]--><?php if(count($pincodes) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $pincodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pincode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $hashedID = Hashids::encode($pincode->id); ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              <td>
                
              </td>
              <td class=""><?php echo e($serialNumber++); ?></td>
              <td class="table-action ">
                <div class="d-flex">
                  <a href="<?php echo e($canEdit ? route('admin.pincode.edit', $hashedID) : 'javascript:void(0);'); ?>"
                    class="action-icon text-info <?php echo e($canEdit ? '' : 'disabled-link'); ?>" title="Edit">
                    <i class="ri-pencil-line"></i>
                  </a>
                  
                </div>
              </td>

              <td class=""> <?php echo e($pincode->code); ?></td>
              <td class=""> <?php echo e($pincode->estimate_days); ?></td>

              <td class="">
                <div class="d-flex justify-content-start align-items-center">
                  <span class="badge badge-<?php echo e($pincode->status ? 'success' : 'danger'); ?>-lighten"
                    title="<?php echo e($pincode->status ? 'Active' : 'Inactive'); ?>" id="status_<?php echo e($hashedID); ?>"
                    <?php echo e($canEdit ? 'role=button tabindex=0 onclick=changeStatus("' . $hashedID . '")' : ''); ?>>
                    <?php echo e($pincode->status ? 'Active' : 'Inactive'); ?>

                  </span>
                </div>
              </td>
              <td><?php echo e(convertDate($pincode->created_at)); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="12" class="">
              <div role="alert" class="alert alert-danger text-center text-danger">No Ddata Found
              </div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($pincodes->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    function changeStatus(id) {
      url = `<?php echo e(route('admin.pincode.edit.status', ':id')); ?>`.replace(':id', id);
      changeStatusAjax(url, id);
    }
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/order-manage/pincode-table.blade.php ENDPATH**/ ?>