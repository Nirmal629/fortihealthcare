<div class="product-details-content-info modern_product_info_card">
  <!-- Meta / Category & SKU -->
  <div class="product-meta-header">
    @if ($category)
      <a href="{{ route('category.slug', $category->slug) }}" class="product-category-pill">
        <span class="material-symbols-outlined" style="font-size: 14px;">category</span>
        {{ $category->title }}
      </a>
    @endif
    <span class="product-sku-pill">SKU: {{ $productVariant->sku }}</span>
  </div>

  <!-- Title & Description -->
  <div>
    <h1 class="modern-product-title">{{ $productVariant->name }}</h1>
    @if ($productVariant->product->description)
      <p class="modern-product-desc mt-2">
        {{ $productVariant->product->description }}
      </p>
    @endif
  </div>

  <!-- Rating & Wishlist Row -->
  <div class="product-rating-wishlist-row">
    <div class="d-flex align-items-center gap-2 flex-wrap">
      @php
        $rating = $productVariant->variantReview->rating ?? 0;
        $isEdit = isset($productVariant->variantReview->id);
        $defaultImage = $productVariant->images[0]->gallery->file_name ?? null;
      @endphp

      @if ($totalRatings > 0)
        <div class="modern-rating-box">
          <div class="modern-rating-stars">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-star-fill" viewBox="0 0 16 16" fill="#f0b334">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
            </svg>
          </div>
          <span class="modern-rating-score">{{ number_format($averageRating, 1) }}</span>
        </div>

        <span class="text-muted font13">({{ $totalRatings }} {{ $totalRatings === 1 ? 'rating' : 'ratings' }})</span>

        <a href="#allReviews" class="modern-review-link">View All Reviews</a>
      @else
        <div class="modern-rating-box" style="background: #f8fafc; border-color: #e2e8f0;">
          <div class="modern-rating-stars">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-star-fill" viewBox="0 0 16 16" fill="#cbd5e1">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
            </svg>
          </div>
          <span class="modern-rating-score" style="color: #94a3b8;">0.0</span>
        </div>

        <span class="text-muted font13">(0 ratings)</span>
      @endif
    </div>

    <!-- Wishlist Button -->
    @if (auth()->check())
      @if ($isInWishlist)
        <a href="javascript:void(0);" data-id="{{ Hashids::encode($productVariant->id) }}"
          data-serial="{{ $productVariant->id }}" title="Remove from Wishlist" id="wishlist-icon" class="modern-wishlist-btn add-to-wishlist-btn">
          <span class="material-symbols-outlined c--red fillup-heart"
            id="wishlist-icon-fill-{{ $productVariant->id }}">favorite</span>
        </a>
      @else
        <a href="javascript:void(0);" data-id="{{ Hashids::encode($productVariant->id) }}"
          data-serial="{{ $productVariant->id }}" title="Add to Wishlist" class="modern-wishlist-btn add-to-wishlist-btn">
          <span class="material-symbols-outlined" id="wishlist-icon-{{ $productVariant->id }}">favorite</span>
        </a>
      @endif
      <form id="add-to-wishlist-form-{{ $productVariant->id }}" action="{{ route('cart.add') }}" method="POST"
        style="display: none;">
        @csrf
        <input type="hidden" name="product_variant_id" value="{{ Hashids::encode($productVariant->id) }}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="is_saved_for_later" value="1">
        <input type="hidden" name="action" value="add_to_wishlist">
      </form>
    @endif
  </div>

  <!-- Price Card -->
  @if ($productVariant->inventory?->quantity > 0)
    @php
      $promo = findSalePrice($productVariant->id);
      $displayPrice = $promo['display_price'];
      $regularPrice = $promo['regular_price'];
      $specialPrice = $promo['special_price'];
    @endphp

    <div class="modern-price-card">
      <div class="d-flex align-items-baseline gap-3 flex-wrap">
        @if ($promo['regular_price_true'] == true)
          <span class="modern-current-price">{{ displayPrice($regularPrice) }}</span>
        @else
          <span class="modern-current-price">{{ displayPrice($displayPrice) }}</span>
          <span class="modern-old-price">{{ displayPrice($regularPrice) }}</span>
          <span class="modern-discount-badge">{{ $promo['display_discount'] }} OFF</span>
        @endif
      </div>

      @if ($specialPrice)
        <span class="special-offer-pill">Special Offer</span>
      @endif
    </div>
  @endif

  <!-- Variant Selectors -->
  @php
    $uniqueAttributes = collect($attributeOptions)->unique('name')->values();
  @endphp

  @if ($uniqueAttributes->isNotEmpty())
    <div class="d-flex flex-column gap-3">
      @foreach ($uniqueAttributes as $attribute)
        @php
          $distinctOptions = collect($attribute['options'])->unique('attribute_value_id')->values();
        @endphp
        <div class="modern-attribute-group" data-attribute-id="{{ $attribute['id'] }}">
          <h4 class="modern-attribute-title">Select {{ $attribute['name'] }}</h4>
          <div class="modern-swatch-grid">
            @foreach ($distinctOptions as $option)
              @php
                $isSelected =
                    isset($currentAttributes[$attribute['id']]) &&
                    $currentAttributes[$attribute['id']] == $option['attribute_value_id'];
                $newAttributes = $currentAttributes->toArray();
                $newAttributes[$attribute['id']] = $option['attribute_value_id'];
                $matchedSku = null;
                foreach ($combinations as $combo) {
                    if ($combo['attributes'] == $newAttributes) {
                        $matchedSku = $combo['sku'];
                        break;
                    }
                }
                $imageUrl = asset('public/uploads/media/products/images/' . $option['image_url']);
              @endphp
              <div class="modern-swatch-item {{ $isSelected ? 'checked' : '' }}">
                <input type="radio" name="po-inp-{{ $attribute['id'] }}" value="{{ $option['attribute_value_id'] }}"
                  data-sku="{{ $matchedSku ?? '' }}" {{ $isSelected ? 'checked' : '' }}>
                @if ($attribute['name'] == 'Color' && !empty($option['image_url']))
                  <div class="modern-swatch-card">
                    <img src="{{ $imageUrl }}" alt="{{ $option['value'] }}" class="modern-swatch-img" loading="lazy">
                    <span class="modern-swatch-name">{{ $option['value'] }}</span>
                  </div>
                @else
                  <div class="modern-chip-card">
                    <span>{{ $option['value'] }}</span>
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
  @endif

  <!-- Stock & Pincode Delivery Checker -->
  @if ($productVariant->inventory?->quantity > 0)
    <div class="modern-pincode-card">
      <div class="modern-pincode-header">
        <span class="stock-status-pill">In Stock (Ready to Ship)</span>
        <div class="estimate_days delivery-estimate-badge"></div>
      </div>
      <div class="modern-pincode-input-group">
        <input type="text" class="form-control modern-pincode-input only-alphabet-numbers-symbols" name="pincode" id="pincode"
          placeholder="Enter Delivery Pincode" maxlength="15" autocomplete="off"
          value="{{ session('user_pincode')['Pincode'] ?? config('defaults.default_pincode') }}">
        <button type="submit" class="btn modern-pincode-btn pincode-apply-btn">
          <span class="material-symbols-outlined" style="font-size: 19px;">local_shipping</span>
          <span>Check</span>
        </button>
      </div>
      <span class="pincode-message font12 mt-1 d-block"></span>
    </div>

    <!-- Purchase Buttons -->
    <div class="modern-buy-actions-grid" id="cart-btn-wrapper">
      <!-- Add to Cart Form -->
      <form id="add-to-cart-form-{{ $productVariant->id }}" action="{{ route('cart.add') }}" method="POST"
        style="display: none;">
        @csrf
        <input type="hidden" name="product_variant_id" value="{{ Hashids::encode($productVariant->id) }}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="is_saved_for_later" value="0">
        <input type="hidden" name="action" value="add_to_cart">
      </form>

      @if ($isInCart)
        <a href="{{ route('cart.index') }}" class="btn modern-add-to-cart-btn view-cart-btn"
          id="view-cart-{{ $productVariant->id }}">
          <span class="material-symbols-outlined">shopping_cart_checkout</span>
          <span>View Cart</span>
        </a>
      @else
        <button type="button" data-id="{{ Hashids::encode($productVariant->id) }}"
          data-serial="{{ $productVariant->id }}"
          class="btn modern-add-to-cart-btn add-to-cart-btn browse-cart-loader"
          id="added-cart-{{ $productVariant->id }}">
          <span class="material-symbols-outlined">shopping_bag</span>
          <span>Add to Cart</span>
        </button>
      @endif

      <!-- Buy Now Form -->
      <form id="buy-now-form-{{ $productVariant->id }}" action="{{ route('cart.add') }}" method="POST"
        style="display: none;">
        @csrf
        <input type="hidden" name="product_variant_id" value="{{ Hashids::encode($productVariant->id) }}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="is_saved_for_later" value="0">
        <input type="hidden" name="action" value="buy_now">
      </form>
      <button type="button" data-id="{{ Hashids::encode($productVariant->id) }}"
        data-serial="{{ $productVariant->id }}" class="btn modern-buy-now-btn buy-now-btn">
        <span class="material-symbols-outlined">bolt</span>
        <span>Buy Now</span>
      </button>
    </div>
  @else
    <div class="p-3 bg-light border border-danger rounded-3 text-center">
      <span class="text-danger fw-bold font16">Currently Out of Stock</span>
      <p class="text-muted font13 mb-0 mt-1">This product is currently unavailable. Please check back later.</p>
    </div>
  @endif

  <!-- Trust Badges -->
  <div class="modern-trust-badges-row">
    <div class="modern-trust-badge-item">
      <span class="material-symbols-outlined">verified</span>
      <span class="text">100% Genuine Quality</span>
    </div>
    <div class="modern-trust-badge-item">
      <span class="material-symbols-outlined">local_shipping</span>
      <span class="text">Fast Express Delivery</span>
    </div>
    <div class="modern-trust-badge-item">
      <span class="material-symbols-outlined">published_with_changes</span>
      <span class="text">Easy Return Policy</span>
    </div>
  </div>

  <!-- Accordion for Specifications & Details -->
  @include('frontend.includes.accordion')

  <!-- Ratings & Reviews -->
  @include('frontend.includes.ratings')

