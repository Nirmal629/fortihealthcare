@props(['fromPage' => ''])
<div class="row">
  <div class="col-lg-12">
    <div class="product_range_wrap">
      <h4 class="font25 fw-normal m-0">
        {{ $fromPage == 'category' ? 'Collections' : 'Category: ' . ($product->category->title ?? ($category->title ?? '')) }}</h4>
      <div class="range_swiper">
        <div class="swiper swiper__5">
          <div class="swiper-wrapper eq-height">
            @if ($fromPage == 'category')
              @forelse ($productCategories as $productCategory)
                <div class="swiper-slide">
                  <div
                    class="product_range_box {{ !empty($category) && $category->slug == $productCategory->slug ? 'active' : '' }}"
                    data-category="{{ $productCategory->slug }}">
                    <a href="{{ route('category.slug', $productCategory->slug) }}" class="group-filter"
                      data-category="{{ $productCategory->slug }}"></a>
                    <figure class="m-0 ratio ratio-1000x800">
                      <img
                        src="{{ $productCategory->category_image ? asset('public/uploads/categories/' . $productCategory->category_image) : asset('public/backend/assetss/images/products/product_thumb.jpg') }}"
                        alt="Product Image" title="Product Image" />
                    </figure>
                    <div class="inf">
                      <p class="font14 m-0">{{ $productCategory->title }}</p>
                      <p class="font14 m-0">
                        <strong>{{ $productCategory->products->first()?->variants?->count() ?? 1 }}</strong> options
                      </p>
                    </div>
                  </div>
                </div>
              @empty
              @endforelse
            @else
              @forelse ($relatedProducts as $relatedProduct)
                @php
                  $firstVariant = $relatedProduct->variants->first();
                  $defaultImage = $firstVariant?->galleries->first()?->file_name
                    ?? ($firstVariant?->images->first()?->gallery?->file_name
                    ?? ($firstVariant->images[0]->gallery->file_name ?? null));
                  $variantCount = $relatedProduct->variants ? $relatedProduct->variants->count() : 1;
                @endphp
                <div class="swiper-slide">
                  <div class="product_range_box {{ (isset($product) && $product->id == $relatedProduct->id) ? 'active' : '' }}">
                    <a href="{{ route('search.product', strtolower(str_replace(' ', '-', $relatedProduct->name))) }}"
                      title="{{ $relatedProduct->name }}"></a>
                    <figure class="m-0 ratio ratio-1000x800">
                        <img src="{{ $defaultImage ? asset('public/uploads/media/products/images/' . $defaultImage) : asset('public/backend/assetss/images/products/product_thumb.jpg') }}" alt="{{ $relatedProduct->name }}">
                    </figure>
                    <div class="inf">
                      <p class="font14 m-0">{{ $relatedProduct->name }}</p>
                      <p class="font14 m-0"><strong>{{ $variantCount }}</strong> options</p>
                    </div>
                  </div>
                </div>
              @empty
              @endforelse
            @endif
          </div>
        </div>
      </div>
      <div class="swiper-nav-inline">
        <div class="swipper_button swiper__5--prev"><span
            class="material-symbols-outlined c--blackc">arrow_back_ios_new</span></div>
        <div class="swipper_button swiper__5--next"><span
            class="material-symbols-outlined c--blackc">arrow_forward_ios</span></div>
      </div>
    </div>
  </div>
</div>
