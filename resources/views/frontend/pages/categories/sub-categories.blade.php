   @extends('frontend.layouts.app')
   @php
     $catTitle = $title ?? ($category->title ?? 'Category');
     $pageMetaTitle = !empty($category->meta_title) ? $category->meta_title : ($catTitle . ' | Fortier Healthcare PVT. LTD.');
     $pageMetaDesc = !empty($category->meta_desc) 
         ? $category->meta_desc 
         : ('Shop ' . $catTitle . ' products online at best prices from Fortier Healthcare PVT. LTD. Explore high-quality healthcare and wellness items.');
     $pageMetaKeywords = !empty($category->meta_keywords) 
         ? $category->meta_keywords 
         : ($catTitle . ', healthcare products, Fortier Healthcare');
   @endphp

   @section('title', $catTitle)
   @section('meta_title', $meta_title ?? $pageMetaTitle)
   @section('meta_description', $meta_description ?? $pageMetaDesc)
   @section('meta_keywords', $meta_keywords ?? $pageMetaKeywords)
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
