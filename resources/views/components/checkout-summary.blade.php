@props(['cart_items', 'shipping_address', 'billing_address'])
<div class="furniture__cartsummery-inside">
  <input type="hidden" name="coupon_id" id="coupon_id" value="">
  <input type="hidden" name="coupon_discount" id="coupon_discount" value="">
  <input type="hidden" name="shipping_address" id="shipping_address" value="{{ $shipping_address->id ?? '' }}">
  <input type="hidden" name="billing_address" id="billing_address" value="{{ $billing_address->id ?? '' }}">
  <x-address-display title="Shipping Address" :userAddress="$shipping_address" addressType="shipping" />
  <x-address-display title="Billing Address" :userAddress="$billing_address" addressType="billing" />
  <x-cart-summary :cart_items="$cart_items" :coupon="true" />
  @if (cartCount() > 0)
    <x-payment-methods />
    <div class="cart_summary_action_area pt-2">
      <div class="cart_action">
        <button id="payNowBtn" class="btn learnmore_btn cart_checkout_btn w-100">Pay Now</button>
      </div>
    </div>
  @endif
</div>
