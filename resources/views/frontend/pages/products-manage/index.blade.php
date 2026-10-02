@extends('frontend.layouts.app')
@push('styles')
  {{-- <!-- Lightbox2 CSS --> --}}

  <style>
    /* .category_hero {
        width: 100%;
      }

      .category_hero .container-fluid {
        padding: 0;
      }

      .category_hero .row {
        margin: 0;
      }

      .category_hero figure {
        margin: 0;
      } */

    .category_hero img {
      width: 100%;
      height: 400px;
      object-fit: cover;
      display: block;
    }
  </style>
@endpush
@section('title', @$title)
@section('content')
  <main>
    {{-- @include('frontend.includes.listing-banner') --}}
    @php
      $settings = [];
      if (!empty($productListingBanner) && isset($productListingBanner->settings)) {
          $settings = json_decode($productListingBanner->settings, true);
      }
      //$settings = json_decode($keepFlowing->settings, true);
    @endphp

    <section class="category_hero fullBG mt-0 p-0">
      <div class="container-fluid p-0">
        <div class="row">
          <div class="col-lg-12">
            <figure class="m-0"><img
                src="{{ !empty($product->category->category_image)
                    ? asset('/public/uploads/categories/' . $product->category->category_image)
                    : asset('public/backend/assetss/images/products/product_thumb.jpg') }}"
                alt="" />
            </figure>
          </div>
        </div>
      </div>
    </section>
    <section class="furniture__product_listingwrp">
      <div class="container-xxl ">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="font45 fw-normal c--blackc">{{ $queryKeyword ?? $product ? $product->name : '' }}
            </h1>
            {{-- <p class="font18">Found: <span class="fw-bold">{{ $variants->total() ?? 0 }}</span> items</p> --}}
          </div>
        </div>
        @include('frontend.includes.list-top-slider')
        @include('frontend.includes.filter-buttons')
        <div class="row">
          <div class="col-lg-12">
            <div class="furniture--grid-4 y-axis mt-3">
              @include('frontend.includes.product-card')
            </div>
          </div>
          <div class="mt-4">
            {{ $variants->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
