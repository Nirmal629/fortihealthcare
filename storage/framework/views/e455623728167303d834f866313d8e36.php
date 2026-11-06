<?php $__env->startSection('title', @$title); ?>

<?php $__env->startPush('styles'); ?>
  <?php echo $__env->make('frontend.pages.user.auth.includes.auth-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <section class="living__signupwrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="inswrp">
            <div class="left">
              <figure class="mb-0">
                <img src="<?php echo e(asset('public/frontend/assets/img/home/signup_popup_thumb.jpg')); ?>" alt="Reset Password"
                  title="Reset Password" class="imageFit" />
              </figure>
            </div>
            <div class="commonforms" id="reset-password">
              <div class="righthead">
                <h3 class="font25">Reset Your Password</h3>
                <p class="c--menuc">Enter your new password below.</p>
              </div>

              <form id="resetForm" class="allForm" method="POST" action="<?php echo e(route('password.update')); ?>"
                autocomplete="off">
                <?php echo csrf_field(); ?>

                <input type="hidden" name="token" value="<?php echo e($token); ?>">

                <div class="form-element">
                  <label class="form-label" for="emailField">Email Address</label>
                  <input name="email" id="emailField" type="text" class="form-field" value="<?php echo e(request()->get('email')); ?>" readonly>
                </div>

                <div class="form-element position-relative">
                  <label class="form-label" for="passwordInput">New Password <em>*</em></label>
                  <input name="password" type="password" class="form-field password-element" id="passwordInput"
                    placeholder="Enter new password" autocomplete="new-password" />
                  <span id="togglePassword">
                    <span class="material-symbols-outlined font25">
                      visibility
                    </span>
                  </span>
                  <i class="msg-error"></i>
                </div>

                <button type="submit" class="btn btn-dark w-100 btn-auth-submit">Reset Password</button>
              </form>

              <div class="existing text-center mt-4">Remembered your password? <a href="<?php echo e(route('signuplogin')); ?>"
                  title="Login">Log In</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('public/common/js/custom_sweet_alert.js')); ?>"></script>
  

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
      const resetForm = $('#resetForm');

      resetForm.validate({
        rules: {
          password: {
            required: true,
            minlength: 6,
            maxlength: 20,
            // regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/
          }
        },
        messages: {
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

      $('#resetForm').on('submit', function(e) {
        e.preventDefault();

        if (!resetForm.valid()) {
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
            // alertify.success(res.message || 'Password has been reset!');
            iziNotify("", res.message || 'Password has been reset!', "success");
            form.find('button[type="submit"]').prop('disabled', false).text('Reset Password');
            window.location.href = res.redirect || "<?php echo e(route('signuplogin')); ?>";
          },
          error: function(xhr) {
            let response = xhr.responseJSON;
            let errors = response.errors || {};
            let message = response.message || 'Something went wrong. Please try again.';

            // alertify.error(message);
            iziNotify("Oops!", message, "error");

            for (let field in errors) {
              let input = form.find(`[name="${field}"]`);
              input.addClass('is-invalid');
              input.siblings('.msg-error').text(errors[field][0]);
            }

            form.find('button[type="submit"]').prop('disabled', false).text('Reset Password');
          }
        });
      });
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/pages/user/auth/password-reset.blade.php ENDPATH**/ ?>