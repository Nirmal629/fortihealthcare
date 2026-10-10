<?php echo $__env->make('backend.includes.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->yieldContent('page-styles'); ?>
<?php echo $__env->yieldPushContent('component-styles'); ?>
<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body>
  <?php echo $__env->make('backend.includes.preloader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="wrapper">
    <?php echo $__env->make('backend.includes.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('backend.includes.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <?php echo $__env->yieldContent('content'); ?>
        </div>
      </div>
    </div>
    <?php echo $__env->make('backend.includes.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>
  <?php echo $__env->make('backend.includes.foot', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/backend/layouts/app.blade.php ENDPATH**/ ?>