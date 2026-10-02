@if ($items->count())
  <div class="cart_items_container">
    @foreach ($items as $item)
      @php
        $variant = $item->productVariant;
        $promo = findSalePrice($variant->id);
        $displayPrice = $promo['display_price'];
        $regularPrice = $promo['regular_price'];
        $discount = $promo['display_discount'];
        $unitPrice = ($promo['regular_price_true'] == true) ? $regularPrice : $displayPrice;
        $lineTotal = $unitPrice * $item->quantity;
      @endphp

      <div class="cart_page_block" id="product-cart-item-{{ $item->productVariant->id }}">
        <div class="product_thumb">
          <figure class="m-0">
            <a href="{{ route('product.show', $item->productVariant->sku) }}"
              title="{{ $item->productVariant->name ?? '' }}">
              <img
                src="{{ !empty($item->productVariant->galleries[0]['file_name'])
                    ? asset('public/uploads/media/products/images/' . $item->productVariant->galleries[0]['file_name'])
                    : asset('public/backend/assetss/images/products/product_thumb.jpg') }}"
                alt="{{ $item->productVariant->name ?? '' }}" class="imageFit">
            </a>
          </figure>
        </div>

        <div class="product_info">
          <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
            <div class="product_name_category">
              <a style="all: unset; cursor: pointer;" href="{{ route('product.show', $item->productVariant->sku) }}">
                <h5>{{ $item->productVariant->name ?? '' }}</h5>
              </a>
              @if(!empty($item->productVariant->sku))
                <span class="text-muted font12">SKU: {{ $item->productVariant->sku }}</span>
              @endif
            </div>

            <div class="cart-action">
              <a href="#" class="action_remove"
                title="Remove this item"
                onclick="event.preventDefault(); document.getElementById('{{ 'remove-form' }}-{{ $item->product_variant_id }}').submit()">
                <span class="material-symbols-outlined font18">delete</span>
                <span>Remove</span>
              </a>
              <form id="remove-form-{{ $item->product_variant_id }}" action="{{ route('cart.remove') }}" method="POST"
                style="display: none;">
                @csrf
                <input type="hidden" name="product_variant_id" value="{{ Hashids::encode($item->product_variant_id) }}">
              </form>
            </div>
          </div>

          <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3 pt-2 border-top">
            <div class="cart_item_pricing">
              <span class="current_price">{{ displayPrice($unitPrice) }}</span>
              @if($discount > 0)
                <span class="old_price">{{ displayPrice($regularPrice) }}</span>
                <span class="discount_badge">{{ $discount }} OFF</span>
              @endif
            </div>

            @if ($cart_action)
              <div class="cart-itemadd-less d-flex align-items-center gap-3">
                @if ($errors->has('quantity.' . $item->product_variant_id))
                  <div class="error text-danger font13">
                    {{ $errors->first('quantity.' . $item->product_variant_id) }}
                  </div>
                @endif
                @if ($errors->has('cart'))
                  <div class="error text-danger font13">
                    {{ $errors->first('cart') }}
                  </div>
                @endif

                @php
                  $display_quantity = $display_quantity ?? false;
                @endphp
                @if ($display_quantity)
                  @php
                    $decrementCondition = $item->quantity <= 1;
                    $incrementCondition = $item->quantity >= ($item->productVariant->inventory->quantity ?? 9999);
                    $quantity = $item->quantity ?? 1;
                  @endphp

                  <form id="decrement-form-{{ $item->product_variant_id }}" action="{{ route('cart.updateQuantity') }}"
                    method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="product_variant_id"
                      value="{{ Hashids::encode($item->product_variant_id) }}">
                    <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                  </form>

                  <form id="increment-form-{{ $item->product_variant_id }}" action="{{ route('cart.updateQuantity') }}"
                    method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="product_variant_id"
                      value="{{ Hashids::encode($item->product_variant_id) }}">
                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                  </form>

                  <div class="cart_custom_qty_box">
                    <button type="button" class="qty_btn qty_minus {{ $decrementCondition ? 'disabled' : '' }}"
                      {{ $decrementCondition ? 'disabled' : '' }}
                      title="{{ $decrementCondition ? 'Minimum 1 item' : 'Decrease quantity' }}"
                      onclick="{{ !$decrementCondition ? "event.preventDefault(); document.getElementById('decrement-form-{$item->product_variant_id}').submit()" : '' }}">
                      <span class="material-symbols-outlined font18">remove</span>
                    </button>
                    <input type="text" class="qty_val_input" value="{{ $quantity }}" readonly />
                    <button type="button" class="qty_btn qty_plus {{ $incrementCondition ? 'disabled' : '' }}"
                      {{ $incrementCondition ? 'disabled' : '' }}
                      title="{{ $incrementCondition ? 'Maximum stock reached' : 'Increase quantity' }}"
                      onclick="{{ !$incrementCondition ? "event.preventDefault(); document.getElementById('increment-form-{$item->product_variant_id}').submit()" : '' }}">
                      <span class="material-symbols-outlined font18">add</span>
                    </button>
                  </div>
                @else
                  <div class="badge bg-light text-dark border px-3 py-2 font14">
                    Qty: {{ $item->quantity }}
                  </div>
                @endif

                <div class="text-end ps-2 d-none d-sm-block">
                  <div class="fw-bold font16 text-dark">{{ displayPrice($lineTotal) }}</div>
                </div>
              </div>
            @else
              <div class="badge bg-light text-dark border px-3 py-2 font14">
                Qty: {{ $item->quantity }}
              </div>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
@else
  <div class="empty-cart-card">
    <div class="empty-icon-box">
      <span class="material-symbols-outlined">shopping_cart</span>
    </div>
    <h3>Your Cart is Empty</h3>
    <p>Looks like you haven't added any products to your shopping cart yet.</p>
    <a href="{{ route('home') }}" class="learnmore_btn">
      Start Shopping
    </a>
  </div>
@endif
