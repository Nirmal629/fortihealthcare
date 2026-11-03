<div class="row">
  <div class="col-12">
    <div class="page-title-box pt-3 pb-3">
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="breadcrumb-item">
              <?php if($index < count($breadcrumbs) - 1): ?>
                <a href="<?php echo e($breadcrumb['url']); ?>"><?php echo e($breadcrumb['label']); ?></a>
              <?php else: ?>
                <?php echo e($breadcrumb['label']); ?>

              <?php endif; ?>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
      </div>
      <h4 class="page-title text-primary"><?php echo e($pageTitle); ?></h4>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/components/breadcrumb.blade.php ENDPATH**/ ?>