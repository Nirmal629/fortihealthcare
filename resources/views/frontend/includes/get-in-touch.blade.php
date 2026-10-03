@php
  $getInTouchBanner = \App\Models\CustomBanner::whereIn('position', ['get_in_touch', 'contact', 'getintouch'])
    ->where('status', 1)
    ->first();
  $bannerImage = null;
  if ($getInTouchBanner && !empty($getInTouchBanner->settings)) {
    $settings = is_array($getInTouchBanner->settings) ? $getInTouchBanner->settings : json_decode($getInTouchBanner->settings, true);
    if (!empty($settings['image'])) {
      $bannerImage = asset('public/uploads/banners/' . $settings['image']);
    }
  }
  if (!$bannerImage) {
    $bannerImage = asset('public/frontend/assets/img/home/hero_banner.png');
  }
@endphp

<section class="contactUs_sec custom-get-in-touch py-4 py-lg-5" id="getintouchId">
    <div class="container-xxl">
        <div class="row align-items-center gy-4 gy-lg-0">
            <!-- Left side image -->
            <div class="col-lg-5 col-md-12 text-center text-lg-start">
                <div class="image-wrapper">
                    <img src="{{ $bannerImage }}" alt="Get In Touch" class="img-fluid rounded-4 shadow-sm">
                </div>
            </div>
            <!-- Right side form -->
            <div class="col-lg-7 col-md-12">
                <div class="form-wrapper">
                    <h2 class="form-heading">Get In <span>Touch</span></h2>
                    <form id="getInTouchForm" action="{{ route('contact-us.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="git_name">Your Name <span class="text-danger">*</span> :</label>
                                <input type="text" name="name" class="form-control custom-input" id="git_name" placeholder="Enter your name">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="git_email">Email address <span class="text-danger">*</span> :</label>
                                <input type="email" name="email" class="form-control custom-input" id="git_email" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="git_phone">Phone Number :</label>
                            <input type="tel" name="phone" class="form-control custom-input" id="git_phone" placeholder="Enter phone number">
                        </div>
                        <div class="form-group mb-4">
                            <label for="git_message">Message <span class="text-danger">*</span> :</label>
                            <textarea name="message" class="form-control custom-input" id="git_message" rows="4" placeholder="Message....."></textarea>
                        </div>
                        <button type="submit" class="btn custom-submit-btn learnmore_btn" id="git_submit_btn">
                            Submit Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
  $(document).ready(function() {
    if ($("#getInTouchForm").length) {
      $("#getInTouchForm").validate({
        rules: {
          name: {
            required: true,
            minlength: 2,
            maxlength: 255
          },
          email: {
            required: true,
            email: true,
            maxlength: 255
          },
          phone: {
            minlength: 6,
            maxlength: 20
          },
          message: {
            required: true,
            minlength: 5,
            maxlength: 2000
          }
        },
        messages: {
          name: {
            required: "{{ __('validation.required', ['attribute' => 'Name']) }}",
            minlength: "{{ __('validation.minlength', ['attribute' => 'Name', 'min' => 2]) }}"
          },
          email: {
            required: "{{ __('validation.required', ['attribute' => 'Email']) }}",
            email: "{{ __('validation.email', ['attribute' => 'Email']) }}"
          },
          phone: {
            minlength: "Please enter a valid phone number",
            maxlength: "Phone number is too long"
          },
          message: {
            required: "{{ __('validation.required', ['attribute' => 'Message']) }}",
            minlength: "{{ __('validation.minlength', ['attribute' => 'Message', 'min' => 5]) }}"
          }
        },
        errorElement: "span",
        errorClass: "text-danger d-block mt-1 font13",
        errorPlacement: function(error, element) {
          error.insertAfter(element);
        },
        submitHandler: function(form) {
          var $btn = $('#git_submit_btn');
          $btn.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...'
          );

          var formData = new FormData(form);

          $.ajax({
            url: $(form).attr('action'),
            type: "POST",
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              if (response.success) {
                if (typeof iziNotify !== 'undefined') {
                  iziNotify("", response.message, "success");
                } else if (typeof swalNotify !== 'undefined') {
                  swalNotify("Success!", response.message, "success");
                } else {
                  alert(response.message);
                }
                form.reset();
              } else {
                if (typeof iziNotify !== 'undefined') {
                  iziNotify("Oops!", response.message || 'Something went wrong', "error");
                } else {
                  alert(response.message || 'Something went wrong');
                }
              }
              $btn.prop('disabled', false).html('Submit Message');
            },
            error: function(xhr) {
              var errorMsg = 'An error occurred while sending your message. Please try again.';
              if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
              } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                var errors = xhr.responseJSON.errors;
                var firstKey = Object.keys(errors)[0];
                if (firstKey && errors[firstKey][0]) {
                  errorMsg = errors[firstKey][0];
                }
              }

              if (typeof iziNotify !== 'undefined') {
                iziNotify("Oops!", errorMsg, "error");
              } else {
                alert(errorMsg);
              }
              $btn.prop('disabled', false).html('Submit Message');
            }
          });
        }
      });
    }
  });
</script>
@endpush
