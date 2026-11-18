<?php
  $fullQuery = request()->query();
?>
<div class="row align-items-center mt-5">
  <div class="col-lg-6">
    <?php if($variants->count() > 0): ?>
      <p class="font18 m-0">Showing
        <strong><?php echo e($variants->firstItem()); ?>-<?php echo e($variants->lastItem()); ?></strong> of
        <strong><?php echo e($variants->total()); ?></strong> items
      </p>
    <?php else: ?>
      No products found
    <?php endif; ?>
  </div>
  <div class="col-lg-6 col-md-6 col-6">
    <div class="buttons-inline d-flex justify-content-end align-items-center gap-3">
      <div class="filterpop">
        <button type="button" class="btn learnmore_btn filter-btn d-inline-flex align-items-center"
          data-bs-toggle="modal" data-bs-target="#sidefilter"><span
            class="material-symbols-outlined font20 me-1">filter_alt</span> Filter</button>
      </div>
    </div>
  </div>
</div>
<?php if(request()->has('min_price') || request()->has('max_price') || count($selectedFilters) >0): ?>
<div class="filter-Wrap">
  <?php if(request()->has('min_price') || request()->has('max_price')): ?>
  
    <?php
      $priceQuery = $fullQuery;
      unset($priceQuery['min_price'], $priceQuery['max_price']);
      $priceUrl = url()->current() . '?' . http_build_query($priceQuery);
    ?>
    <div class="alert alert-secondary alert-dismissible fade show py-1 px-3 rounded-pill" role="alert">
      <strong>Price:</strong> <?php echo e(request('min_price') ?? 0); ?> – <?php echo e(request('max_price') ?? '∞'); ?>

      <a href="<?php echo e($priceUrl); ?>" class="btn-close" aria-label="Close"></a>
    </div>
  <?php endif; ?>

  
  <?php $__currentLoopData = $selectedFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        $query = $fullQuery;
        if (isset($query['attributes'][$key])) {
            $query['attributes'][$key] = array_filter($query['attributes'][$key], fn($v) => $v !== $value);
            if (empty($query['attributes'][$key])) {
                unset($query['attributes'][$key]);
            }
        }
        $filterUrl = url()->current() . '?' . http_build_query($query);
      ?>
      <div class="alert alert-secondary alert-dismissible fade show py-1 px-3 rounded-pill" role="alert">
        <strong><?php echo e($key); ?>:</strong> <?php echo e($value); ?>

        <a href="<?php echo e($filterUrl); ?>" class="btn-close" aria-label="Close"></a>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>

<?php echo $__env->make('frontend.includes.filter-modal', [
    'route' => route('search.product', $product->searchSlug),
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/includes/filter-buttons.blade.php ENDPATH**/ ?>