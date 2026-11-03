<?php $__env->startSection('page-styles'); ?>
  <link href="<?php echo e(asset('/public/backend/assetss/select2/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve(['pageTitle' => $pageTitle,'skipLevels' => $adminUser['id'] ? [1] : []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php $component = App\View\Components\FormCard::resolve(['formTitle' => $cardHeader,'backRoute' => route('admin.users'),'formId' => 'userForm'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FormCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="row">
      <div class="col-md-4">
        <div class="mb-3 required">
          <label class="form-label">First Name</label>
          <input class="form-control only-alphabet-symbols" type="text" name="firstname" id="firstname"
            value="<?php echo e($adminUser['first_name']); ?>">
          <div id="firstname-error-container"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="mb-3 not-required">
          <label class="form-label">Middle Name</label>
          <input class="form-control only-alphabet-symbols" type="text" name="middlename" id="middlename"
            value="<?php echo e($adminUser['middle_name']); ?>">
          <div id="middlename-error-container"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="mb-3 not-required">
          <label class="form-label">Last Name</label>
          <input class="form-control only-alphabet-symbols" type="text" name="lastname" id="lastname"
            value="<?php echo e($adminUser['last_name']); ?>">
          <div id="lastname-error-container"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="mb-3 required">
          <label class="form-label">Email</label>
          <input class="form-control" type="email" name="adminemail" id="adminemail" value="<?php echo e($adminUser['email']); ?>">
          <div id="adminemail-error-container"></div>
        </div>
      </div>
      <div class="col-md-4">
        <?php if (isset($component)) { $__componentOriginal3d68ecf3e28393b1ba3bad4e4abaef06 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d68ecf3e28393b1ba3bad4e4abaef06 = $attributes; } ?>
