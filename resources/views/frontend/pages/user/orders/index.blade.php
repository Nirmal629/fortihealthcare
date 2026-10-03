@extends('frontend.layouts.app')
@push('styles')
  <style>
    .disabled-link {
      pointer-events: none;
      opacity: 0.6;
      cursor: not-allowed;
    }

    /* Theme-Based Order Page Styles */
    .profile_order_return_box {
      background: #ffffff;
      border-radius: 10px;
      border: 1px solid #e9ecef !important;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
      margin-bottom: 24px;
      overflow: hidden;
      transition: all 0.3s ease;
    }
    .profile_order_return_box:hover {
      box-shadow: 0 6px 20px rgba(240, 179, 52, 0.12);
      border-color: #f0b334 !important;
    }
    .order_status_wrap {
      background: #fafafa;
      padding: 18px 24px;
    }
    .status_wrap .icon.active {
      background-color: #f0b334 !important;
      color: #ffffff !important;
    }
    .viewdetails a {
      color: #f0b334;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      transition: all 0.3s ease;
    }
    .viewdetails a:hover {
      color: #d6981e;
      transform: translateX(3px);
    }
    .order-action-btn,
    .exchange .custom-submit-btn {
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
    .exchange .custom-submit-btn::after {
      content: 'arrow_forward';
      font-family: 'Material Symbols Outlined';
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      font-weight: 400;
      font-size: 18px;
    }
    .order-action-btn::before,
    .exchange .custom-submit-btn::before {
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
    .exchange .custom-submit-btn:hover::before {
      transform: skewX(-45deg) scale(1, 1);
    }
    .order-action-btn:hover,
    .exchange .custom-submit-btn:hover {
      color: #f0b334 !important;
      border-color: #f0b334 !important;
    }
    .modal-submit-btn {
      background-color: #f0b334 !important;
      color: #ffffff !important;
      border: 1px solid transparent !important;
      font-weight: 500;
      padding: 10px 20px !important;
      transition: all 0.3s ease;
    }
    .modal-submit-btn:hover {
      background-color: #d6981e !important;
      color: #ffffff !important;
    }
    .modal-cancel-btn {
      border: 1px solid #ced4da !important;
      color: #6c757d !important;
      font-weight: 500;
      padding: 10px 20px !important;
      transition: all 0.3s ease;
    }
    .modal-cancel-btn:hover {
      background-color: #f8f9fa !important;
      color: #333333 !important;
    }
    .empty-orders-card {
      background: #ffffff;
      border-radius: 12px;
      padding: 48px 24px;
      text-align: center;
      border: 1px dashed #ced4da;
    }
    .empty-orders-card .empty-icon {
      font-size: 64px;
      color: #f0b334;
      margin-bottom: 16px;
    }
  </style>
@endpush
@section('title', @$title)
@section('content')

  <section class="breadcrumb-wrapper py-4 border-top">
    <div class="container-xxl">
      <ul class="breadcrumbs">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li>Account</li>
      </ul>
    </div>
  </section>
  <section class="furniture_myaccount_wrap pt-2 pb-5">
    <div class="container flow-rootX3">
      <div class="row mb-4">
        <div class="col-lg-12">
          <div class="account-page-header">
            <h1 class="fw-bold m-0 font32 text-dark">My Orders</h1>
            <p class="text-muted m-0 font14 mt-1">Track, view and manage your order history</p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="my_account_wrap">
            @include('frontend.pages.user.includes.profile-sidebar')
            <div class="right_content">
              <div class="profile_details overflow-hidden border flow-rootX3 h-100">
                <div class="heading border-bottom pb-3 px-4 pt-3">
                  <h2 class="font22 fw-bold m-0 c--blackc">All Orders</h2>
                </div>
                <div class="info flow-rootX2 p-4">
                  @forelse ($orders as $order)
                    @php
                      $statuses = getStatusesLog();
                      $statusIcons = [
                          1 => 'check', // Confirmed
                          2 => 'sync_problem', // Cancellation Initiated
                          3 => 'cancel', // Cancelled
                          4 => 'local_shipping', // Shipped
                          5 => 'house', // Delivered
                      ];
                      $currentStatus = $order['order_status'];
                      $returnType = $order->order_status > 4 ? 'Return' : 'Cancel';
                    @endphp
                    <div class="profile_order_return_box border">
                      <div class="order_status_wrap pb-3 border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="status_wrap d-flex align-items-center gap-3">
                          <div class="icon active rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <span class="material-symbols-outlined font22">{{ $statusIcons[$currentStatus] ?? 'help_outline' }}</span>
                          </div>
                          <div class="txts">
                            <div class="txt">
                              <h4 class="font18 mb-1 fw-bold c--blackc">
                                {{ $statuses[$currentStatus] ?? 'Unknown Status' }}
                              </h4>
                              <div class="date font13 text-muted">
                                Placed on {{ \Carbon\Carbon::parse($order['created_at'])->format('D, j M Y') }} &bull; 
                                <span class="fw-medium text-dark">{{ '#' . $order['order_number'] }}</span> &bull; 
                                <span class="fw-bold text-dark">{{ displayPrice($order['net_total']) }}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="viewdetails">
                          <a href="{{ route('order.details', $order['order_number']) }}"
                            title="View Details" class="font15">
                            View Details <span class="material-symbols-outlined font18">arrow_forward</span>
                          </a>
                        </div>
                      </div>
                      
                      @foreach ($order->orderProducts as $item)
                        @php
                          $defaultImage = $item->variant->images[0]->gallery->file_name ?? null;
                        @endphp
                        <div class="product_details py-4 px-4">
                          <a href="{{ route('product.show', $item->variant->sku) }}"
                            title="{{ $item->variant->name }}"></a>
                          <figure class="ratio ratio-1000x1000 mb-0" style="max-width: 100px; border-radius: 8px; overflow: hidden;"><img
                              src="{{ $defaultImage ? asset('public/uploads/media/products/images/' . $defaultImage) : asset('public/backend/assetss/images/products/product_thumb.jpg') }}"
                              alt="{{ $item->variant->name }}" title="{{ $item->variant->name }}" /></figure>
                          <div class="details ps-3">
                            <h3 class="font22 fw-normal c--blackc mb-2">{{ $item->variant->name }}</h3>
                            <p class="font14 text-muted mb-0">Qty: {{ $item->quantity ?? 1 }} &bull; Price: {{ displayPrice($item->sell_price) }}</p>
                          </div>
                        </div>
                        @include('frontend.includes.review-items', [
                            'variantId' => $item->variant->id,
                            'variantName' => $item->variant->name,
                            'review' => $item->review,
                            'orderStatus' => $item->order->order_status,
                            'image' => $defaultImage
                                ? asset('public/uploads/media/products/images/' . $defaultImage)
                                : asset('public/backend/assetss/images/products/product_thumb.jpg'),
                        ])
                      @endforeach

                      @if ($order->order_status != 3)
                        <div class="exchange border-top py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2 bg-light-subtle">
                          <span class="font14 text-muted">Need to modify or cancel this order?</span>
                          <a class="btn custom-submit-btn learnmore_btn order-action-btn" href="javascript:void(0);"
                            title="{{ $returnType }} Order"
                            onclick="needHelp('{{ Hashids::encode($order->id) }}', '{{ $returnType }}')">
                            {{ $returnType }} Order
                          </a>
                        </div>
                      @endif

                    </div>
                  @empty
                    <div class="empty-orders-card">
                      <span class="material-symbols-outlined empty-icon">receipt_long</span>
                      <h4 class="font22 fw-bold text-dark mb-2">No Orders Found</h4>
                      <p class="text-muted font14 mb-4">You have not placed any orders yet. Start shopping and explore our collections!</p>
                      <a href="{{ route('home') }}" class="btn custom-submit-btn learnmore_btn">
                        Start Shopping
                      </a>
                    </div>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('frontend.includes.review-modal')

  {{-- Help Modal --}}
  <div class="modal genericmodal fade" id="HelpModal" tabindex="-1" aria-labelledby="HelpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font22 fw-bold"><span id="help_title"></span> Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body flow-rootX2">
          <div id="newHelp">
            <form id="helpForm">
              @csrf
              <div class="form-element form-textarea mb-4 mt-2">
                <label class="form-label font14 fw-medium text-dark">Please describe your concern or cancellation reason:</label>
                <textarea id="help_text" name="help_text" class="form-field form-control" rows="3" placeholder="Write your reason here..."></textarea>
                <input type="hidden" name="order_type" id="order_type" value="">
                <div id="help-error-container" class="text-danger font12 mt-1"></div>
              </div>
              <div class="action d-flex justify-content-end align-items-center gap-3">
                <button type="button" class="btn modal-cancel-btn w-50" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn modal-submit-btn w-50">Submit Request</button>
              </div>
            </form>
          </div>
          <div id="alreadyHelp" style="display: none" class="p-3 bg-light rounded-3">
            <h5 class="fw-bold font16 mb-3 text-dark">Previous Request Status</h5>
            <p class="font14 mb-1"><strong>Request Type:</strong> <span id="userRequest"></span></p>
            <p class="font14 mb-1"><strong>Your Reason:</strong> <span id="userReason"></span></p>
            <p class="font14 mb-1"><strong>Current Status:</strong> <span id="adminStatus" class="badge bg-warning text-dark"></span></p>
            <p class="font14 mb-0"><strong>Response:</strong> <span id="adminResponse"></span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

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
        let that = this;

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
            url: "{{ route('user.get-review') }}",
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
            url: '{{ route('user.submit-review') }}', // ✅ your backend route
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

    function needHelp(id, type) {
      $.ajax({
        url: '{{ route('order.return') }}',
        type: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          value: id
        },
        success: function(response) {
          if (response.success) {
            if (!response.current_status) {
              $('#order_type').val(id + '_' + type);
              $('#newHelp').show();
              $('#alreadyHelp').hide();
            } else {
              $('#userRequest').text(response.type);
              $('#userReason').text(response.user_reason);
              $('#adminStatus').text(response.current_status);
              $('#adminResponse').text(response.response);
              $('#alreadyHelp').show();
              $('#newHelp').hide();
            }
            $('#help_title').text(type);
            $('#HelpModal').modal('show');
          }
        },
        error: function() {
          iziNotify("Error!", error.responseJSON.message, "error");
        }
      });
    }

    $('#helpForm').validate({
      rules: {
        help_text: {
          required: true,
          maxlength: 255
        },
      },
      messages: {
        help_text: {
          required: "Please write your query.",
          maxlength: "Query must be at least 255 characters."
        },
      },
      errorElement: "div",
      errorPlacement: function(error, element) {
        let errorContainer = $(`#${element.attr('id')}-error-container`);
        if (errorContainer.length) {
          error.appendTo(errorContainer);
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function(form, event) {
        event.preventDefault();
        $.ajax({
          url: '{{ route('order.return.save') }}',
          type: 'POST',
          data: $(form).serialize(),
          success: function(response) {
            if (response.success) {
              $('#HelpModal').modal('hide');
              iziNotify("", response.message, "success");
            } else {
              iziNotify("Oops!", response.message, "error");
            }
          },
          error: function() {
            iziNotify("Error!", error.responseJSON.message, "error");
          }
        });
      }
    });
  </script>
  <script src="https://unpkg.com/ionicons@4.2.4/dist/ionicons.js"></script>
@endpush
