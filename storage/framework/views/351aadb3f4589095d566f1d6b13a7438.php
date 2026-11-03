<?php $__env->startPush('component-styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('/public/backend/assetss/intlTelInput/intlTelInput.min.css')); ?>">
<?php $__env->stopPush(); ?>
<div class="mb-4 <?php echo e($required ? 'required' : ''); ?> phone-input-container">
  <label for="phone" class="form-label">Phone</label>
  <input type="text" class="form-control only-numbers" name="<?php echo e($name); ?>" id="<?php echo e($id); ?>"
    placeholder="Enter Phone Number" value="<?php echo e($previousValue ?? ''); ?>" inputmode="numeric">
  <div class="<?php echo e($id); ?>-error-container"></div>
</div>

<?php $__env->startPush('component-scripts'); ?>
  <script src="<?php echo e(asset('/public/backend/assetss/intlTelInput/intlTelInput.min.js')); ?>"></script>

  <script>
    const input = document.querySelector("#<?php echo e($id); ?>"),
      iti = window.intlTelInput(input, {
        initialCountry: "auto",
        formatOnDisplay: false, // Prevent reformatting to national format
        geoIpLookup: t => {
          fetch("https://ipapi.co/json").then((t => t.json())).then((i => t(i.country_code))).catch((() => t("in")))
        },
        strictMode: true,
        loadUtils: () => import("<?php echo e(asset('/public/backend/assetss/intlTelInput/utils.js')); ?>")
      }),
      form = input.closest("form");
    form && form.addEventListener("submit", (function(t) {
      if (iti.isValidNumber()) {
        const t = iti.getNumber();
        input.value = t
      }
    })), jQuery.validator.addMethod("validPhone", (function(t, i) {
      return this.optional(i) || iti.isValidNumber()
    }), "<?php echo e(__('validation.invalid', ['attribute' => 'Phone Number'])); ?>");
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/components/phone-number.blade.php ENDPATH**/ ?>