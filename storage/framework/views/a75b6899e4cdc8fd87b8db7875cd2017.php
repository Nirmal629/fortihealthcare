<?php $__env->startSection('title', @$title); ?>

<?php $__env->startPush('styles'); ?>
  <?php echo $__env->make('frontend.pages.user.auth.includes.auth-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <section class="living__signupwrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="inswrp">
            <div class="left">
              <?php
                $settings = json_decode($login_page_banner['settings'] ?? '{}', true);
                $imageName = $settings['image'] ?? '';
                $altText = $settings['alt_text'] ?? 'Login';

                // Check if image exists, else use default
                $imagePath = !empty($imageName)
                    ? asset(config('defaults.banner_image_path') . $imageName)
                    : asset('public/frontend/assets/img/home/signup_popup_thumb.jpg');
              ?>

              <figure class="mb-0">
                <img src="<?php echo e($imagePath); ?>" alt="<?php echo e($altText); ?>" title="<?php echo e($altText); ?>" class="imageFit" />
              </figure>
            </div>

            
            <div class="commonforms" id="emailForm">
              <div class="righthead">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-1">
                  <h1 class="font25 mb-0">Signup or Login</h1>

                </div>
                <p class="c--menuc">Log In to track/place orders. </p>
              </div>
              <form class="allForm" id="loginRegisterForm" autocomplete="off">
                <?php echo csrf_field(); ?>
                <div class="form-element">
                  <label class="form-label" for="email">Email Address <em>*</em></label>
                  <input name="email" type="email" id="email" class="form-field" placeholder="Enter your email" autocomplete="new-email" />
                  <span class="msg-error error"></span>
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
                  <span class="msg-error error"></span>
                </div>

                <div class="rememberwrap">
                  <div class="form-check m-0">
                    <input class="form-check-input" type="checkbox" name="remember" value="1" id="rememberme">
                    <label class="form-check-label font14" for="rememberme">Remember me</label>
                  </div>
                  <div class="forgotpass"><a href="<?php echo e(route('password.request')); ?>" title="Forgot password?">Forgot password?</a></div>
                </div>

                <div class="registermainwrap">
                  Don't have an account? <a href="<?php echo e(route('register')); ?>" class="fw-bold text-dark text-decoration-underline" title="Register Here">Register Here</a>
                </div>

                <button type="submit" class="btn btn-dark w-100 btn-auth-submit">Login Here</button>

                <div class="form-check required">
                  <input class="form-check-input" type="checkbox" name="flexCheckDefault" value="1"
                    id="flexCheckDefault" checked>
                  <label class="form-check-label font14" for="flexCheckDefault">
                    By continuing, you agree to Fortier's <a href="<?php echo e(route('cms.page', 'terms-of-use')); ?>">Terms of
                      Use</a> and <a href="<?php echo e(route('cms.page', 'privacy-policy')); ?>">Privacy
                      Policy</a>.
                  </label>
                  <p class="msg-error error"></p>
                </div>

                <!-- <div class="googlelogin">
                  <a href="<?php echo e(route('auth.google')); ?>" title="Continue with Google">
                    <span><img src="<?php echo e(asset('public/frontend/assets/img/icons/google-icon.svg')); ?>" alt="Google"
                        title="Google" /></span>
                    <span>Continue with Google</span>
                  </a>
                </div> -->
                <?php if(session('error')): ?>
                  <div id="flash-message" style="color: #ef4444; padding: 10px 14px; border-radius: 8px; border: 1px solid #fecaca; background: #fef2f2; margin-top: 15px; font-size: 13.5px;">
                    <?php echo e(session('error')); ?>

                  </div>

                  <script>
                    setTimeout(function() {
                      var flash = document.getElementById('flash-message');
                      if (flash) {
                        flash.style.display = 'none';
                      }
                    }, 5000);
                  </script>
                <?php endif; ?>
              </form>
            </div>

            <!-- <div class="commonforms otpField" id="otpForm" style="display: none;">
              <div class="righthead">
                <h1 class="font25">Verify your email</h1>
                <p class="c--menuc">We’ve emailed a 6-digit verification code to <span id="otpSentTo"
                    class="fw-bold text-dark"></span>
                  <a href="javascript:void(0);" title="Change Email" class="text-decoration-underline ms-1" id="changeEmail">Change</a>.
                  Please enter it below.
                </p>
              </div>

              <form class="allForm" id="otpVerifyForm" method="POST" action="<?php echo e(route('verifyotp')); ?>"
                autocomplete="off">
                <?php echo csrf_field(); ?>
                <div class="otpElement">
                  <div class="form-element">
                    <input name="otp[0]" id="otp1" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                  <div class="form-element">
                    <input name="otp[1]" id="otp2" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                  <div class="form-element">
                    <input name="otp[2]" id="otp3" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                  <div class="form-element">
                    <input name="otp[3]" id="otp4" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                  <div class="form-element">
                    <input name="otp[4]" id="otp5" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                  <div class="form-element">
                    <input name="otp[5]" id="otp6" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                </div>
                <span id="otp-error" class="msg-error error text-center d-block mb-3"></span>

                <button type="submit" id="verifyOtpBtn" class="btn btn-dark w-100 btn-auth-submit">Verify &
                  Continue</button>
              </form>
              <div class="existing text-center">Didn't receive the code? <a href="javascript:void(0);" id="resendOtpBtn"
                  title="Resend Code">Resend Code</a>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </section>


  
  
  
  
  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('public/common/js/custom_input.js')); ?>"></script>
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

    $(document).ready(function() {
      const loginForm = $('#loginRegisterForm');
      const emailField = $('#email');
      const passwordField = $('#passwordInput');
      const rememberCheckbox = $('#rememberme');

      // Prefill email if remembered
      const savedEmail = localStorage.getItem('rememberedEmail');
      if (savedEmail) {
        emailField.val(savedEmail).trigger('change');
        rememberCheckbox.prop('checked', true);
      }

      function sendAjaxRequest(url, data, successCallback, errorCallback) {
        $.ajax({
          url,
          method: 'POST',
          data: {
            ...data,
            "_token": "<?php echo e(csrf_token()); ?>"
          },
          success: successCallback,
          error: errorCallback || function(xhr) {
            let msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Something went wrong. Please try again.";
            iziNotify("Oops!", msg, "error");
          }
        });
      }

      const validationSettings = {
        errorPlacement: (error, element) => element.siblings('.msg-error').text(error.text()),
        highlight: element => $(element).addClass('is-invalid'),
        unhighlight: element => $(element).removeClass('is-invalid').siblings('.msg-error').text('')
      };

      loginForm.validate({
        ...validationSettings,
        rules: {
          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
            minlength: 6
          },
          flexCheckDefault: {
            required: true
          }
        },
        messages: {
          email: {
            required: "Please enter your email address.",
            email: "Please enter a valid email address."
          },
          password: {
            required: "Please enter your password.",
            minlength: "Password must be at least 6 characters."
          },
          flexCheckDefault: {
            required: "Please agree to the Terms of Use and Privacy Policy to continue."
          }
        },
        submitHandler: function() {
          let $submitBtn = loginForm.find('button[type="submit"]').prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Logging in...'
          );

          if (rememberCheckbox.is(':checked')) {
            localStorage.setItem('rememberedEmail', emailField.val());
          } else {
            localStorage.removeItem('rememberedEmail');
          }

          sendAjaxRequest(
            '<?php echo e(route('signuplogin')); ?>', {
              email: emailField.val(),
              password: passwordField.val(),
              remember: rememberCheckbox.is(':checked') ? 1 : 0
            },
            function(res) {
              if (res.success) {
                iziNotify("", res.message, "success");
                setTimeout(function() {
                  window.location.href = res.redirect || '<?php echo e(route('category.list')); ?>';
                }, 700);
              } else {
                $submitBtn.prop('disabled', false).html('Login Here');
                iziNotify("Oops!", res.message, "error");
              }
            },
            function(xhr) {
              $submitBtn.prop('disabled', false).html('Login Here');
              let msg = "Invalid credentials. Please try again.";
              if (xhr.responseJSON) {
                if (xhr.responseJSON.message) {
                  msg = xhr.responseJSON.message;
                } else if (xhr.responseJSON.errors) {
                  let firstKey = Object.keys(xhr.responseJSON.errors)[0];
                  msg = xhr.responseJSON.errors[firstKey][0];
                }
              }
              iziNotify("Oops!", msg, "error");
            }
          );
        }
      });
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/pages/user/auth/login-register.blade.php ENDPATH**/ ?>