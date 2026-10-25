<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['cart_items', 'coupon' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['cart_items', 'coupon' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="cart_summery <?php echo e(cartCount() == 0 ? 'd-none' : ''); ?>">

  <div class="summary_header">
    <h3 class="summary_title">Order Summary</h3>
    <span class="summary_count_badge">
      <?php echo e(cartCount()); ?> <?php echo e(cartCount() == 1 ? 'Item' : 'Items'); ?>

    </span>
  </div>

  <?php
    use Illuminate\Support\Facades\DB;

    $extra_charges = DB::table('charges')->where('status', true)->get();
  ?>
  <div class="cart_totals_grid">
    <?php
      $total = 0;
      $totalTax = 0;
      $totalCategoryTaxPercent = 0;
    ?>

    <div class="summary_items_list">
      <?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $variant = $item->productVariant;
          $promo = findSalePrice($variant->id);

          $displayPrice = $promo['display_price'];
          $regularPrice = $promo['regular_price'];
          $discount = $promo['display_discount'];
          if ($promo['regular_price_true'] == true) {
              $unitPrice = $regularPrice;
          } else {
              $unitPrice = $displayPrice;
          }

          $subtotal = $unitPrice * $item->quantity;
          $total += $subtotal;

          $categoryTaxRate = $variant?->category?->tax ?? 0;
          $itemTax = ($unitPrice * $item->quantity * $categoryTaxRate) / 100;
          $totalTax += $itemTax;
          $totalCategoryTaxPercent += $categoryTaxRate;
        ?>

        <div class="summary_item_row">
          <div class="pe-2 text-truncate" style="max-width: 68%;">
            <a class="item_title" href="<?php echo e(route('product.show', $variant->sku)); ?>">
              <?php echo e($variant->name); ?>

            </a>
            <span class="item_qty">× <?php echo e($item->quantity); ?></span>
            <i class="ri-information-line text-primary ms-1 font13" data-bs-toggle="tooltip" data-bs-placement="top"
              title="<?php echo e(config('defaults.tax_name')); ?>: <?php echo e($categoryTaxRate); ?>% (<?php echo e(displayPrice($itemTax)); ?>)">
            </i>
            <?php if($discount > 0): ?>
              <div><span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 10px; padding: 2px 6px;"><?php echo e($discount); ?> OFF</span></div>
            <?php endif; ?>
          </div>
          <div class="item_price"><?php echo e(displayPrice($subtotal)); ?></div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php
      $avgTax = count($cart_items) > 0 ? $totalCategoryTaxPercent / count($cart_items) : 0;
      $grandTotal = $total + $totalTax;
    ?>

    <div class="summary_calc_list">
      <div class="summary_calc_row">
        <span class="calc_label">Subtotal</span>
        <span class="calc_val"><?php echo e(displayPrice($total)); ?></span>
      </div>

      <div class="summary_calc_row">
        <span class="calc_label">Estimated Tax</span>
        <span class="calc_val"><?php echo e(displayPrice($totalTax)); ?></span>
      </div>

      
      <?php
        $deliveryChargesTotal = 0;
      ?>

      <?php $__currentLoopData = $extra_charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $applyCharge = true;
          $conditions = json_decode($charge->conditions, true) ?? [];

          // Apply min_order condition
          if (isset($conditions['min_order']) && $grandTotal < $conditions['min_order']) {
              $applyCharge = false;
          }

          if (!$applyCharge) {
              continue;
          }

          $chargeAmount = 0;
          switch ($charge->calculation_method) {
              case 'fixed':
                  $chargeAmount = $charge->value;
                  break;
              case 'percentage':
                  $chargeAmount = ($grandTotal * $charge->value) / 100;
                  break;
          }

          // Skip if charge amount is 0
          if ($chargeAmount <= 0) {
              continue;
          }

          $deliveryChargesTotal += $chargeAmount;
        ?>

        <div class="summary_calc_row">
          <span class="calc_label">
            <?php echo e($charge->name); ?>

            <?php if($charge->calculation_method === 'percentage'): ?>
              <small class="text-muted">(<?php echo e($charge->value); ?>%)</small>
            <?php endif; ?>
          </span>
          <span class="calc_val"><?php echo e(displayPrice($chargeAmount)); ?></span>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php
      $grandTotalWithDelivery = $grandTotal + $deliveryChargesTotal;
    ?>

    <div id="coupon-section"></div>
    <?php if($coupon): ?>
      <form id="coupon-form" class="mt-2 mb-2">
        <?php echo csrf_field(); ?>
        <div class="input-group">
          <input type="hidden" name="order_amount" id="order_amount" value="<?php echo e($grandTotalWithDelivery); ?>">
          <input type="text" name="coupon_code" id="coupon_code" class="form-control font13"
            placeholder="Coupon code" style="border-radius: 6px 0 0 6px;">
          <button type="submit" class="btn text-white px-3 font13 fw-semibold" style="background-color: #f0b334; border-radius: 0 6px 6px 0;">Apply</button>
        </div>
      </form>
      <div class="search-coupon text-end mb-2">
        <a href="javascript:void(0);" onclick="showCouponModal()" class="font12 text-decoration-none" style="color: #f0b334; font-weight: 500;">
          <i class="ri-coupon-3-line me-1"></i> View Available Coupons
        </a>
      </div>
    <?php endif; ?>

    <div class="summary_total_row">
      <div class="total_label_group">
        <span class="total_label">Order Total</span>
        <span class="tax_note">Inclusive of all taxes</span>
      </div>
      <span class="total_val order-total-amount"><?php echo e(displayPrice($grandTotalWithDelivery)); ?></span>
    </div>
  </div>
</div>


<div class="modal genericmodal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="couponModalLabel">Available Coupons</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="coupon-modal-body">
        ...
      </div>
    </div>
  </div>
</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    $(document).on('click', '#remove-coupon-btn', function() {
      $.ajax({
        url: "<?php echo e(route('checkout.coupon.remove')); ?>",
        type: "POST",
        data: {
          _token: "<?php echo e(csrf_token()); ?>"
        },
        success: function(response) {
          if (response.success) {
            iziNotify("", response.message, "success");
            $('#coupon-section').html('');
            $('#coupon-form').removeClass('d-none').addClass('d-flex');
            $('#coupon_code').val('');
            location.reload();
          } else {
            iziNotify("Oops!", response.message, "error");
          }
        },
        error: function() {
          iziNotify("Oops!", "Something went wrong!", "error");
        }
      });
    });

    $('#coupon-form').validate({
      rules: {
        coupon_code: {
          required: true
        }
      },
      messages: {
        coupon_code: {
          required: "Please enter a coupon code."
        }
      },
      errorElement: "span",
      errorPlacement: function(error, element) {
        if (element.attr('id') === 'coupon_code') {
          element.closest('.stock-delivery').after(error);
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function(form) {
        let code = $('#coupon_code').val();
        let orderAmount = $('#order_amount').val();
        applyCoupon(code, orderAmount);
      }
    });

    function applyCoupon(code, orderAmount) {
      $.ajax({
        url: "<?php echo e(route('checkout.coupon.apply')); ?>",
        type: "POST",
        data: {
          _token: "<?php echo e(csrf_token()); ?>",
          coupon_code: code,
          order_amount: orderAmount
        },
        success: function(response) {
          if (response.success) {
            iziNotify("", response.message, "success");
            $('#couponModal').modal('hide');
            $('#coupon-section').html(response.html);
            $('#coupon-form').addClass('d-none');
            $('.order-total-amount').text(response.final_amount);
            $('#coupon_id').val(response.coupon_id);
            $('#coupon_discount').val(response.discount);
          } else {
            iziNotify("Oops!", response.message, "error");
          }
        },
        error: function() {
          iziNotify("Oops!", "Something went wrong!", "error");
        }
      });
    }

    function showCouponModal() {
      $('#couponModal').appendTo('body').modal('show');
      $.ajax({
        url: "<?php echo e(route('checkout.list-of-coupons')); ?>",
        type: "GET",
        success: function(response) {
          $('#couponModal #coupon-modal-body').empty();
          if (response.data.length > 0) {
            let htmlContent = '<div class="row row-cols-1 g-3" style="max-height: 400px; overflow-y: auto;">';

            $.each(response.data, function(index, coupon) {
              htmlContent += `
            <div class="col">
              <div class="card border-info shadow-sm h-100 apply-coupon-card" data-code="${coupon.code}" style="cursor: pointer;">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="card-title mb-0 text-dark">
                      <i class="ri-coupon-3-line me-1"></i> ${coupon.code}
                    </h5>
                    <span class="badge bg-dark fs-6">
                     ${coupon.amount} OFF
                    </span>
                  </div>
                  ${coupon.min_order_value !== 0
                    ? `<p class="card-text text-muted mb-0">
                                                                                                             <i class="ri-shopping-basket-line me-1"></i> Min Order: ₹${coupon.min_order_value}
                                                                                                           </p>`
                    : ''
                  }
                </div>
              </div>
            </div>
          `;
            });

            htmlContent += '</div>';
            $('#coupon-modal-body').html(htmlContent);

            // Attach click event to each coupon card
            $('.apply-coupon-card').on('click', function() {
              const code = $(this).data('code');
              const orderAmount = $('#order_amount').val();
              applyCoupon(code, orderAmount);
            });

          } else {
            $('#coupon-modal-body').html('<p class="text-warning">No coupons available at this time.</p>');
          }
        },
        error: function() {
          $('#couponModal #coupon-modal-body').html('<p class="text-danger">Failed to load coupon data.</p>');
          iziNotify("Oops!", "Something went wrong!", "error");
        }
      });
    }
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/components/cart-summary.blade.php ENDPATH**/ ?>