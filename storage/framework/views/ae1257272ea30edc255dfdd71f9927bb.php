<?php $__env->startPush('styles'); ?>
  <style>
    .disabled-link {
      pointer-events: none;
      opacity: 0.6;
      cursor: not-allowed;
    }

    /* Theme-Based Order Details Page Styles */
    .profile_order_return_box {
      background: #ffffff;
      border-radius: 10px;
      border: 1px solid #e9ecef !important;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
      overflow: hidden;
    }
    .order_status_wrap {
      background: #fafafa;
      padding: 18px 24px;
    }
    .status_wrap .icon.active {
      background-color: #f0b334 !important;
      color: #ffffff !important;
    }
    .track_card.active .icon {
      background-color: #f0b334 !important;
    }
    .track_card.active h4 {
      color: #f0b334 !important;
      font-weight: 600;
    }
    .order-action-btn,
    .download .custom-submit-btn {
      background-color: #f0b334 !important;
      color: #ffffff !important;
      border-radius: 0 !important;
      padding: 10px 50px 10px 20px !important;
      font-size: 15px !important;
      position: relative;
      border: 1px solid transparent !important;
      transition: all 0.5s !important;
      z-index: 1;
      overflow: hidden;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      text-decoration: none !important;
      font-weight: 500;
      cursor: pointer;
    }
    .order-action-btn::after,
    .download .custom-submit-btn::after {
      content: 'download';
      font-family: 'Material Symbols Outlined';
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      font-weight: 400;
      font-size: 18px;
    }
    .order-action-btn::before,
    .download .custom-submit-btn::before {
      content: "";
      background-color: #ffffff;
      position: absolute;
      z-index: -1;
      left: -20%;
      right: -20%;
      top: 0;
      bottom: 0;
      transform: skewX(-45deg) scale(0, 1);
      transition: all 0.5s;
    }
    .order-action-btn:hover::before,
    .download .custom-submit-btn:hover::before {
      transform: skewX(-45deg) scale(1, 1);
    }
    .order-action-btn:hover,
    .download .custom-submit-btn:hover {
      color: #f0b334 !important;
      border-color: #f0b334 !important;
    }
  </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title', @$title); ?>
<?php
  // pd($orders);
