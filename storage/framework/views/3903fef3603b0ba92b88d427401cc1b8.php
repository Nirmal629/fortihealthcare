<?php $__env->startSection('page-styles'); ?>
  <link href="<?php echo e(asset('/public/backend/assetss/select2/select2.min.css')); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/css/intlTelInput.css">
  <style>
    .component-img-container img {
      max-width: 100%;
      max-height: 100%;
      display: block;
      margin: 0 auto;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve(['pageTitle' => $pageTitle,'skipLevels' => [0]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Breadcrumb::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $attributes = $__attributesOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__attributesOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $component = $__componentOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__componentOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
  <div class="col-xl-12 col-lg-12 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <ul class="nav nav-pills bg-nav-pills mb-3">
          <li class="nav-item">
            <a href="#general" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
              <span class="d-none d-md-block">General</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#mail_config" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 "
              id="mail_config-tab">
              <span class="d-none d-md-block">Email</span>
            </a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane show active" id="general">
            <div class="row">
              <div class="col-md-12">
                <h2 class="mb-3 text-primary font-16 fw-medium border-bottom border-primary pb-2">Store Settings</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <form id="siteSettingsForm">
                  <?php echo csrf_field(); ?>
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <div class="d-flex align-items-center required">
                        <label class="form-label me-2 mb-0">Store Logo</label>
                        <div>
                          <?php echo $__env->make('components.image-uploader', [
                              'imageLink' => siteLogo(),
                              'route' => route('admin.upload-site-logo'),
                              'resolution' => [273, 72], // width, height
                              'max_size' => 2000, // in KB
                          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <form id="siteGeneralForm">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-4">
                  <div class="mb-3 required">
                    <label for="sitename" class="form-label">Store Name</label>
                    <input type="text" class="form-control only-alphabet-symbols" name="sitename" id="sitename"
                      placeholder="Enter Store Name" value = "<?php echo e($settings['sitename'] ?? ''); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 required">
                    <label for="siteurl" class="form-label">Store URL</label>
                    <input type="text" class="form-control" id="siteurl" name="siteurl" placeholder="Enter Store URL"
                      value = "<?php echo e($settings['siteurl'] ?? ''); ?>">
                    <div class="siteurl-error-container"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 required">
                    <label for="site_email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="site_email" id="site_email" placeholder="Enter email"
                      value = "<?php echo e($settings['site_email'] ?? ''); ?>">
                    <div class="site_email-error-container"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 required">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control only-numbers" name="site_primary_phone"
                      id="site_primary_phone" placeholder="Enter Phone Number"
                      value="<?php echo e($settings['site_primary_phone'] ?? ''); ?>" inputmode="numeric">
                    <div class="site_primary_phone-error-container"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label for="phone" class="form-label">Alternate Phone</label>
                    <input type="text" class="form-control only-numbers" name="site_secondary_phone"
                      id="site_secondary_phone" placeholder="Enter Phone Number"
                      value="<?php echo e($settings['site_secondary_phone'] ?? ''); ?>" inputmode="numeric">
                    <div class="site_secondary_phone-error-container"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label for="tax_no" class="form-label"><?php echo e(config('defaults.tax_name')); ?> No</label>
                    <input type="text" class="form-control" name="tax_no" id="tax_no"
                      placeholder="Enter <?php echo e(config('defaults.tax_name')); ?> No"
                      value = "<?php echo e($settings['tax_no'] ?? ''); ?>">
                    <div class="tax_no-error-container"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">Default Currency</label>
                    <select class="form-select select2" name="currency" id="currency">
                      <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(Hashids::encode($currency['id'])); ?>"
                          <?php echo e($currency['id'] == ($settings['currency_id'] ?? 0) ? 'selected' : ''); ?>>
                          <?php echo e($currency['name']); ?>

                        </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="tax_no-error-container"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">Order Mails Copy To</label>
                    <select class="form-select select2" name="order_copy_to" id="order_copy_to">
                      <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(Hashids::encode($role['id'])); ?>"
                          <?php echo e($role['id'] == ($settings['order_copy_to'] ?? 0) ? 'selected' : ''); ?>>
                          <?php echo e($role['name']); ?>

                        </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="tax_no-error-container"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">Threshold Mails To</label>
                    <select class="form-select select2" name="threshold_mails" id="threshold_mails">
                      <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(Hashids::encode($role['id'])); ?>"
                          <?php echo e($role['id'] == ($settings['threshold_mails'] ?? 0) ? 'selected' : ''); ?>>
                          <?php echo e($role['name']); ?>

                        </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="tax_no-error-container"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">Two Factor Authentication</label>
                    <select class="form-select select2" name="two_factor_auth" id="two_factor_auth">
                        <option value="1" <?php echo e(isset($settings['payment_gateway']) && $settings['two_factor_auth'] == 1 ? 'selected' : ''); ?>>Yes</option>
                        <option value="2" <?php echo e(isset($settings['payment_gateway']) && $settings['two_factor_auth'] == 2 ? 'selected' : ''); ?>>No</option>
                    </select>
                    <div class="tax_no-error-container"></div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">Payment Gateway</label>
                    <select class="form-select select2" name="payment_gateway" id="payment_gateway">
                        <option value="1" <?php echo e(isset($settings['payment_gateway']) && $settings['payment_gateway'] == 1 ? 'selected' : ''); ?>>Stripe</option>
                        <option value="2" <?php echo e(isset($settings['payment_gateway']) && $settings['payment_gateway'] == 2 ? 'selected' : ''); ?>>Paypal</option>
                    </select>
                    <div class="tax_no-error-container"></div>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-md-12">
                  <h2 class="mb-3 text-primary font-16 fw-medium border-bottom border-primary pb-2">Store Address</h2>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label for="address" class="form-label">Address Line 1</label>
                    <input type="text" class="form-control" name="address1" id="address1"
                      placeholder="Enter Address Line 1" value="<?php echo e($settings['address1'] ?? ''); ?>">
                    <div class="address1-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label for="address" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" name="address2" id="address2"
                      placeholder="Enter Address Line 2" value="<?php echo e($settings['address2'] ?? ''); ?>">
                    <div class="address2-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label for="address" class="form-label">Landmark</label>
                    <input type="text" class="form-control" name="landmark" id="landmark"
                      placeholder="Enter Landmark" value="<?php echo e($settings['landmark'] ?? ''); ?>">
                    <div class="landmark-error-container"> </div>
                  </div>
                </div>
                <?php if(!config('defaults.country_id')): ?>
                  <div class="col-md-4">
                    <div class="mb-3 not-required">
                      <label for="country" class="form-label">Country</label>
                      <select class="form-select select2" name="country" id="country">
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e(Hashids::encode($country['id'])); ?>"
                            <?php echo e($settings['country_id'] == $country['id'] ? 'selected' : ''); ?>>
                            <?php echo e($country['name']); ?>

                          </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <div class="country-error-container"></div>
                    </div>
                  </div>
                <?php else: ?>
                  <input type="hidden" name="country" value="<?php echo e(Hashids::encode(config('defaults.country_id'))); ?>">
                <?php endif; ?>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label for="state" class="form-label">State</label>
                    <select class="form-select select2" name="state" id="state">
                      <option value=""></option>
                      <?php $__currentLoopData = $stateList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(Hashids::encode($state['id'])); ?>"
                          <?php echo e($state['id'] == ($settings['state_id'] ?? 0) ? 'selected' : ''); ?>>
                          <?php echo e($state['name']); ?>

                        </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="state-error"> </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="Enter City"
                      value="<?php echo e($settings['city'] ?? ''); ?>">
                    <div class="city-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">Zip Code</label>
                    <input type="text" class="form-control only-zip-code" name="zip_code" id="zip_code"
                      placeholder="Enter Zip Code" value="<?php echo e($settings['zip_code'] ?? ''); ?>">
                    <div class="zip_code-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <h2 class="mb-3 text-primary font-16 fw-medium border-bottom border-primary pb-2">Social Media
                    Links</h2>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">Facebook Link</label>
                    <input type="text" class="form-control" name="facebook_link" id="facebook_link"
                      placeholder="Enter Facebook Link" value="<?php echo e($settings['facebook_link'] ?? ''); ?>">
                    <div class="facebook_link-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">X (Twitter) Link</label>
                    <input type="text" class="form-control" name="x_link" id="x_link"
                      placeholder="Enter X (Twitter) Link" value="<?php echo e($settings['x_link'] ?? ''); ?>">
                    <div class="x_link-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">Instagram link</label>
                    <input type="text" class="form-control" name="instagram_link" id="instagram_link"
                      placeholder="Enter Instagram link" value="<?php echo e($settings['instagram_link'] ?? ''); ?>">
                    <div class="instagram_link-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">Youtube Link</label>
                    <input type="text" class="form-control" name="youtube_link" id="youtube_link"
                      placeholder="Enter Youtube Link" value="<?php echo e($settings['youtube_link'] ?? ''); ?>">
                    <div class="youtube_link-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">LinkedIn Link</label>
                    <input type="text" class="form-control" name="linkedin_link" id="linkedin_link"
                      placeholder="Enter LinkedIn Link" value="<?php echo e($settings['linkedin_link'] ?? ''); ?>">
                    <div class="linkedin_link-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 not-required">
                    <label class="form-label">Google Map Link</label>
                    <input type="text" class="form-control" name="google_map" id="google_map"
                      placeholder="Enter Google Map Embed Code " value="<?php echo e($settings['google_map'] ?? ''); ?>">
                    <div class="google_map-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 not-required">
                    <label class="form-label">Google Playstore Link</label>
                    <input type="text" class="form-control" name="google_play_link" id="google_play_link"
                      placeholder="Enter Google Playstore Link" value="<?php echo e($settings['google_play_link'] ?? ''); ?>">
                    <div class="google_play_link-error-container"> </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 not-required">
                    <label class="form-label">Apple Appstore Link</label>
                    <input type="text" class="form-control" name="apple_app_link" id="apple_app_link"
                      placeholder="Enter Apple Appstore Link" value="<?php echo e($settings['apple_app_link'] ?? ''); ?>">
                    <div class="apple_app_link-error-container"> </div>
                  </div>
                </div>
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
              </div>
            </form>
          </div>
          <div class="tab-pane " id="mail_config">
            <form id="mailConfigForm">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-3">
                  <div class="mb-3 required">
                    <label for="mail_host" class="form-label">Driver</label>
                    <input type="text" class="form-control" name="mail_mailer" id="mail_mailer"
                      placeholder="Enter Driver" value = "<?php echo e($mail['mail_mailer'] ?? env('MAIL_MAILER')); ?>" readonly>
                    <div class="mail_driver-error-container"></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3 required">
                    <label for="mail_host" class="form-label">Host</label>
                    <input type="text" class="form-control" name="mail_host" id="mail_host"
                      placeholder="Enter Host" value = "<?php echo e($mail['mail_host'] ?? env('MAIL_HOST')); ?>" readonly>
                    <div class="mail_host-error-container"></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3 required">
                    <label for="mail_port" class="form-label">Port</label>
                    <input type="text" class="form-control only-numbers" name="mail_port" id="mail_port"
                      placeholder="Enter Port" value = "<?php echo e($mail['mail_port'] ?? env('MAIL_PORT')); ?>" readonly>
                    <div class="mail_port-error-container"></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3 required">
                    <label for="mail_username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="mail_username" id="mail_username"
                      placeholder="Enter Username" value = "<?php echo e($mail['mail_username'] ?? env('MAIL_USERNAME')); ?>"
                      readonly>
                    <div class="mail_username-error-container"></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3 required">
                    <label for="mail_password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="mail_password" id="mail_password"
                      placeholder="Enter Password" value = "<?php echo e($mail['mail_password'] ?? env('MAIL_PASSWORD')); ?>"
                      readonly>
                    <div class="mail_password-error-container"></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3 required">
                    <label for="mail_encryption" class="form-label">Encryption</label>
                    <input type="text" class="form-control" name="mail_encryption" id="mail_encryption"
                      placeholder="Enter Encryption" value = "<?php echo e($mail['mail_encryption'] ?? env('MAIL_ENCRYPTION')); ?>"
                      readonly>
                    <div class="mail_encryption-error-container"></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3 required">
                    <label for="mail_from_address" class="form-label">From Address</label>
                    <input type="text" class="form-control" name="mail_from_address" id="mail_from_address"
                      placeholder="Enter From Address"
                      value = "<?php echo e($mail['mail_from_address'] ?? env('MAIL_FROM_ADDRESS')); ?>" readonly>
                    <div class="mail_from_address-error-container"></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3 required">
                    <label for="mail_from_name" class="form-label">From Name</label>
                    <input type="text" class="form-control" name="mail_from_name" id="mail_from_name"
                      placeholder="Enter From Name" value = "<?php echo e($mail['mail_from_name'] ?? env('MAIL_FROM_NAME')); ?>"
                      readonly>
                    <div class="mail_from_name-error-container"></div>
                  </div>
                </div>
              </div>
              <div class="row ">
                <div class="col-lg-12 text-end">
                  <button type="button" class="btn btn-primary mt-2 px-4" id="editMailBtn">Edit</button>
                  <div class="d-flex justify-content-end gap-2 mt-2">
                    <button type="button" class="btn btn-secondary px-4" id="backMailBtn"
                      style="display: none">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" id="updateMailBtn"
                      style="display: none">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
  <script src="<?php echo e(asset('/public/backend/assetss/js/jquery.validate.min.js')); ?>"></script>
  <script src="<?php echo e(asset('/public/backend/assetss/select2/select2.min.js')); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/js/intlTelInput.min.js"></script>
  <script src="<?php echo e(asset('/public/common/js/custom_input.js?v=1' . time())); ?>"></script>
  <script>
    function ajaxFormSubmission(url, data, callback) {
      $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(response) {
          if (response.success) {
            swalNotify("Success!", response.message, "success");
            callback(true);
          } else {
            swalNotify("Oops!", response.message, "error");
            callback(false);
          }
        },
        error: function(error) {
          swalNotify("Error!", error.responseJSON.message, "error");
          callback(false);
        }
      });
    }
    $('#siteGeneralForm').validate({
      rules: {
        siteurl: {
          required: true,
          url: true,
          maxlength: 100
        },
        sitename: {
          required: true,
          maxlength: 100
        },
        site_email: {
          required: true,
          email: true,
          maxlength: 100
        },
        site_primary_phone: {
          required: true,
          validPhone: true
        },
        site_secondary_phone: {
          validAlternatePhone: true
        },
        address1: {
          maxlength: 100
        },
        address2: {
          maxlength: 100
        },
        landmark: {
          maxlength: 100
        },
        city: {
          maxlength: 100
        },
        zip_code: {
          maxlength: 15
        },
        facebook_link: {
          facebook: true,
          maxlength: 100
        },
        x_link: {
          twitter: true,
          maxlength: 100
        },
        instagram_link: {
          instagram: true,
          maxlength: 100
        },
        youtube_link: {
          youtube: true,
          maxlength: 100
        },
        linkedin_link: {
          linkedin: true,
          maxlength: 100
        },
        google_map: {
          googlemap: true
        },
        google_play_link: {
          googleplay: true,
          maxlength: 200
        },
        apple_app_link: {
          appstore: true,
          maxlength: 200
        }
      },
      messages: {
        siteurl: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Store URL'])); ?>",
          url: "<?php echo e(__('validation.url', ['attribute' => 'Store URL'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Store URL', 'max' => 100])); ?>"
        },
        sitename: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Store Name'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Store Name', 'max' => 100])); ?>"
        },
        site_email: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Email Address'])); ?>",
          email: "<?php echo e(__('validation.invalid', ['attribute' => 'Email Format'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Email Address', 'max' => 100])); ?>"
        },
        site_primary_phone: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Phone'])); ?>",
          minlength: "<?php echo e(__('validation.minlength', ['attribute' => 'Phone', 'min' => 10])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Phone', 'max' => 10])); ?>"
        },
        site_secondary_phone: {
          minlength: "<?php echo e(__('validation.minlength', ['attribute' => 'Alternate Phone Number', 'min' => 10])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Alternate Phone Number', 'max' => 10])); ?>"
        },
        address1: {
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Address 1', 'max' => 100])); ?>"
        },
        address2: {
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Address 2', 'max' => 100])); ?>"
        },
        landmark: {
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Landmark', 'max' => 100])); ?>"
        },
        city: {
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'City', 'max' => 100])); ?>"
        },
        zip_code: {
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Zip Code', 'max' => 15])); ?>"
        },
        facebook_link: {
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Facebook Link', 'max' => 100])); ?>"
        },
        x_link: {
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'X Link', 'max' => 100])); ?>"
        },
        instagram_link: {
          url: "<?php echo e(__('validation.url', ['attribute' => 'Instagram Link'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Instagram Link', 'max' => 100])); ?>"
        },
        youtube_link: {
          url: "<?php echo e(__('validation.url', ['attribute' => 'Youtube Link'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Youtube Link', 'max' => 100])); ?>"
        },
        linkedin_link: {
          url: "<?php echo e(__('validation.url', ['attribute' => 'Linkedin Link'])); ?>",
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Linkedin Link', 'max' => 100])); ?>"
        },
        google_play_link: {
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'Google Play Link', 'max' => 100])); ?>"
        },
        apple_app_link: {
          maxlength: "<?php echo e(__('validation.maxlength', ['attribute' => 'App Store Link', 'max' => 100])); ?>"
        }
      },
      errorElement: "div",
      errorPlacement: function(error, element) {
        let errorContainer = $(`#${element.attr('id')}-error-container`);
        if (errorContainer.length) {
          error.appendTo(errorContainer);
        } else {
          error.insertAfter(element); // Fallback
        }
      },
      highlight: function(element) {
        $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function(element) {
        $(element).removeClass("is-invalid").addClass("is-valid");
      },
      submitHandler: function(form) {
        if ($('#site_primary_phone').val() === $('#site_secondary_phone').val()) {
          $('.site_secondary_phone-error-container').addClass('error').html(
            "<?php echo e(__('validation.cant_match', ['attribute' => 'Alternate Phone Number', 'target' => 'Phone'])); ?>"
          );
          return;
        }

        const data = $('#siteGeneralForm').serialize()
        ajaxFormSubmission("<?php echo e(route('admin.site_settings.store')); ?>", data, function(status) {
          if (status) {
            $('#siteGeneralForm .is-valid').removeClass('is-valid');
          }
        });
      }
    });


    $('#editMailBtn').on('click', function() {
      swalConfirm("Are you sure to Edit?", "Incorrect mail settings may cause issues!!!").then((result) => {
        if (result
          .isConfirmed) {
          $('#mailConfigForm input').prop('readonly', false);
          $('#mail_driver').focus();
          setUpdateEmailButtons(true);
        }
      });
    });

    setUpdateEmailButtons(false);
    $('#backMailBtn').on('click', function() {
      $('#mailConfigForm input').prop('readonly', true);
      setUpdateEmailButtons(false);
    });

    function setUpdateEmailButtons(status) {
      if (status) {
        $('#editMailBtn').hide();
        $('#updateMailBtn').show();
        $('#backMailBtn').show();
      } else {
        $('#editMailBtn').show();
        $('#updateMailBtn').hide();
        $('#backMailBtn').hide();
      }
    }

    $('#mailConfigForm').validate({
      rules: {
        mail_driver: {
          required: true
        },
        mail_host: {
          required: true
        },
        mail_port: {
          required: true
        },
        mail_username: {
          required: true
        },
        mail_password: {
          required: true
        },
        mail_encryption: {
          required: true
        },
        mail_from_address: {
          required: true
        },
        mail_from_name: {
          required: true
        }
      },
      messages: {
        mail_driver: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Driver'])); ?>"
        },
        mail_host: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Host'])); ?>"
        },
        mail_port: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Port'])); ?>"
        },
        mail_username: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Username'])); ?>"
        },
        mail_password: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Password'])); ?>"
        },
        mail_encryption: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'Encryption'])); ?>"
        },
        mail_from_address: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'From Address'])); ?>"
        },
        mail_from_name: {
          required: "<?php echo e(__('validation.required', ['attribute' => 'From Name'])); ?>"
        },
      },
      errorElement: "div",
      errorPlacement: function(error, element) {
        let errorContainer = $(`#${element.attr('id')}-error-container`);
        if (errorContainer.length) {
          error.appendTo(errorContainer);
        } else {
          error.insertAfter(element); // Fallback
        }
      },
      highlight: function(element) {
        $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function(element) {
        $(element).removeClass("is-invalid").addClass("is-valid");
      },
      submitHandler: function(form) {
        const data = $('#mailConfigForm').serialize()
        ajaxFormSubmission("<?php echo e(route('admin.update_mail_config')); ?>", data, function(status) {
          if (status) {
            $('#mailConfigForm .is-valid').removeClass('is-valid');
          }
        });
      }
    });

    $('.select2').select2({
      width: '100%',
      placeHolder: "Select Currrency"
    });

    function initializePhoneInput(selector, validationName, attributeName) {
      const input = document.querySelector(selector);
      if (!input) return;

      const iti = window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: callback => {
          fetch("https://ipapi.co/json")
            .then(response => response.json())
            .then(data => callback(data.country_code))
            .catch(() => callback("in"));
        },
        strictMode: true,
        loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/js/utils.js")
      });

      const form = input.closest("form");
      if (form) {
        form.addEventListener("submit", (event) => {
          if (iti.isValidNumber()) {
            input.value = iti.getNumber();
          }
        });
      }

      jQuery.validator.addMethod(validationName, function(value, element) {
        return this.optional(element) || iti.isValidNumber();
      }, `<?php echo e(__('validation.invalid', ['attribute' => '${attributeName}'])); ?>`);

      return iti;
    }

    // Usage
    const phoneInputs = [{
        selector: "#site_primary_phone",
        validationName: "validPhone",
        attributeName: "Phone Number"
      },
      {
        selector: "#site_secondary_phone",
        validationName: "validAlternatePhone",
        attributeName: "Alternate Phone Number"
      }
    ];

    // Initialize all phone inputs
    const itis = phoneInputs.map(inputConfig =>
      initializePhoneInput(
        inputConfig.selector,
        inputConfig.validationName,
        inputConfig.attributeName
      )
    );

    $.validator.addMethod("facebook", function(value, element) {
      value = (value || "").toString();
      return this.optional(element) || /^(https?:\/\/)?(www\.)?(facebook\.com|fb\.com)\/[A-Za-z0-9_.-]+\/?$/.test(
        value);
    }, "<?php echo e(__('validation.url', ['attribute' => 'Facebook Link'])); ?>");

    $.validator.addMethod("linkedin", function(value, element) {
      value = (value || "").toString();
      return this.optional(element) || /^(https?:\/\/)?(www\.)?linkedin\.com\/(in|company)\/[A-Za-z0-9_-]+\/?$/.test(
        value);
    }, "<?php echo e(__('validation.url', ['attribute' => 'LinkedIn Link'])); ?>");

    $.validator.addMethod("twitter", function(value, element) {
      value = (value || "").toString();
      return this.optional(element) || /^(https?:\/\/)?(www\.)?(twitter\.com|x\.com)\/[A-Za-z0-9_]+\/?$/.test(value);
    }, "<?php echo e(__('validation.url', ['attribute' => 'Twitter/X Link'])); ?>");

    $.validator.addMethod("youtube", function(value, element) {
      value = (value || "").toString();
      return this.optional(element) ||
        /^(https?:\/\/)?(www\.)?(youtube\.com\/(channel|c|user|watch\?v=)|youtu\.be\/)[A-Za-z0-9_\-]+/.test(value);
    }, "<?php echo e(__('validation.url', ['attribute' => 'YouTube Link'])); ?>");

    $.validator.addMethod("instagram", function(value, element) {
      value = (value || "").toString();
      return this.optional(element) || /^(https?:\/\/)?(www\.)?instagram\.com\/[A-Za-z0-9_.]+\/?$/.test(value);
    }, "<?php echo e(__('validation.url', ['attribute' => 'Instagram Link'])); ?>");

    $.validator.addMethod("googlemap", function(value, element) {
      value = (value || "").toString();
      return this.optional(element) || /^(https?:\/\/)?(www\.)?google\.[a-z.]+\/maps\/embed\?.+/.test(value);
    }, "<?php echo e(__('validation.url', ['attribute' => 'Google Map Embed'])); ?>");

    $.validator.addMethod("googleplay", function(value, element) {
      value = (value || "").toString();
      return this.optional(element) ||
        /^(https?:\/\/)?(www\.)?play\.google\.com\/store\/apps\/details\?id=[a-zA-Z0-9_.-]+(&.*)?\/?$/.test(value);
    }, "<?php echo e(__('validation.url', ['attribute' => 'Google Play Store Link'])); ?>");

    $.validator.addMethod("appstore", function(value, element) {
      value = (value || "").toString();
      return this.optional(element) ||
        /^(https?:\/\/)?(www\.)?(apps\.apple\.com|itunes\.apple\.com)\/[a-zA-Z]{2}\/app\/[a-zA-Z0-9_-]+\/id[0-9]+\/?$/
        .test(value);
    }, "<?php echo e(__('validation.url', ['attribute' => 'App Store Link'])); ?>");
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/backend/pages/system/site-settings.blade.php ENDPATH**/ ?>