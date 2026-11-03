<?php $__env->startSection('page-styles'); ?>
<link href="<?php echo e(asset('/public/backend/assetss/select2/select2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve(['pageTitle' => $pageTitle,'skipLevels' => [0]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php if (isset($component)) { $__componentOriginal010d7f86e3f33f397845e24b9949ed37 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal010d7f86e3f33f397845e24b9949ed37 = $attributes; } ?>
<?php $component = App\View\Components\FormCard::resolve(['formTitle' => $cardHeader,'backRoute' => '','formId' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FormCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
   <div class="row">
      <div class="col-md-4">
         <div class="mb-3 required">
            <label class="form-label">Seeder Name</label>
            <select name="category" aria-label="Default select" class="form-select select2 category" id="category">
               <option value="" selected>Select one</option>
               <option value="1">Furniture</option>
               <option value="2">Sunglasses</option>
               
               <option value="4">Grocery</option>

            </select>
            <div id="modulename-error-container" style="display: none;"></div>
         </div>
         <div class="mb-3 seed">
            <a href="javascript:void(0);" class="btn btn-primary seeding-table">Seed</a>
         </div>
      </div>
      <div class="col-md-8">
         <div class="mb-3 seed-data" style="display: none;">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>Serial No</th>
                     <th>Seeder Name</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody id="seeder-status-table">
                  <!-- dynamic rows here -->
               </tbody>
            </table>
            <a href="<?php echo e(route('home')); ?>" target="_blank" class="btn btn-success vist-frontend" style="display: none;">Visit Frontend</a>
         </div>
      </div>
   </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal010d7f86e3f33f397845e24b9949ed37)): ?>