?>
<?php $__env->startSection('content'); ?>

  <section class="breadcrumb-wrapper py-4 border-top">
    <div class="container-xxl">
      <ul class="breadcrumbs">
        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li>Account</li>
      </ul>
    </div>
  </section>
  <section class="furniture_myaccount_wrap pt-4">
    <div class="container flow-rootX3">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="fw-normal mt-0 font45 c--blackc">Account</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="my_account_wrap">
            <?php echo $__env->make('frontend.pages.user.includes.profile-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <div class="right_content">
              <div class="profile_details overflow-hidden border flow-rootX3 h-100">
                <div class="heading border-bottom pb-4">
                  <h2 class="font25 fw-medium m-0 c--blackc">Order Details</h2>
                </div>
                <?php
                  use App\Enums\OrderStatus;

                  $labels = OrderStatus::labels();

                  $statusIcons = [
                      OrderStatus::CONFIRMED => 'check_circle', // 1
                      OrderStatus::CANCELLATION_INITIATED => 'sync_problem', // 2
                      OrderStatus::CANCELLED => 'cancel', // 3
                      OrderStatus::SHIPPED => 'local_shipping', // 4
                      OrderStatus::DELIVERED => 'home', // 5
                      OrderStatus::RETURN_ACCEPTED => 'assignment_return', // 6
                      OrderStatus::REFUND_DONE => 'paid', // 7
                  ];

                  $expectedFlow = [OrderStatus::CONFIRMED, OrderStatus::SHIPPED, OrderStatus::DELIVERED];

                  $history = $order->orderHistories->sortBy('created_at');
                  $finalStatuses = [];
                  $existingStatusIds = [];
                  $cutOff = false;

                  foreach ($history as $entry) {
                      $statusId = $entry->status;

                      if ($cutOff) {
                          break;
                      }

                      $finalStatuses[] = [
                          'id' => $statusId,
                          'label' => $labels[$statusId] ?? 'Unknown',
                          'icon' => $statusIcons[$statusId] ?? 'info',
                          'datetime' => \Carbon\Carbon::parse(
                              $entry->scheduled_date . ' ' . $entry->scheduled_time,
                          )->format('M j, Y \a\t g:iA'),
                          'active' => true,
                      ];

                      $existingStatusIds[] = $statusId;

                      if ($statusId == OrderStatus::CANCELLED) {
                          $cutOff = true;
                      }
                  }

                  // If not cancelled, show future steps (from expectedFlow) as inactive
                  if (!$cutOff) {
                      foreach ($expectedFlow as $statusId) {
                          if (!in_array($statusId, $existingStatusIds)) {
                              $finalStatuses[] = [
                                  'id' => $statusId,
                                  'label' => $labels[$statusId] ?? 'Unknown',
                                  'icon' => $statusIcons[$statusId] ?? 'info',
                                  'datetime' => null,
                                  'active' => false,
                              ];
                          }
                      }
                  }

                  // For optional View All logic
                  $totalLogCount = count($finalStatuses);
                  $initialLimit = 3;

                  $latestStatusLog = $order->orderHistories->sortByDesc('created_at')->first();
                  $currentStatus = $latestStatusLog->status ?? null;
                  //pd($statuses[$currentStatus]);
                  //pd($statusIcons[$currentStatus]);

                  // Get latest 3 history entries based on created_at
                  // Latest 3 status IDs
                  // Filter statuses to only those present in orderHistories
                  // $statuses = array_intersect_key($statuses, $historyMap->toArray());

                  // // Latest 3 statuses by created_at
                  // $latestStatusIds = $order->orderHistories->sortBy('created_at')->take(3)->pluck('status')->toArray();
                ?>

                <div class="info flow-rootX2">
                  <div class="profile_order_return_box border">
                    <div class="order_status_wrap pb-4 border-bottom">
                      <div class="status_wrap">
                        <div class="icon active"><span
                            class="material-symbols-outlined font22"><?php echo e($statusIcons[$currentStatus] ?? 'help_outline'); ?></span>
                        </div>
                        <div class="txts flow-rootx2">
                          <div class="txt">
                            <h4 class="font20 mb-0 fw-normal c--blackc">
                              <?php echo e($labels[$currentStatus] ?? 'Unknown Status'); ?></h4>
                            <div class="date font14 c--gry">on
                              <?php echo e(\Carbon\Carbon::parse($latestStatusLog->created_at)->format('D, j M')); ?></div>
                            <div class="date font14 c--gry">
                              <?php echo e('#' . $order['order_number']); ?></div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        $defaultImage = $item->variant->images[0]->gallery->file_name ?? null;
                      ?>
                      <div class="product_details edit my-4">
                        <a href="<?php echo e(route('product.show', $item->variant->sku)); ?>" title="<?php echo e($item->variant->name); ?>"></a>
                        <figure class="ratio ratio-1000x1000 mb-0"><img
                            src="<?php echo e($defaultImage ? asset('public/uploads/media/products/images/' . $defaultImage) : asset('public/backend/assetss/images/products/product_thumb.jpg')); ?>"
                            alt="Mayuri" title="Mayuri" /></figure>

                        <div class="details flow-rootX">
                          <div class="top flow-rootX">
                            <h3 class="font35 fw-normal c--blackc"><?php echo e($item->variant->name); ?></h3>
                            <p class="font20 fw-normal c--blackc mb-0">Unit Selected :<?php echo e($item->quantity ?? 0); ?></p>
                          </div>
                          <?php
                            $regularPrice = $item->regular_price;
                            $sellPrice = $item->sell_price;
                            $showDiscount = $regularPrice > $sellPrice && $regularPrice > 0;
                            $discountPercent = $showDiscount
                                ? round((($regularPrice - $sellPrice) / $regularPrice) * 100)
                                : 0;
                          ?>
                          <div class="bottom">
                            <h2 class="font35 fw-normal c--blackc"><?php echo e(displayPrice($sellPrice)); ?></h2>
                            
                          </div>
                        </div>
                      </div>

                      
                      <?php echo $__env->make('frontend.includes.review-items', [
                          'variantId' => $item->variant->id,
                          'variantName' => $item->variant->name,
                          'review' => $item->review,
                          'orderStatus' => $item->order->order_status,
                          'image' => $defaultImage
                              ? asset('public/uploads/media/products/images/' . $defaultImage)
                              : asset('public/backend/assetss/images/products/product_thumb.jpg'),
                      ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="delivery_address pt-4 flow-rootX border-top mt-3">
                      <?php
                        $shippingAddress = json_decode($order->shipping_address, true);
                      ?>

                      <h4 class="font16 fw-normal text-capital c--gry">Delivery Address</h4>
                      <address>
                        <?php if(isset($shippingAddress['name'])): ?>
                          <p class="mb-0 fw-semibold"><?php echo e($shippingAddress['name']); ?></p>
                        <?php endif; ?>

                        <?php if(isset($shippingAddress['address'])): ?>
                          <p class="mb-0"><?php echo e($shippingAddress['address']); ?></p>
                        <?php endif; ?>

                        <?php if(isset($shippingAddress['state'])): ?>
                          <p class="mb-0"><?php echo e($shippingAddress['state']); ?></p>
                        <?php endif; ?>

                        <?php if(isset($shippingAddress['phone'])): ?>
                          <p class="mb-0">Phone: <?php echo e($shippingAddress['phone']); ?></p>
                        <?php endif; ?>
                      </address>

                      </address>

                    </div>
                    <div class="profile_trak_wrap border-top mt-4 pt-4 flow-rootX">
                      <div class="track_card_wrap">
                        <?php $__currentLoopData = $finalStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div
                            class="track_card <?php echo e($status['active'] ? 'active' : ''); ?> <?php echo e($index >= $initialLimit ? 'd-none track-toggle' : ''); ?>">
                            <div class="blk">
                              <div class="icon">
                                <span class="material-symbols-outlined c--whitec"><?php echo e($status['icon']); ?></span>
                              </div>
                              <div class="txt">
                                <h4 class="fw-normal font16"><?php echo e($status['label']); ?></h4>
                                <?php if($status['datetime']): ?>
                                  <p class="font14 c--gry"><?php echo e($status['datetime']); ?></p>
                                <?php endif; ?>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>

                      
                      <?php if($totalLogCount > $initialLimit): ?>
                        <div class="viewupdates mt-3">
                          <a href="javascript:void(0)" class="font16 d-inline-flex gap-2 align-items-center"
                            id="toggleTrackLog" title="View All Updates">
                            View All Updates
                            <span class="material-symbols-outlined">expand_more</span>
                          </a>
                        </div>
                      <?php endif; ?>
                    </div>



                    <div class="total_item_wrap border-top mt-4 pt-4 d-flex align-items-center justify-content-between">
                      <h4 class="font20 fw-medium c--blackc mb-0">Total Item Price</h4>
                      <h3 class="font28 fw-normal c--blackc mb-0"><?php echo e(displayPrice($order['net_total'])); ?>

                      </h3>
                    </div>
                    <div class="download_invoicewrap pt-4 d-flex align-items-center justify-content-between">
                      <div class="payment_method font16 c--success">
                        <?php echo e($order['payment_method_display']); ?>:
                        <?php echo e(displayPrice($order['net_total'])); ?></div>

                      <div class="download">
                        <a href="<?php echo e(route('order-invoice.download', Hashids::encode($order['id']))); ?>"
                          class="btn custom-submit-btn learnmore_btn order-action-btn"
                          title="Download Invoice">
                          Download Invoice</a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php echo $__env->make('frontend.includes.review-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

  <script>
    document.getElementById('toggleTrackLog')?.addEventListener('click', function() {
      document.querySelectorAll('.track-toggle').forEach(el => el.classList.toggle('d-none'));
      const btn = this.querySelector('.material-symbols-outlined');
      btn.textContent = btn.textContent === 'expand_more' ? 'expand_less' : 'expand_more';
      this.innerHTML = btn.textContent === 'expand_less' ?
        'Hide Updates <span class="material-symbols-outlined">expand_less</span>' :
        'View All Updates <span class="material-symbols-outlined">expand_more</span>';
    });
  </script>







  <script>
    window.addEventListener('load', () => {
      const stars = document.querySelectorAll('.star');

      stars.forEach((star, index) => {
        star.addEventListener('click', () => {
          stars.forEach((s, i) => {
            if (i <= index) {
              s.setAttribute('name', 'star'); // filled icon
              s.classList.add('active'); // add filled style
            } else {
              s.setAttribute('name', 'star-outline'); // outline icon
              s.classList.remove('active'); // remove filled style
            }
          });
        });
      });
    });



    let imgArray = []; // Global array to hold all selected images

    function ImgUpload() {
      $('.upload__inputfile').each(function() {
        $(this).on('change', function(e) {
          let imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
          let maxLength = parseInt($(this).attr('data-max_length')) || 10;

          let files = e.target.files;
          let filesArr = Array.prototype.slice.call(files);

          filesArr.forEach(function(file) {
            if (!file.type.match('image.*')) return;

            if (imgArray.length >= maxLength) {
              iziNotify("Error!", "You can only upload up to " + maxLength + " images.", "error");
              return;
            }

            // Prevent duplicates by file name
            if (imgArray.some(f => f.name === file.name)) {
              iziNotify("Info", "Duplicate file skipped: " + file.name, "info");
              return;
            }

            imgArray.push(file);

            let reader = new FileReader();
            reader.onload = function(e) {
              let html = `
        <div class='upload__img-box'>
          <div class='img-bg' style='background-image: url(${e.target.result})' data-file='${file.name}'>
            <div class='upload__img-close'></div>
          </div>
        </div>`;
              imgWrap.append(html);
            };
            reader.readAsDataURL(file);
          });

          // Clear input so re-selection works
          $(this).val('');
        });
      });

      // Remove image on close click
      $('body').on('click', ".upload__img-close", function() {
        let fileName = $(this).parent().data("file");

        imgArray = imgArray.filter(file => file.name !== fileName);

        $(this).closest('.upload__img-box').remove();
      });
    }

    jQuery(document).ready(function() {
      ImgUpload();
    });



    $(document).ready(function() {
      let selectedRating = 0;
      const rememberCheckbox = $('#submitting');
      // Open modal and populate data
      $('.open-review-modal').on('click', function() {
        let that = this; // ✅ Fix: define 'that' at the top

        let variantId = $(that).data('variant-id');
        let name = $(that).data('variant-name');
        let image = $(that).data('image');
        let reviewId = $(that).data('review-id') || '';
        // let reviewId = $(that).data('review-id') || '';

        // Reset form
        $('#reviewForm')[0].reset();
        $('#modal_variant_id').val(variantId);
        $('#modal_variant_name').text(name);
        $('#modal_variant_image').attr('src', image);
        $('#WriteReviewModal .star').attr('name', 'star-outline').removeClass('active');
        selectedRating = 0;
        $('#review_id').remove();
        $('#WriteReviewModal .modal-title').text(reviewId !== '' ? 'Edit Review' : 'Write Review');


        if (reviewId !== '') {
          $.ajax({
            url: "<?php echo e(route('user.get-review')); ?>",
            type: "GET",
            data: {
              review_id: reviewId
            },
            success: function(response) {
              if (response.success) {
                $('#productreview').val(response.data.productreview || '');
                selectedRating = response.data.rating;

                // ⭐ Update modal stars
                $('#WriteReviewModal .star').each(function(index) {
                  $(this)
                    .toggleClass('active', index < selectedRating)
                    .attr('name', index < selectedRating ? 'star' : 'star-outline');
                });

                // ⭐ Update anchor stars (clicked one)
                $(that).find('.star').each(function(index) {
                  $(this)
                    .toggleClass('active', index < selectedRating)
                    .attr('name', index < selectedRating ? 'star' : 'star-outline');
                });

                // ✅ Inject existing images dynamically
                const container = $('.upload__img-wrap');
                container.empty(); // Clear old previews
                (response.data.images || []).forEach((url, index) => {
                  const filename = url.split('/').pop();
                  const imgBox = `
                    <div class="upload__img-box">
                      <div class="img-bg" style="background-image: url(${url})"
                          data-number="${index}" data-file="${filename}">
                        <div class="upload__img-close"></div>
                      </div>
                    </div>`;
                  container.append(imgBox);
                });

                $('#reviewForm').append(
                  '<input type="hidden" id="review_id" name="review_id" value="' +
                  reviewId +
                  '">'
                );
              }
            },
            error: function() {
              iziNotify('Error!', 'Failed to fetch review data.', 'error');
            },
          });
        }

        $('#WriteReviewModal').modal('show');
      });

      // $(document).on('click', '.star', function() {
      //   selectedRating = $(this).index() + 1;

      //   $('.star').each(function(index) {
      //     $(this)
      //       .toggleClass('active', index < selectedRating)
      //       .attr('name', index < selectedRating ? 'star' : 'star-outline');
      //   });
      // });

      $('.star').on('click', function() {
        selectedRating = $(this).index() + 1;
        $('.star').each(function(index) {
          $(this).attr('name', index < selectedRating ? 'star' : 'star-outline');
        });
      });

      $('#reviewForm').validate({
        ignore: [],
        rules: {
          // productreview: {
          //   // required: true,
          //   maxlength: 10
          // },
          'images[]': {
            extension: "jpg|jpeg|png|webp"
          },
          consent: {
            required: true
          }
        },
        messages: {
          // productreview: {
          //   // required: "Please write your review.",
          //   maxlength: "Review must be at least 10 characters."
          // },
          'images[]': {
            extension: "Only JPG, JPEG, PNG, or WEBP files are allowed."
          },
          consent: {
            required: "You must agree before submitting."
          }
        },
        errorElement: "i",
        errorPlacement: function(error, element) {
          let errorContainer = $(`#${element.attr('id')}-error-container`);
          if (errorContainer.length) {
            error.appendTo(errorContainer);
          } else {
            error.insertAfter(element);
          }
        },
        submitHandler: function(form, event) {
          event.preventDefault(); // ⛔ prevent default redirect

          if (selectedRating === 0) {
            iziNotify("Error!", "Please select a rating.", "error");
            return false;
          }

          let formData = new FormData(form);
          formData.append('rating', selectedRating);

          // Append all selected images
          imgArray.forEach((file, index) => {
            formData.append('images[]', file);
          });

          $.ajax({
            url: '<?php echo e(route('user.submit-review')); ?>', // ✅ your backend route
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              if (response.success) {
                $('#WriteReviewModal').modal('hide');
                iziNotify("", response.message, "success");
                window.location.reload();
              } else {
                iziNotify("Oops!", response.message, "error");
              }
            },
            error: function(xhr) {
              if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                // Laravel validation error format
                let firstError = Object.values(xhr.responseJSON.errors)[0][0]; // Get first error message
                iziNotify("Validation Error!", firstError, "error");
              } else if (xhr.responseJSON && xhr.responseJSON.message) {
                // Custom error message from service
                iziNotify("Error!", xhr.responseJSON.message, "error");
              } else {
                iziNotify("Error!", "Something went wrong. Please try again.", "error");
              }
            }
          });
        }
      });
    });
  </script>
  <script src="https://unpkg.com/ionicons@4.2.4/dist/ionicons.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/pages/user/orders/order-details.blade.php ENDPATH**/ ?>