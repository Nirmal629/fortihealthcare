@php
  $image1 = config('defaults.contact_us_image1');
  $image2 = config('defaults.contact_us_image2');
@endphp
<main class="pg_contact">
  <section class="getIntouch custom-get-in-touch pt-4 pb-4 pt-lg-5 pb-lg-5">
    <div class="container-xxl">
      <div class="row  gy-4 gy-lg-0">
        <!-- Left side visual & quick contact info -->
        <div class="col-lg-5 col-md-12">
          <div class="git-left-panel">
            <div class="git-visual-wrapper">
              <figure class="m-0 position-relative get-intouchimage_fig">
                <img src="{{ !empty($page->feature_image) ? asset('public/uploads/cms_pages/' . $page->feature_image) : asset('public/frontend/assets/img/contact/banner.webp') }}"
                    alt="{{ $page->title ?? 'Contact Fortier Healthcare' }}" title="{{ $page->title ?? 'Contact Fortier Healthcare' }}" class="git-banner-img img-fluid w-100" />
                <div class="git-visual-badge">
                  <span class="material-symbols-outlined">verified</span>
                  <span>Fortier Support</span>
                </div>
              </figure>
            </div>

            <div class="git-info-cards">
              <!-- Phone Card -->
              <div class="git-info-card">
                <div class="git-info-icon">
                  <span class="material-symbols-outlined">call</span>
                </div>
                <div class="git-info-content">
                  <span class="git-info-label">Direct Call Support</span>
                  <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_primary_phone'] ?? $siteSettings['phone'] ?? '+919173069721') }}" class="git-info-value">
                    {{ $siteSettings['site_primary_phone'] ?? $siteSettings['phone'] ?? '+91 91 730 69721' }}
                  </a>
                </div>
              </div>

              <!-- Email Card -->
              <div class="git-info-card">
                <div class="git-info-icon">
                  <span class="material-symbols-outlined">mail</span>
                </div>
                <div class="git-info-content">
                  <span class="git-info-label">Official Email</span>
                  <a href="mailto:{{ $siteSettings['site_email'] ?? $siteSettings['email'] ?? 'fortiercustomersupport@gmail.com' }}" class="git-info-value">
                    {{ $siteSettings['site_email'] ?? $siteSettings['email'] ?? 'fortiercustomersupport@gmail.com' }}
                  </a>
                </div>
              </div>

              <!-- Address Card -->
              <div class="git-info-card">
                <div class="git-info-icon">
                  <span class="material-symbols-outlined">location_on</span>
                </div>
                <div class="git-info-content">
                  <span class="git-info-label">Corporate Office</span>
                  <div class="git-info-value">
                    {{ !empty($siteSettings['address1']) ? $siteSettings['address1'] : ($siteSettings['address'] ?? 'Rajkot, Gujarat, India') }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right side form -->
        <div class="col-lg-7 col-md-12">
          <div class="form-wrapper px-lg-3">
            <div class="git-tag">
              <span class="git-tag-dot"></span>
              <span>Direct Inquiries</span>
            </div>
            <h2 class="form-heading">Get In <span>Touch</span></h2>
            <p class="git-desc">We are here to assist with any questions regarding our healthcare and pharmaceutical solutions, ethical marketing, or order inquiries. Reach out to our team today.</p>
            <form class="allForm git-form" id="contactForm">
              <div class="row">
                <div class="col-md-6 form-group mb-3">
                  <label class="form-label" for="first_name">First Name <em>*</em></label>
                  <div class="git-input-wrap">
                    <span class="git-input-icon material-symbols-outlined">person</span>
                    <input name="first_name" id="first_name" type="text" class="form-control custom-input" placeholder="Enter first name">
                  </div>
                  <div id="first_name-error-container" class="git-error-container"></div>
                </div>
                <div class="col-md-6 form-group mb-3">
                  <label class="form-label" for="last_name">Last Name</label>
                  <div class="git-input-wrap">
                    <span class="git-input-icon material-symbols-outlined">badge</span>
                    <input name="last_name" id="last_name" type="text" class="form-control custom-input" placeholder="Enter last name">
                  </div>
                  <div id="last_name-error-container" class="git-error-container"></div>
                </div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="email">Enter Your Email <em>*</em></label>
                <div class="git-input-wrap">
                  <span class="git-input-icon material-symbols-outlined">mail</span>
                  <input name="email" id="email" type="email" class="form-control custom-input" placeholder="Enter your email address">
                </div>
                <div id="email-error-container" class="git-error-container"></div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="message">Enter Your Message <em>*</em></label>
                <div class="git-input-wrap git-textarea-wrap">
                  <span class="git-input-icon material-symbols-outlined">chat</span>
                  <textarea class="form-control custom-input" name="message" id="message" rows="4" placeholder="How can our healthcare team assist you today?"></textarea>
                </div>
                <div id="message-error-container" class="git-error-container"></div>
              </div>
              <div class="form-group mb-4">
                <label class="form-label" for="captcha">Security Verification <em>*</em></label>
                <div class="git-captcha-box">
                  <div class="captcha-preview-area">
                    <img src="{{ captcha_src('flat') }}" alt="Captcha" id="captcha-image" class="captcha-img">
                    <button type="button" class="btn btn-captcha-refresh" onclick="refreshCaptcha()"
                      title="Refresh CAPTCHA" aria-label="Refresh Captcha">
                      <span class="material-symbols-outlined">refresh</span>
                    </button>
                  </div>
                  <div class="git-input-wrap captcha-input-wrap">
                    <span class="git-input-icon material-symbols-outlined">verified_user</span>
                    <input type="text" name="captcha" id="captcha" class="form-control custom-input"
                      placeholder="Enter CAPTCHA text">
                  </div>
                </div>
                <div id="captcha-error-container" class="git-error-container"></div>
              </div>
              <div class="action mt-2">
                <button type="submit" class="btn custom-submit-btn" id="sendMessageBtn">Send Message</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@push('scripts')
  <script>
    $(document).ready(function() {
      $("#contactForm").validate({
        rules: {
          first_name: {
            required: true,
            minlength: 2
          },
          last_name: {
            minlength: 2
          },
          email: {
            required: true,
            email: true
          },
          message: {
            required: true,
            minlength: 10
          },
          captcha: {
            required: true,
          }
        },
        messages: {
          first_name: {
            required: "{{ __('validation.required', ['attribute' => 'First Name']) }}",
            minlength: "{{ __('validation.minlength', ['attribute' => 'First Name', 'min' => 2]) }}"
          },
          last_name: {
            // required: "{{ __('validation.required', ['attribute' => 'Last Name']) }}",
            minlength: "{{ __('validation.minlength', ['attribute' => 'Last Name', 'min' => 2]) }}"
          },
          email: {
            required: "{{ __('validation.required', ['attribute' => 'Email']) }}",
            email: "{{ __('validation.email', ['attribute' => 'Email']) }}"
          },
          message: {
            required: "{{ __('validation.required', ['attribute' => 'Message']) }}",
            minlength: "{{ __('validation.minlength', ['attribute' => 'Message', 'min' => 10]) }}"
          },
          captcha: {
            required: "{{ __('validation.required', ['attribute' => 'Captcha']) }}"
          }
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
          let errorContainer = $(`#${element.attr('id')}-error-container`);
          if (errorContainer.length) {
            error.appendTo(errorContainer);
          } else {
            error.insertAfter(element);
          }
        },
        submitHandler: function(form) {
          $('#sendMessageBtn').prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...'
          );
          let formData = new FormData(form);
          $.ajax({
            url: `{{ route('contact-us.store') }}`,
            type: "POST",
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              if (response.success) {
                iziNotify("", response.message, "success");
                form.reset();
                refreshCaptcha();
              } else {
                iziNotify("Oops!", response.message, "error");
              }
              $('#sendMessageBtn').prop('disabled', false).html('Send Message');
            },
            error: function(error) {
              iziNotify("Oops!", error.responseJSON.message, "error");
              $('#captcha').val('');
              refreshCaptcha();
              $('#sendMessageBtn').prop('disabled', false).html('Send Message');
            }
          });
        }
      });

      function refreshCaptcha() {
        const captchaImage = document.getElementById('captcha-image');
        captchaImage.src = '{{ captcha_src('flat') }}?' + new Date().getTime();
      }
      window.refreshCaptcha = refreshCaptcha;
    });
  </script>
