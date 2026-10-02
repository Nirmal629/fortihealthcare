@extends('frontend.layouts.app')
@push('styles')
  <style>
    .category_hero {
      width: 100%;
      overflow: hidden;
      background: #f8fafc;
    }

    .category_hero figure {
      margin: 0;
      width: 100%;
    }

    .category_hero img.category-banner-header-img {
      width: 100%;
      max-height: 420px;
      height: auto;
      object-fit: cover;
      display: block;
    }

    .category-title-wrap {
      padding-top: 1.5rem;
      margin-bottom: 0.5rem;
    }

    .category-page-main-title {
      font-size: 2.4rem;
      font-weight: 500;
      color: #111827;
      margin: 0;
      line-height: 1.2;
      letter-spacing: -0.5px;
    }

    .category-title-divider {
      border: 0;
      border-top: 1.5px solid #111827;
      opacity: 1;
      margin: 12px 0 16px 0;
    }

    .furniture__product_listingwrp {
      padding-top: 0.5rem;
      padding-bottom: 3rem;
    }

    @media (max-width: 768px) {
      .category_hero img.category-banner-header-img {
        max-height: 240px;
      }
      .category-page-main-title {
        font-size: 1.8rem;
      }
    }
  </style>
@endpush

@section('title', @$title ?? ($category->title ?? 'Category'))

@section('content')
  @php
    $bannerImage = null;
    if (!empty($category->category_image)) {
        $bannerImage = asset('public/uploads/categories/' . $category->category_image);
    } elseif (!empty($category->parent?->category_image)) {
        $bannerImage = asset('public/uploads/categories/' . $category->parent->category_image);
    } elseif (!empty($productListingBanner) && isset($productListingBanner->settings)) {
        $bannerSettings = json_decode($productListingBanner->settings, true);
        if (!empty($bannerSettings['image'])) {
            $bannerImage = asset(config('defaults.banner_image_path', 'public/uploads/banners/') . $bannerSettings['image']);
        }
    }
  @endphp

  {{-- Admin Uploaded Subcategory / Category Banner --}}
  @if (!auth()->guard('web')->check() && $bannerImage)
    <section class="category_hero fullBG mt-0 p-0">
      <div class="container-fluid p-0">
        <div class="row m-0">
          <div class="col-lg-12 p-0">
            <figure class="m-0">
              <img src="{{ $bannerImage }}" alt="{{ $title ?? ($category->title ?? '') }}" class="w-100 img-fluid category-banner-header-img" />
            </figure>
          </div>
        </div>
      </div>
    </section>
  @endif

  <section class="furniture__product_listingwrp">
    <div class="container-xxl">
      
      {{-- Category / Subcategory Title with Divider Line as per Screenshot --}}
      <div class="row category-title-wrap">
        <div class="col-lg-12">
          <h1 class="category-page-main-title">{{ $title ?? ($category->title ?? '') }}</h1>
          <hr class="category-title-divider" />
        </div>
      </div>

      {{-- Filters / Sort Options --}}
      @include('frontend.includes.filter-buttons')

      {{-- Product Grid List (10 Products Per Page) --}}
      <div class="row">
        <div class="col-lg-12">
          @if (isset($variants) && count($variants) > 0)
            <div class="furniture--grid-4 y-axis mt-3">
              @include('frontend.includes.product-card')
            </div>
          @else
            <div class="text-center py-5 my-4">
              <div class="d-inline-flex p-4 rounded-circle bg-light mb-3">
                <span class="material-symbols-outlined text-muted" style="font-size: 48px;">inventory_2</span>
              </div>
              <h4 class="fw-semibold text-dark">No Products Found</h4>
              <p class="text-muted">There are currently no products available in this category.</p>
              <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4 py-2 mt-2">Browse All Products</a>
            </div>
          @endif
        </div>

        @if (isset($variants) && $variants instanceof \Illuminate\Pagination\LengthAwarePaginator && $variants->hasPages())
          <div class="mt-4 d-flex justify-content-center">
            {{ $variants->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        @endif
      </div>

    </div>
  </section>
@endsection
