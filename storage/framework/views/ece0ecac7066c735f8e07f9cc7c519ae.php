<div>
  <div class="d-flex filter-small justify-content-end align-items-center mb-2">
    <div class="d-flex min-250 me-2" wire:ignore>
      <select class="form-select select2" name="order_status" id="order_status">
        <option value="">Order Status</option>

        <?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <!--[if BLOCK]><![endif]--><?php if($key > 0): ?>
            <option value="<?php echo e(Hashids::encode($key)); ?>">
              <?php echo e($status); ?>

            </option>
          <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        
      </select>
    </div>
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
        $canEdit = hasUserPermission('admin.orders.edit');
        $canDelete = hasUserPermission('admin.orders.delete');
      ?>
      <thead>
        <tr>
          <th class="">Sl.</th>
          <th class="">Action</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'created_at',
              'displayName' => 'Purchase Date',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'order_number',
              'displayName' => 'Order Number',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'order_status',
              'displayName' => 'Status',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'order_total',
              'displayName' => 'Amount',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'user_id',
              'displayName' => 'Customer',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <th class="">Email</th>

          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'payment_method',
              'displayName' => 'Payment Method',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </tr>
      </thead>
      <tbody>
        <?php $sl = 1; ?>
        <!--[if BLOCK]><![endif]--><?php if(count($orders) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $hashedID = Hashids::encode($order->id); ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              <td class=""><?php echo e($serialNumber++); ?></td>
              <td class="table-action ">
                <div class="d-flex">
                  <a href="<?php echo e($canEdit ? route('admin.orders.edit', $hashedID) : 'javascript:void(0);'); ?>"
                    class="action-icon text-info <?php echo e($canEdit ? '' : 'disabled-link'); ?>" title="Edit">
                    <i class="ri-pencil-line"></i>
                  </a>
                </div>
              </td>
              <td class=""><?php echo e(convertDate($order->created_at)); ?></td>
              <td class="nowrap">
                <div class="d-flex justify-content-start align-items-center">
                  <?php echo e($order->order_number); ?>

                </div>
              </td>
              <td class="">
                <div class="d-flex justify-content-start align-items-center">
                  <span class="badge <?php echo e($statusColor[$order->order_status]); ?> text-white">
                    <?php echo e($orderStatus[$order->order_status]); ?>

                  </span>
                </div>
              </td>
              <td class=""><?php echo e(displayPrice($order->net_total)); ?></td>
              <td class="nowrap"><?php echo e(userNameById('', $order->user_id)); ?></td>
              <td class=""><?php echo e(userDetailById('', $order->user_id)->email); ?></td>
              <td class=""><?php echo e($order->payment_method_display); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="12" class="">
              <div role="alert" class="alert alert-danger text-center text-danger">No orders Found
              </div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($orders->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  <script src="<?php echo e(asset('/public/backend/assetss/select2/select2.min.js')); ?>"></script>
  <script>
    $(document).ready(function() {
      $('#order_status').on('change', function() {
        var orderStatus = $(this).val();
        Livewire.dispatch('updateValue', [orderStatus]);
        // triggerChange();
      });

      $('#order_status').select2({
        placeholder: 'Filter by Status',
        allowClear: true,
      });

      function changeStatus(id) {
        url = `<?php echo e(route('admin.orders.edit.status', ':id')); ?>`.replace(':id', id);
        changeStatusAjax(url, id);
      }

      function deleteRecord(id) {
        url = `<?php echo e(route('admin.orders.delete', ':id')); ?>`.replace(':id', id);
        deleteAjax(url);
      }

      $("#deleteBtn").on("click", function() {
        deleteMultipleAjax(`<?php echo e(route('admin.orders.delete.multiple')); ?>`);
      });
    });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/livewire/order-manage/orders-table.blade.php ENDPATH**/ ?>