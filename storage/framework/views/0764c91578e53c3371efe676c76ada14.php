<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['states']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['states']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="modal genericmodal fade AddNewAddressModal modern_address_modal" id="AddNewAddressModal" tabindex="-1" aria-labelledby="AddNewAddressModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modern_modal_content">
      <div class="modal-header modern_modal_header">
        <div class="d-flex align-items-center gap-3">
          <div class="modal_header_icon">
            <span class="material-symbols-outlined">location_on</span>
          </div>
          <div>
            <h5 class="modal-title modern_modal_title" id="AddNewAddressModalLabel">Add Shipping Address</h5>
            <p class="modal_subtitle mb-0">Enter your complete address details for delivery</p>
          </div>
        </div>
        <button type="button" class="btn-close modern_close_btn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modern_modal_body">
        <form class="allForm modern_address_form" id="checkout_add_edit_address">
          <?php echo csrf_field(); ?>
          <div class="form-element name">
            <label class="form-label">Full Name <em>*</em></label>
            <input name="name" id="name" type="text" class="form-field only-alphabet-symbols" placeholder="Enter recipient full name">
          </div>

          <div class="form-element has-value mobile">
            <label class="form-label">Mobile Number <em>*</em></label>
            <?php if (isset($component)) { $__componentOriginal17f236cf1a624ba165b7cade2a6fb18c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal17f236cf1a624ba165b7cade2a6fb18c = $attributes; } ?>
