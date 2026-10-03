@extends('frontend.layouts.app')

@section('title', @$title)

@section('content')

  @include('frontend.includes.banners.offer-slider')
  <main>
    @include('frontend.includes.banners.main-slider')
     @if ($showDisclaimer ?? true)
    @include('frontend.includes.disclaimer')
  @endif
   {{--@include('frontend.includes.banners.furniture-category')--}}
     {{--@include('frontend.includes.banners.block-wrap')--}}
     {{--@include('frontend.includes.banners.brand-slider')--}}
    {{-- @include('frontend.includes.banners.brand-slider') // Remove for Grocery --}}
    {{-- @include('frontend.includes.banners.furniture-contemporary')--}}
    {{-- @include('frontend.includes.banners.furniture-sale-block')--}}

   {{-- @include('frontend.includes.slider', [
        'heading' => 'Todays Deals',
        'slug' => '',
        'collections' => $productCategories,
        'defaultCategory' => $productCategories->first()->slug ?? '',
        'slugRoute' => 'category.slug',
        'listRoute' => 'category.list',
        'options' => true,
    ])--}}

    {{-- <section class="furniture__book_collection_wrp">
      <div class="container-xxl">
        <div class="row">
          <div class="col-lg-12 flow-rootX3">
            <div class="header">
              <h3 class="font45 fw-normal"><a href="javascript:void();" title="Book From this Collections">Book From this
                  Collections</a></h3>
              <h4 class="font35 fw-normal">Your Mayuri Room, Reimagined with Sophistication</h4>
            </div>
            <div class="imagewrp">
              <figure><img src="{{ asset('public/frontend/assets/img/home/book_collection.jpg') }}" alt="Mayuri"
                  title="Mayuri" class="imageFit" />
              </figure>
              <div class="iconswrp one">
                <a href="javascript:void();" title="Table">
                  <div class="point"></div>
                </a>
                <div class="info flow-rootX">
                  <a href="javascript:void();" title=""></a>
                  <h5 class="font20 m-0">Green Elegant Table</h5>
                  <div class="price c--primary font20">$1500 <span
                      class="material-symbols-outlined">arrow_forward_ios</span></div>
                </div>
              </div>
              <div class="iconswrp two">
                <a href="javascript:void();" title="Sofa">
                  <div class="point"></div>
                </a>
                <div class="info flow-rootx">
                  <a href="javascript:void();" title=""></a>
                  <h5 class="font20 m-0">Green Elegant Sofa</h5>
                  <div class="price c--primary font20">$3000 <span
                      class="material-symbols-outlined">arrow_forward_ios</span></div>
                </div>
              </div>
              <div class="iconswrp three">
                <a href="javascript:void();" title="Chair">
                  <div class="point"></div>
                </a>
                <div class="info flow-rootx">
                  <a href="javascript:void();" title=""></a>
                  <h5 class="font20 m-0">Cream Elegant Chair</h5>
                  <div class="price c--primary font20">$2000 <span
                      class="material-symbols-outlined">arrow_forward_ios</span></div>
                </div>
              </div>
              <div class="iconswrp four">
                <a href="javascript:void();" title="Lamp">
                  <div class="point"></div>
                </a>
                <div class="info flow-rootx">
                  <a href="javascript:void();" title=""></a>
                  <h5 class="font20 m-0">Black Side Lamp Shade</h5>
                  <div class="price c--primary font20">$1000 <span
                      class="material-symbols-outlined">arrow_forward_ios</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}


     {{--@if ($recentlyViewedPrtoducts->count() > 0)
      @include('frontend.pages.home.recently-viewed-products')
    @endif--}}


     {{--@include('frontend.includes.banners.keep-flowing')--}}

    @include('frontend.includes.featured-category-slider', ['category' => $featuredCategory ?? null])

    @include('frontend.includes.get-in-touch')

    @include('frontend.includes.banners.subscribe')
    {{-- @include('frontend.includes.banners.showrooms') --}}
  </main>
@endsection

@push('styles')
<style>
  /* Global Home Page Button Styles */
  main .btn,
  .living__home-hero--media .txt-wrp .btn-light,
  .living__home-hero--media .txt-wrp .custom-submit-btn {
    background-color: #f0b334 !important;
    color: #ffffff !important;
    position: relative;
    border: 1px solid transparent !important;
    transition: all 0.5s !important;
    z-index: 1;
    overflow: hidden;
    padding: 10px 50px 10px 20px !important;
  }

  main .btn::before,
  .living__home-hero--media .txt-wrp .btn-light::before,
  .living__home-hero--media .txt-wrp .custom-submit-btn::before {
    content: "";
    background-color: #ffffff;
    position: absolute;
    z-index: -1;
    left: -20%;
    right: -20%;
    top: 0;
    bottom: 0;
    transform: skewX(-45deg) scale(0, 1);
    transition: all 0.5s;
  }

  main .btn:hover::before,
  .living__home-hero--media .txt-wrp .btn-light:hover::before,
  .living__home-hero--media .txt-wrp .custom-submit-btn:hover::before {
    transform: skewX(-45deg) scale(1, 1);
  }

  main .btn:hover,
  .living__home-hero--media .txt-wrp .btn-light:hover,
  .living__home-hero--media .txt-wrp .custom-submit-btn:hover {
    color: #f0b334 !important;
    border-color: #f0b334 !important;
  }

  /* Custom Subscribe Button: Same to same design with equal left & right padding */
  .custom-subscribe-btn,
  main .custom-subscribe-btn {
    padding: 10px 25px !important;
    border-radius: 50rem !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .custom-subscribe-btn::after,
  main .custom-subscribe-btn::after {
    display: none !important;
  }
</style>
@endpush

@push('scripts')
  <script>
    $(document).ready(function() {
      const speed = $('.marquee').data('speed') || 30000; // fallback to 30 seconds

      $('.marquee').marquee({
        direction: 'left',
        duration: speed,
        gap: 0,
        delayBeforeStart: 0,
        duplicated: true,
        pauseOnHover: true
      });
    });
  </script>
@endpush
