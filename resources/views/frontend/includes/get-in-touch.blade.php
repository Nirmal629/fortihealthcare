<section class="contactUs_sec custom-get-in-touch py-4 py-lg-5" id="getintouchId">
    <div class="container-xxl">
        <div class="row align-items-center gy-4 gy-lg-0">
            <!-- Left side image -->
            <div class="col-lg-5 col-md-12 text-center text-lg-start">
                <div class="image-wrapper">
                    <img src="{{ asset('public/frontend/assets/img/home/hero_banner.png.Png') }}" alt="Contact Us" class="img-fluid rounded-4 shadow-sm" style="max-height: 420px; ">
                </div>
            </div>
            <!-- Right side form -->
            <div class="col-lg-7 col-md-12">
                <div class="form-wrapper">
                    <h2 class="form-heading">Get In <span>Touch</span></h2>
                    <form action="#" method="post">
                        <div class="form-group mb-3">
                            <label for="yourName">Your Name :</label>
                            <input type="text" class="form-control custom-input" id="yourName" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="emailAddress">Email address :</label>
                            <input type="email" class="form-control custom-input" id="emailAddress" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phoneNumber">Phone Number :</label>
                            <input type="number" class="form-control custom-input" id="phoneNumber" placeholder="Enter phone number" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="Entermessage">Message :</label>
                            <textarea class="form-control custom-input" id="Entermessage" rows="4" placeholder="Message....." required></textarea>
                        </div>
                        <button type="submit" class="btn custom-submit-btn learnmore_btn">Submit Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
