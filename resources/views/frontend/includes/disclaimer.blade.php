@php
    $aboutBanner = \App\Models\CustomBanner::where('position', 'About_banners')->where('status', 1)->first();
    $aboutBannerSettings = $aboutBanner ? json_decode($aboutBanner->settings, true) : null;
@endphp

@push('styles')
<style>
  /* Home Page About Us Section Professional Typography & Spacing */
  .furniture__disclaimer.aboutus_sec {
    padding: 3.75rem 0 !important;
  }
  .furniture__disclaimer.aboutus_sec .sub_heading {
    display: inline-block;
    margin-bottom: 0.45rem !important;
    color: #f0b334 !important;
    font-size: 1.05rem !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.08em !important;
    line-height: 1.3 !important;
  }
  .furniture__disclaimer.aboutus_sec .heading {
    font-size: 2.25rem !important;
    font-weight: 800 !important;
    line-height: 1.25 !important;
    letter-spacing: -0.02em !important;
    margin-bottom: 1.1rem !important;
    color: #111827 !important;
  }
  .furniture__disclaimer.aboutus_sec .heading span,
  .furniture__disclaimer.aboutus_sec .heading strong {
    color: #f0b334 !important;
    font-weight: 800 !important;
  }
  .furniture__disclaimer.aboutus_sec .desc,
  .furniture__disclaimer.aboutus_sec .desc p,
  .furniture__disclaimer.aboutus_sec .desc .p {
    color: #4b5563 !important;
    line-height: 1.6 !important;
    font-size: 1.05rem !important;
    font-weight: 400 !important;
    margin-bottom: 0.85rem !important;
    letter-spacing: normal !important;
    overflow-wrap: break-word !important;
    word-wrap: break-word !important;
  }
  .furniture__disclaimer.aboutus_sec .desc span {
    color: inherit !important;
    line-height: inherit !important;
    font-size: inherit !important;
    margin-bottom: 0 !important;
    display: inline !important;
  }
  .furniture__disclaimer.aboutus_sec .desc p:last-child {
    margin-bottom: 0 !important;
  }
  .furniture__disclaimer.aboutus_sec .desc p:empty,
  .furniture__disclaimer.aboutus_sec .desc p:has(> br:only-child) {
    display: none !important;
  }
  .furniture__disclaimer.aboutus_sec .desc br + br {
    display: none !important;
  }
  .furniture__disclaimer.aboutus_sec .miniheading,
  .furniture__disclaimer.aboutus_sec .desc .miniheading,
  .furniture__disclaimer.aboutus_sec .desc h6 {
    display: inline-block;
    font-size: 1.15rem !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.06em !important;
    margin-top: 0.85rem !important;
    margin-bottom: 0.45rem !important;
    color: #f0b334 !important;
    line-height: 1.3 !important;
  }
  .furniture__disclaimer.aboutus_sec .about-btn-wrap {
    margin-top: 1.25rem !important;
  }
  @media (max-width: 991px) {
    .furniture__disclaimer.aboutus_sec {
      padding: 2.75rem 0 !important;
    }
    .furniture__disclaimer.aboutus_sec .heading {
      font-size: 1.85rem !important;
      line-height: 1.25 !important;
      margin-bottom: 0.9rem !important;
    }
    .furniture__disclaimer.aboutus_sec .desc,
    .furniture__disclaimer.aboutus_sec .desc p,
    .furniture__disclaimer.aboutus_sec .desc .p {
      font-size: 1rem !important;
      line-height: 1.55 !important;
      margin-bottom: 0.75rem !important;
    }
    .furniture__disclaimer.aboutus_sec .miniheading,
    .furniture__disclaimer.aboutus_sec .desc .miniheading,
    .furniture__disclaimer.aboutus_sec .desc h6 {
      font-size: 1.1rem !important;
      margin-top: 0.65rem !important;
      margin-bottom: 0.35rem !important;
    }
  }
  @media (max-width: 767px) {
    .furniture__disclaimer.aboutus_sec {
      padding: 2rem 0 !important;
    }
    .furniture__disclaimer.aboutus_sec .heading {
      font-size: 1.45rem !important;
      line-height: 1.25 !important;
      margin-bottom: 0.75rem !important;
    }
    .furniture__disclaimer.aboutus_sec .desc,
    .furniture__disclaimer.aboutus_sec .desc p,
    .furniture__disclaimer.aboutus_sec .desc .p {
      font-size: 0.95rem !important;
      line-height: 1.5 !important;
      margin-bottom: 0.65rem !important;
    }
    .furniture__disclaimer.aboutus_sec .miniheading,
    .furniture__disclaimer.aboutus_sec .desc .miniheading,
    .furniture__disclaimer.aboutus_sec .desc h6 {
      font-size: 1.05rem !important;
      margin-top: 0.55rem !important;
      margin-bottom: 0.3rem !important;
    }
  }
</style>
@endpush

<section class="furniture__disclaimer fullBG bg-- mt-0 aboutus_sec py-4 py-lg-5">
  <div class="container-xxl">
    <h4 class="sub_heading">About Us</h4>
    <h2 class="heading">{!! !empty($aboutBanner->title) ? $aboutBanner->title : 'Welcome to Our Pharmacy <span>Fortier Healthcare Pvt. Ltd.</span>' !!}</h2>
    <div class="row align-items-start gy-4 gy-lg-0">
      <div class="col-lg-7 col-md-12 col-12 flow-rootX2">
        <div class="desc">
          @if(!empty(strip_tags(trim($aboutBannerSettings['content'] ?? ''))))
            {!! $aboutBannerSettings['content'] !!}
          @else
            <p>Fortier Healthcare Pvt. Ltd. is an innovative pharmaceutical driven by commitment for delivering high quality and affordable healthcare solutions. Patient's well-being is our foremost priority, we integrate technology backed innovation. Fortier Healthcare Pvt. Ltd. established in the year 2021 and headquartered in Rajkot, Gujarat. The company has established a strong presence in ethical marketing in India's healthcare industry.</p>
            <h6 class="miniheading">Our commitment</h6>
            <p>At Fortier Healthcare Pvt. Ltd., our commitment is rooted in a deep sense of responsibility towards patients, healthcare professionals, and the communities we serve. Every product we deliver reflects our focus on uncompromising quality, thoughtful innovation, and accessibility. By adhering to the highest regulatory standards and anticipating the evolving needs of healthcare, we ensure that trust remains at the heart of every partnership. For us, commitment is not a promise-it is a constant pursuit of excellence that guides everything we do.</p>
          @endif
        </div>
        <div class="about-btn-wrap d-flex flex-wrap gap-3 mt-3">
          <a href="{{ route('cms.page', 'contact-us') }}" class="btn btn-light learnmore_btn">Get In Touch</a>
          <a href="{{ route('cms.page', 'about-us') }}" class="btn btn-dark learnmore_btn">View More</a>
        </div>
      </div>
      <div class="col-lg-5 col-md-12 col-12">
        <div class="aboutimg_wrap">
             <img
      src="{{ !empty($aboutBannerSettings['image']) ? asset('public/uploads/banners/' . $aboutBannerSettings['image']) : asset('public/frontend/assets/img/about/about.jpg') }}"
      alt="{{ !empty($aboutBanner->title) ? $aboutBanner->title : 'About Us' }}" title="{{ !empty($aboutBanner->title) ? $aboutBanner->title : 'About Us' }}" class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover imageFit" />
        </div>
      </div>
    </div>
  </div>
</section>
