@extends('frontend.layouts.app')

@section('title', @$title)

@push('styles')
  @include('frontend.pages.user.auth.includes.auth-styles')
@endpush

@section('content')
  <section class="living__signupwrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="inswrp">
            <div class="left">
              <figure class="mb-0">
                <img src="{{ asset('public/frontend/assets/img/home/signup_popup_thumb.jpg') }}" alt="Login"
                  title="Login" class="imageFit" />
              </figure>
            </div>
            <div class="commonforms" id="login">
              <div class="righthead">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-1">
                  <h3 class="font25 mb-0">Welcome Back!</h3>
                  <a href="{{ route('register') }}" class="btn btn-outline-dark btn-sm px-3 py-1 fw-semibold text-decoration-none" style="border-radius: 8px; font-size: 13px;" title="Register Here">Register Here</a>
                </div>
                <p class="c--menuc">Log in to track orders, save items to your wishlist. Don't have an account? <a href="{{ route('register') }}" class="fw-bold text-dark text-decoration-underline" title="Register Here">Register Here</a></p>
              </div>

              <form id="loginForm" class="allForm" method="POST" action="{{ route('signuplogin') }}" autocomplete="off">
                @csrf

                <div class="form-element">
                  <label class="form-label" for="emailField">Email Address <em>*</em></label>
                  <input name="email" type="text" class="form-field" placeholder="Enter your email" autocomplete="off" id="emailField" />
                  <i class="msg-error"></i>
                </div>

                <div class="form-element position-relative">
                  <label class="form-label" for="passwordInput">Password <em>*</em></label>
                  <input name="password" type="password" class="form-field password-element" id="passwordInput"
                    placeholder="Enter your password" autocomplete="new-password" />
                  <span id="togglePassword">
                    <span class="material-symbols-outlined font25">
                      visibility
                    </span>
                  </span>
                  <i class="msg-error"></i>
                </div>

                <div class="rememberwrap">
                  <div class="form-check m-0">
                    <input class="form-check-input" type="checkbox" name="remember" value="1" id="rememberme">
                    <label class="form-check-label font14" for="rememberme">Remember me</label>
                  </div>
                  <div class="forgotpass"><a href="{{ route('password.request') }}" title="Forgot password?">Forgot
                      password?</a>
                  </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 btn-auth-submit">Log In</button>

                <div class="auth-divider">
                  <span>or continue with</span>
                </div>

                <div class="googlelogin">
                  <a href="{{ route('auth.google') }}" title="Continue with Google">
                    <span><img src="{{ asset('public/frontend/assets/img/icons/google-icon.svg') }}" alt="Google"
                        title="Google" class="" /></span> <span>Continue with Google</span>
                  </a>
                </div>
              </form>

              <div class="existing text-center">Don't have an account? <a href="{{ route('register') }}"
                  title="Register">Register</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script src="{{ asset('public/common/js/custom_sweet_alert.js') }}"></script>
  {{-- AlertifyJS CDN (Semantic Theme) --}}
  {{-- <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script> --}}

  <script>
    $('#togglePassword').on('click', function() {
      const input = $('#passwordInput');
      const span_icon = $(this).find('.material-symbols-outlined');

      if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        span_icon.text('visibility_off');
      } else {
        input.attr('type', 'password');
        span_icon.text('visibility');
      }
    });

    // alertify.set('notifier', 'position', 'top-right');

    $.validator.addMethod("regex", function(value, element, pattern) {
      if (this.optional(element)) {
        return true;
      }
      return pattern.test(value);
    }, "Invalid format.");

    $(document).ready(function() {
      const loginForm = $('#loginForm');
      const emailField = $('#emailField');
      const rememberCheckbox = $('#rememberme');

      // Prefill if remembered
      const savedEmail = localStorage.getItem('rememberedEmail');
      if (savedEmail) {
        emailField.val(savedEmail).trigger('change');
        rememberCheckbox.prop('checked', true);
      }

      loginForm.validate({
        rules: {
          email: {
            required: true,
            regex: /^[\w\.\-]+@([\w\-]+\.)+[\w]{2,4}$/
          },
          password: {
            required: true,
            minlength: 6,
            maxlength: 20,
            // regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/
          }
        },
        messages: {
          email: {
            required: "Email is required.",
            regex: "Please enter a valid email address."
          },
          password: {
            required: "Password is required.",
            minlength: "Password must be at least 6 characters.",
            maxlength: "Password cannot exceed 20 characters.",
            // regex: "Password must contain at least one uppercase letter, one lowercase letter, and one number."
          }
        },
        errorPlacement: function(error, element) {
          element.siblings('.msg-error').text(error.text());
        },
        highlight: function(element) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
          $(element).removeClass('is-invalid');
          $(element).siblings('.msg-error').text('');
        }
      });

      loginForm.on('submit', function(e) {
        e.preventDefault();

        if (!loginForm.valid()) {
          return;
        }

        let form = $(this);
        let formData = form.serialize();

        $.ajax({
          url: form.attr('action'),
          method: 'POST',
          data: formData,
          beforeSend: function() {
            form.find('button[type="submit"]').prop('disabled', true).text('Processing...');
            form.find('.form-field').removeClass('is-invalid');
            form.find('.msg-error').text('');
          },
          success: function(res) {
            // Save email to localStorage if checkbox is checked
            if (rememberCheckbox.is(':checked')) {
              localStorage.setItem('rememberedEmail', emailField.val());
            } else {
              localStorage.removeItem('rememberedEmail');
            }

            iziNotify("", res.message || 'Logged in successfully! Redirecting...', "success");
            setTimeout(() => {
              window.location.href = res.redirect || "{{ route('category.list') }}";
            }, 700);
          },
          error: function(xhr) {
            let response = xhr.responseJSON;
            let errors = response.errors || {};
            let message = response.message || 'Something went wrong. Please try again.';

            // Show only the first error
            let firstField = Object.keys(errors)[0];
            if (firstField) {
              iziNotify("Oops!", errors[firstField][0], "error");
            }

            for (let field in errors) {
              let input = form.find(`[name="${field}"]`);
              input.addClass('is-invalid');
              input.siblings('.msg-error').text(errors[field][0]);
            }

            form.find('button[type="submit"]').prop('disabled', false).text('Log In');
          }
        });
      });
    });
  </script>
@endpush
