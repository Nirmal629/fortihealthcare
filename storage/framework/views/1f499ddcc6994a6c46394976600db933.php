<div>
  <div class="d-flex filter-small justify-content-end align-items-center mb-2">
    <div class="d-flex me-2">
      <div class="input-group input-group-text font-14 bg-white" id="reportrange" wire:ignore>
        <i class="mdi mdi-calendar-range font-14 d-flex me-2"></i>
        <span class=""></span>
      </div>
    </div>

    <?php echo $__env->make('livewire.includes.datatable-search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>

  <?php echo $__env->make('livewire.includes.datatable-pagecount', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <div class="table-responsive">
    <table class="table table-centered mb-0">
      <?php
        $canEdit = hasUserPermission('admin.promotion.edit');
        $canDelete = hasUserPermission('admin.promotion.delete');
      ?>
      <thead>
        <tr>
          
          <th>Sl.</th>
          <th>Action</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'promotion_mode',
              'displayName' => 'Promotion Mode',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'name',
              'displayName' => 'Promotion Name',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'promotion_start_from',
              'displayName' => 'Promotion Start From',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'promotion_end_to',
              'displayName' => 'Promotion End To',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'status',
              'displayName' => 'Status',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'created_by',
              'displayName' => 'Created By',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'updated_by',
              'displayName' => 'Updated By',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </tr>
      </thead>
      <tbody>
        <!--[if BLOCK]><![endif]--><?php if($promotions->count() > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $promotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $hashedID = Hashids::encode($promotion->id); ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              
              <td><?php echo e($serialNumber++); ?></td>
              <td class="table-action">
                <div class="d-flex">
                  <a href="<?php echo e($canEdit ? route('admin.promotion.edit', $hashedID) : 'javascript:void(0);'); ?>"
                    class="action-icon text-info <?php echo e($canEdit ? '' : 'disabled-link'); ?>" title="Edit">
                    <i class="ri-pencil-line"></i>
                  </a>
                  
                </div>
              </td>
              <td><?php echo e($promotion->promotion_mode == 1 ? 'Product Wise' : 'Category Wise'); ?></td>
              <td><?php echo e(ucfirst($promotion->name)); ?></td>
              <td><?php echo e(convertDateTimeHours($promotion->promotion_start_from)); ?></td>
              <td><?php echo e(convertDateTimeHours($promotion->promotion_end_to)); ?></td>
              <td>
                <span class="badge badge-<?php echo e($promotion->status ? 'success' : 'danger'); ?>-lighten"
                  title="<?php echo e($promotion->status ? 'Active' : 'Inactive'); ?>" id="status_<?php echo e($hashedID); ?>"
                  <?php echo e($canEdit ? 'role=button tabindex=0 onclick=changeStatus("' . $hashedID . '")' : ''); ?>>
                  <?php echo e($promotion->status ? 'Active' : 'Inactive'); ?>

                </span>
              </td>
              <td class="updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src="<?php echo e(userImageById('admin', $promotion->created_by)['thumbnail']); ?>" alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e(userNameById('admin', $promotion->created_by) ?? 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($promotion->created_at)); ?></span>
                  </div>
                </div>
              </td>
              <td class="updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src="<?php echo e(userImageById('admin', $promotion->updated_by)['thumbnail']); ?>" alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e(userNameById('admin', $promotion->updated_by) ?? 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($promotion->updated_at)); ?></span>
                  </div>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="13" class="text-center">
              <div class="alert alert-danger text-danger">No Promotions Found</div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($promotions->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    function changeStatus(id) {
      let url = `<?php echo e(route('admin.promotion.edit.status', ':id')); ?>`.replace(':id', id);
      changeStatusAjax(url, id);
    }

    function deleteRecord(id) {
      let url = `<?php echo e(route('admin.coupons.delete', ':id')); ?>`.replace(':id', id);
      deleteAjax(url);
    }

    $("#deleteBtn").on("click", function() {
      deleteMultipleAjax(`<?php echo e(route('admin.coupons.delete.multiple')); ?>`);
    });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/promotions/promotion-table.blade.php ENDPATH**/ ?>