<?php
  $rating = $review->rating ?? 0;
  $isEdit = isset($review->id);
?>


<?php if($orderStatus == 5): ?>
  <div class="rate_write pt-4">
    <input type="hidden" id="order_id" value="<?php echo e($variantId); ?>">
    <a href="javascript:void(0);" class="open-review-modal" data-bs-toggle="modal" data-bs-target="#WriteReviewModal"
      data-variant-id="<?php echo e($variantId); ?>" data-variant-name="<?php echo e($variantName); ?>"
      data-review-id="<?php echo e($review->id ?? ''); ?>" data-review-productreview="<?php echo e($review->productreview ?? ''); ?>"
      data-image="<?php echo e($image); ?>" title="Rate & Write Review">

      <div class="starwrp d-flex justify-content-start align-items-center gap-3">
        <div class="stars disbled">
          <?php for($i = 1; $i <= 5; $i++): ?>
            <ion-icon class="star<?php echo e($i <= $rating ? ' active' : ''); ?>" id="star<?php echo e($i); ?>"
              name="<?php echo e($i <= $rating ? 'star' : 'star-outline'); ?>"></ion-icon>
          <?php endfor; ?>
        </div>

        <?php if($orderStatus == 5): ?>
          <p class="font16 c--primary mb-0">
            <?php echo e($isEdit ? 'Edit Review' : 'Rate & Write Review'); ?>

            
          </p>
        <?php endif; ?>
      </div>
    </a>
  </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/includes/review-items.blade.php ENDPATH**/ ?>