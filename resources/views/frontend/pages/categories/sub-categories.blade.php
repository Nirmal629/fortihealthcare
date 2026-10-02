   @extends('frontend.layouts.app')
   @section('title', @$title)
   @section('content')
     @if (!auth()->guard('web')->check())
       @include('frontend.includes.banners.category-banner', [
           'categoryBanner' => $categoryBanner,
       ])
     @endif
     @include('frontend.includes.category_slider', [
         'categories' => $childCategories,
         'categoryHeadlineBanner' => $categoryHeadlineBanner,
     ])

     {{-- @include('frontend.includes.hot_deals', [
         'hotDeals' => $categoryHotDealsBlock,
     ]) --}}
   @endsection
