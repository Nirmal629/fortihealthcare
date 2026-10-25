<?php if($items->count()): ?>
  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="cart_page_block border" id="product-cart-item-<?php echo e($item->productVariant->id); ?>">
      <div class="product_thumb">
        <figure class="m-0 ratio ratio-1000x800">
          <a href="<?php echo e(route('product.show', $item->productVariant->sku)); ?>" title="<?php echo e($item->productVariant->name); ?>">
            <img
              src="<?php echo e(!empty($item->productVariant->galleries[0]['file_name'])
                  ? asset('public/uploads/media/products/images/' . $item->productVariant->galleries[0]['file_name'])
                  : asset('public/backend/assetss/images/products/product_thumb.jpg')); ?>"
              alt="<?php echo e($item->productVariant->name); ?>" class="imageFit">
          </a>
        </figure>
      </div>

      <div class="product_info border-start d-flex justify-content-center flex-column p-4 flow-rootX2">

          <div class="cart-action d-flex justify-content-end align-items-center gap-3">
            <a href="javascript:void(0);" data-id="<?php echo e(Hashids::encode($item->productVariant->id)); ?>" data-serial="<?php echo e($item->productVariant->id); ?>" class="action_savelater add-to-cart-btn c--blackc d-flex align-items-center gap-2">
                <span class="material-symbols-outlined font20"> update</span>
                <u>Move to Cart</u>
            </a>
            
            <form id="add-to-cart-form-<?php echo e($item->product_variant_id); ?>" action="<?php echo e(route('cart.add')); ?>" method="POST" style="display: none;">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="product_variant_id" value="<?php echo e(Hashids::encode($item->product_variant_id)); ?>">
              <input type="hidden" name="quantity" value="<?php echo e($item->quantity); ?>">
              <input type="hidden" name="is_saved_for_later" value="0">
              <input type="hidden" name="action" value="add_to_cart">
            </form>
          </div>
        <div class="product_name_category flow-rootx">
          <a style="all: unset; cursor: pointer;" href="<?php echo e(route('product.show', $item->productVariant->sku)); ?>">
            <h5 class="font35 fw-normal c--blackc mt-0"><?php echo e($item->productVariant->name); ?></h5>
          </a>
        </div>
        <?php if (isset($component)) { $__componentOriginal806375e7513d5d7f92c8588223a61385 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal806375e7513d5d7f92c8588223a61385 = $attributes; } ?>
<?php $component = App\View\Components\ProductPrice::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ProductPrice::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->productVariant)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal806375e7513d5d7f92c8588223a61385)): ?>
<?php $attributes = $__attributesOriginal806375e7513d5d7f92c8588223a61385; ?>
<?php unset($__attributesOriginal806375e7513d5d7f92c8588223a61385); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal806375e7513d5d7f92c8588223a61385)): ?>
<?php $component = $__componentOriginal806375e7513d5d7f92c8588223a61385; ?>
<?php unset($__componentOriginal806375e7513d5d7f92c8588223a61385); ?>
<?php endif; ?>
      </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
  <div class="text-center border p-5">
    <h4>No items in wishlist.</h4>
  </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/wishlist_items.blade.php ENDPATH**/ ?>