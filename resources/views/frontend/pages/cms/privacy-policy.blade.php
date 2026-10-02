<section class="living__home-hero about_hero_banner">
  <div class="living__home-hero--media">
    <div class="swiper-slide">
      <figure>
        <img
          src="{{ !empty($page->banner_image) ? asset('public/uploads/cms_pages/' . $page->banner_image) : (!empty($page->feature_image) ? asset('public/uploads/cms_pages/' . $page->feature_image) : asset('public/frontend/assets/img/privacy-policy/banner.jpg')) }}"
          alt="{{ $page->title ?? 'Privacy Policy' }}" title="{{ $page->title ?? 'Privacy Policy' }}" class="imageFit" />
      </figure>

      <div class="txt-wrp">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="inside"></div>
              <div class="txt">
                <h1 class="font45 fw-normal mb-0 c--whitec banner_heading">
                  {{ $page->title ?? 'Privacy Policy' }}
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="privacy_Policy py-5">
  <div class="container-xxl flow-rootX2">
    {!! $page->body ?? '' !!}
  </div>
</section>

@include('frontend.includes.banners.keep-flowing')
