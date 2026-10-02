@props(['states'])
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
          @csrf
          <div class="form-element name">
            <label class="form-label">Full Name <em>*</em></label>
            <input name="name" id="name" type="text" class="form-field only-alphabet-symbols" placeholder="Enter recipient full name">
          </div>

          <div class="form-element has-value mobile">
            <label class="form-label">Mobile Number <em>*</em></label>
            <x-phone-number-frontend :required="true" :previousValue="''" :name="'phone'" :id="'phone'" />

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
              @forelse ($states as $state)
                <option value="{{ Hashids::encode($state->id) }}">{{ $state->name }}</option>
              @empty
                <option value="">No states available</option>
              @endforelse
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
@push('component-scripts')
  <script src="{{ asset('/public/common/js/custom_input.js?v=3' . time()) }}"></script>

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
          required: "{{ __('validation.required', ['attribute' => 'Name']) }}",
          maxlength: "{{ __('validation.maxlength', ['attribute' => 'Name', 'max' => '50']) }}"
        },
        phone: {
          required: "{{ __('validation.required', ['attribute' => 'Mobile']) }}",
        },
        pincode: {
          required: "{{ __('validation.required', ['attribute' => 'Pincode']) }}",
          minlength: "{{ __('validation.minlength', ['attribute' => 'Pincode', 'min' => '3']) }}",
          maxlength: "{{ __('validation.maxlength', ['attribute' => 'Pincode', 'max' => '15']) }}",
          noSpecialChars: "Only letters, numbers, hyphens and spaces are allowed."
        },
        state: {
          required: "{{ __('validation.required', ['attribute' => 'State']) }}"
        },
        address: {
          required: "{{ __('validation.required', ['attribute' => 'Address']) }}",
          maxlength: "{{ __('validation.maxlength', ['attribute' => 'Address', 'max' => '100']) }}"
        },
        landmark: {
          required: "{{ __('validation.required', ['attribute' => 'Landmark']) }}",
          maxlength: "{{ __('validation.maxlength', ['attribute' => 'Landmark', 'max' => '100']) }}"
        },
        city: {
          required: "{{ __('validation.required', ['attribute' => 'City']) }}",
          maxlength: "{{ __('validation.maxlength', ['attribute' => 'City', 'max' => '100']) }}"
        }
      },
      errorElement: 'div',
      errorPlacement: (error, element) => error.insertAfter($(`#${element.attr('id')}-error-container`).length ?
        `#${element.attr('id')}-error-container` : element),
      submitHandler: function(form) {
        $.ajax({
          url: "{{ route('user.create-or-update-address') }}",
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
@endpush
