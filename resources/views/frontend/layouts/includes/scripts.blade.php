<!-- JavaScript Libraries -->
<script src="{{ asset('/public/backend/assetss/js/vendor.min.js') }}"></script>

<!-- For Marquee -->
<script src="{{ asset('public/frontend/assets/js/jquery.marquee.min.js') }}"></script>

<!-- Bootstrat JS -->
<script src="{{ asset('public/frontend/assets/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('public/frontend/assets/lib/swiper@9/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/easyzoom.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/gsap.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/SplitText.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/ScrollTrigger.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/lenis.min.js') }}"></script>

<script src="{{ asset('public/backend/assetss/js/jquery.validate.min.js') }}"></script>

<!-- Custom Javascript -->
<script type="text/javascript" src="{{ asset('public/frontend/assets/js/alert.js') }}?v={{ filemtime(public_path('frontend/assets/js/alert.js')) }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/assets/js/main.js') }}?v={{ filemtime(public_path('frontend/assets/js/main.js')) }}"></script>

{{-- Address Modal JS --}}
<script>
    $(document).on('click', '.list-address', function(e) {
        e.preventDefault();
        $('#listOfAddressModal').modal('show');
    });

    if (document.getElementById('openCreateAddressModalBtn')) {
        document.getElementById('openCreateAddressModalBtn').addEventListener('click', function () {
        const scriptUrl = `{{ asset('/public/backend/assetss/intlTelInput/intlTelInput.min.js') }}`;
        if (!document.querySelector(`script[src="${scriptUrl}"]`)) {
            const script = document.createElement('script');
            script.src = scriptUrl;
            script.onload = loadAddressModal; // Load modal after script is ready
            document.body.appendChild(script);
        } else {
            loadAddressModal();
        }
      });
    }

    function loadAddressModal() {
      fetch('{{ route('load.address.modal') }}')
        .then(response => response.json())
        .then(data => {
            document.getElementById('createNewAddressModalContainer').innerHTML = data.html;

            // Show modal
            const modalElement = document.getElementById('addressModal');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();

            $('#listOfAddressModal').modal('hide');

            initAddressFormValidation();
            populateForm();
            initAddressMobileJs();
        })
        .catch(error => {
            console.error('Error loading modal:', error);
            iziNotify('Error!', 'Failed to load the address modal.', 'error');
        });
    }
    function initAddressMobileJs() {
      const input = document.querySelector("#custom-phone");
      if (!input) return;

      let iti = window.intlTelInput(input, {
          allowDropdown: false,
          initialCountry: "in",
          onlyCountries: ["in"],
          autoPlaceholder: "off",
          formatOnDisplay: false,
          useFullscreenPopup: false,
          strictMode: false,
          loadUtils: () => import("{{ asset('/public/backend/assetss/intlTelInput/utils.js') }}")
      });

      const container = input.closest('.phone-input-container');
      if (container) {
        container.addEventListener('click', function(e) {
          if (e.target !== input) {
            input.focus();
          }
        });
      }

      const form = input.closest("form");

      form?.addEventListener("submit", function (e) {
          if (iti && typeof iti.isValidNumber === 'function' && iti.isValidNumber()) {
              input.value = iti.getNumber();
          }
      });

      if (window.jQuery && $.validator) {
          $.validator.addMethod("validPhone", function (value, element) {
              if (this.optional(element)) return true;
              if (iti && typeof iti.isValidNumber === 'function') {
                  const valid = iti.isValidNumber();
                  if (valid === true) return true;
              }
              const clean = (value || '').replace(/[\s\-\(\)\.]/g, '');
              return /^(?:(?:\+|0{0,2})91)?[6-9]\d{9}$/.test(clean) || /^\d{10}$/.test(clean);
          }, "{{ __('validation.invalid', ['attribute' => 'Phone Number']) }}");
      }
    }

    function initAddressFormValidation() {
      $.validator.addMethod("noSpecialChars", function(value, element) {
          return this.optional(element) || /^[a-zA-Z0-9\- ]+$/.test(value);
      }, "Only letters, numbers, hyphens, and spaces are allowed.");

      $.validator.addMethod("indianPincode", function(value, element) {
          const val = (value || '').trim();
          if (this.optional(element)) {
              return true;
          }
          const isValid = /^[1-9][0-9]{5}$/.test(val);
          if (!isValid && val.length > 0) {
              if (typeof window.showPanIndiaToast === 'function') {
                  window.showPanIndiaToast();
              }
          }
          return isValid;
      }, "");

      $('#add_address_form').validate({
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
                  indianPincode: true
              },
              state: {
                  required: true
              },
              address: {
                  required: true
              },
              landmark: {
                  required: true
              },
              city: {
                  required: true
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
                  indianPincode: ""
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
          errorElement: "i",
          errorPlacement: function(error, element) {
              if (element.attr('name') === 'pincode' && (!error.text().trim() || error.text().includes('PAN india'))) {
                  return;
              }
              let errorContainer = $(`#${element.attr('id')}-error-container`);
              if (errorContainer.length) {
                  error.appendTo(errorContainer);
              } else {
                  error.insertAfter(element);
              }
          },
          submitHandler: function(form) {
              $.ajax({
                  url: '{{ route("user.update-address") }}',
                  type: "POST",
                  data: new FormData(form),
                  contentType: false,
                  processData: false,
                  success: function(response) {
                      if (response.success) {
                          // Hide the add/edit address modal
                          $('#addressModal').modal('hide');

                          // Refresh the address list
                          window.refreshAddressList();

                          // Update the header pincode display
                          $('.default-pin').text(`${response.user_pincode.Name || '{{ config('defaults.default_location') }}'} ${response.user_pincode.Pincode || '{{ config('defaults.default_pincode') }}'}`);

                          // Show the address list modal
                          $('#listOfAddressModal').modal('show');

                          iziNotify("", response.message, "success");
                      } else {
                          iziNotify("Oops!", response.message, "error");
                      }
                  },
                  error: function(xhr) {
                      iziNotify("Oops!", "An error occurred while saving the address.", "error");
                  }
              });
          }
      });
    }

    function populateForm() {
        $('input[name="name"]').on('focusin', function() {
            $(this).parent('.form-element').addClass('has-value');
        });
        $('input[name="name"]').on('focusout', function() {
          if (!$(this).val()) {
            $(this).parent('.form-element').removeClass('has-value');
          }
        });

        $('input[name="pincode"]').on('focusin', function() {
            $(this).parent('.form-element').addClass('has-value');
        });
        $('input[name="pincode"]').on('focusout change input', function(e) {
          const val = ($(this).val() || '').trim();
          if (!val) {
            $(this).parent('.form-element').removeClass('has-value');
          } else {
            $(this).parent('.form-element').addClass('has-value');
            if ((e.type === 'focusout' || e.type === 'change' || val.length >= 6) && !/^[1-9][0-9]{5}$/.test(val)) {
              if (typeof window.showPanIndiaToast === 'function') {
                window.showPanIndiaToast();
              }
            }
          }
        });

        $('input[name="address"]').on('focusin', function() {
            $(this).parent('.form-element').addClass('has-value');
        });
        $('input[name="address"]').on('focusout', function() {
          if (!$(this).val()) {
            $(this).parent('.form-element').removeClass('has-value');
          }
        });

        $('input[name="city"]').on('focusin', function() {
            $(this).parent('.form-element').addClass('has-value');
        });
        $('input[name="city"]').on('focusout', function() {
          if (!$(this).val()) {
            $(this).parent('.form-element').removeClass('has-value');
          }
        });

        $('input[name="landmark"]').on('focusin', function() {
            $(this).parent('.form-element').addClass('has-value');
        });
        $('input[name="landmark"]').on('focusout', function() {
          if (!$(this).val()) {
            $(this).parent('.form-element').removeClass('has-value');
          }
        });

        $('select[name="state"]').parent('.form-element').addClass('has-value');
        $('input[name="phone"]').parent('.form-element').addClass('has-value');
        $('#defaultaddress').prop('checked', true);
        $('.address-modal-title').text('Add Address');
        $('#address_id').val('');
    }

  </script>

  <!-- Old Scripts for Header/Footer Match -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
  <script src="{{ asset('public/old_assets/js/main.js') }}"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    if (typeof AOS !== 'undefined') {
      AOS.init();
    }
  </script>

