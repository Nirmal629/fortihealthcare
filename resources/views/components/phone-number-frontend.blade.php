@push('component-styles')
  <link rel="stylesheet" href="{{ asset('/public/backend/assetss/intlTelInput/intlTelInput.min.css') }}">
  <style>
    .phone-input-container {
      position: relative !important;
      z-index: 1050 !important;
      width: 100% !important;
      height: 48px !important;
      min-height: 48px !important;
      max-height: 48px !important;
      overflow: visible !important;
      margin: 0 !important;
      padding: 0 !important;
      display: block !important;
    }

    .phone-input-container .iti,
    .iti {
      width: 100% !important;
      height: 48px !important;
      min-height: 48px !important;
      max-height: 48px !important;
      position: relative !important;
      display: block !important;
      overflow: visible !important;
      margin: 0 !important;
      padding: 0 !important;
      border: none !important;
    }

    .iti input,
    .iti input.form-field,
    .phone-input-container input.form-field {
      width: 100% !important;
      height: 48px !important;
      min-height: 48px !important;
      max-height: 48px !important;
      padding-left: 64px !important;
      box-sizing: border-box !important;
      margin: 0 !important;
      display: block !important;
    }

    .iti__country-container {
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      bottom: 0 !important;
      height: 48px !important;
      max-height: 48px !important;
      z-index: 1050 !important;
      overflow: visible !important;
      margin: 0 !important;
      padding: 0 !important;
      border: none !important;
    }

    .iti__selected-country {
      height: 48px !important;
      min-height: 48px !important;
      max-height: 48px !important;
      background: transparent !important;
      border: none !important;
      padding: 0 6px 0 12px !important;
      margin: 0 !important;
      outline: none !important;
      box-shadow: none !important;
      display: flex !important;
      align-items: center !important;
      cursor: pointer !important;
    }

    .iti__selected-country:focus,
    .iti__selected-country:active,
    .iti__selected-country:focus-visible {
      outline: none !important;
      box-shadow: none !important;
      border: none !important;
      background: transparent !important;
    }

    .iti--inline-dropdown .iti__dropdown-content,
    .iti__dropdown-content {
      position: absolute !important;
      z-index: 999999 !important;
      top: 48px !important;
      left: 0 !important;
      width: 320px !important;
      max-width: calc(100vw - 40px) !important;
      background: #ffffff !important;
      border: 1.5px solid #e2e8f0 !important;
      border-radius: 12px !important;
      box-shadow: 0 16px 36px -4px rgba(0, 0, 0, 0.18), 0 4px 12px rgba(0, 0, 0, 0.08) !important;
      margin-top: 4px !important;
      margin-left: 0 !important;
      margin-right: 0 !important;
      overflow: hidden !important;
      animation: itiDropdownSlide 0.2s ease-out !important;
      float: none !important;
    }

    @keyframes itiDropdownSlide {
      from {
        opacity: 0;
        transform: translateY(-6px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .iti__search-input {
      width: 100% !important;
      padding: 10px 14px !important;
      border: none !important;
      border-bottom: 1px solid #e2e8f0 !important;
      font-size: 13.5px !important;
      color: #0f172a !important;
      background: #f8fafc !important;
      outline: none !important;
      border-radius: 12px 12px 0 0 !important;
    }

    .iti__country-list {
      max-height: 200px !important;
      overflow-y: auto !important;
      padding: 6px 0 !important;
      margin: 0 !important;
      list-style: none !important;
      scrollbar-width: thin !important;
      scrollbar-color: #cbd5e1 #f8fafc !important;
    }

    .iti__country-list::-webkit-scrollbar {
      width: 6px !important;
    }

    .iti__country-list::-webkit-scrollbar-track {
      background: #f8fafc !important;
    }

    .iti__country-list::-webkit-scrollbar-thumb {
      background-color: #cbd5e1 !important;
      border-radius: 4px !important;
    }

    .iti__country {
      padding: 8px 14px !important;
      font-size: 13.5px !important;
      color: #334155 !important;
      display: flex !important;
      align-items: center !important;
      gap: 8px !important;
      transition: background-color 0.15s ease !important;
      cursor: pointer !important;
    }

    .iti__country:hover,
    .iti__country.iti__highlight {
      background-color: #f1f5f9 !important;
      color: #0f172a !important;
    }

    .iti__country .iti__country-name {
      font-weight: 500 !important;
      font-size: 13.5px !important;
      color: #1e293b !important;
    }

    .iti__country .iti__dial-code {
      font-size: 12.5px !important;
      color: #64748b !important;
      margin-left: auto !important;
    }
  </style>
@endpush

<div class="{{ $required ? 'required' : '' }} phone-input-container">
  <input type="text" class="form-field only-numbers" name="{{ $name }}" id="{{ $id }}"
    autocomplete="new-phone" inputmode="numeric" placeholder="Phone" value="{{ $previousValue ?? '' }}">
  <i class="msg-error"></i>
  <div class="{{ $id }}-error-container"></div>
</div>

@push('component-scripts')
  <script src="{{ asset('/public/backend/assetss/intlTelInput/intlTelInput.min.js') }}"></script>

  <script>
    const input = document.querySelector("#{{ $id }}"),
      iti = window.intlTelInput(input, {
        initialCountry: "auto",
        autoPlaceholder: "off",
        formatOnDisplay: false,
        useFullscreenPopup: false,
        geoIpLookup: t => {
          fetch("https://ipapi.co/json").then((t => t.json())).then((i => t(i.country_code))).catch((() => t("in")))
        },
        strictMode: true,
        loadUtils: () => import("{{ asset('/public/backend/assetss/intlTelInput/utils.js') }}")
      }),
      form = input.closest("form");

    function handleDropdownWheel(e) {
      e.stopPropagation();
    }

    input.addEventListener('open:countrydropdown', function() {
      const dropdown = document.querySelector('.iti__country-list');
      if (dropdown) {
        dropdown.style.overflowY = 'auto';
        dropdown.addEventListener('wheel', handleDropdownWheel, { passive: false });
      }
    });

    input.addEventListener('close:countrydropdown', function() {
      const dropdown = document.querySelector('.iti__country-list');
      if (dropdown) {
        dropdown.removeEventListener('wheel', handleDropdownWheel);
      }
    });

    form && form.addEventListener("submit", (function(t) {
      if (iti.isValidNumber()) {
        const t = iti.getNumber();
        input.value = t
      }
    })), jQuery.validator.addMethod("validPhone", (function(t, i) {
      return this.optional(i) || iti.isValidNumber()
    }), "{{ __('validation.invalid', ['attribute' => 'Phone Number']) }}");
  </script>
@endpush