@endpush
@push('styles')
  <style>
    .custom-get-in-touch {
      background: linear-gradient(135deg, #091222 0%, #0f172a 45%, #16243d 100%) !important;
      border: 1px solid rgba(240, 179, 52, 0.2) !important;
      border-radius: 0 !important;
      box-shadow: 0 20px 45px -10px rgba(9, 18, 34, 0.6);
      position: relative;
    }

    .custom-get-in-touch .custom-submit-btn,
    .custom-get-in-touch .form-control.custom-input,
    .custom-get-in-touch .git-info-card,
    .custom-get-in-touch .git-visual-wrapper,
    .custom-get-in-touch .btn-captcha-refresh,
    .custom-get-in-touch .captcha-preview-area {
      border-radius: 0 !important;
    }

    .git-error-container span.error,
    .custom-get-in-touch span.error {
      color: #f87171 !important;
      font-size: 0.82rem;
      font-weight: 500;
      margin-top: 4px;
      display: block;
    }

    @keyframes gitPulse {
      0%, 100% {
        opacity: 1;
        transform: scale(1);
      }
      50% {
        opacity: 0.4;
        transform: scale(0.85);
      }
    }

    .git-tag-dot {
      animation: gitPulse 2s infinite ease-in-out;
    }
  </style>
@endpush
