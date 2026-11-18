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
        $canEdit = hasUserPermission('admin.roles.edit');
        $canDelete = hasUserPermission('admin.roles.delete');
      ?>
      <thead>
        <tr>
          <th class="sl-col">
            <div class="form-check">
              <input type="checkbox" class="form-check-input <?php echo e($canDelete ? '' : 'disabled-link'); ?>"
                id="<?php echo e($canDelete ? 'maincheck' : ''); ?>">
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
        <!--[if BLOCK]><![endif]--><?php if(count($roles) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $hashedID = Hashids::encode($role->id); ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              <td>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input <?php echo e($canDelete ? '' : 'disabled-link'); ?>"
                    <?php echo $canDelete ? 'id="check_' . $hashedID . '"' : ''; ?>>
                  <label class="form-check-label"></label>
                </div>
              </td>
              <td class=""><?php echo e($serialNumber++); ?></td>
              <td class="table-action ">
                <div class="d-flex">
                  <a href="<?php echo e($canEdit ? route('admin.roles.edit', $hashedID) : 'javascript:void(0);'); ?>"
                    class="action-icon text-info <?php echo e($canEdit ? '' : 'disabled-link'); ?>" title="Edit">
                    <i class="ri-pencil-line"></i>
                  </a>
                  <a href="javascript:void(0);" class="action-icon text-danger <?php echo e($canDelete ? '' : 'disabled-link'); ?>"
                    title="Remove" onclick="<?php echo e($canDelete ? 'deleteRecord(' . json_encode($hashedID) . ')' : ''); ?>">
                    <i class="ri-delete-bin-line"></i>
                  </a>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center"><?php echo e($role->name); ?>

                  <i class="ri-information-line ms-1" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title='<?php echo e(truncateNoWordBreak($role->description ?? 'No Info', 250)); ?>'></i>
                </div>
              </td>
              <td class="">
                <div class="actinact">
                  <span class="badge badge-<?php echo e($role->status ? 'success' : 'danger'); ?>-lighten"
                    title="<?php echo e($role->status ? 'Active' : 'Inactive'); ?>" id="status_<?php echo e($hashedID); ?>"
                    <?php echo e($canEdit ? 'role=button tabindex=0 onclick=changeStatus("' . $hashedID . '")' : ''); ?>><?php echo e($role->status ? 'Active' : 'Inactive'); ?></span>
                </div>
              </td>
              <td class=" updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src="<?php echo e(userImageById('admin', $role->created_by)['thumbnail']); ?>" alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e($role->created_by ? userNameById('admin', $role->created_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($role->created_at)); ?></span>
                  </div>
                </div>
              </td>
              <td class=" updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src="<?php echo e(userImageById('admin', $role->updated_by)['thumbnail']); ?>" alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e($role->updated_by ? userNameById('admin', $role->updated_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($role->updated_at)); ?></span>
                  </div>
                </div>
              </td>

            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="7" class="">
              <div role="alert" class="alert alert-danger text-center text-danger">
                No Roles Found
              </div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($roles->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    function changeStatus(id) {
      url = `<?php echo e(route('admin.roles.edit.status', ':id')); ?>`.replace(':id', id);
      changeStatusAjax(url, id);
    }

    function deleteRecord(id) {
      url = `<?php echo e(route('admin.roles.delete', ':id')); ?>`.replace(':id', id);
      deleteAjax(url);
    }

    $("#deleteBtn").on("click", function() {
      deleteMultipleAjax(`<?php echo e(route('admin.roles.delete.multiple')); ?>`);
    });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/admin/roles-table.blade.php ENDPATH**/ ?>