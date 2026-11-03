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
                        'colName' => 'query',
                        'displayName' => 'Search Query',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('livewire.includes.datatable-header-sort', [
                        'colName' => 'count',
                        'displayName' => 'Search Count',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('livewire.includes.datatable-header-sort', [
                        'colName' => 'created_at',
                        'displayName' => 'Last Searched',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </tr>
            </thead>
            <tbody>
                <!--[if BLOCK]><![endif]--><?php if(count($searchQueries) > 0): ?>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $searchQueries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $searchQuery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($serialNumber++); ?></td>
                            <td><?php echo e($searchQuery->query); ?></td>
                            <td><?php echo e($searchQuery->count); ?></td>
                            <td><?php echo e($searchQuery->created_at->format('Y-m-d H:i:s')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                <?php else: ?>
                    <tr>
                        <td colspan="4">
                            <div role="alert" class="alert alert-danger text-center text-danger">No Search Queries Found</div>
                        </td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <?php echo e($searchQueries->links('vendor.livewire.bootstrap')); ?>

</div>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/reports/search-query-table.blade.php ENDPATH**/ ?>