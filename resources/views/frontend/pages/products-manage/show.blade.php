@extends('frontend.layouts.app')
@push('styles')
{{-- <!-- Lightbox2 CSS --> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endpush

@section('title', @$title)

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