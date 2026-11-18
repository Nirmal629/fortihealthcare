<div>
  <div class="d-flex filter-small justify-content-end align-items-center mb-2">
    <div class="d-flex w-25 me-2" wire:ignore>
      <select class="form-select select2" name="country" id="country">
        <option value="">Select Country</option>
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e(Hashids::encode($country['id'])); ?>">
            <?php echo e($country['name']); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      </select>
    </div>

    <?php echo $__env->make('livewire.includes.datatable-search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  </div>
  <?php echo $__env->make('livewire.includes.datatable-pagecount', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="table-responsive">
    <table class="table table-centered mb-0">
      <thead>
        <tr>
          <th class="sl-col">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="maincheck">
              <label class="form-check-label" for="customCheck1"></label>
            </div>
          </th>
          <th class="">Sl.</th>
          <th class="">Action</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'country_id',
              'displayName' => 'Country',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'name',
              'displayName' => 'State Name',
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
        <!--[if BLOCK]><![endif]--><?php if($locations->count() > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $hashedID = Hashids::encode($location->id); ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              <td>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="check_<?php echo e($hashedID); ?>">
                  <label class="form-check-label"></label>
                </div>
              </td>
              <td class=""><?php echo e($serialNumber++); ?></td>
              <td class="table-action ">
                <div class="d-flex">
                  <a href="<?php echo e(route('admin.states.edit', $hashedID)); ?>" class="action-icon text-info" title="Edit">
                    <i class="ri-pencil-line"></i></a>
                  <a href="javascript: void(0);" class="action-icon text-danger" title="Remove"
                    onclick="deleteRecord('<?php echo e($hashedID); ?>')"> <i class="ri-delete-bin-line"></i></a>
                </div>
              </td>
              <td class=""><?php echo e($location->country->name); ?> (<?php echo e($location->country->code); ?>)</td>
              <td class=""><?php echo e($location->name); ?></td>
              
              <td class=" updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src=<?php echo e(userImageById('admin', $location->created_by)['thumbnail']); ?> alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e($location->created_by ? userNameById('admin', $location->created_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($location->created_at)); ?></span>
                  </div>
                </div>
              </td>
              <td class=" updatedby">
                <div class="thumb">
                  <span class="account-user-avatar">
                    <img src=<?php echo e(userImageById('admin', $location->updated_by)['thumbnail']); ?> alt="user-image"
                      width="32" class="rounded-circle">
                  </span>
                  <div class="inf">
                    <?php echo e($location->updated_by ? userNameById('admin', $location->updated_by) : 'N/A'); ?>

                    <span><?php echo e(convertDateTimeHours($location->updated_at)); ?></span>
                  </div>
                </div>
              </td>

            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="8" class="">
              <div role="alert" class="alert alert-danger text-center text-danger">No States Found</div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($locations->links('vendor.livewire.bootstrap')); ?>

</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    $('#country').select2({
      placeholder: 'Filter by Country',
      allowClear: true,
      width: '100%',
    });

    $('#country').on('change', function() {
      var countryId = $(this).val();
      Livewire.dispatch('countryChangedComponent', [countryId]);
    });

    function changeStatus(id) {
      url = `<?php echo e(route('admin.states.edit.status', ':id')); ?>`.replace(':id', id);
      changeStatusAjax(url, id);
    }

    function deleteRecord(id) {
      url = `<?php echo e(route('admin.states.delete', ':id')); ?>`.replace(':id', id);
      deleteAjax(url);
    }

    $("#deleteBtn").on("click", function() {
      deleteMultipleAjax(`<?php echo e(route('admin.states.delete.multiple')); ?>`);
    });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/system/location-table.blade.php ENDPATH**/ ?>