<?php $component = App\View\Components\PhoneNumberFrontend::resolve(['required' => true,'previousValue' => '','name' => 'phone','id' => 'phone'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('phone-number-frontend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\PhoneNumberFrontend::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal17f236cf1a624ba165b7cade2a6fb18c)): ?>
<?php $attributes = $__attributesOriginal17f236cf1a624ba165b7cade2a6fb18c; ?>
<?php unset($__attributesOriginal17f236cf1a624ba165b7cade2a6fb18c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal17f236cf1a624ba165b7cade2a6fb18c)): ?>
<?php $component = $__componentOriginal17f236cf1a624ba165b7cade2a6fb18c; ?>
<?php unset($__componentOriginal17f236cf1a624ba165b7cade2a6fb18c); ?>
<?php endif; ?>

          </div>

          <div class="form-element address">
            <label class="form-label">Address / Street <em>*</em></label>
            <input name="address" type="text" class="form-field" placeholder="Flat, House no., Building, Apartment">
          </div>
          <div class="form-element locality">
            <label class="form-label">Landmark <em>*</em></label>
            <input name="landmark" type="text" class="form-field" placeholder="E.g. Near Apollo Hospital, opposite park">
          </div>
          <div class="form-element city">
            <label class="form-label">City / District <em>*</em></label>
            <input name="city" type="text" class="form-field" placeholder="City or district">
          </div>

          <div class="form-element state has-value">
            <label class="form-label">State <em>*</em></label>
            <select class="form-field form-select" name="state" id="state">
              <option value="" selected>Select State</option>
              <?php
                $indianStates = (isset($states) && count($states) > 0)
                  ? $states->filter(function($s) { return in_array($s->name, \App\Models\State::INDIAN_STATES); })->sortBy('name')
                  : \App\Models\State::getIndianStates();
                if ($indianStates->isEmpty()) {
                  $indianStates = \App\Models\State::getIndianStates();
                }
              ?>
              <?php $__empty_1 = true; $__currentLoopData = $indianStates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <option value="<?php echo e(Hashids::encode($state->id)); ?>"><?php echo e($state->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <option value="">No states available</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="form-element pincode">
            <label class="form-label">Pincode <em>*</em></label>
            <input name="pincode" type="text" class="form-field" placeholder="6-digit PIN code">
          </div>
          <div class="form-check modern_default_check defaultaddress mb-3">
            <input class="form-check-input" type="checkbox" name="is_default" id="is_default" checked>
            <label class="form-check-label font14 fw-medium" for="is_default">Make this as my default delivery address</label>
          </div>
          <div class="action modern_modal_actions d-flex align-items-center gap-3 pt-2">
            <button type="button" class="btn modern_cancel_btn"
              data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn modern_save_btn">Save Details</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->startPush('component-scripts'); ?>
  <script src="<?php echo e(asset('/public/common/js/custom_input.js?v=3' . time())); ?>"></script>

  <script>
    // Modal toggle
    $('.add-new-address-btn').click(() => {
      $('#AddressModal').modal('hide');
      $('select[name="state"]').parent('.form-element').addClass('has-value');
      $('#AddNewAddressModal').modal('show');
    });

    $.validator.addMethod("noSpecialChars", function(value, element) {
      return this.optional(element) || /^[a-zA-Z0-9\- ]+$/.test(value);
    }, "Only letters, numbers, hyphens, and spaces are allowed.");

    // Form validation and submission
    $('#checkout_add_edit_address').validate({
      rules: {
        name: {
          required: true,
          maxlength: 50
        },
        phone: {
          required: true,
          validPhone: true
        },
        pincode: {
          required: true,
          minlength: 3,
          maxlength: 15,
          noSpecialChars: true
        },
        state: {
          required: true
        },
        address: {
          required: true,
          maxlength: 100
        },
        landmark: {
          required: true,
          maxlength: 100
        },
        city: {
          required: true,
          maxlength: 100
        }
      },
      messages: {
        name: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Name'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Name', 'max' => '50'])); ?>"
        },
        phone: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Mobile'])); ?>",
        },
        pincode: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Pincode'])); ?>",
          minlength: "<?php echo e(__('validation.minlength', ['attribute' => 'Pincode', 'min' => '3'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Pincode', 'max' => '15'])); ?>",
          noSpecialChars: "Only letters, numbers, hyphens and spaces are allowed."
        },
        state: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'State'])); ?>"
        },
        address: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Address'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Address', 'max' => '100'])); ?>"
        },
        landmark: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Landmark'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Landmark', 'max' => '100'])); ?>"
        },
        city: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'City'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'City', 'max' => '100'])); ?>"
        }
      },
      errorElement: 'div',
      errorPlacement: (error, element) => error.insertAfter($(`#${element.attr('id')}-error-container`).length ?
        `#${element.attr('id')}-error-container` : element),
      submitHandler: function(form) {
        $.ajax({
          url: "<?php echo e(route('user.create-or-update-address')); ?>",
          type: 'POST',
          data: $(form).serialize(),
          success: function(response) {
            if (response.success) {
              let addressType = $('input[name="default_address"]:checked').attr('data-attr-type2') || 'shipping';
              let html = $(response.html);
              html.find('input[name="default_address"]').attr('data-attr-type2', addressType);
              updateAddress(html.prop('outerHTML'), addressType, response.id);
              // Prepend the updated HTML
              $('.address_block').prepend(html);
              $('#no-address').remove();
                form.reset();
              iziNotify('', response.message, 'success');
            } else
              iziNotify('', response.message, 'error');
          },
          error: function(xhr) {
            iziNotify('Error!', xhr.responseJSON?.message || 'Failed to save address', 'error')
          }
        })
      }
    });
    function updateAddress(addressHtml, addressType, id) {
      if (addressType == 'shipping') {
          $('#shipping_address').val(id);
          selectedShippingAddress = id;
      } else {
          $('#billing_address').val(id);
          selectedBillingAddress = id;
      }
      /* let addressPartHtml = $('#address_' + id).html();
      let label = addressType.includes('shipping') ? 'Shipping' : 'Billing';

      addressPartHtml += `<a href="javascript:void(0);" class="font16 change-address-btn" data-address-type="${addressType}">
        Change ${label} Address
      </a>`;
       $('.' + addressType).html(addressPartHtml); */
      let addressCount = $('#address_count').val();
      $('#address_count').val(parseInt($('#address_count').val()) + 1);
      $('#AddNewAddressModal').modal('hide');
      // if (addressCount > 1) {
        $('#AddressModal').modal('show');
      // }
    }
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/components/checkout-create-address-modal.blade.php ENDPATH**/ ?>