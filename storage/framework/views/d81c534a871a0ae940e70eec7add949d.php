<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo e(config('app.name')); ?> | <?php echo e($pageTitle ?? ''); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Theme Config Js -->
  <script src=<?php echo e(asset('/public/backend/assetss/js/theme-config.js')); ?>></script>

  <!-- App css -->
  <link href=<?php echo e(asset('/public/backend/assetss/app-saas.min.css')); ?> rel="stylesheet" type="text/css" id="app-style" />
  <link href=<?php echo e(asset('/public/backend/assetss/dart-scss/style.css')); ?> rel="stylesheet" type="text/css" />

  <!-- Icons css -->
  <link href=<?php echo e(asset('/public/backend/assetss/icons.min.css')); ?> rel="stylesheet" type="text/css" />

  
  <link rel="shortcut icon" href=<?php echo e(asset('/public/backend/assetss/images/favicon/favicon-32x32.png')); ?>>

  <?php echo $__env->yieldContent('page-styles'); ?>
  <style>
    .error {
      color: red;
    }
  </style>

</head>

<body>

  <?php echo $__env->make('backend.includes.preloader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="wrapper position-relative min-vh-100 loginpages">

    <div class="loginBG position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100 opacity-50">
      <img src=<?php echo e(asset('/public/backend/assetss/images/login-bg.jpg')); ?> alt="">
    </div>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative min-vh-100 d-flex align-items-sm-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xxl-4 col-lg-5">
            <div class="card border-0 bg-transparent">

              <div class="py-3 text-center bg-transparent loginlogo">
                <h2>Fortier Healthcare PVT. LTD.</h2>
                
                
                
              </div>
              <div class="card-body rounded-3 p-4 border-0 bg-white">
                <?php echo $__env->yieldContent('content'); ?>
              </div> <!-- end card-body -->
            </div>
            

          </div> <!-- end col -->
        </div>
        
      </div>
      
    </div>
    
    <div class="loginfooter">
      © <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?> - All Rights Reserved.
    </div>
  </div>

  
  <script src=<?php echo e(asset('/public/backend/assetss/js/vendor.min.js')); ?>></script>

  
  <script src=<?php echo e(asset('/public/backend/assetss/js/app.min.js')); ?>></script>
  <script>
    $(document).ready((function() {
      $(document).ajaxStart((function() {

        $("body").append(
          '\n      <div id="full-page-spinner" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5); z-index: 9999;">\n          <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">\n              <div class="bouncing-loader">\n                  <div></div>\n                  <div></div>\n                  <div></div>\n              </div>\n          </div>\n      </div>\n  '
        )
      })).ajaxStop((function() {
        $("#full-page-spinner").remove()
      }))
    }));
  </script>
  <?php echo $__env->yieldContent('page-scripts'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/backend/layouts/guest.blade.php ENDPATH**/ ?>