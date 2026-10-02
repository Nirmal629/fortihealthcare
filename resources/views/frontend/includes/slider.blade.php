@props([
    'heading' => 'Collections',
    'options' => true,
    'slug' => '',
    'collections' => [],
    'defaultCategory' => null,
])

<section class="furniture__products_scroller_wrap flow-rootX3">
  <div class="container-xxl">
    <div class="row">
      <div class="col-lg-4">
        <h2 class="fw-normal m-0 font45 c--blackc">{{ $heading }}</h2>
      </div>

      @if ($options)
        <div class="col-lg-8">
          <div class="filterswrap gap-4 d-flex align-items-center justify-content-end">
            <div class="filterblocks d-flex gap-4">

              @foreach ($collections as $collection)
                <a href="#" class="group-filter {{ $collection->slug === $defaultCategory ? 'active' : '' }}"
                  data-category="{{ $collection->slug }}">
                  {{ $collection->title }}
                </a>
              @endforeach

            </div>

            <a href="#" class="btn btn-outline-dark" title="View Collections">
              View Collections
            </a>
          </div>
        </div>
      @endif
    </div>
  </div>

  <div class="container-xxl">
    <div class="swiperwrp">
      <div class="swiper swiper__new">
        <div class="swiper-wrapper eq-height" id="product-scroller"></div>
      </div>

      <div class="error-message" style="display:none;color:#dc3545;text-align:center;margin-top:1rem;">
      </div>
    </div>
  </div>
</section>

@push('styles')
  <style>
    #product-scroller.loading-overlay {
      position: relative;
      min-height: 300px;
    }

    #product-scroller.loading-overlay::after {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(255, 255, 255, 0.7);
      z-index: 20;
    }

    .product-card.loading {
      position: relative;
      opacity: 0.7;
    }

    .product-card.loading::after {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(255, 255, 255, 0.7);
      z-index: 10;
    }

    .group-filter.active {
      color: #000;
      text-decoration: underline;
    }
  </style>
@endpush

@push('scripts')
  <script>
    (function($) {

      const config = {
        urls: {
          collections: '{{ route('home.collections') }}',
          variantDetails: '{{ route('home.getVariantDetails') }}'
        },
        defaultCategory: '{{ $defaultCategory }}'
      };

      let swiper;

      function initSwiper() {
        const $wrapper = $('#product-scroller');
        const totalSlides = $wrapper.find('.swiper-slide').length;

        const breakpoints = {
          0: {
            slidesPerView: 1.2
          },
          768: {
            slidesPerView: 2.5
          },
          992: {
            slidesPerView: 3
          },
          1200: {
            slidesPerView: 4.5
          }
        };

        const slidesPerView = Object.keys(breakpoints).reduce(
          (acc, bp) => window.innerWidth >= bp ? breakpoints[bp].slidesPerView : acc,
          4
        );

        const enableSwiper = totalSlides > slidesPerView;

        if (swiper) {
          swiper.destroy(true, true);
          swiper = null;
        }

        swiper = new Swiper('.swiper__new', {
          loop: enableSwiper,
          slidesPerView,
          spaceBetween: 20,
          allowTouchMove: enableSwiper,
          breakpoints,
          autoplay: enableSwiper ? {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
          } : false
        });
      }

      function fetchProducts(categorySlug) {
        const $wrapper = $('#product-scroller').addClass('loading-overlay');
        const $error = $('.error-message').hide();

        swiper && (swiper.allowSlideNext = swiper.allowSlidePrev = swiper.allowTouchMove = false);

        $.get(config.urls.collections, {
            category_slug: categorySlug,
            excludeProductId: `{{ isset($productVariant) ? Hashids::encode($productVariant->product_id) : '' }}`
          })
          .done(response => {
            $wrapper.empty().append(response);
            initSwiper();
          })
          .fail(() => {
            $error.text('Failed to load products. Try again.').show();
          })
          .always(() => {
            $wrapper.removeClass('loading-overlay');
            swiper && (swiper.allowSlideNext = swiper.allowSlidePrev = swiper.allowTouchMove = true);
          });
      }

      class ProductCardUpdater {
        constructor($card) {
          this.$card = $card;
        }

        update(variant) {
          const {
            name,
            url,
            value,
            image,
            image_name,
            sale_price,
            regular_price,
            discount_percent,
            isDiscount,
            in_cart,
            isOutOfStock
          } = variant;

          this.$card.find('.tag.out-of-stock, .tag.primary').remove();
          this.$card.find('.price').empty();

          const $showingbag = this.$card.find('.showingbag');
          const $btn = $showingbag.find('a.add-to-cart-btn');

          this.$card.find('.dot-loader-btn').remove();

          if (isOutOfStock || in_cart) {
            $showingbag.addClass('d-none');
          } else {
            $showingbag.removeClass('d-none');
            $btn.prop('disabled', false)
              .html('<span class="material-symbols-outlined">local_mall</span>')
              .attr('title', 'Add To Cart')
              .show();
          }

          this.$card.find('.product_name h3 a').text(name);
          this.$card.find('.details_link').attr('href', url);
          this.$card.find('form input[name="product_variant_id"]').val(value);
          $btn.attr('data-id', value);

          this.$card.find('img.product-image').attr({
            alt: image_name,
            src: image
          });

          if (isOutOfStock) {
            this.$card.find('.main-image-wrap').prepend(
              `<div class="tag out-of-stock font12">Out of Stock</div>`
            );
            this.$card.find('.price').html(`<span class="text-danger">Currently Unavailable</span>`);
          }

          if (isDiscount && sale_price) {
            this.$card.find('.price').html(
              `${sale_price}<span class="old-price ms-2">${regular_price}</span>`
            );
            this.$card.find('.main-image-wrap').prepend(
              `<div class="tag primary font12">${discount_percent} Off</div>`
            );
          } else {
            this.$card.find('.price').html(regular_price || sale_price || '');
          }
        }
      }

      $(document).ready(function() {

        initSwiper();

        let defaultCategory = config.defaultCategory;

        if (!defaultCategory) {
          defaultCategory = $('.group-filter').first().data('category');
        }

        $('.group-filter')
          .removeClass('active')
          .filter(`[data-category="${defaultCategory}"]`)
          .addClass('active');

        fetchProducts(defaultCategory);

        $('.group-filter').on('click', function(e) {
          e.preventDefault();

          const category = $(this).data('category');

          $('.group-filter').removeClass('active');
          $(this).addClass('active');

          fetchProducts(category);
        });

        $(window).resize(initSwiper);

        $(document).on('click', '.color-option .circle', async function() {
          const $circle = $(this);
          const $card = $circle.closest('.product-card').addClass('loading');

          try {
            const res = await $.get(config.urls.variantDetails, {
              variant_id: $circle.parent().data('variant-id'),
              color: $circle.data('color')
            });

            if (res.success) {
              new ProductCardUpdater($card).update(res.variant);
            }
          } catch {
            $('.error-message').text('Variant load failed').show();
          } finally {
            $card.removeClass('loading');
          }
        });

      });

    })(jQuery);
  </script>
@endpush
