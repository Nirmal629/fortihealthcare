<?php $__env->startSection('page-styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve(['pageTitle' => $pageTitle,'skipLevels' => $role->id ? [1] : []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Breadcrumb::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $attributes = $__attributesOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__attributesOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $component = $__componentOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__componentOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginal010d7f86e3f33f397845e24b9949ed37 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal010d7f86e3f33f397845e24b9949ed37 = $attributes; } ?>
<?php $component = App\View\Components\FormCard::resolve(['formTitle' => $cardHeader,'backRoute' => route('admin.roles'),'formId' => 'roleForm'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FormCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="row">
      <div class="col-md-6">
        <div class="mb-3 required">
          <label class="form-label">Role Name</label>
          <input class="form-control only-alphabet-numbers-symbols" type="text" name="rolename" id="rolename"
            value="<?php echo e($role->name); ?>">
          <div id="rolename-error-container"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3 required">
          <label class="form-label">Status </label>
          <select name="status" id="div_status" class="form-select">
            <option value="1" <?php echo e($role->status === 1 ? 'selected' : ''); ?>>Active</option>
            <option value="0" <?php echo e($role->status === 0 ? 'selected' : ''); ?>>Inactive</option>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="mb-3 not-required">
          <label for="password" class="form-label">Description </label>
          <textarea class="form-control" rows="3" name="description" id="description"
            placeholder="Role description (optional)"><?php echo e($role->description); ?></textarea>
          <div id="description-error-container"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="d-flex card-header justify-content-between align-items-center">
            <h4 class="header-title">Set Permissions for <span id="roleName"><?php echo e($role->name ?? 'New Role'); ?></span></h4>
          </div>
          <div class="card-body">
            <?php if (isset($component)) { $__componentOriginala5b7c31bfac4efc12639e3c3a35ccfe9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala5b7c31bfac4efc12639e3c3a35ccfe9 = $attributes; } ?>
<?php $component = App\View\Components\PermissionList::resolve(['modulesList' => $modules,'checkedPermissions' => $checkedPermissions] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('permission-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\PermissionList::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala5b7c31bfac4efc12639e3c3a35ccfe9)): ?>
<?php $attributes = $__attributesOriginala5b7c31bfac4efc12639e3c3a35ccfe9; ?>
<?php unset($__attributesOriginala5b7c31bfac4efc12639e3c3a35ccfe9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala5b7c31bfac4efc12639e3c3a35ccfe9)): ?>
<?php $component = $__componentOriginala5b7c31bfac4efc12639e3c3a35ccfe9; ?>
<?php unset($__componentOriginala5b7c31bfac4efc12639e3c3a35ccfe9); ?>
<?php endif; ?>
          </div>
        </div>
      </div>
    </div>
   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal010d7f86e3f33f397845e24b9949ed37)): ?>
<?php $attributes = $__attributesOriginal010d7f86e3f33f397845e24b9949ed37; ?>
<?php unset($__attributesOriginal010d7f86e3f33f397845e24b9949ed37); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal010d7f86e3f33f397845e24b9949ed37)): ?>
<?php $component = $__componentOriginal010d7f86e3f33f397845e24b9949ed37; ?>
<?php unset($__componentOriginal010d7f86e3f33f397845e24b9949ed37); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
  <script src="<?php echo e(asset('/public/backend/assetss/js/jquery.validate.min.js')); ?>"></script>
  <script src="<?php echo e(asset('/public/common/js/custom_input.js?v=' . time())); ?>"></script>
  <script>
    $(document).ready(function() {
      $('#roleForm').validate({
        rules: {
          rolename: {
            required: true,
            minlength: 3,
            maxlength: 100
          },
          description: {
            maxlength: 1000
          }
        },
        messages: {
          rolename: {
            required: "<?php echo e(__('validation.required', ['attribute' => 'Role Name'])); ?>",
            minlength: "<?php echo e(__('validation.minlength', ['attribute' => 'Role Name', 'min' => 3])); ?>",
            maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Role Name', 'max' => 100])); ?>"
          },
          description: {
            maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Description', 'max' => 1000])); ?>"
          }
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
          let errorContainer = $(`#${element.attr('id')}-error-container`);
          if (errorContainer.length) {
            error.appendTo(errorContainer);
          } else {
            error.insertAfter(element); // Fallback
          }
        },
        highlight: function(element) {
          $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element) {
          $(element).removeClass("is-invalid").addClass("is-valid");
        },
        submitHandler: function(form) {
          let formID = "<?php echo e(Hashids::encode($role->id ?? '')); ?>"
          let url = "<?php echo e(route('admin.roles.store')); ?>"
          if (formID)
            url = `<?php echo e(route('admin.roles.update', ':id')); ?>`.replace(':id', formID);
          $.ajax({
            type: "POST",
            url: url,
            data: $('#roleForm').serialize(),
            success: function(response) {
              if (response.success) {
                $('.is-valid').removeClass('is-valid');
                swalNotify("Success!", response.message, "success");
                if (!formID) {
                  $('#roleForm')[0].reset();
                }
              } else {
                swalNotify("Oops!", response.message, "error");
              }
            },
            error: function(error) {
              swalNotify("Error!", error.responseJSON.message, "error");
            }
          })
        }
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/backend/pages/admin/role/form.blade.php ENDPATH**/ ?>