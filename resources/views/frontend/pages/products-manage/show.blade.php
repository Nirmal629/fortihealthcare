@extends('frontend.layouts.app')
@push('styles')
{{-- <!-- Lightbox2 CSS --> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<style>
  /* Prevent horizontal scroll on Product Details Page */
  html, body {
    overflow-x: hidden;
  }

  .product-details-page-section {
    width: 100% !important;
    max-width: 100% !important;
    overflow-x: clip !important;
    box-sizing: border-box !important;
  }

  .product-details-grid-wrapper {
    display: grid !important;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) !important;
    gap: 36px !important;
    align-items: start !important;
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
  }

  .product-details-gallery-col,
  .product-details-info-col {
    min-width: 0 !important;
    max-width: 100% !important;
    width: 100% !important;
    box-sizing: border-box !important;
  }

  .product-details-slider-wrap,
  .modern_product_gallery_card,
  .modern_product_info_card {
    min-width: 0 !important;
    max-width: 100% !important;
    width: 100% !important;
    box-sizing: border-box !important;
    overflow: hidden !important;
  }

  .modern_main_slider,
  .modern_thumbs_slider {
    min-width: 0 !important;
    max-width: 100% !important;
    width: 100% !important;
    box-sizing: border-box !important;
    overflow: hidden !important;
  }

  .modern_main_slider .swiper-wrapper,
  .modern_thumbs_slider .swiper-wrapper {
    box-sizing: border-box !important;
  }

  .modern_product_info_card * {
    max-width: 100%;
  }

  .modern-product-title,
  .modern-product-desc {
    overflow-wrap: break-word !important;
    word-wrap: break-word !important;
    word-break: break-word !important;
  }

  .modern-trust-badges-row {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)) !important;
    gap: 12px !important;
    width: 100% !important;
    box-sizing: border-box !important;
  }

  .modern-pincode-input-group {
    display: grid !important;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) !important;
    gap: 12px !important;
    width: 100% !important;
    box-sizing: border-box !important;
  }

  .modern-buy-actions-grid {
    display: grid !important;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) !important;
    gap: 14px !important;
    width: 100% !important;
    box-sizing: border-box !important;
  }

  .modern-product-accordion {
    width: 100% !important;
    box-sizing: border-box !important;
  }

  .modern-product-accordion .accordion-body {
    overflow-wrap: break-word !important;
    word-wrap: break-word !important;
    word-break: break-word !important;
    overflow-x: auto !important;
  }

  .modern-product-accordion .accordion-body table {
    max-width: 100% !important;
  }

  @media (max-width: 991px) {
    .product-details-grid-wrapper {
      grid-template-columns: minmax(0, 1fr) !important;
      gap: 24px !important;
    }

    .product-details-gallery-col {
      position: static !important;
    }

    .modern_product_info_card {
      padding: 20px !important;
    }

    .modern-buy-actions-grid {
      grid-template-columns: minmax(0, 1fr) !important;
    }
  }

  @media (max-width: 576px) {
    .product-details-page-section {
      padding-top: 1rem !important;
      padding-bottom: 1rem !important;
    }

    .modern_product_gallery_card {
      padding: 12px !important;
      border-radius: 16px !important;
    }

    .modern_product_info_card {
      padding: 16px !important;
      border-radius: 16px !important;
    }

    .modern-pincode-input-group {
      grid-template-columns: minmax(0, 1fr) !important;
    }

    .modern-trust-badges-row {
      grid-template-columns: minmax(0, 1fr) !important;
      gap: 10px !important;
    }
  }
</style>
@endpush

@php
  $productName = $title ?? ($productVariant->name ?? ($productVariant->product->name ?? 'Product Details'));
  $rawDesc = $productVariant->product->description ?? ($productVariant->product->product_details ?? '');
  $cleanDesc = trim(preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($rawDesc, ENT_QUOTES, 'UTF-8'))));
  $fallbackDesc = !empty($cleanDesc) 
      ? \Illuminate\Support\Str::limit($cleanDesc, 160) 
      : ('Buy ' . $productName . ' online at best price from Fortier Healthcare PVT. LTD. Fast pan-India delivery on healthcare and wellness products.');
  $fallbackTitle = $productName . ' | Fortier Healthcare PVT. LTD.';
  $categoryTitle = $category->title ?? ($productVariant->category->title ?? '');
  $fallbackKeywords = implode(', ', array_filter([$productName, $categoryTitle, 'Fortier Healthcare', 'buy online', 'healthcare']));
@endphp

@section('title', $productName)
@section('meta_title', $meta_title ?? $fallbackTitle)
@section('meta_description', $meta_description ?? $fallbackDesc)
@section('meta_keywords', $meta_keywords ?? $fallbackKeywords)

@section('content')
@include('frontend.includes.breadcrumb')

<section class="product-details-page-section py-4">
  <div class="container-xxl">
    <div class="product-details-grid-wrapper">
      <div class="product-details-gallery-col">
        @include('frontend.includes.image-slide')
      </div>
      <div class="product-details-info-col">
        @include('frontend.includes.product-buy')
      </div>
    </div>
  </div>
</section>
@endsection

@push('component-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
$(document).ready(function() {
  $(document).on('click', '.po-items', function() {
    window.location.href = $(this).data('url');
  });

  $('.buy-now-btn').on('click', function() {
    const id = $(this).data('id');
    let serial = $(this).data('serial');
    $('#buy-now-form-' + serial).submit();
  });
});
</script>
@endpush