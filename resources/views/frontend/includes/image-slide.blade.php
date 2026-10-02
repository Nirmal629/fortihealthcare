<div class="product-details-slider-wrap">
  <div class="modern_product_gallery_card">
    <div class="swiper swiper--product-detail modern_main_slider">
      <div class="swiper-wrapper">
        @forelse ($orderedImages as $item)
          <div class="swiper-slide">
            <div class="easyzoom easyzoom--overlay w-100 h-100 d-flex align-items-center justify-content-center">
              <a href="javascript:void(0)" class="w-100 d-flex align-items-center justify-content-center" style="aspect-ratio: 1/1;">
                @if ($item->gallery->file_type == 'video/mp4')
                  <video width="100%" height="100%" controls style="max-height: 480px; object-fit: contain;">
                    <source
                      src="{{ asset('public/uploads/media/products/videos/' . $item->gallery->file_name) }}"
                      type="video/mp4">
                  </video>
                @else
                  <img src="{{ asset('public/uploads/media/products/images/' . $item->gallery->file_name) }}"
                    alt="{{ $productVariant->name }}" title="{{ $productVariant->name }}" style="max-height: 480px; width: 100%; object-fit: contain;">
                @endif
              </a>
            </div>
          </div>
        @empty
          <div class="swiper-slide">
            <div class="w-100 d-flex align-items-center justify-content-center" style="aspect-ratio: 1/1;">
              <img src="{{ asset('public/backend/assetss/images/products/product_thumb.jpg') }}" alt=""
                title="" style="max-height: 480px; width: 100%; object-fit: contain;" />
            </div>
          </div>
        @endforelse
      </div>
    </div>

    <div class="swiper swiper--product-thumbs modern_thumbs_slider">
      <div class="swiper-wrapper">
        @forelse ($orderedImages as $item)
          <div class="swiper-slide" role="group">
            <div class="d-flex align-items-center justify-content-center" style="aspect-ratio: 1/1; padding: 4px;">
              @if ($item->gallery->file_type == 'video/mp4')
                <video src="{{ asset('public/uploads/media/products/videos/' . $item->gallery->file_name) }}"
                  controls title="{{ $productVariant->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;"></video>
              @elseif (
                  $item->gallery->file_type == 'image/jpeg' ||
                      $item->gallery->file_type == 'image/png' ||
                      $item->gallery->file_type == 'image/jpg' ||
                      $item->gallery->file_type == 'image/webp')
                <img src="{{ asset('public/uploads/media/products/images/' . $item->gallery->file_name) }}"
                  alt="{{ $productVariant->name }}" title="{{ $productVariant->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
              @endif
            </div>
          </div>
        @empty
          <div class="swiper-slide">
            <div class="d-flex align-items-center justify-content-center" style="aspect-ratio: 1/1; padding: 4px;">
              <img src="{{ asset('public/backend/assetss/images/products/product_thumb.jpg') }}" alt=""
                title="" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;" />
            </div>
          </div>
        @endforelse
      </div>
      <div class="swiper-scrollbar swiper-scrollbar-horizontal" style="display: none;"></div>
      <div class="swiper-buttons">
        <div class="swiper-button-prev" tabindex="-1" role="button" aria-label="Previous slide"></div>
        <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>
      </div>
    </div>
  </div>
</div>