<?php if($items->count()): ?>
  <div class="cart_items_container">
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        $variant = $item->productVariant;
        $promo = findSalePrice($variant->id);
        $displayPrice = $promo['display_price'];
        $regularPrice = $promo['regular_price'];
        $discount = $promo['display_discount'];
        $unitPrice = ($promo['regular_price_true'] == true) ? $regularPrice : $displayPrice;
        $lineTotal = $unitPrice * $item->quantity;
      ?>

      <div class="cart_page_block" id="product-cart-item-<?php echo e($item->productVariant->id); ?>">
        <div class="product_thumb">
          <figure class="m-0">
            <a href="<?php echo e(route('product.show', $item->productVariant->sku)); ?>"
              title="<?php echo e($item->productVariant->name ?? ''); ?>">
              <img
                src="<?php echo e(!empty($item->productVariant->galleries[0]['file_name'])
                    ? asset('public/uploads/media/products/images/' . $item->productVariant->galleries[0]['file_name'])
                    : asset('public/backend/assetss/images/products/product_thumb.jpg')); ?>"
                alt="<?php echo e($item->productVariant->name ?? ''); ?>" class="imageFit">
            </a>
          </figure>
        </div>

        <div class="product_info">
          <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
            <div class="product_name_category">
              <a style="all: unset; cursor: pointer;" href="<?php echo e(route('product.show', $item->productVariant->sku)); ?>">
                <h5><?php echo e($item->productVariant->name ?? ''); ?></h5>
              </a>
              <?php if(!empty($item->productVariant->sku)): ?>
                <span class="text-muted font12">SKU: <?php echo e($item->productVariant->sku); ?></span>
              <?php endif; ?>
            </div>

            <div class="cart-action">
              <a href="#" class="action_remove"
                title="Remove this item"
                onclick="event.preventDefault(); document.getElementById('<?php echo e('remove-form'); ?>-<?php echo e($item->product_variant_id); ?>').submit()">
                <span class="material-symbols-outlined font18">delete</span>
                <span>Remove</span>
              </a>
              <form id="remove-form-<?php echo e($item->product_variant_id); ?>" action="<?php echo e(route('cart.remove')); ?>" method="POST"
                style="display: none;">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_variant_id" value="<?php echo e(Hashids::encode($item->product_variant_id)); ?>">
              </form>
            </div>
          </div>

          <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3 pt-2 border-top">
            <div class="cart_item_pricing">
              <span class="current_price"><?php echo e(displayPrice($unitPrice)); ?></span>
              <?php if($discount > 0): ?>
                <span class="old_price"><?php echo e(displayPrice($regularPrice)); ?></span>
                <span class="discount_badge"><?php echo e($discount); ?> OFF</span>
              <?php endif; ?>
            </div>

            <?php if($cart_action): ?>
              <div class="cart-itemadd-less d-flex align-items-center gap-3">
                <?php if($errors->has('quantity.' . $item->product_variant_id)): ?>
                  <div class="error text-danger font13">
                    <?php echo e($errors->first('quantity.' . $item->product_variant_id)); ?>

                  </div>
                <?php endif; ?>
                <?php if($errors->has('cart')): ?>
                  <div class="error text-danger font13">
                    <?php echo e($errors->first('cart')); ?>

                  </div>
                <?php endif; ?>

                <?php
                  $display_quantity = $display_quantity ?? false;
                ?>
                <?php if($display_quantity): ?>
                  <?php
                    $decrementCondition = $item->quantity <= 1;
                    $incrementCondition = $item->quantity >= ($item->productVariant->inventory->quantity ?? 9999);
                    $quantity = $item->quantity ?? 1;
                  ?>

                  <form id="decrement-form-<?php echo e($item->product_variant_id); ?>" action="<?php echo e(route('cart.updateQuantity')); ?>"
                    method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="product_variant_id"
                      value="<?php echo e(Hashids::encode($item->product_variant_id)); ?>">
                    <input type="hidden" name="quantity" value="<?php echo e($item->quantity - 1); ?>">
                  </form>

                  <form id="increment-form-<?php echo e($item->product_variant_id); ?>" action="<?php echo e(route('cart.updateQuantity')); ?>"
                    method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="product_variant_id"
                      value="<?php echo e(Hashids::encode($item->product_variant_id)); ?>">
                    <input type="hidden" name="quantity" value="<?php echo e($item->quantity + 1); ?>">
                  </form>

                  <div class="cart_custom_qty_box">
                    <button type="button" class="qty_btn qty_minus <?php echo e($decrementCondition ? 'disabled' : ''); ?>"
                      <?php echo e($decrementCondition ? 'disabled' : ''); ?>

                      title="<?php echo e($decrementCondition ? 'Minimum 1 item' : 'Decrease quantity'); ?>"
                      onclick="<?php echo e(!$decrementCondition ? "event.preventDefault(); document.getElementById('decrement-form-{$item->product_variant_id}').submit()" : ''); ?>">
                      <span class="material-symbols-outlined font18">remove</span>
                    </button>
                    <input type="text" class="qty_val_input" value="<?php echo e($quantity); ?>" readonly />
                    <button type="button" class="qty_btn qty_plus <?php echo e($incrementCondition ? 'disabled' : ''); ?>"
                      <?php echo e($incrementCondition ? 'disabled' : ''); ?>

                      title="<?php echo e($incrementCondition ? 'Maximum stock reached' : 'Increase quantity'); ?>"
                      onclick="<?php echo e(!$incrementCondition ? "event.preventDefault(); document.getElementById('increment-form-{$item->product_variant_id}').submit()" : ''); ?>">
                      <span class="material-symbols-outlined font18">add</span>
                    </button>
                  </div>
                <?php else: ?>
                  <div class="badge bg-light text-dark border px-3 py-2 font14">
                    Qty: <?php echo e($item->quantity); ?>

                  </div>
                <?php endif; ?>

                <div class="text-end ps-2 d-none d-sm-block">
                  <div class="fw-bold font16 text-dark"><?php echo e(displayPrice($lineTotal)); ?></div>
                </div>
              </div>
            <?php else: ?>
              <div class="badge bg-light text-dark border px-3 py-2 font14">
                Qty: <?php echo e($item->quantity); ?>

              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php else: ?>
  <div class="empty-cart-card">
    <div class="empty-icon-box">
      <span class="material-symbols-outlined">shopping_cart</span>
    </div>
    <h3>Your Cart is Empty</h3>
    <p>Looks like you haven't added any products to your shopping cart yet.</p>
    <a href="<?php echo e(route('home')); ?>" class="learnmore_btn">
      Start Shopping
    </a>
  </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/cart_items.blade.php ENDPATH**/ ?>