<div>
  <div class="d-flex filter-small justify-content-end align-items-center mb-2">
    <div class="d-flex me-2">
      <div class="input-group input-group-text font-14 bg-white" id="reportrange" wire:ignore>
        <i class="mdi mdi-calendar-range font-14 d-flex me-2"></i>
        <span class=""></span>
      </div>
    </div>

    <?php echo $__env->make('livewire.includes.datatable-search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  </div>
  <?php echo $__env->make('livewire.includes.datatable-pagecount', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="table-responsive">
    <table class="table table-centered mb-0">
      <thead>
        <tr>
          <th>Sl.</th>
          <th>Category</th>
          <th>Variant Name</th>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'sku',
              'displayName' => 'SKU',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'order_count',
              'displayName' => 'Order Count',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->make('livewire.includes.datatable-header-sort', [
              'colName' => 'total_sales',
              'displayName' => 'Total Sales',
          ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <!--[if BLOCK]><![endif]--><?php if(count($products) > 0): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $variant = $product->variant;
              if (!$variant || $variant == null) {
                  continue;
              }
              $mainProduct = $variant->product ?? null;
              $hashedID = Hashids::encode($variant->id);
            ?>
            <tr id="row_<?php echo e($hashedID); ?>">
              <td class=""><?php echo e($serialNumber++); ?></td>
              <td><?php echo e($mainProduct->category->title ?? 'N/A'); ?></td>
              <td><?php echo e($variant->name); ?></td>
              <td><?php echo e($variant->sku); ?></td>
              <td>
                <?php echo e($product->order_count); ?>

              </td>
              <td>
                <?php echo e(displayPrice($product->total_sales)); ?>

              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <tr>
            <td colspan="12">
              <div role="alert" class="alert alert-danger text-center text-danger">No Products Found</div>
            </td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>

    </table>
  </div>
  <?php echo e($products->links('vendor.livewire.bootstrap')); ?>

</div>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/livewire/reports/top-selling-products-table.blade.php ENDPATH**/ ?>