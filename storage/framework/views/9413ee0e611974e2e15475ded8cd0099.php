<?php $__env->startSection('page-styles'); ?>
  <link href="<?php echo e(asset('/public/backend/assetss/select2/select2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve(['pageTitle' => $pageTitle,'skipLevels' => $order->id ? [1] : []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php $component = App\View\Components\FormCard::resolve(['formTitle' => $cardHeader,'backRoute' => route('admin.shipment-management'),'formId' => 'shipmentForm'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
          <label for="product_id" class="form-label">Order No</label>
          <input type="text" class="form-control" readonly value="<?php echo e($order->order_number ?? ''); ?>">
          <div id="order_number-error-container"></div>
        </div>
      </div>
      <div class="col-md-6">
        
        <div class="mb-3 required">
          <label for="order_status" class="form-label">Order Status</label>
          <select name="order_status" id="order_status" class="form-select">
            <?php $__currentLoopData = $shippingStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($key > 0): ?>
                <option value="<?php echo e(Hashids::encode($key)); ?>" <?php echo e($order->order_status == $key ? 'selected' : ''); ?>>
                  <?php echo e($status); ?>

                </option>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <div id="order_status"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3 required">
          <label class="form-label">Scheduled Date</label>
          <input type="text" class="form-control datepicker" name="scheduled_date" id="scheduled_date"
            value="<?php echo e($scheduledDate ? $scheduledDate : now()->format('d/m/Y')); ?>" autocomplete="new-date">
          <div id="scheduled_date-error-container" class="invalid-feedback"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3 required">
          <label class="form-label">Scheduled Time</label>
          <input type="time" class="form-control" name="scheduled_time" id="scheduled_time"
            value="<?php echo e($scheduledTime ? $scheduledTime : now()->format('H:i')); ?>">

          <div id="scheduled_time-error-container" class="invalid-feedback"></div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="mb-3 not-required">
          <label class="form-label">Description</label>
          <textarea rows="3" class="form-control" name="description" id="description" placeholder="Enter Description"></textarea>
          <div id="description-error-container"></div>
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

  <div class="card card-h-100">
    <div class="d-flex card-header justify-content-between align-items-center">
      <h4 class="header-title mb-0">Order Status History</h4>
    </div>
    <div class="card-body">
      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('order-manage.order-history-table', ['order' => $order]);

$__html = app('livewire')->mount($__name, $__params, 'lw-3171402295-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
  </div>

  
<?php $__env->stopSection(); ?>
<?php $__env->startPush('component-styles'); ?>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <style>
    .invalid-feedback {
      all: unset;
    }
  </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-scripts'); ?>
  <script src="<?php echo e(asset('/public/backend/assetss/js/jquery.validate.min.js')); ?>"></script>
  <script src="<?php echo e(asset('/public/backend/assetss/select2/select2.min.js')); ?>"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="<?php echo e(asset('/public/common/js/custom_input.js?v=' . time())); ?>"></script>
  <script>
    $('#order_status').select2({
      'placeholder': 'Select Status',
    });
    $('.datepicker').datepicker({
      dateFormat: "dd/mm/yy",
      changeMonth: true,
      changeYear: true,
      onClose: function() {
        $(this).valid();
      }
    });
    $('.datepicker').on('keydown paste', function(e) {
      e.preventDefault();
    });

    $.validator.addMethod("dateFormat", function(value, element) {
      return this.optional(element) || /^\d{2}\/\d{2}\/\d{4}$/.test(value);
    }, "Please enter a valid date in the format dd/mm/yyyy.");
    $('#shipmentForm').validate({
      rules: {
        scheduled_date: {
          required: true,
          // date: true,
          dateFormat: true
        },
        'scheduled_time': {
          required: true,
        },
      },
      messages: {
        scheduled_date: {
          required: "__('validation.required', ['attribute' => 'Schedule Date'])",
        },
        scheduled_time: {
          required: "__('validation.required', ['attribute' => 'Schedule Time'])",
        },

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
        let formID = '<?php echo e(Hashids::encode($order->id ?? '')); ?>'
        if (formID)
          url = `<?php echo e(route('admin.shipment-management.update', ':id')); ?>`.replace(':id', formID);
        $.ajax({
          type: "POST",
          url: url,
          data: $('#shipmentForm').serialize(),
          success: function(response) {
            if (response.success) {
              swalNotify("Success!", response.message, "success");
              $(form).find(".is-valid, .is-invalid").removeClass("is-valid is-invalid");
              if (!formID) {
                form.reset();
                $(form).find(".select2").val(null).trigger("change.select2");
              }
              Livewire.dispatch('refreshComponent');
            } else {
              swalNotify("Oops!", response.message, "error");
            }
          },
          error: function(error) {
            console.log(error);
            swalNotify("Error!", error.responseJSON.message, "error");
          }
        })
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/backend/pages/order-manage/shipping/form.blade.php ENDPATH**/ ?>