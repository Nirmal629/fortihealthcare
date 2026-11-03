<?php $__env->startSection('page-styles'); ?>
  <style>
    .disabled-link {
      pointer-events: none;
      opacity: 0.5;
      cursor: not-allowed;
    }
  </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve(['pageTitle' => $pageTitle,'skipLevels' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
  <?php if (isset($component)) { $__componentOriginala31fc4d2266293530c9d5eb8740625d1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala31fc4d2266293530c9d5eb8740625d1 = $attributes; } ?>
<?php $component = App\View\Components\ListCard::resolve(['cardHeader' => $cardHeader,'baseRoute' => 'admin.shipment-management'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('list-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ListCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('order-manage.shipping-table', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2879367230-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala31fc4d2266293530c9d5eb8740625d1)): ?>
<?php $attributes = $__attributesOriginala31fc4d2266293530c9d5eb8740625d1; ?>
<?php unset($__attributesOriginala31fc4d2266293530c9d5eb8740625d1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala31fc4d2266293530c9d5eb8740625d1)): ?>
<?php $component = $__componentOriginala31fc4d2266293530c9d5eb8740625d1; ?>
<?php unset($__componentOriginala31fc4d2266293530c9d5eb8740625d1); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('component-scripts'); ?>
  <script>
    $(document).ready(function() {
      $('#addBtn').attr('style', 'display: none !important');
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/backend/pages/order-manage/shipping/index.blade.php ENDPATH**/ ?>