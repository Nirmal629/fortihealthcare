<?php
    $aboutBanner = \App\Models\CustomBanner::where('position', 'About_banners')->where('status', 1)->first();
    $aboutBannerSettings = $aboutBanner ? json_decode($aboutBanner->settings, true) : null;
?>

<section class="furniture__disclaimer fullBG bg-- mt-0 aboutus_sec py-4 py-lg-5">
  <div class="container-xxl">
    <h4 class="sub_heading">About Us</h4>
    <h2 class="heading"><?php echo !empty($aboutBanner->title) ? $aboutBanner->title : 'Welcome to Our Pharmacy <span>Fortier Healthcare Pvt. Ltd.</span>'; ?></h2>
    <div class="row align-items-start gy-4 gy-lg-0">
      <div class="col-lg-7 col-md-12 col-12 flow-rootX2">
        <?php if(!empty(strip_tags(trim($aboutBannerSettings['content'] ?? '')))): ?>
            <div class="desc">
                <?php echo $aboutBannerSettings['content']; ?>

            </div>
        <?php else: ?>
            <p class="desc">Fortier healthcare Pvt. Ltd. Is an innovative pharmaceutical driven by commitment for delivering high quality and affordable healthcare solutions. Patient's well-being is our foremost priority, we integrate technology backed innovation . Fortier healthcare pvt ltd established in the year 2021 and headquartered in Rajkot, Gujarat . The company has established a strong presence in ethical marketing in India's healthcare industry.</p>
            <h6 class="miniheading">Our commitment</h6>
            <p class="desc">At Fortier Healthcare Pvt. Ltd., our commitment is rooted in a deep sense of responsibility towards patients, healthcare professionals, and the communities we serve. Every product we deliver reflects our focus on uncompromising quality, thoughtful innovation, and accessibility. By adhering to the highest regulatory standards and anticipating the evolving needs of healthcare, we ensure that trust remains at the heart of every partnership. For us, commitment is not a promise-it is a constant pursuit of excellence that guides everything we do.</p>
        <?php endif; ?>
        <div class="about-btn-wrap d-flex flex-wrap gap-3 mt-3">
          <a href="<?php echo e(route('cms.page', 'contact-us')); ?>" class="btn btn-light learnmore_btn">Get In Touch</a>
          <a href="<?php echo e(route('cms.page', 'about-us')); ?>" class="btn btn-dark learnmore_btn">View More</a>
        </div>
      </div>
      <div class="col-lg-5 col-md-12 col-12">
        <div class="aboutimg_wrap">
             <img
      src="<?php echo e(!empty($aboutBannerSettings['image']) ? asset('public/uploads/banners/' . $aboutBannerSettings['image']) : asset('public/frontend/assets/img/about/about.jpg')); ?>"
      alt="<?php echo e(!empty($aboutBanner->title) ? $aboutBanner->title : 'About Us'); ?>" title="<?php echo e(!empty($aboutBanner->title) ? $aboutBanner->title : 'About Us'); ?>" class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover imageFit" />
        </div>
      </div>
    </div>
  </div>
</section>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/disclaimer.blade.php ENDPATH**/ ?>