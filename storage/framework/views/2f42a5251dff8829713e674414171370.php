<?php
  $settings = [];
  if (!empty($subscribe) && isset($subscribe->settings)) {
      $settings = json_decode($subscribe->settings, true);
  }
  // Decode the settings JSON to access image, alt_text, and hyper_link
?>
<section class="furniture__subscription_wrap py-4 py-lg-5 my-4 my-lg-5 position-relative overflow-hidden rounded-4" style="background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%); box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
  <div class="container position-relative z-2">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-xl-7 col-12">
        <div class="mb-3 mb-lg-4 d-inline-block p-3 rounded-circle" style="background: rgba(0,0,0,0.03);">
          <span class="material-symbols-outlined" style="font-size: 2.5rem; color: #333;">drafts</span>
        </div>
        
        <h2 class="fw-bold mb-2 mb-lg-3 text-dark subscription-heading">
          <?php echo $settings['content'] ?? 'Subscribe to our Newsletter'; ?>

        </h2>
        <p class="text-muted mb-4 mb-lg-5 subscription-desc">Join our mailing list to receive the latest news, updates, and special offers directly in your inbox.</p>

        <div class="emailformwrp mx-auto" style="max-width: 550px;">
          <form class="allForm" id="subscribeForm">
            <?php echo csrf_field(); ?>
            <div class="input-group input-group-lg bg-white rounded-pill p-1 p-sm-2 shadow-sm border border-light" style="transition: box-shadow 0.3s ease;">
              <span class="input-group-text bg-transparent border-0 ps-3 ps-sm-4 text-muted">
                <span class="material-symbols-outlined">mail</span>
              </span>
              <input name="email" id="email" type="email" class="form-control border-0 shadow-none px-2 px-sm-3 bg-transparent"
                placeholder="Enter your email address" style="outline: none;">
              <button type="button" class="btn custom-subscribe-btn rounded-pill fw-semibold subscribeEmail" title="Subscribe">Subscribe</button>
            </div>
            <div id="email-error-container" class="text-danger mt-3 small text-start ps-4 fw-medium"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $__env->startPush('scripts'); ?>
  
  <script>
    $(document).ready(function() {
      let validator = $('#subscribeForm').validate({
        rules: {
          email: {
            required: true,
            email: true,
            maxlength: 100
          }
        },
        messages: {
          email: {
            required: "<?php echo e(__('validation.required', ['attribute' => 'Email'])); ?>",
            email: "<?php echo e(__('validation.invalid', ['attribute' => 'Email Format'])); ?>",
            maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Email', 'max' => 100])); ?>"
          }
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
          let errorContainer = $(`#${element.attr('id')}-error-container`);
          if (errorContainer.length)
            error.appendTo(errorContainer);
          else
            error.insertAfter(element);
        },
      });

      $('.subscribeEmail').on('click', function(e) {
        e.preventDefault();
        if ($('#subscribeForm').valid()) {
          let form = $('#subscribeForm')[0];
          let url = "<?php echo e(route('subscribeEmail')); ?>";
          $.ajax({
            type: "POST",
            url: url,
            data: $('#subscribeForm').serialize(),
            success: function(response) {
              if (response.success) {
                $(form).find(".is-valid, .is-invalid").removeClass("is-valid is-invalid");
                iziNotify("", response.message, "success");
                form.reset();
              } else {
                iziNotify("Oops!", response.message, "error");
              }
            },
            error: function(error) {
              iziNotify("Error!", error.responseJSON.message, "error");
            }
          });
        }
      });
    });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/banners/subscribe.blade.php ENDPATH**/ ?>