<?php $component = App\View\Components\PhoneNumber::resolve(['required' => true,'previousValue' => $adminUser['phone'],'name' => 'adminphone','id' => 'adminphone'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('phone-number'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\PhoneNumber::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d68ecf3e28393b1ba3bad4e4abaef06)): ?>
<?php $attributes = $__attributesOriginal3d68ecf3e28393b1ba3bad4e4abaef06; ?>
<?php unset($__attributesOriginal3d68ecf3e28393b1ba3bad4e4abaef06); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d68ecf3e28393b1ba3bad4e4abaef06)): ?>
<?php $component = $__componentOriginal3d68ecf3e28393b1ba3bad4e4abaef06; ?>
<?php unset($__componentOriginal3d68ecf3e28393b1ba3bad4e4abaef06); ?>
<?php endif; ?>
      </div>
      <div class="col-md-4">
        <div class="mb-3 required">
          <label class="form-label">Status</label>
          <select name="status" id="div_status" class="form-select">
            <option value="1" <?php echo e($adminUser['status'] === 1 ? 'selected' : ''); ?>>Active</option>
            <option value="0" <?php echo e($adminUser['status'] === 0 ? 'selected' : ''); ?>>Inactive</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3 required">
          <label class="form-label">Select Role</label>
          <select class="form-select select2" name="adminrole[]" id="adminrole" multiple
            style="line-height: 41.6px !important;">
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e(Hashids::encode($role->id)); ?>"
                <?php echo e(in_array($role->id, $adminUser['role'] ?? []) ? 'selected' : ''); ?>>
                <?php echo e($role->name); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <div id="adminrole-error-container"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label">Select Department</label>
          <select class="form-select select2" name="department" id="department">
            <option value="">Select Department</option>
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e(Hashids::encode($department->id ?? null)); ?>"
                <?php echo e($department->id == ($adminUser['department'] ?? 0) ? 'selected' : ''); ?>>
                <?php echo e($department->name); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <div id="department-error-container"></div>
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
  <script src="<?php echo e(asset('/public/backend/assetss/select2/select2.min.js')); ?>"></script>
  <script src="<?php echo e(asset('/public/common/js/custom_input.js?v=1' . time())); ?>"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2();

      let isUpdating = false;

      $('#adminrole').on('change', function() {
        if (isUpdating) return; // Prevent recursion

        var selectData = $(this).select2('data'); // Get selected options
        var isSuperAdminSelected = selectData.some(option => option.text.trim() === 'Super Admin');

        if (isSuperAdminSelected) {
          // Find the "Super Admin" option
          var superAdminOption = selectData.find(option => option.text.trim() === 'Super Admin');
          swalNotify("Great!", "You have selected \"Super Admin\". No other options can be selected.", "success");
          // Prevent further selection modifications during this operation
          isUpdating = true;

          // Keep only "Super Admin" selected
          $(this).val([superAdminOption.id]).trigger('change');

          isUpdating = false; // Reset the flag
        }
      });

      $('#userForm').validate({
        ignore: [],
        rules: {
          firstname: {
            required: true,
            minlength: 3,
            maxlength: 100
          },
          middlename: {
            required: false,
            maxlength: 100
          },
          lastname: {
            required: false,
            maxlength: 100
          },
          adminemail: {
            required: true,
            email: true,
            maxlength: 100
          },
          adminphone: {
            required: true,
            validPhone: true // Custom validation method from PhoneNumber Component
          },
          "adminrole[]": {
            required: true
          }
        },
        messages: {
          firstname: {
            required: "<?php echo e(__('validation.required', ['attribute' => 'First Name'])); ?>",
            minlength: "<?php echo e(__('validation.minlength', ['attribute' => 'First Name', 'min' => 3])); ?>",
            maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'First Name', 'max' => 100])); ?>"
          },
          middlename: {
            maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Middle Name', 'max' => 100])); ?>"
          },
          lastname: {
            maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Last Name', 'max' => 100])); ?>"
          },
          adminemail: {
            required: "<?php echo e(__('validation.required', ['attribute' => 'Email'])); ?>",
            email: "<?php echo e(__('validation.invalid', ['attribute' => 'Email Format'])); ?>",
            maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Email', 'max' => 100])); ?>"
          },
          adminphone: {
            required: "<?php echo e(__('validation.required', ['attribute' => 'Phone'])); ?>",
            minlength: "<?php echo e(__('validation.mindigits', ['attribute' => 'Phone', 'min' => 10])); ?>"
          },
          "adminrole[]": {
            required: "<?php echo e(__('validation.required', ['attribute' => 'At Least One Role'])); ?>"
          }
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
          let errorContainer = $(`#${element.attr('id')}-error-container`);
          // Check if element is a Select2
          if (element.hasClass("select2-hidden-accessible")) {
            let select2Container = element.next(".select2-container");

            if (errorContainer.length) {
              error.appendTo(errorContainer);
            } else {
              error.insertAfter(select2Container); // Place after Select2 container
            }
          } else {
            if (errorContainer.length) {
              error.appendTo(errorContainer);
            } else {
              error.insertAfter(element); // Fallback for other elements
            }
          }
        },
        highlight: function(element) {
          // Add is-invalid for Select2
          if ($(element).hasClass("select2-hidden-accessible")) {
            $(element).next(".select2-container").addClass("is-invalid").removeClass("is-valid");
          } else {
            $(element).addClass("is-invalid").removeClass("is-valid");
          }
        },
        unhighlight: function(element) {
          // Remove is-invalid for Select2
          if ($(element).hasClass("select2-hidden-accessible")) {
            $(element).next(".select2-container").removeClass("is-invalid").addClass("is-valid");
          } else {
            $(element).removeClass("is-invalid").addClass("is-valid");
          }
        },
        submitHandler: function(form) {
          let formID = "<?php echo e(Hashids::encode($adminUser['id'] ?? '')); ?>"
          let url = "<?php echo e(route('admin.users.store')); ?>"
          if (formID)
            url = `<?php echo e(route('admin.users.update', ':id')); ?>`.replace(':id', formID);
          $.ajax({
            type: "POST",
            url: url,
            data: $('#userForm').serialize(),
            success: function(response) {
              if (response.success) {
                $(form).find(".is-valid, .is-invalid").removeClass("is-valid is-invalid");
                swalNotify("Success!", response.message, "success");
                if (!formID) {
                  form.reset();
                  $(form).find(".select2").val(null).trigger("change.select2");
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

    $(".select2").on("change", function() {
      $(this).valid();
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/backend/pages/admin/users/form.blade.php ENDPATH**/ ?>