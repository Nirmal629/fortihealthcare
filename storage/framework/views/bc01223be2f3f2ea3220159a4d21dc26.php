<?php $__empty_1 = true; $__currentLoopData = $moreReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  <div class="review-items mt-3">
    <img
      src="<?php echo e(userImageById('', $value->user_id) ? userImageById('', $value->user_id)['image'] : asset('public/frontend/assets/img/home/top_user_thumb.jpg')); ?>"
      class="review-user" alt="" title="" />

    <div class="review-content-info flow-rootX">
      <div class="review-star mb-0">
        <?php
          $rating = round($value->rating);
          $maxStars = 5;
        ?>

        <?php for($i = 1; $i <= $maxStars; $i++): ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-star-fill" viewBox="0 0 16 16"
            fill="<?php echo e($i <= $rating ? '#F69029' : '#E0E0E0'); ?>">
            <path
              d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
            </path>
          </svg>
        <?php endfor; ?>
      </div>

      <?php echo $value->productreview ?? ''; ?>


      
      <?php if(!empty($value->reviewImages)): ?>
        <div class="review-gallery mt-2 d-flex flex-wrap gap-2">
          <?php $__currentLoopData = $value->reviewImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              //pd($value->reviewImages);
              $imageUrl = is_array($img) ? $img['image'] : asset('public/reviews/' . $img->image);
            ?>
            <a href="<?php echo e($imageUrl); ?>" data-lightbox="review-<?php echo e($value->id); ?>" data-title="Review Image">
              <img src="<?php echo e($imageUrl); ?>" alt="Review Image" class="img-thumbnail"
                style="width: 80px; height: 80px; object-fit: cover;" />
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>


      <div class="review-user-details font14 mt-2">
        <p class="fw-medium c--blackc m-0">
          <?php echo e($value->user ? trim("{$value->user->first_name} {$value->user->middle_name} {$value->user->last_name}") : 'N/A'); ?>

        </p>
        <p class="c--gry m-0"><?php echo e(convertDate($value->created_at)); ?></p>
      </div>
    </div>
  </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <h5 class="text-center">No Review Found !!</h5>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/pages/user/includes/review-items.blade.php ENDPATH**/ ?>