@extends('frontend.layouts.category')
@section('title', @$title ?? 'All Categories')
@section('meta_title', $meta_title ?? 'All Categories | Fortier Healthcare PVT. LTD.')
@section('meta_description', $meta_description ?? 'Explore all healthcare, medical supplies, and wellness product categories at Fortier Healthcare PVT. LTD. Find high-quality products for all your healthcare needs.')
@section('meta_keywords', $meta_keywords ?? 'categories, healthcare categories, medical products, wellness products, healthcare supplies, Fortier Healthcare')
@section('category-content')
  @include('frontend.includes.category_slider', [
      'categories' => $popularCategories,
      'categoryHeadlineBanner' => $categoryHeadlineBanner,
  ])
@endsection
