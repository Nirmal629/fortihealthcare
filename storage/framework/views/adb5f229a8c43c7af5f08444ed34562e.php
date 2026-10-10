<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo e($pageTitle ?? ''); ?> | <?php echo e(config('app.name')); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <!-- Theme Config Js -->
  <script src=<?php echo e(asset('/public/backend/assetss/js/theme-config.js')); ?>></script>

  <!-- App css -->
  <link href=<?php echo e(asset('/public/backend/assetss/app-saas.min.css?v=' . time())); ?> rel="stylesheet" type="text/css"
    id="app-style" />
  <link href=<?php echo e(asset('/public/backend/assetss/dart-scss/style.css?v=' . time())); ?> rel="stylesheet" type="text/css" />

  <!-- Icons css -->
  <link href=<?php echo e(asset('/public/backend/assetss/icons.min.css')); ?> rel="stylesheet" type="text/css" />

  
  <link rel="shortcut icon" href=<?php echo e(asset('/public/backend/assetss/images/favicon/favicon-32x32.png')); ?>>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/backend/includes/head.blade.php ENDPATH**/ ?>