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
          
          <th class="">Sl.</th>
          <th class="">Action</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'gateway_name',
              'displayName' => 'Name',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <th class="">Logo</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'gateway_mode',
              'displayName' => 'Mode',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'gateway_key',
              'displayName' => 'Key',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <th class="">Secret</th>
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
        <!--[if BLOCK]><![endif]--><?php if(count($payment_gateways) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $payment_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $hashedID = Hashids::encode($payment_gateway->id); ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              
              <td class=""><?php echo e($serialNumber++); ?></td>
              <td class="table-action ">
                <div class="d-flex">
                  <a href="<?php echo e(route('admin.payments.edit', $hashedID)); ?>" class="action-icon text-info" title="Edit">
                    <i class="ri-pencil-line"></i></a>
                  <a href="javascript: void(0);" class="action-icon text-muted pe-none" title="Remove"> <i
                      class="ri-delete-bin-line"></i></a>
                </div>
              </td>
              <td class=""><?php echo e($payment_gateway->gateway_name); ?> </td>
              <td class=""><img src=<?php echo e(asset('/public/common/images/gateway_logos/' . $payment_gateway->logo)); ?>

                  alt="logo" width="100" /> </td>
              <td class=""><?php echo e($payment_gateway->gateway_mode); ?></td>
              <td class=""><?php echo e(truncateNoWordBreak($payment_gateway->gateway_key, 20) ?? 'N/A'); ?></td>
              <td class="">
                <?php echo e($payment_gateway->gateway_secret ? str_repeat('*', 10) : 'N/A'); ?>

              </td>
              <td class="">
                <div class="actinact">
                  <span role="button" tabindex="0" id="status_<?php echo e($hashedID); ?>"
                    class="badge badge-<?php echo e($payment_gateway->status ? 'success' : 'danger'); ?>-lighten"
                    title="<?php echo e($payment_gateway->status ? 'Active' : 'Inactive'); ?>" id="status_<?php echo e($hashedID); ?>"
                    onclick="changeStatus('<?php echo e($hashedID); ?>')"><?php echo e($payment_gateway->status ? 'Active' : 'Inactive'); ?></span>
                </div>
              </td>
              <td class=" updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src=<?php echo e(userImageById('admin', $payment_gateway->created_by)['thumbnail']); ?> alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e($payment_gateway->created_by ? userNameById('admin', $payment_gateway->created_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($payment_gateway->created_at)); ?></span>
                  </div>
                </div>
              </td>
              <td class=" updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src=<?php echo e(userImageById('admin', $payment_gateway->updated_by)['thumbnail']); ?> alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e($payment_gateway->updated_by ? userNameById('admin', $payment_gateway->updated_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($payment_gateway->updated_at)); ?></span>
                  </div>
                </div>
              </td>

            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="11" class="">
              <div role="alert" class="alert alert-danger text-center text-danger">
                No Payment Options Found
              </div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($payment_gateways->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    $('#addBtn').attr('style', 'display: none !important');

    function changeStatus(id) {
      url = `<?php echo e(route('admin.payments.edit.status', ':id')); ?>`.replace(':id', id);
      changeStatusAjax(url, id);
    }

    function deleteRecord(id) {
      url = `<?php echo e(route('admin.payments.delete', ':id')); ?>`.replace(':id', id);
      deleteAjax(url);
    }

    $("#deleteBtn").on("click", function() {
      deleteMultipleAjax(`<?php echo e(route('admin.payments.delete.multiple')); ?>`);
    });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/system/payments-table.blade.php ENDPATH**/ ?>