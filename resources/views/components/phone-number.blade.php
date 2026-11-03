@push('component-styles')
  <link rel="stylesheet" href="{{ asset('/public/backend/assetss/intlTelInput/intlTelInput.min.css') }}">
  <style>
    .iti__country-container,
    .iti__selected-country {
      cursor: default !important;
      pointer-events: none !important;
    }
    .phone-input-container input {
      position: relative !important;
      z-index: 1 !important;
      pointer-events: auto !important;
      cursor: text !important;
    }
    .iti__arrow,
    .iti__dropdown-content,
    .iti__country-list {
      display: none !important;
    }
  </style>
@endpush
<div class="mb-4 {{ $required ? 'required' : '' }} phone-input-container">
  <label for="phone" class="form-label">Phone</label>
  <input type="text" class="form-control only-numbers" name="{{ $name }}" id="{{ $id }}"
    placeholder="Enter Phone Number" value="{{ $previousValue ?? '' }}" inputmode="numeric">
  <div class="{{ $id }}-error-container"></div>
</div>

@push('component-scripts')
  <script src="{{ asset('/public/backend/assetss/intlTelInput/intlTelInput.min.js') }}"></script>

  <script>
    const input = document.querySelector("#{{ $id }}");
    if (input) {
      const iti = window.intlTelInput(input, {
        allowDropdown: false,
        initialCountry: "in",
        onlyCountries: ["in"],
        autoPlaceholder: "off",
        formatOnDisplay: false, // Prevent reformatting to national format
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
      if (form) {
        form.addEventListener("submit", function(t) {
          if (iti && typeof iti.isValidNumber === 'function' && iti.isValidNumber()) {
            input.value = iti.getNumber();
          }
        });
      }

      if (window.jQuery && jQuery.validator) {
        jQuery.validator.addMethod("validPhone", function(t, i) {
          if (this.optional(i)) return true;
          if (iti && typeof iti.isValidNumber === 'function') {
            const valid = iti.isValidNumber();
            if (valid === true) return true;
          }
          const clean = (t || '').replace(/[\s\-\(\)\.]/g, '');
          return /^(?:(?:\+|0{0,2})91)?[6-9]\d{9}$/.test(clean) || /^\d{10}$/.test(clean);
        }, "{{ __('validation.invalid', ['attribute' => 'Phone Number']) }}");
      }
    }
  </script>
@endpush
