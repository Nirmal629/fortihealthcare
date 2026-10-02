@extends('frontend.layouts.app')

@section('title', @$title)

@section('content')

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
                <div class="heading d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 flex-wrap gap-2">
                  <div>
                    <h2 class="font22 fw-bold text-dark m-0">Saved Addresses</h2>
                    <p class="text-muted font13 mb-0 mt-1">Manage your delivery and billing addresses</p>
                  </div>
                  <a href="javascript:void(0);"
                    class="btn modern_edit_profile_btn d-inline-flex align-items-center gap-2 create-or-edit-address"
                    title="Add New Address">
                    <span class="material-symbols-outlined font18">add</span>
                    <span>Add New Address</span>
                  </a>
                </div>
                <div class="info" id="address_block_profile">
                  @include('frontend.includes.list-of-profile-address', ['addresses' => $addresses])
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <x-create-or-edit-address-modal :states="$states" />
@endsection

@push('scripts')
@endpush