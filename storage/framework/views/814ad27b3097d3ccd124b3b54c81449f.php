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
                        'colName' => 'user_name',
                        'displayName' => 'Customer Name',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('livewire.includes.datatable-header-sort', [
                        'colName' => 'total_order_amount',
                        'displayName' => 'Order Amount',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('livewire.includes.datatable-header-sort', [
                        'colName' => 'order_count',
                        'displayName' => 'Order Count',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </tr>
            </thead>

            <tbody>
                <!--[if BLOCK]><![endif]--><?php if(count($customers) > 0): ?>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="row_<?php echo e($customer->user_id); ?>">
                            <td><?php echo e($serialNumber++); ?></td>
                            
                            <td>
                                <a href="<?php echo e(route('admin.reports.customer-order-list', ['user_id' => Hashids::encode($customer->user_id)])); ?>"><?php echo e($customer->user_name); ?></a>
                            </td>
                            <td><?php echo e(displayPrice($customer->total_order_amount)); ?></td>
                            <td><?php echo e($customer->order_count); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                <?php else: ?>
                    <tr>
                        <td colspan="4">
                            <div role="alert" class="alert alert-danger text-center text-danger">No Customers Found</div>
                        </td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <?php echo e($customers->links('vendor.livewire.bootstrap')); ?>

</div>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/livewire/reports/top-customer-by-revenue-table.blade.php ENDPATH**/ ?>