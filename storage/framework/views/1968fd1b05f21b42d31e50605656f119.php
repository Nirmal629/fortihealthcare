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
      <thead>
        <tr>
          <th class="sl-col">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="maincheck">
              <label class="form-check-label" for="customCheck1"></label>
            </div>
          </th>
          <th class="">Sl.</th>
          <th class="">Action</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'name',
              'displayName' => 'Name',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'code',
              'displayName' => 'Code',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'position',
              'displayName' => 'Position',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'decimal_places',
              'displayName' => 'Decimal Places',
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
        <!--[if BLOCK]><![endif]--><?php if(count($currencies) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $hashedID = Hashids::encode($currency->id); ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              <td>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="check_<?php echo e($hashedID); ?>">
                  <label class="form-check-label"></label>
                </div>
              </td>
              <td class=""><?php echo e($serialNumber++); ?></td>
              <td class="table-action ">
                <div class="d-flex">
                  <a href="<?php echo e(route('admin.currencies.edit', $hashedID)); ?>" class="action-icon text-info"
                    title="Edit">
                    <i class="ri-pencil-line"></i></a>
                  <a href="javascript: void(0);" class="action-icon text-danger" title="Remove"
                    onclick="deleteRecord('<?php echo e($hashedID); ?>')"> <i class="ri-delete-bin-line"></i></a>
                </div>
              </td>
              <td class="nowrap"><?php echo e($currency->name); ?> (<?php echo e($currency->symbol); ?>)</td>
              <td class=""><?php echo e($currency->code); ?></td>
              <td class=""><?php echo e(ucfirst($currency->position)); ?></td>
              <td class=""><?php echo e($currency->decimal_places); ?></td>
              <td class="">
                <div class="actinact">
                  <span class="badge badge-<?php echo e($currency->status ? 'success' : 'danger'); ?>-lighten"
                    title="<?php echo e($currency->status ? 'Active' : 'Inactive'); ?>" id="status_<?php echo e($hashedID); ?>"
                    role="button" tabindex="0"
                    onclick="changeStatus('<?php echo e($hashedID); ?>')"><?php echo e($currency->status ? 'Active' : 'Inactive'); ?></span>
                </div>
              </td>
              <td class=" updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src=<?php echo e(userImageById('admin', $currency->created_by)['thumbnail']); ?> alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e($currency->created_by ? userNameById('admin', $currency->created_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($currency->created_at)); ?></span>
                  </div>
                </div>
              </td>
              <td class=" updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src=<?php echo e(userImageById('admin', $currency->updated_by)['thumbnail']); ?> alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e($currency->updated_by ? userNameById('admin', $currency->updated_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($currency->updated_at)); ?></span>
                  </div>
                </div>
              </td>

            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="10" class="">
              <div role="alert" class="alert alert-danger text-center text-danger">
                No currencies Found
              </div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($currencies->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    function changeStatus(id) {
      url = `<?php echo e(route('admin.currencies.edit.status', ':id')); ?>`.replace(':id', id);
      changeStatusAjax(url, id);
    }

    function deleteRecord(id) {
      url = `<?php echo e(route('admin.currencies.delete', ':id')); ?>`.replace(':id', id);
      deleteAjax(url);
    }

    $("#deleteBtn").on("click", function() {
      deleteMultipleAjax(`<?php echo e(route('admin.currencies.delete.multiple')); ?>`);
    });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/system/currency-table.blade.php ENDPATH**/ ?>