<th class="" style="cursor: pointer;" wire:click="sortByCol('<?php echo e($colName); ?>')">
  <div class="d-flex align-items-center">
    <?php echo e($displayName); ?>

    <!--[if BLOCK]><![endif]--><?php if($sortColumn != $colName): ?>
      <i class="ri-arrow-up-down-line ms-1" style="font-size: 15px; color: lightgray"></i>
    <?php elseif($sortDirection == 'ASC'): ?>
      <i class="ri-arrow-up-line ms-1" style="font-size: 15px"></i>
    <?php else: ?>
      <i class="ri-arrow-down-line ms-1" style="font-size: 15px"></i>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
  </div>
</th>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/livewire/includes/datatable-header-sort.blade.php ENDPATH**/ ?>