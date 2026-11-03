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
              'colName' => 'status',
              'displayName' => 'Status',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'last_login',
              'displayName' => 'Last Login',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'created_at',
              'displayName' => 'Joined Date',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </tr>
      </thead>
      <tbody>
        <!--[if BLOCK]><![endif]--><?php if(count($customers) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $hashedID = Hashids::encode($customer->id);
              $canEditRow = true;
              $canDeleteRow = true;
            ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              <td><?php echo e($serialNumber++); ?></td>
              <td class="table-action">
                <div class="d-flex">
                  <a href="<?php echo e($canEditRow ? route('admin.customers.edit', $hashedID) : 'javascript:void(0);'); ?>"
                    class="action-icon text-info <?php echo e($canEditRow ? '' : 'disabled-link'); ?>" title="Edit">
                    <i class="ri-pencil-line"></i>
                  </a>
                </div>
              </td>
              <td class="updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src="<?php echo e(userImageById('', $customer->id)['thumbnail']); ?>" alt=""
                      title="<?php echo e(userNameById('', $customer->id)); ?>" class="rounded-circle" />
                  </span>
                  <div class="inf">
                    <?php echo e($customer->first_name); ?> <?php echo e($customer->last_name); ?>

                  </div>
                </div>
              </td>
              <td class="nowrap"><?php echo e($customer->email); ?></td>
              <td class="nowrap"><?php echo e($customer->phone ?? 'N/A'); ?></td>

              <td>
                <span class="badge badge-<?php echo e($customer->status == 1 ? 'success' : 'danger'); ?>-lighten"
                  title="<?php echo e($customer->status == 1 ? 'Active' : 'Revoked'); ?>" id="status_<?php echo e($hashedID); ?>"
                  <?php echo $canEditRow ? "role='button' tabindex='0' onclick='changeStatus(\"$hashedID\")'" : ''; ?>>
                  <?php echo e(__($customer->status == 1 ? 'Active' : 'Revoked')); ?>

                </span>

              </td>
              <td class="nowrap">
                <?php echo e($customer->last_login ? convertDateTimeHours($customer->last_login) : 'N/A'); ?>

              </td>
              <td class="updatedby">
                <div class="inf">
                  <span><?php echo e(convertDateTimeHours($customer->created_at)); ?></span>
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
  <?php echo e($customers->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    function changeStatus(id) {
      url = `<?php echo e(route('admin.customers.edit.status', ':id')); ?>`.replace(':id', id);
      changeStatusAjax(url, id);
    }

    function deleteRecord(id) {
      url = `<?php echo e(route('admin.customers.delete', ':id')); ?>`.replace(':id', id);
      deleteAjax(url);
    }

    $("#deleteBtn").on("click", function() {
      deleteMultipleAjax(`<?php echo e(route('admin.customers.delete.multiple')); ?>`);
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
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/order-manage/customers-table.blade.php ENDPATH**/ ?>