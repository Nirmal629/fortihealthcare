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
        $canEditGlobal = hasUserPermission('admin.users.edit');
        $canDeleteGlobal = hasUserPermission('admin.users.delete');
        $loggedInAdmin = user('admin');
      ?>
      <thead>
        <tr>
          <th class="sl-col">
            <div class="form-check">
              <input type="checkbox" class="form-check-input <?php echo e($canDeleteGlobal ? '' : 'disabled-link'); ?>"
                id="<?php echo e($canDeleteGlobal ? 'maincheck' : ''); ?>">
              <label class="form-check-label" for="customCheck1"></label>
            </div>
          </th>
          <th class="">Sl.</th>
          <th class="">Action</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'first_name',
              'displayName' => 'Name',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'email',
              'displayName' => 'Email',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'phone',
              'displayName' => 'Phone',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'roleNames',
              'displayName' => 'Role',
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
        <!--[if BLOCK]><![endif]--><?php if(count($adminUsers) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $adminUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adminUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $hashedID = Hashids::encode($adminUser->id);
              $roles = array_map('intval', explode(',', $adminUser->role_ids));
              $notYetLoggedIn = !in_array($adminUser->id, $firstLoggedIn);

              $canEditRow = false;
              $canDeleteRow = false;

              if ($canEditGlobal) {
                  $canEditRow =
                      $loggedInAdmin->role_id == 1 ||
                      in_array($loggedInAdmin->role_id, $roles) ||
                      min($roles) > $loggedInAdmin->role_id;
              }

              if ($canDeleteGlobal) {
                  if ($loggedInAdmin->role_id == 1) {
                      $canDeleteRow = !in_array(1, $roles);
                  } else {
                      $canDeleteRow = min($roles) > $loggedInAdmin->role_id;
                  }
              }
            ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              <td>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input <?php echo e($canDeleteRow ? '' : 'disabled-link'); ?>"
                    <?php echo $canDeleteRow ? 'id="check_' . $hashedID . '"' : ''; ?>>
                  <label class="form-check-label"></label>
                </div>
              </td>
              <td><?php echo e($serialNumber++); ?></td>
              <td class="table-action">
                <div class="d-flex">
                  <a href="<?php echo e($canEditRow ? route('admin.users.edit', $hashedID) : 'javascript:void(0);'); ?>"
                    class="action-icon text-info <?php echo e($canEditRow ? '' : 'disabled-link'); ?>" title="Edit">
                    <i class="ri-pencil-line"></i>
                  </a>
                  <a href="javascript:void(0);"
                    class="action-icon text-danger <?php echo e($canDeleteRow ? '' : 'disabled-link'); ?>" title="Remove"
                    onclick="<?php echo e($canDeleteRow ? 'deleteRecord(' . json_encode($hashedID) . ')' : ''); ?>">
                    <i class="ri-delete-bin-line"></i>
                  </a>
                  <!--[if BLOCK]><![endif]--><?php if($notYetLoggedIn): ?>
                    <a href="javascript:void(0);" class="action-icon text-warning" title="Resend Credential Mail"
                      onclick="resendLoginMail('<?php echo e($hashedID); ?>')">
                      <i class="ri-mail-line"></i>
                    </a>
                  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
              </td>
              <td class="updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src="<?php echo e(userImageById('admin', $adminUser->id)['thumbnail']); ?>" alt=""
                      title="<?php echo e($adminUser->first_name); ?> <?php echo e($adminUser->middle_name); ?> <?php echo e($adminUser->last_name); ?>"
                      class="rounded-circle" />
                  </span>
                  <div class="inf">
                    <?php echo e($adminUser->first_name); ?> <?php echo e($adminUser->middle_name); ?> <?php echo e($adminUser->last_name); ?>

                  </div>
                </div>
              </td>
              <td class="nowrap"><?php echo e($adminUser->email); ?></td>
              <td class="nowrap"><?php echo e($adminUser->phone); ?></td>
              <td class="nowrap"><?php echo e($adminUser->roleNames); ?></td>
              <td>
                <span class="badge badge-<?php echo e($adminUser->status ? 'success' : 'danger'); ?>-lighten"
                  title="<?php echo e($adminUser->status ? 'Active' : 'Inactive'); ?>" id="status_<?php echo e($hashedID); ?>"
                  <?php echo e($canEditRow ? 'role=button tabindex=0 onclick=changeStatus("' . $hashedID . '")' : ''); ?>>
                  <?php echo e(__($adminUser->status ? 'Active' : 'Inactive')); ?>

                </span>
              </td>
              <td class="updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src="<?php echo e(userImageById('admin', $adminUser->created_by)['thumbnail']); ?>" alt=""
                      class="rounded-circle" width="32" />
                  </span>
                  <div class="inf">
                    <?php echo e($adminUser->created_by ? userNameById('admin', $adminUser->created_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($adminUser->created_at)); ?></span>
                  </div>
                </div>
              </td>
              <td class="updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src="<?php echo e(userImageById('admin', $adminUser->updated_by)['thumbnail']); ?>" alt=""
                      class="rounded-circle" width="32" />
                  </span>
                  <div class="inf">
                    <?php echo e($adminUser->updated_by ? userNameById('admin', $adminUser->updated_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($adminUser->updated_at)); ?></span>
                  </div>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="10">
              <div role="alert" class="alert alert-danger text-center text-danger">
                No Users Found
              </div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($adminUsers->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    function changeStatus(id) {
      url = `<?php echo e(route('admin.users.edit.status', ':id')); ?>`.replace(':id', id);
      changeStatusAjax(url, id);
    }

    function deleteRecord(id) {
      url = `<?php echo e(route('admin.users.delete', ':id')); ?>`.replace(':id', id);
      deleteAjax(url);
    }

    $("#deleteBtn").on("click", function() {
      deleteMultipleAjax(`<?php echo e(route('admin.users.delete.multiple')); ?>`);
    });

    function resendLoginMail(id) {
      const url = `<?php echo e(route('admin.users.mail.resend', ':id')); ?>`.replace(':id', id);
      $.post(url, {
        _token: "<?php echo e(csrf_token()); ?>"
      }, (response) => {
        swalNotify(response.success ? "Success!" : "Oops!", response.message, response.success ? "success" : "error");
      });
    }
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/admin/admin-user-table.blade.php ENDPATH**/ ?>