</div>

@push('scripts')
  <script src="{{ asset('/public/backend/assetss/js/jquery.validate.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.pincode-message').hide();
      $('.estimate_days').hide();

      function checkPincode(pincode) {
        if (!pincode || pincode.trim().length === 0) {
          $('.pincode-message')
            .show()
            .html('Please enter pincode')
            .css('color', '#ef4444');
          $('.estimate_days').hide();
          return;
        }

        $.ajax({
          url: "{{ route('pincode.check') }}",
          type: "POST",
          data: {
            pincode: pincode,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function(response) {
            if (response.success && response.is_serviceable) {
              if (response.data && response.data.estimate_days != null) {
                $('.estimate_days').html(`<span class="material-symbols-outlined" style="font-size:16px; color:#10b981;">schedule</span> Est. Delivery: ${response.data.estimate_days}`);
              }
              $('.pincode-message')
                .show()
                .html('✓ Serviceable at this pincode')
                .css('color', '#10b981');

              $('.estimate_days').show();
              $('#cart-btn-wrapper').removeClass('d-none');
            } else {
              $('.pincode-message')
                .show()
                .html('✕ Not serviceable at this pincode')
                .css('color', '#ef4444');
              $('.estimate_days').hide();
              $('#cart-btn-wrapper').addClass('d-none');
            }
          },
          error: function() {
            $('.pincode-message')
              .show()
              .html('Invalid pincode format')
              .css('color', '#f59e0b');
          }
        });
      }

      $('.pincode-apply-btn').on('click', function(e) {
        e.preventDefault();
        const pincode = $('#pincode').val();
        checkPincode(pincode);
      });

      const initialPincode = $('#pincode').val();
      if (initialPincode && initialPincode.length >= 3) {
        checkPincode(initialPincode);
      }
    });
  </script>
  <script>
    document.addEventListener('click', function(e) {
      if (e.target.matches('input[type="radio"][name^="po-inp-"]')) {
        let sku = e.target.dataset.sku;
        if (sku && sku.trim() !== '') {
          window.location.href = `{{ route('product.show', ['variant' => ':sku']) }}`.replace(':sku', sku);
        } else {
          iziNotify("", 'No SKU for this selection, not redirecting.', "error");
        }
      }
    });
  </script>
@endpush