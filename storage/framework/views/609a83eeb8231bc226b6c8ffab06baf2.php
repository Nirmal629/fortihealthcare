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
        $canEdit = hasUserPermission('admin.orders.edit');
        $canDelete = hasUserPermission('admin.orders.delete');
      ?>
      <thead>
        <tr>
          <th class="">Sl.</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'customer_name',
              'displayName' => 'Customer Name',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'order_number',
              'displayName' => 'Order Number',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'order_status',
              'displayName' => 'Shipping Status',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'created_at',
              'displayName' => 'Delivery Date',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'shipping_address',
              'displayName' => 'Shipping Address',
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
              <td class="updatedby">
                  <div class="thumb">
                    <span class="account-user-avatar">
                      <img src=<?php echo e(userImageById('user', $order->user_id)['thumbnail']); ?> alt="user-image"
                      width="32" class="rounded-circle">
                    </span>
                    <div class="inf">
                      <?php echo e(userNameById('', $order->user_id)); ?>

                    </div>
                  </div>
                </td>

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
              <td class=" updatedby">
                <span><?php echo e(convertDateTimeHours($order->created_at)); ?></span>
              </td>
              <td>
                <?php
                    $shipping_address = json_decode($order->shipping_address);
                    $shipping_name    = data_get($shipping_address, 'name');
                    $shipping_address = data_get($shipping_address, 'address');
                    $shipping_phone   = data_get($shipping_address, 'phone');
                ?>
                 <?php echo e($shipping_name); ?> <br><?php echo e($shipping_address); ?> <br> <?php echo e($shipping_phone); ?>

              </td>
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

  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/livewire/order-manage/shipping-billing-table.blade.php ENDPATH**/ ?>