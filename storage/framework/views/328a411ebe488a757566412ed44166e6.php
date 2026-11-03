<div>
  <div class="d-flex filter-small justify-content-end align-items-center mb-2">
    <?php echo $__env->make('livewire.includes.datatable-search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>
  <?php echo $__env->make('livewire.includes.datatable-pagecount', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="table-responsive">
    <table class="table table-centered mb-0">
      <?php
        $canEdit = hasUserPermission('admin.contact.edit');
        $canDelete = hasUserPermission('admin.contact.delete');
      ?>
      <thead>
        <tr>
          <th class="sl-col">
          <th class="">Sl.</th>
          <th class="">Action</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'name',
              'displayName' => 'Name',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'email',
              'displayName' => 'Email',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'phone',
              'displayName' => 'Phone',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'created_at',
              'displayName' => 'Created At',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </tr>
      </thead>
      <tbody>
        <?php $sl = 1; ?>
        <!--[if BLOCK]><![endif]--><?php if(count($contacts) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $hashedID = Hashids::encode($contact->id); ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              <td>
              </td>
              <td class=""><?php echo e($serialNumber++); ?></td>
              <td class="table-action ">
                <div class="d-flex">
                  <!-- View Details Icon -->
                  <a href="javascript:void(0);" class="action-icon text-primary me-2"
                     title="View Details" data-bs-toggle="modal" data-bs-target="#contactDetailsModal"
                     onclick="viewDetails('<?php echo e($hashedID); ?>')">
                    <i class="ri-eye-line"></i>
                  </a>
                  <a href="javascript:void(0);" class="action-icon text-danger <?php echo e($canDelete ? '' : 'disabled-link'); ?>"
                    title="Remove" onclick="<?php echo e($canDelete ? 'deleteRecord(' . json_encode($hashedID) . ')' : ''); ?>">
                    <i class="ri-delete-bin-line"></i>
                  </a>
                </div>
              </td>
              <td class=""> <?php echo e($contact->name); ?></td>
              <td class=""> <?php echo e($contact->email); ?></td>
              <td class=""> <?php echo e($contact->phone ?? '-'); ?></td>
              <td><?php echo e(convertDateTimeHours($contact->created_at)); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="12" class="">
              <div role="alert" class="alert alert-danger text-center text-danger">No Ddata Found
              </div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
  </div>
  <?php echo e($contacts->links('vendor.livewire.bootstrap')); ?>


  <!-- Bootstrap Modal for Contact Details -->
    <div class="modal fade" id="contactDetailsModal" tabindex="-1" aria-labelledby="contactDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactDetailsModalLabel">Contact Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="contactDetailsContent">
                        <p><strong>Name:</strong> <span id="contactName"></span></p>
                        <p><strong>Email:</strong> <span id="contactEmail"></span></p>
                        <p><strong>Phone:</strong> <span id="contactPhone"></span></p>
                        <p><strong>Message:</strong> <span id="contactMessage"></span></p>
                        <p><strong>Submitted On:</strong> <span id="contactSubmittedOn"></span></p>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    function changeStatus(id) {
      url = `<?php echo e(route('admin.contacts.edit.status', ':id')); ?>`.replace(':id', id);
      changeStatusAjax(url, id);
    }
    function deleteRecord(id) {
      url = `<?php echo e(route('admin.contacts.delete', ':id')); ?>`.replace(':id', id);
      deleteAjax(url);
    }
    function viewDetails(id) {
      url = `<?php echo e(route('admin.contacts.details', ':id')); ?>`.replace(':id', id);
      $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
          console.log(response);

          if (response.success) {
            $('#contactName').text(response.data.name);
            $('#contactEmail').text(response.data.email);
            $('#contactPhone').text(response.data.phone || 'N/A');
            $('#contactMessage').text(response.data.message || 'No message provided');
            $('#contactSubmittedOn').text(response.data.created_at);
          } else {
            swalNotify("Oops!", response.message, "error");
          }
        },
        error: function() {
          swalNotify("Oops!", 'An error occurred while fetching contact details.', "error");
        }
      });
    }
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/livewire/contact-manage/contact-table.blade.php ENDPATH**/ ?>