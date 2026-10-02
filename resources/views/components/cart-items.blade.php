@props(['c_items' => [], 's_items' => [], 'cart_action' => true, 'display_quantity'])

<div class="furniture_cart_left">
  <div class="inside">
    <div class="cart_block">
      <div class="cart_grid">
        {{-- Cart Items Section --}}
        <div id="cart-items-wrapper">
          @include('frontend.includes.cart_items', ['items' => $c_items, 'display_quantity' => $display_quantity])
        </div>

        {{-- Wishlist / Saved for Later Section (hidden on cart page) --}}
        <div id="wishlist-items-wrapper" class="d-none"></div>
      </div>
    </div>
  </div>
</div>
