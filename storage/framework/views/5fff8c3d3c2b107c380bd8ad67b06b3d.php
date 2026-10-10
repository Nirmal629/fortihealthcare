
<?php if (isset($component)) { $__componentOriginala31fc4d2266293530c9d5eb8740625d1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala31fc4d2266293530c9d5eb8740625d1 = $attributes; } ?>
<?php $component = App\View\Components\ListCard::resolve(['cardHeader' => 'Top Customer Revenue','baseRoute' => 'admin.departments','addBtnShow' => false] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
[$__name, $__params] = $__split('reports.top-customer-by-revenue-table', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2747473265-0', $__slots ?? [], get_defined_vars());

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
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/backend/includes/top-customer-revenue.blade.php ENDPATH**/ ?>