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
                    <th>Sl.</th>
                    <?php echo $__env->make('livewire.includes.datatable-header-sort', [
                        'colName' => 'order_number',
                        'displayName' => 'Order Number',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('livewire.includes.datatable-header-sort', [
                        'colName' => 'net_total',
                        'displayName' => 'Net Total',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <th>Order Status</th>
                    <?php echo $__env->make('livewire.includes.datatable-header-sort', [
                        'colName' => 'created_at',
                        'displayName' => 'Order Date',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </tr>
            </thead>
            <tbody>
                <!--[if BLOCK]><![endif]--><?php if(count($orders) > 0): ?>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $hashedID = Hashids::encode($order->id); ?>
                        <tr id="orders_<?php echo e($hashedID); ?>">
                            <td><?php echo e($serialNumber++); ?></td>
                            <td><a href="<?php echo e(route('admin.orders.edit', $hashedID)); ?>"><?php echo e($order->order_number); ?></a></td>
                            <td><?php echo e(displayPrice($order->net_total)); ?></td>
                            <td>
                              <div class="d-flex justify-content-start align-items-center">
                                <span class="badge <?php echo e($statusColor[$order->order_status]); ?> text-white">
                                  <?php echo e($orderStatus[$order->order_status]); ?>

                                </span>
                              </div>
                            </td>
                            <td><?php echo e($order->created_at->format('Y-m-d H:i:s')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                <?php else: ?>
                    <tr>
                        <td colspan="5">
                            <div role="alert" class="alert alert-danger text-center text-danger">No Orders Found</div>
                        </td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <?php echo e($orders->links('vendor.livewire.bootstrap')); ?>

</div>


<?php $__env->startPush('component-scripts'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#reportrange').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        alwaysShowCalendars: true,
    }, function(start, end, label) {
        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('startDate', start.format('YYYY-MM-DD'));
        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('endDate', end.format('YYYY-MM-DD'));
    });
});
  </script>

<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/reports/customer-orders-table.blade.php ENDPATH**/ ?>