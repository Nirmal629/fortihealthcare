@extends('frontend.layouts.app')
@push('styles')
  <style>
    .tooltip-inner {
      background-color: #333;
      color: #fff;
      font-size: 14px;
      padding: 8px 12px;
      border-radius: 6px;
    }

    .tooltip.bs-tooltip-top .tooltip-arrow::before {
      border-top-color: #333;
    }
  </style>
@endpush
@section('title', @$title)

@section('content')
  <section class="furniture_cart_wrap">
    <div class="container-xxl">

      {{-- Checkout Stepper --}}
      <div class="cart_stepper_wrap">
        <a href="{{ route('cart.index') }}" class="cart_stepper_item text-decoration-none">
          <span class="step_num">1</span>
          <span class="step_text">Shopping Cart</span>
        </a>
        <div class="cart_stepper_divider"></div>
        <div class="cart_stepper_item active">
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
          Checkout & Address
        </h1>
        <p class="text-muted font15 m-0">Select shipping & billing address and complete your order.</p>
      </div>

      <div class="furniture_cart_inside_wrap">
        <x-cart-items :c_items="$cart_items" :display_quantity="false" />
        <div class="furniture__cartsummery-right">
          <input type="hidden" id="address_count" value="{{ !empty($addresses) ? count($addresses) : 0 }}">
          <x-checkout-summary :cart_items="$cart_items" :shipping_address="$shipping_address" :billing_address="$billing_address" />
        </div>
      </div>
    </div>
  </section>

  <x-address-modal :addresses="$addresses ?? []" />
  <x-checkout-create-address-modal :states="$states" />
@endsection

@push('component-scripts')
  <script>
    $('#payNowBtn').click(function(e) {
      e.preventDefault();
      if (!$('#billing_address').val() || !$('#shipping_address').val()) {
        iziNotify("", 'Please add both billing and shipping address', "error");
        return;
      }
      $(this).prop('disabled', true).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...'
      );

      $.ajax({
        url: '{{ route('checkout.process') }}',
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
          billing_address: $('#billing_address').val(),
          shipping_address: $('#shipping_address').val(),
          coupon_id: $('#coupon_id').val(),
          coupon_discount: $('#coupon_discount').val(),
          payment_method: $('input[name="paymentmode"]:checked').val(),
        },
        success: function({
          success,
          message,
          redirect
        }) {
          if (success) {
            // iziNotify("", message, "success");
            setTimeout(() => window.location.href = `${redirect}`, 1000);
          } else {
            iziNotify("Oops!", message, "error");
            $('#payNowBtn').prop('disabled', false).html('Pay Now');
          }
        },
        error: function(xhr) {
          let errorMessage = xhr.responseJSON?.message || 'An error occurred during payment processing';
          iziNotify("Oops!", errorMessage, "error");
          $('#payNowBtn').prop('disabled', false).html('Pay Now');
        }
      });
    });
  </script>
@endpush
