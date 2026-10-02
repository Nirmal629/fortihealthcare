@extends('frontend.layouts.app')

@section('title', @$title)

@section('content')

  <section class="breadcrumb-wrapper py-4 border-top">
    <div class="container-xxl">
      <ul class="breadcrumbs">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('profile') }}">Account</a></li>
        <li><a href="{{ route('profile-details') }}">Profile Details</a></li>
        <li>Edit Details</li>
      </ul>
    </div>
  </section>
  <section class="furniture_myaccount_wrap pt-2 pb-5">
    <div class="container">
      <div class="row mb-4">
        <div class="col-lg-12">
          <div class="account-page-header">
            <h1 class="fw-bold m-0 font32 text-dark">My Account</h1>
            <p class="text-muted m-0 font14 mt-1">Manage your account information, orders, and addresses</p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="my_account_wrap">
            @include('frontend.pages.user.includes.profile-sidebar')
            <div class="right_content">
              <div class="profile_details modern_profile_card h-100">
                <div class="heading d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                  <div>
                    <h2 class="font22 fw-bold text-dark m-0">Edit Profile Details</h2>
                    <p class="text-muted font13 mb-0 mt-1">Update your personal account information</p>
                  </div>
                  <a href="{{ route('profile-details') }}" class="btn modern_cancel_profile_btn d-inline-flex align-items-center gap-2"
                    title="Back to Details">
                    <span class="material-symbols-outlined font18">arrow_back</span>
                    <span>Back</span>
                  </a>
                </div>
                <div class="info">
                  <form class="allForm edit_details modern_profile_form" id="edit_details">
                    @csrf
                    <div class="row g-3">
                      <div class="col-md-6">
                        <div class="modern_form_group">
                          <label class="modern_form_label">First Name <span class="text-danger">*</span></label>
                          <div class="modern_input_wrap">
                            <span class="material-symbols-outlined modern_input_icon">person</span>
                            <input name="first_name" id="first_name" type="text" class="form-control modern_form_control only-alphabet-symbols"
                              placeholder="Enter First Name" value="{{ user()->first_name ?? '' }}">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="modern_form_group">
                          <label class="modern_form_label">Last Name</label>
                          <div class="modern_input_wrap">
                            <span class="material-symbols-outlined modern_input_icon">person_outline</span>
                            <input name="last_name" id="last_name" type="text" class="form-control modern_form_control only-alphabet-symbols"
                              placeholder="Enter Last Name" value="{{ user()->last_name ?? '' }}">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="modern_form_group">
                          <label class="modern_form_label">Email Address <span class="text-danger">*</span></label>
                          <div class="modern_input_wrap">
                            <span class="material-symbols-outlined modern_input_icon">mail</span>
                            <input name="email" id="email" type="email" class="form-control modern_form_control modern_input_readonly"
                              value="{{ user()->email ?? '' }}" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="modern_form_group">
                          <label class="modern_form_label">Mobile No <span class="text-danger">*</span></label>
                          <div class="modern_phone_field_wrap">
                            <x-phone-number-frontend :required="true" :previousValue="user()->phone ?? ''" :name="'phone'" :id="'phone'" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="modern_form_group">
                          <label class="modern_form_label">Gender <span class="text-danger">*</span></label>
                          <div class="modern_input_wrap">
                            <span class="material-symbols-outlined modern_input_icon">wc</span>
                            <select name="gender" id="gender" class="form-select modern_form_control">
                              <option value="" {{ !empty(user()->gender) ? '' : 'selected' }}> Select Gender</option>
                              <option value="1" {{ user()->gender == '1' ? 'selected' : '' }}>Male</option>
                              <option value="2" {{ user()->gender == '2' ? 'selected' : '' }}>Female</option>
                              <option value="3" {{ user()->gender == '3' ? 'selected' : '' }}>Other</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="modern_form_group">
                          <label class="modern_form_label">Date of Birth</label>
                          <div class="modern_input_wrap">
                            <span class="material-symbols-outlined modern_input_icon">calendar_month</span>
                            <input name="dob" id="dob" type="date" class="form-control modern_form_control" max="{{ date('Y-m-d') }}"
                              value="{{ user()->dob ? date('Y-m-d', strtotime(user()->dob)) : '' }}">
                          </div>
                        </div>
                      </div>

                      <div class="col-12 mt-4 pt-2">
                        <div class="d-flex align-items-center gap-3">
                          <button type="submit" class="btn modern_edit_profile_btn d-inline-flex align-items-center gap-2 px-4 py-2">
                            <span class="material-symbols-outlined font18">save</span>
                            <span>Save Details</span>
                          </button>
                          <a href="{{ route('profile-details') }}" class="btn modern_cancel_profile_btn d-inline-flex align-items-center gap-2 px-4 py-2">
                            <span>Cancel</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script src="{{ asset('/public/common/js/custom_input.js?v=1' . time()) }}"></script>

  <script>
    $(document).ready(function() {
      $("#edit_details").validate({
        rules: {
          first_name: {
            required: true
          },
          /* last_name: {
              required: true
          }, */
          email: {
            required: true,
            email: true
          },
          phone: {
            required: true,
            validPhone: true // Custom validation method from PhoneNumber Component
          },
          gender: {
            required: true
          },
          dob: {
            date: true
          }
        },
        messages: {
          first_name: {
            required: "{{ __('validation.required', ['attribute' => 'First Name']) }}"
          },
          /* last_name: {
              required: "{{ __('validation.required', ['attribute' => 'Last Name']) }}"
          }, */
          email: {
            required: "{{ __('validation.required', ['attribute' => 'Email']) }}",
            email: "{{ __('validation.email', ['attribute' => 'Email']) }}"
          },
          phone: {
            required: "{{ __('validation.required', ['attribute' => 'Pnone No']) }}",
            number: "{{ __('validation.numeric', ['attribute' => 'Pnone No']) }}"
          },
          gender: {
            required: "{{ __('validation.required', ['attribute' => 'Gender']) }}"
          },
          dob: {
            date: "{{ __('validation.date', ['attribute' => 'Date of Birth']) }}"
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
        submitHandler: function(form) {
          $.ajax({
            url: "{{ route('user.update-profile') }}",
            type: "POST",
            data: $(form).serialize(),
            success: function(response) {
              if (response.success) {
                iziNotify("", response.message, "success");
              } else {
                console.log("response: ", response);

                iziNotify("Oops!", response.message, "error");
              }
            },
            error: function(xhr) {
              iziNotify("Oops!", xhr.responseJSON.message, "error");
            }
          });
        }
      });
    });
  </script>
@endpush
