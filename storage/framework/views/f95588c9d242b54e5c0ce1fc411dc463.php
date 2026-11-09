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
        $canEdit = hasUserPermission('admin.cms-pages.edit');
        $canDelete = hasUserPermission('admin.cms-pages.delete');
      ?>
      <thead>
        <tr>
          
          <th class="">Sl.</th>
          <th class="">Action</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'title',
              'displayName' => 'Title',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'slug',
              'displayName' => 'Slug',
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
        <?php $sl = 1; ?>
        <!--[if BLOCK]><![endif]--><?php if(count($cmsPages) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cmsPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmsPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <?php if($cmsPage->slug == 'faqs') continue; ?>
            <?php $hashedID = Hashids::encode($cmsPage->id); ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              
              <td class=""><?php echo e($serialNumber++); ?></td>
              <td class="table-action ">
                <div class="d-flex">
                  <a href="<?php echo e($canEdit ? route('admin.cms-pages.edit', $hashedID) : 'javascript:void(0);'); ?>"
                    class="action-icon text-info <?php echo e($canEdit ? '' : 'disabled-link'); ?>" title="Edit">
                    <i class="ri-pencil-line"></i>
                  </a>
                  <a href="javascript:void(0);" class="action-icon text-danger disabled-link" title="Remove">
                    <i class="ri-delete-bin-line"></i>
                  </a>
                </div>
              </td>

              <td>
                <?php echo e($cmsPage->title); ?>

              </td>
              <td class="">
                <?php echo e($cmsPage->slug); ?>

              </td>
              <td class="">
                <span class="badge badge-<?php echo e($cmsPage->status ? 'success' : 'danger'); ?>-lighten"
                  title="<?php echo e($cmsPage->status ? 'Active' : 'Inactive'); ?>" id="status_<?php echo e($hashedID); ?>"
                  <?php echo e($canEdit ? 'role=button tabindex=0 onclick=changeStatus("' . $hashedID . '")' : ''); ?>>
                  <?php echo e($cmsPage->status ? 'Active' : 'Inactive'); ?>

                </span>
              </td>
              <td class=" updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src=<?php echo e(userImageById('admin', $cmsPage->created_by)['thumbnail']); ?> alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e($cmsPage->created_by ? userNameById('admin', $cmsPage->created_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($cmsPage->created_at)); ?></span>
                  </div>
                </div>
              </td>
              <td class=" updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src=<?php echo e(userImageById('admin', $cmsPage->updated_by)['thumbnail']); ?> alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e($cmsPage->updated_by ? userNameById('admin', $cmsPage->updated_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($cmsPage->updated_at)); ?></span>
                  </div>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="10" class="">
              <div role="alert" class="alert alert-danger text-center text-danger">No Cms Pages Found</div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($cmsPages->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    function changeStatus(id) {
      url = `<?php echo e(route('admin.cms-pages.edit.status', ':id')); ?>`.replace(':id', id);
      changeStatusAjax(url, id);
    }

    function deleteRecord(id) {
      url = `<?php echo e(route('admin.cms-pages.delete', ':id')); ?>`.replace(':id', id);
      deleteAjax(url);
    }

    $("#deleteBtn").on("click", function() {
      deleteMultipleAjax(`<?php echo e(route('admin.cms-pages.delete.multiple')); ?>`);
    });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/content-manage/cms-page-table.blade.php ENDPATH**/ ?>