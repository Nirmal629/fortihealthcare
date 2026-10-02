@extends('frontend.layouts.app')
@push('styles')
  <style>
    .custom-tooltip {
      position: relative;
      cursor: pointer;
    }

    .custom-tooltip::after {
      content: attr(data-tooltip);
      position: absolute;
      bottom: 125%;
      left: 50%;
      transform: translateX(-50%);
      background-color: #333;
      color: #fff;
      padding: 8px 12px;
      border-radius: 6px;
      white-space: nowrap;
      font-size: 14px;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s ease-in-out;
      z-index: 1000;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Tooltip arrow */
    .custom-tooltip::before {
      content: "";
      position: absolute;
      bottom: 115%;
      left: 50%;
      transform: translateX(-50%);
      border-width: 6px;
      border-style: solid;
      border-color: #333 transparent transparent transparent;
      opacity: 0;
      transition: opacity 0.2s ease-in-out;
      z-index: 1001;
    }

    /* Show tooltip on hover */
    .custom-tooltip:hover::after,
    .custom-tooltip:hover::before {
      opacity: 1;
    }
  </style>
@endpush

@section('title', @$title)

@section('content')
  <!-- <section class="breadcrumb-wrapper py-4 border-top">
    <div class="container-xxl">
      <ul class="breadcrumbs">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li>Cart</li>
      </ul>
    </div>
  </section> -->

  <section class="furniture_cart_wrap">
    <div class="container-xxl">

      {{-- Checkout Stepper --}}
      <div class="cart_stepper_wrap">
        <div class="cart_stepper_item active">
          <span class="step_num">1</span>
          <span class="step_text">Shopping Cart</span>
        </div>
        <div class="cart_stepper_divider"></div>
        <div class="cart_stepper_item">
          <span class="step_num">2</span>
          <span class="step_text">Checkout & Address</span>
        </div>
        <div class="cart_stepper_divider"></div>
        <div class="cart_stepper_item">
          <span class="step_num">3</span>
          <span class="step_text">Confirmation</span>
        </div>
      </div>

      <div class="cart-page-header">
        <h1 class="cart-title">
          Shopping Cart
          @if(cartCount() > 0)
            <span class="cart-count-badge">{{ cartCount() }} {{ cartCount() == 1 ? 'item' : 'items' }}</span>
          @endif
        </h1>
        <p class="text-muted font15 m-0">Review your selected pharmaceutical & healthcare items and proceed to checkout.</p>
      </div>

      <div class="furniture_cart_inside_wrap">
        <x-cart-items :c_items="$cart_items" :s_items="$saved_for_later_items" :display_quantity="true"/>

        <div class="furniture__cartsummery-right {{ cartCount() == 0 ? 'd-none' : '' }}">
          <div class="furniture__cartsummery-inside">
            <div id="cart-summary-wrapper">
              <x-cart-summary :cart_items="$cart_items" />
            </div>

            <div class="cart_summary_action_area">
              <div class="cart_action">
                <a id="proceed-to-checkout" href="{{ cartCount() > 0 ? route('checkout') : 'javascript:void(0)' }}"
                  class="btn learnmore_btn cart_checkout_btn {{ cartCount() > 0 ? '' : 'disabled' }}">Proceed To Checkout</a>
              </div>
              <div class="text-center">
                <a href="{{ route('home') }}" class="continue_shopping_link">
                  <span class="material-symbols-outlined font16">arrow_back</span>
                  <span>Continue Shopping</span>
                </a>
              </div>
            </div>

            <div class="cart_trust_badges_box">
              <div class="cart_trust_badge_item">
                <span class="material-symbols-outlined">verified_user</span>
                <span>256-Bit SSL Encrypted & Secure Checkout</span>
              </div>
              <div class="cart_trust_badge_item">
                <span class="material-symbols-outlined">local_shipping</span>
                <span>Fast & Reliable Dispatch</span>
              </div>
              <div class="cart_trust_badge_item">
                <span class="material-symbols-outlined">verified</span>
                <span>100% Genuine Healthcare Products</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{--@include('frontend.includes.checkout-more-products')--}}
@endsection

@push('scripts')
@endpush
