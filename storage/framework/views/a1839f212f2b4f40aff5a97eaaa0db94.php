<?php $__env->startSection('title', @$title); ?>

<?php $__env->startSection('content'); ?>
  <main class="min-vh-50 d-flex flex-column justify-content-center align-items-center py-5">
    <div class="text-center mb-4">
      <h3 class="fw-bold">Hello <?php echo e(userNameById('', user()->id) ?? 'Guest'); ?></h3>
      
    </div>

    <form id="confirm-form" class="w-100" style="max-width: 400px;">
      <?php echo csrf_field(); ?>
      <div class="form-group mb-3 text-center">
        <h5 for="captcha" class="form-label">Enter the CAPTCHA to Confirm COD</h5>
        <div class="captcha-wrapper d-flex justify-content-center align-items-center gap-2 mb-2">
          <img src="<?php echo e(captcha_src('flat')); ?>" class="captcha-image border rounded" alt="captcha" height="40">
          <button type="button" class="btn btn-outline-secondary btn-sm" id="refresh-captcha" title="Refresh CAPTCHA">
            <i class="ri-refresh-line"></i>
          </button>
        </div>
        <input type="text" name="captcha" id="captcha" class="form-control text-center" placeholder="Enter CAPTCHA">
        <?php $__errorArgs = ['captcha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger small d-block mt-2"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="text-center">
        <button type="submit" id="confirmBtn" class="btn btn-dark px-4">Submit</button>
      </div>
    </form>
  </main>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('component-scripts'); ?>
  <script>
  $(document).ready(function() {
      const $refreshBtn = $('#refresh-captcha');
      const $captchaImg = $('.captcha-image');
      const $form = $('#confirm-form');

      $refreshBtn.on('click', function() {
        $refreshBtn.prop('disabled', true).addClass('loading');

        $.ajax({
          url: '<?php echo e(route('captcha.refresh')); ?>',
          type: 'GET',
          dataType: 'json',
          timeout: 5000,
          success: function(response) {
            if (response.captcha) {
              $captchaImg.attr('src', response.captcha + '?' + Date.now());
            } else {
              iziNotify("Oops!", 'Unexpected response. Please try again.', "warning");
            }
          },
          error: function(xhr) {
            if (xhr.status === 429) {
              iziNotify("Oops!", 'Too many attempts. Please wait a moment before refreshing.', "error");
            } else {
              iziNotify("Oops!", 'Failed to refresh CAPTCHA. Please check your connection.', "error");
            }
            console.error('CAPTCHA refresh error:', xhr);
          },
          complete: function() {
            $refreshBtn.prop('disabled', false).removeClass('loading');
          }
        });
      });

    $form.on('submit', function(e) {
        e.preventDefault();
        if (!$('#captcha').val()) {
          iziNotify("Oops!", 'Please enter the CAPTCHA.', "error");
          return;
        }
        $('#confirmBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...');
        $.ajax({
          url: '<?php echo e(route('checkout.confirm')); ?>',
          method: 'POST',
          data: {
              '_token': '<?php echo e(csrf_token()); ?>',
              'captcha': $('#captcha').val(),
              'order_number': '<?php echo e($order_number); ?>'
          },
          success: function(response) {
            if (response.success) {
                  $('#confirmBtn').prop('disabled', true).html('Submit');
                  iziNotify("", response.message, "success");
                  setTimeout(() => window.location.href = response.redirect + '?from=confirmation', 1000);
              } else {
                  $('#confirmBtn').prop('disabled', false).html('Submit');
                  iziNotify("Oops!", response.message, "error");
                  $('#captcha').val('');
                  $refreshBtn.trigger('click');
              }
          },
          error: function(error) {
              $('#confirmBtn').prop('disabled', false).html('Submit');
              iziNotify("Error!", error.responseJSON?.message, "error");
              $('#captcha').val('');
              $refreshBtn.trigger('click');
          }
      });
      });
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/pages/checkout/confirm.blade.php ENDPATH**/ ?>