<?php $attributes = $__attributesOriginal010d7f86e3f33f397845e24b9949ed37; ?>
<?php unset($__attributesOriginal010d7f86e3f33f397845e24b9949ed37); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal010d7f86e3f33f397845e24b9949ed37)): ?>
<?php $component = $__componentOriginal010d7f86e3f33f397845e24b9949ed37; ?>
<?php unset($__componentOriginal010d7f86e3f33f397845e24b9949ed37); ?>
<?php endif; ?>
<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('/public/backend/assetss/select2/select2.min.js')); ?>"></script>
<script>
  $('#category').select2({
      'placeholder': 'Select a Category',
    });
   $(document).ready(function() {
       let category = null; // selected category
       let seeders = [];

       $('.category').on('change', function() {
           category = $(this).val();
           if (!category) {

             $('#modulename-error-container').show().html('<span class="text-danger">Please select a category first.</span>');
             return;
         }
         else{
           $('#modulename-error-container').hide();
         }
           $('.seed-data').hide();
           $('#seeder-status-table').empty();
           $('.vist-frontend').hide();

           if (category == 1) {
               seeders = [
                   { id: 1, title: 'Product Category Seeder', seederName: 'ProductCategorySeeder'},
                   { id: 2, title: 'Product Attribute, Attribute Value Seeder',seederName: 'ProductAttributeValueSeeder'},
                   { id: 3, title: 'Product Seeder, Product Variant Attribute Seeder, Inventory Seeder',seederName: 'ProductSeeder'},
                   { id: 4, title: 'Product Variant Image Seeder',seederName: 'ProductVariantImageSeeder'},
                   { id: 5, title: 'Custom Banner Seeder',seederName: 'CustomBannerSeeder'},
                   { id: 6, title: 'CMS Page Seeder',seederName: 'CmsPageSeeder'}
               ];
               $('.seed').show();
           }
            else if (category == 2) {
               seeders = [
                   { id: 1, title: 'Product Category Seeder', seederName: 'ProductCategorySeeder'},
                   { id: 2, title: 'Product Attribute, Attribute Value Seeder',seederName: 'ProductAttributeValueSeeder'},
                   { id: 3, title: 'Product Seeder, Product Variant Attribute Seeder, Inventory Seeder',seederName: 'ProductSeeder'},
                   { id: 4, title: 'Product Variant Image Seeder',seederName: 'ProductVariantImageSeeder'},
                   { id: 5, title: 'Custom Banner Seeder',seederName: 'CustomBannerSeeder'},
                   { id: 6, title: 'CMS Page Seeder',seederName: 'CmsPageSeeder'}
               ];
               $('.seed').show();
           }
           else if (category == 3) {
               seeders = [
                   { id: 1, title: 'Product Category Seeder', seederName: 'ProductCategorySeeder'},
                   { id: 2, title: 'Product Attribute, Attribute Value Seeder',seederName: 'ProductAttributeValueSeeder'},
                   { id: 3, title: 'Product Seeder, Product Variant Attribute Seeder, Inventory Seeder',seederName: 'ProductSeeder'},
                   { id: 4, title: 'Product Variant Image Seeder',seederName: 'ProductVariantImageSeeder'},
                   { id: 5, title: 'Custom Banner Seeder',seederName: 'CustomBannerSeeder'},
                   { id: 6, title: 'CMS Page Seeder',seederName: 'CmsPageSeeder'}
               ];
               $('.seed').show();
           }
           else if (category == 4) {
               seeders = [
                   { id: 1, title: 'Product Category Seeder', seederName: 'ProductCategorySeeder'},
                   { id: 2, title: 'Product Attribute, Attribute Value Seeder',seederName: 'ProductAttributeValueSeeder'},
                   { id: 3, title: 'Product Seeder, Product Variant Attribute Seeder, Inventory Seeder',seederName: 'ProductSeeder'},
                   { id: 4, title: 'Product Variant Image Seeder',seederName: 'ProductVariantImageSeeder'},
                   { id: 5, title: 'Custom Banner Seeder',seederName: 'CustomBannerSeeder'},
                   { id: 6, title: 'CMS Page Seeder',seederName: 'CmsPageSeeder'}
               ];
               $('.seed').show();
           }
           else {
               $('.seed').hide();
           }
       });

       $('.seeding-table').off('click').on('click', function(e) {
           e.preventDefault();

           if (!category) {
               // alert('Please select a category first.');
               $('#modulename-error-container').show().html('<span class="text-danger">Please select a Seeder first.</span>');
               return;
           }

           swalConfirm("Are you sure?", "You won't be able to revert this!").then((result) => {
               if (result.isConfirmed) {
                   $('#seeder-status-table').empty(); // clear table before starting

                   seeders.forEach((seeder) => {
                       $('#seeder-status-table').append(`
                           <tr id="seeder-row-${seeder.id}">
                               <td>${seeder.id}</td>
                               <td>${seeder.title}</td>
                               <td><span class="badge bg-warning" id="status-${seeder.id}">Pending</span></td>
                           </tr>
                       `);
                   });

                   runSeeding(0); // start seeding from first
                   $('.seed-data').show(); // show seed data
               }
           });
       });

       function runSeeding(index) {
           if (index >= seeders.length) {
               let allSeedingDone = true;
               $('#seeder-status-table tr').each(function() {
                   if ($(this).find('td').eq(2).text().trim() != 'Done') {
                       allSeedingDone = false;
                       return false;
                   }
               });
               if (allSeedingDone) {
                   $('.vist-frontend').show();
               }
               return; // All done
           }
           let seeder = seeders[index];
           // Update status to Seeding
           $(`#status-${seeder.id}`).removeClass('bg-warning bg-success').addClass('bg-primary').text('Seeding...');
           // Ajax call to backend for each seeder
           setTimeout(() => {
             $.ajax({
                 url: `<?php echo e(route('admin.truncate-and-seed')); ?>`,
                 method: 'POST',
                 data: {
                     category: category,
                     title: seeder.title,
                     seeder_name: seeder.seederName,
                     _token: '<?php echo e(csrf_token()); ?>'
                 },
                 success: function(response) {
                     $(`#status-${seeder.id}`).removeClass('bg-primary').addClass('bg-success').text('Done');
                     runSeeding(index + 1); // seed next
                 },
                 error: function(error) {
                     $(`#status-${seeder.id}`).removeClass('bg-primary').addClass('bg-danger').text('Failed');
                     console.log(error.responseJSON.message);
                     swalNotify("Error!", error.responseJSON.message, "error");
                 }
             });
           }, 1000);
       }
   });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/backend/pages/system/new-store-setup/form.blade.php ENDPATH**/ ?>