{{-- backend/pages/reports/product-performance/index.blade.php --}}

@extends('backend.layouts.app')

@section('page-styles')
  <link rel="stylesheet" href="{{ asset('/public/backend/assetss/daterangepicker.css') }}">
@endsection

@section('content')
  <x-breadcrumb :pageTitle="$pageTitle" :skipLevels=[] />

  <div class="row">
    <div class="col-xl-6 col-lg-6">
      @include('backend.includes.top-products')
    </div>

    <div class="col-xl-6 col-lg-6">
      @include('backend.includes.product-revenue')
    </div>
  </div>

  <x-list-card :cardHeader="'Product Performance'" :baseRoute="'admin.departments'" :addBtnShow="false">
    <livewire:reports.product-performance-table />
  </x-list-card>
@endsection

@section('page-scripts')
  <script src="{{ asset('/public/backend/assetss/js/moment.min.js') }}"></script>
  <script src="{{ asset('/public/backend/assetss/js/daterangepicker.js') }}"></script>
@endsection
