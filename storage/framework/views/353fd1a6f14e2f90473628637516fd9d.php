<?php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
?>

<div>
  <!--[if BLOCK]><![endif]--><?php if($paginator->total() > 0): ?>
    <div class="pagination mt-3 mb-1 d-flex justify-content-between align-items-center">
      <div class="showing">
        <p class="small text-muted">
          <?php echo __('Showing'); ?>

          <span class="fw-semibold"><?php echo e($paginator->firstItem()); ?></span>
          <?php echo __('to'); ?>

          <span class="fw-semibold"><?php echo e($paginator->lastItem()); ?></span>
          <?php echo __('of'); ?>

          <span class="fw-semibold"><?php echo e($paginator->total()); ?></span>
          <?php echo __('results'); ?>

        </p>
      </div>

      <nav aria-label="...">
        <ul class="pagination pagination-sm mb-0">
          
          <li class="page-item <?php echo e($paginator->onFirstPage() ? 'disabled' : ''); ?>">
            <button type="button" class="page-link" wire:click="previousPage('<?php echo e($paginator->getPageName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>" <?php echo e($paginator->onFirstPage() ? 'disabled' : ''); ?>>
              <?php echo app('translator')->get('pagination.previous'); ?>
            </button>
          </li>

          
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              
              <!--[if BLOCK]><![endif]--><?php if(is_string($element)): ?>
                  <li class="page-item disabled"><span class="page-link"><?php echo e($element); ?></span></li>
              <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

              
              <!--[if BLOCK]><![endif]--><?php if(is_array($element)): ?>
                  <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="page-item <?php echo e($page == $paginator->currentPage() ? 'active' : ''); ?>">
                        <button type="button" class="page-link" wire:click="gotoPage(<?php echo e($page); ?>, '<?php echo e($paginator->getPageName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>">
                          <?php echo e($page); ?>

                        </button>
                      </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
              <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

          
          <li class="page-item <?php echo e($paginator->hasMorePages() ? '' : 'disabled'); ?>">
            <button type="button" class="page-link" wire:click="nextPage('<?php echo e($paginator->getPageName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>" <?php echo e($paginator->hasMorePages() ? '' : 'disabled'); ?>>
              <?php echo app('translator')->get('pagination.next'); ?>
            </button>
          </li>
        </ul>
      </nav>
    </div>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/vendor/livewire/bootstrap.blade.php ENDPATH**/ ?>