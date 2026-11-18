




<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
@php
  $headMetaTitle = trim($__env->yieldContent('meta_title', $meta_title ?? ''));
  if (empty($headMetaTitle)) {
      $rawTitle = trim($__env->yieldContent('title', $title ?? ''));
      if (str_contains($rawTitle, 'Fortier Healthcare')) {
          $headMetaTitle = $rawTitle;
      } else {
          $headMetaTitle = $rawTitle !== '' ? ($rawTitle . ' | Fortier Healthcare PVT. LTD.') : 'Fortier Healthcare PVT. LTD.';
      }
  }

  $headMetaDesc = trim($__env->yieldContent('meta_description', $meta_description ?? ($meta_desc ?? '')));
  if (empty($headMetaDesc)) {
      $headMetaDesc = 'Fortier Healthcare PVT. LTD. - Quality healthcare, medical supplies, and wellness products online.';
  }

  $headMetaKeywords = trim($__env->yieldContent('meta_keywords', $meta_keywords ?? ''));
@endphp
<meta name="keywords" content="{{ strip_tags($headMetaKeywords) }}">
<meta name="description" content="{{ strip_tags($headMetaDesc) }}">
<meta property="og:title" content="{{ strip_tags($headMetaTitle) }}">
<meta property="og:description" content="{{ strip_tags($headMetaDesc) }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">

<link rel="shortcut icon" href="{{ asset('public/favicon.ico') }}">
<link rel="icon" type="image/png" sizes="16x16"
  href="{{ asset('public/frontend/assets/img/favicon/favicon-16x16.png') }}?v={{ filemtime(public_path('frontend/assets/img/favicon/favicon-16x16.png')) }}">
<link rel="icon" type="image/png" sizes="32x32"
  href="{{ asset('public/frontend/assets/img/favicon/favicon-32x32.png') }}?v={{ filemtime(public_path('frontend/assets/img/favicon/favicon-32x32.png')) }}">
<link rel="icon" type="image/png" sizes="48x48"
  href="{{ asset('public/frontend/assets/img/favicon/favicon-48x48.png') }}?v={{ filemtime(public_path('frontend/assets/img/favicon/favicon-48x48.png')) }}">
<link rel="apple-touch-icon" sizes="180x180"
  href="{{ asset('public/frontend/assets/img/favicon/apple-touch-icon.png') }}?v={{ filemtime(public_path('frontend/assets/img/favicon/apple-touch-icon.png')) }}">
<!-- Libraries Stylesheet -->
<link href="{{ asset('public/frontend/assets/lib/swiper@9/swiper-bundle.min.css') }}" rel="stylesheet">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
  rel="stylesheet">

<!-- Material Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
  rel="stylesheet">
<link href="{{ asset('/public/backend/assetss/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Bootstrap Css -->
<link href="{{ asset('public/frontend/assets/lib/bootstrap.css') }}" rel="stylesheet">

<!-- Template Stylesheet -->
<link
  href="{{ asset('public/frontend/assets/dart-scss/style.css') }}?ver={{ filemtime(public_path('frontend/assets/dart-scss/style.css')) }}"
  rel="stylesheet">

<link rel="stylesheet" href="{{ asset('/public/backend/assetss/intlTelInput/intlTelInput.min.css') }}">
<style>
  .iti {
    width: 100%;
  }

  .iti input {
    width: 100%;
    padding: 10px;
  }
</style>
