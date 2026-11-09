<section class="breadcrumb-wrapper py-4 border-top">
  <div class="container-xxl">
    <ul class="breadcrumbs">
      <li><a href="<?php echo e(url('/')); ?>">Home</a></li>

      <?php if($parentCategories->isNotEmpty()): ?>
        <?php $__currentLoopData = $parentCategories->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
            <a href="<?php echo e(route('category.slug', $parent->slug)); ?>"><?php echo e($parent->title); ?></a>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>

      <?php if($category): ?>
        <li>
          <a href="<?php echo e(route('category.slug', $category->slug)); ?>"><?php echo e($category->title); ?></a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</section>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/includes/breadcrumb.blade.php ENDPATH**/ ?>