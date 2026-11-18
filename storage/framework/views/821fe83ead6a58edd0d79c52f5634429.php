<div class="permissionsblkwp verticalscroll">
  <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="permissionsblk roles">
      
      <h5 class="mb-3 text-dark font-17 fw-medium">
        <div class="form-check">
          <input type="checkbox" class="form-check-input check-all-module" id="module_<?php echo e($module['id']); ?>"
            data-module-id="<?php echo e($module['id']); ?>">
          <label class="form-check-label" for="module_<?php echo e($module['id']); ?>"><?php echo e($module['name']); ?></label>
        </div>
      </h5>
      <?php $__currentLoopData = $module['submodules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submodule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <div class="individualrow d-flex justify-content-between align-items-center p-2">
          <div class="itemhead">
            <div class="form-check">
              <input type="checkbox" class="form-check-input check-all-submodule" id="submodule_<?php echo e($submodule['id']); ?>"
                data-submodule-id="<?php echo e($submodule['id']); ?>" data-module-id="<?php echo e($module['id']); ?>">
              <label class="form-check-label" for="submodule_<?php echo e($submodule['id']); ?>"><?php echo e($submodule['name']); ?></label>
            </div>
          </div>
          
          <div class="items d-flex justify-content-end align-items-center">
            <?php $__currentLoopData = $submodule['permissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="form-check">
                <input type="checkbox"
                  class="form-check-input submodule_<?php echo e($submodule['id']); ?>_permission module_<?php echo e($module['id']); ?>_permission check-permission"
                  id="submodule_<?php echo e($submodule['id']); ?>_permission<?php echo e($permission['id']); ?>"
                  data-permission-id="<?php echo e($permission['id']); ?>" data-submodule-id="<?php echo e($submodule['id']); ?>"
                  data-module-id="<?php echo e($module['id']); ?>" name="permissions[<?php echo e($submodule['id']); ?>][]"
                  value="<?php echo e(Hashids::encode($permission['id'])); ?>" <?php if(isset($checkedPermissions[$submodule['id']]) && in_array($permission['id'], $checkedPermissions[$submodule['id']])): ?> checked <?php endif; ?>>
                <label class="form-check-label"
                  for="submodule_<?php echo e($submodule['id']); ?>_permission<?php echo e($permission['id']); ?>"><?php echo e($permission['name']); ?></label>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    function updateSubmoduleState(e){const d=$(`.submodule_${e}_permission`).length,t=$(`.submodule_${e}_permission:checked`).length,o=$(`#submodule_${e}`);t===d?o.prop("checked",!0).prop("indeterminate",!1):t>0?o.prop("checked",!1).prop("indeterminate",!0):o.prop("checked",!1).prop("indeterminate",!1)}function updateModuleState(e){const d=$(`.check-all-submodule[data-module-id="${e}"]`).length,t=$(`.check-all-submodule[data-module-id="${e}"]:checked`).length,o=$(`.check-all-submodule[data-module-id="${e}"]:indeterminate`).length,i=$(`#module_${e}`);t===d&&0===o?i.prop("checked",!0).prop("indeterminate",!1):t>0||o>0?i.prop("checked",!1).prop("indeterminate",!0):i.prop("checked",!1).prop("indeterminate",!1)}$(".check-permission").on("change",(function(){const e=$(this).data("submodule-id"),d=$(this).data("module-id"),t=$(this).data("permission-id"),o=$(`.submodule_${e}_permission[id="submodule_${e}_permission1"]`);1!==t&&this.checked&&o.prop("checked",!0),1!==t||this.checked||$(`.submodule_${e}_permission`).prop("checked",!1),updateSubmoduleState(e),updateModuleState(d)})),$(".check-all-submodule").on("change",(function(){const e=$(this).data("submodule-id"),d=$(this).data("module-id");$(`.submodule_${e}_permission`).prop("checked",this.checked),updateModuleState(d)})),$(".check-all-module").on("change",(function(){const e=$(this).data("module-id"),d=$(this).is(":checked");$(`.module_${e}_permission`).prop("checked",d),$(`.check-all-submodule[data-module-id="${e}"]`).prop("checked",d),$(`.check-all-submodule[data-module-id="${e}"]`).prop("indeterminate",!1)})),$(".check-permission").each((function(){const e=$(this).data("submodule-id"),d=$(this).data("module-id");updateSubmoduleState(e),updateModuleState(d)}));

  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/components/permission-list.blade.php ENDPATH**/ ?>