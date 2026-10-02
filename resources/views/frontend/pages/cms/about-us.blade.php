<section class="living__home-hero about_hero_banner">
  <div class="living__home-hero--media">
    <div class="swiper-slide">
      <figure>
        <img
          src="{{ !empty($page->banner_image) ? asset('public/uploads/cms_pages/' . $page->banner_image) : (!empty($page->feature_image) ? asset('public/uploads/cms_pages/' . $page->feature_image) : asset('public/frontend/assets/img/about/banner.jpg')) }}"
          alt="{{ $page->title ?? 'About Us' }}" title="{{ $page->title ?? 'About Us' }}" class="imageFit" />
      </figure>

      <div class="txt-wrp">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="inside"></div>
              <div class="txt">
                <h1 class="font45 fw-normal mb-0 c--whitec banner_heading">
                  {{ $page->title ?? 'About Us' }}
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@php
  $rawSections = json_decode($page->body, true);
  $sections = [];
  if (is_array($rawSections)) {
    foreach ($rawSections as $sec) {
      if (!empty(strip_tags(trim($sec['description'] ?? '')))) {
        $sections[] = $sec;
      }
    }
  }
@endphp

@if(count($sections) > 0)
  @foreach($sections as $index => $section)
    <section class="about_Us_dynamic modern-about-section py-4 py-lg-5 {{ $index > 0 ? 'pt-0 pt-lg-0' : '' }}">
      <div class="container-xxl py-2 py-lg-4">
        <div class="row align-items-center  gy-4 gy-lg-0 {{ $index % 2 == 1 && !empty($section['image']) ? 'flex-lg-row-reverse' : '' }}">
          <div class="{{ !empty($section['image']) ? 'col-lg-6 mb-2 mb-lg-0' : 'col-lg-12' }}">
            <div class="about-content-wrapper">
              {!! $section['description'] !!}
            </div>
          </div>
          @if(!empty($section['image']))
            <div class="col-lg-6">
              <figure class="about-image-wrapper m-0 position-relative">
                <img src="{{ asset('public/uploads/cms_pages/' . $section['image']) }}" alt="{{ $page->title ?? 'About Us' }}" class="img-fluid rounded-4 shadow-lg w-100 object-fit-cover" />
                <div class="image-accent-box"></div>
              </figure>
            </div>
          @endif
        </div>
      </div>
    </section>
  @endforeach
@elseif(!empty(strip_tags($page->body)))
  <section class="about_Us_dynamic modern-about-section py-4 py-lg-5">
    <div class="container-xxl py-2 py-lg-4">
      <div class="row align-items-center  gy-4 gy-lg-0">
        <div class="{{ !empty($page->feature_image) ? 'col-lg-6 mb-2 mb-lg-0' : 'col-lg-12' }}">
          <div class="about-content-wrapper">
            {!! $page->body !!}
          </div>
        </div>
        @if(!empty($page->feature_image))
          <div class="col-lg-6">
            <figure class="about-image-wrapper m-0 position-relative">
              <img src="{{ asset('public/uploads/cms_pages/' . $page->feature_image) }}" alt="{{ $page->title ?? 'About Us' }}" class="img-fluid rounded-4 shadow-lg w-100 object-fit-cover" />
              <div class="image-accent-box"></div>
            </figure>
          </div>
        @endif
      </div>
    </div>
  </section>
@else

<section class="welcomeText">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2 class="font56 fw-normal">Welcome to Mayuri, where we believe that every space deserves to tell a unique
          story.</h2>
      </div>
      <div class="col-lg-6">
        <p class="font24">With years of experience in the industry, we’ve cultivated a reputation for delivering
          personalized design solutions tailored to your individual needs. Whether you're furnishing a cozy apartment,
          a spacious home, or a modern office, we’re here to help you transform your space into something truly
          special.</p>
      </div>
    </div>
  </div>
</section>
<section class="yearsexprience">
  <div class="container">
    <div class="inner-content">
      <div class="count">25<em class="c--red">+</em> <span class="font25">Years Experience</span></div>
      <div class="right p-0">
        <figure class="mb-0"><img src="{{ asset('public/frontend/assets/img/about/about-us.png') }}" alt="Mayuri" title="Mayuri"
            class="" /></figure>
      </div>
    </div>
  </div>
</section>
<section class="businessExcellence">
  <div class="container flow-rootX3">
    <h3 class="font56 fw-normal">Lead the future with Mayuri, where<br> digital innovation meets business<br>
      excellence.</h3>
    <figure><img src="{{ asset('public/frontend/assets/img/about/business-excellence.jpg') }}" alt="Mayuri"
        title="Mayuri" class="" /></figure>
    <p class="font24">At Mayuri, your privacy is extremely important to us. This Privacy Policy outlines how we
      collect, use, disclose, and safeguard your personal information when you visit, interact with, or make a
      purchase from our website, <a href="https://mayuriseattle.com/" class="c--red" target="_blank">mayuriseattle.com</a>. We are committed to
      ensuring that your personal data is handled securely and in compliance with all applicable data protection laws
      and regulations.</p>
    <p class="font24">At Mayuri, your privacy is extremely important to us. This Privacy Policy outlines how we
      collect, use, disclose, and safeguard your personal information when you visit, interact with, or make a
      purchase from our website, <a href="https://mayuriseattle.com/" class="c--red" target="_blank">mayuriseattle.com</a>. We are committed to
      ensuring that your personal data is handled securely and in compliance with all applicable data protection laws
      and regulations.</p>
  </div>
</section>

@endif
