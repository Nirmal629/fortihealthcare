<?php $__env->startSection('page-styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve(['pageTitle' => $pageTitle,'skipLevels' => [1]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Breadcrumb::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $attributes = $__attributesOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__attributesOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $component = $__componentOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__componentOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
  <div class="container-fluid py-4">
    <div class="card shadow-sm">
      <div class="card-header bg-light d-flex justify-content-between align-items-center p-3">
        <div>
          <h4 class="mb-0 text-dark">
            <a href="javascript:void(0)" onclick="history.back()" class="text-danger me-2"><i
                data-feather="arrow-left"></i></a>
            Ordered on <?php echo e(date('d F Y h:i A', strtotime($order->created_at))); ?> | Order #<?php echo e($order->order_number); ?>

          </h4>
          <h6 class="mt-2">Status: <span class="badge bg-info text-white"><?php echo e($order->order_status_text); ?></span></h6>
        </div>
        <div>
          <a href="javascript:void(0)" onclick="downloadInvoice('<?php echo e(Hashids::encode($order->id)); ?>')"
            class="btn btn-warning btn-sm me-2">Download Invoice</a>
          <a href="javascript:void(0)" onclick="printInvoice('<?php echo e(Hashids::encode($order->id)); ?>')"
            class="btn btn-primary btn-sm">Print
            Invoice</a>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="row mb-4">
          <div class="col-12">
            <ul class="list-unstyled d-flex flex-column gap-2">
              <li><i data-feather="user" class="me-2"></i><strong>Customer:
                </strong><?php echo e(userNameById('', $order->user_id)); ?></li>
              <li><i data-feather="phone" class="me-2"></i><strong>Phone: </strong><?php echo e(userDetailById('', $order->user_id)->phone); ?></li>
            </ul>
          </div>
        </div>
        <?php
          $shippingAddress = json_decode($order->shipping_address);
          $billingAddress = json_decode($order->billing_address);
          $otherCharges   = json_decode($order->other_charges, true);
        ?>
        <div class="row mb-4 g-4">
          <div class="col-md-3">
            <h5 class="text-dark">Billing Details:</h5>
            <ul class="list-unstyled">
              <li><?php echo e($billingAddress->name); ?></li>
              <li><?php echo e($billingAddress->phone); ?></li>
              <li><?php echo e($billingAddress->address); ?></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h5 class="text-dark">Shipping Details:</h5>
            <ul class="list-unstyled">
              <li><?php echo e($shippingAddress->name); ?></li>
              <li><?php echo e($shippingAddress->phone); ?></li>
              <li><?php echo e($shippingAddress->address); ?></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h5 class="text-dark">Payment Method</h5>
            <ul class="list-unstyled">
              <li><?php echo e($order->payment_method_display); ?></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h5 class="text-dark">Order Summary</h5>
            <ul class="list-unstyled">
              <li class="d-flex justify-content-between"><span>Item Total:</span>
                <span><?php echo e(displayPrice($order->order_total)); ?></span>
              </li>
              <li class="d-flex justify-content-between"><span>Tax Amount:</span>
                <span><?php echo e(displayPrice($order->total_tax)); ?></span>
              </li>
              <?php if(!empty($otherCharges) && count($otherCharges) > 0): ?>
                <?php $__currentLoopData = $otherCharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($value > 0): ?>
                    <li class="d-flex justify-content-between"><span><?php echo e(ucwords(str_replace('_', ' ', $key))); ?>:</span>
                      <span><?php echo e(displayPrice($value ?? 0)); ?></span>
                    </li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>

              <?php if($order->coupon_id != null): ?>
                <li class="d-flex justify-content-between"><span>Coupon Discount:</span>
                  <span>-<?php echo e(displayPrice($order->coupon_discount)); ?></span>
                </li>
              <?php endif; ?>
              <li class="d-flex justify-content-between"><strong>Grand Total:</strong>
                <span><strong><?php echo e(displayPrice($order->net_total)); ?></strong></span>
              </li>
            </ul>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-uppercase">
              <tr>
                <th scope="col" class="px-4 py-2">Image</th>
                <th scope="col" class="px-4 py-2">Item</th>
                <th scope="col" class="px-4 py-2">Product Code</th>
                <th scope="col" class="px-4 py-2 text-center">Price</th>
                <th scope="col" class="px-4 py-2 text-center">Qty</th>
                <th scope="col" class="px-4 py-2 text-center">Tax</th>
                <th scope="col" class="px-4 py-2 text-center">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php if($order->orderProducts->count() > 0): ?>
                <?php $__currentLoopData = $order->orderProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productVariant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $defaultImage = $productVariant->variant->images[0]->gallery->file_name ?? null;
                    $totalPrice = $productVariant->sell_price * $productVariant->quantity + $productVariant->tax_amount;
                  ?>
                  <tr>
                    <td class="px-4 py-2">
                      <img width="80" alt=""
                        src="<?php echo e($defaultImage ? asset('public/uploads/media/products/images/' . $defaultImage) : asset('public/backend/assetss/images/products/product_thumb.jpg')); ?>"
                        class="img-fluid" />
                    </td>
                    <td class="p-2"><?php echo e($productVariant->variant->name ?? ''); ?></td>
                    <td class="p-2"><?php echo e($productVariant->variant->sku ?? ''); ?></td>
                    <td class="p-2 text-center"><?php echo e(displayPrice($productVariant->sell_price)); ?></td>
                    <td class="p-2 text-center"><?php echo e($productVariant->quantity); ?></td>
                    <td class="p-2 text-center"><?php echo e(displayPrice($productVariant->tax_amount)); ?></td>
                    <td class="p-2 text-center"><?php echo e(displayPrice($totalPrice)); ?></td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
  <script>
    function downloadInvoice(orderId) {
      let url = `<?php echo e(route('admin.order.invoice.download', ':id')); ?>`.replace(':id', orderId);
      location.href = url;
    }

    function printInvoice(orderId) {
      let url = `<?php echo e(route('admin.order.invoice.print', ':id')); ?>`.replace(':id', orderId);
      const printWindow = window.open(url, '_blank');
      printWindow.focus();
      printWindow.onload = function() {
        printWindow.print();
      };
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/backend/pages/order-manage/orders/form.blade.php ENDPATH**/ ?>