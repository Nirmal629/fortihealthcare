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
        $canEdit = hasUserPermission('admin.newsletter.edit');
        $canDelete = hasUserPermission('admin.newsletter.delete');
      ?>
      <thead>
        <tr>
          
          <th class="">Sl.</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'email',
              'displayName' => 'Email',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'is_subscribe',
              'displayName' => 'Is Subscribed',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'created_at',
              'displayName' => 'Created At',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </tr>
      </thead>
      <tbody>
        <?php $sl = 1; ?>
        <!--[if BLOCK]><![endif]--><?php if(count($newsletters) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $newsletters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsletter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $hashedID = Hashids::encode($newsletter->id); ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              
              <td class=""><?php echo e($serialNumber++); ?></td>
              <td>
                <?php echo e($newsletter->email ?? 'N/A'); ?>

              </td>
              <td>
                <!--[if BLOCK]><![endif]--><?php if($newsletter->is_subscribe == 1): ?>
                  <span class="badge bg-success">Subscribed</span>
                <?php elseif($newsletter->is_subscribe == 0): ?>
                  <span class="badge bg-danger">Pending</span>
                <?php else: ?>
                  <span class="badge bg-secondary">N/A</span>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
              </td>
              <td class="">
                <?php echo e(convertDateTimeHours($newsletter->created_at)); ?>

              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="4" class="">
              <div role="alert" class="alert alert-danger text-center text-danger">No Newsletters Found</div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($newsletters->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/promotions/newsletter-table.blade.php ENDPATH**/ ?>