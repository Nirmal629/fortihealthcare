<div>

  <div class="d-flex filter-small justify-content-end align-items-center mb-2">
    

    

  </div>
  <?php echo $__env->make('livewire.includes.datatable-pagecount', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="table-responsive">
    <table class="table table-centered mb-0">
      <thead>
        <tr>
          <th>Sl.</th>
          <th>Status</th>
          <th>Logged Date - Time</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>

        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $orderHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <?php
            $statuses = getStatuses();
          ?>
          <tr>
            <td> <?php echo e($serialNumber++); ?></td>
            <td><?php echo e($statuses[$history->status] ?? 'Unknown'); ?></td>
            <td><?php echo e(convertDate($history->scheduled_date)); ?>

              <?php echo e(\Carbon\Carbon::parse($history->scheduled_time)->format('h:i A')); ?></td>
            <td><?php echo e($history->description ?? 'N/A'); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="4" class="text-center">No Order history available.</td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($orderHistory->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/order-manage/order-history-table.blade.php ENDPATH**/ ?>