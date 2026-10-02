@extends('frontend.layouts.app')
@section('title', @$title)
@section('content')
  @if (!auth()->guard('web')->check())
    @include('frontend.includes.banners.category-banner', [
        'categoryBanner' => $categoryBanner,
    ])
  @endif
  @yield('category-content')

  {{-- @include('frontend.includes.hot_deals', [
      'hotDeals' => $categoryHotDealsBlock,
  ]) --}}

  {{-- @include('frontend.includes.slider', [
      'heading' => 'New Collections',
      'slug' => 'new-collections',
      'slugRoute' => 'category.slug',
      'listRoute' => 'category.list',
      'collections' => $productCategories,
  ]) --}}

  {{-- @include('frontend.includes.sale_block') --}}
@endsection
