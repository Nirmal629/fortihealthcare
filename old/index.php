<!-----Header------>
<?php include "includes/header.php";
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$version = date('Y-m-d h:i:s');

header("Location: index.php?v=$version");

?>

<!------Home-banner-------->
<section class="homebanner_sec bottomSide_gap">
    <div class="banner_image herobanner_slider">
        <div class="item">
            <div class="item_img">
                <img src="assets/images/hero_banner.png.png" class="img-fluid" alt="banner-image" />
            </div>
            <div class="cust_container">
                <div class="banner_content">
                    <div class="wrapper middleleft" data-aos="fade-right" data-aos-duration="2000">
                        <h1 class="heading banner_heading">Good Health Can’t wait</h1>
                        <p class="bannerdesc desc">At Fortier Healthcare Pvt. Ltd., we believe that access to quality healthcare should never be delayed. Our mission is to deliver trusted pharmaceutical solutions quickly, safely, and efficiently—because your good health can’t wait.</p>

                        <div class="button_wrap">
                            <a href="#getintouchId" class="btn learnmore_btn">Get In Touch</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="item">
            <div class="item_img">
                <img src="assets/images/hero_banner.png.png" class="img-fluid" alt="banner-image" />
            </div>
            <div class="cust_container">
                <div class="banner_content ">
                    <div class="wrapper middlecenter" data-aos="fade-up" data-aos-duration="2000">
                        <h1 class="heading banner_heading">Good Health Can’t wait</h1>
                        <p class="bannerdesc desc">At Fortier Healthcare Pvt. Ltd., we believe that access to quality healthcare should never be delayed. Our mission is to deliver trusted pharmaceutical solutions quickly, safely, and efficiently—because your good health can’t wait.</p>

                        <div class="button_wrap">
                            <a href="#getintouchId" class="btn learnmore_btn">Get In Touch</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="item_img">
                <img src="assets/images/hero_banner.png.png" class="img-fluid" alt="banner-image" />
            </div>
            <div class="cust_container">
                <div class="banner_content ">
                    <div class="wrapper middleright" data-aos="fade-left" data-aos-duration="2000">
                        <h1 class="heading banner_heading">Good Health Can’t wait</h1>
                        <p class="bannerdesc desc">At Fortier Healthcare Pvt. Ltd., we believe that access to quality healthcare should never be delayed. Our mission is to deliver trusted pharmaceutical solutions quickly, safely, and efficiently—because your good health can’t wait.</p>

                        <div class="button_wrap">
                            <a href="#getintouchId" class="btn learnmore_btn">Get In Touch</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>

<!----About-us---------->
<section class="aboutus_sec bothSide_gap">
    <div class="cust_container">
                <h4 class="sub_heading">About Us</h4>
                <h2 class="heading">Welcome to Our Pharmacy <span>Fortier Healthcare Pvt. Ltd.</span></h2>
        <div class="row">
            <div class="col-lg-7 col-md-12 col-12">
                <p class="desc">Fortier healthcare Pvt. Ltd. Is an innovative pharmaceutical driven by commitment for delivering high quality and affordable healthcare solutions. Patient’s well-being is our
foremost priority, we integrate technology backed innovation . Fortier healthcare pvt ltd established in the year 2021 and headquartered in Rajkot, Gujarat . The company has established a strong presence in ethical marketing in India’s healthcare industry.</p>
               <h6 class="miniheading">Our commitment</h6>
                <p class="desc">At Fortier Healthcare Pvt. Ltd., our commitment is rooted in a deep sense of responsibility towards patients, healthcare professionals, and the communities we serve. Every product we deliver reflects our focus on uncompromising quality, thoughtful</p>
                <p class="desc">innovation, and accessibility. By adhering to the highest regulatory standards and anticipating the evolving needs of healthcare, we ensure that trust remains at the heart of every partnership. For us, commitment is not a promise—it is a constant pursuit of
excellence that guides everything we do.</p>
                <a href="#getintouchId" class="btn learnmore_btn">Get In Touch</a>
            </div>
            <div class="col-lg-5 col-md-12 col-12 m-auto">
                <div class="aboutimg_wrap">
                    <img src="assets/images/about.jpg" class="img-fluid" loading="lazy" alt="image..." />
                </div>
            </div>
        </div>
    </div>
</section>

<!-----product-sec------->
<section class="product_sec bothSide_gap">
    <div class="cust_container">
        <h4 class="sub_heading">Our Product</h4>
        <div class="sectionheading_wrap">
            <h2 class="heading">Delivering Health, One <span>Product at a Time</span></h2>
            <a href="all-product.php" class="learnmore_btn btn">View All</a>
        </div>

        <div class="productlist_wrap">
            <div class="product_box">
                <div class="product_img">
                    <img src="assets/images/product/product-jpeg-500x500.webp" class="img-fluid" alt="logo.." />
                </div>
                <div class="details">
                    <h4 class="name">ANASTRON 1mg Tablets IP</h4>
                    <p class="desc">It is used with other treatments such as surgery or radiation to treat breast cancer in women who have attained menopause.</p>
                </div>
            </div>
            <div class="product_box">
                <div class="product_img">
                    <img src="assets/images/product/MANKIND.png" class="img-fluid" alt="logo.." />
                </div>
                <div class="details">
                    <h4 class="name">Mankind</h4>
                    <p class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
            <div class="product_box">
                <div class="product_img">
                    <img src="assets/images/product/MANKIND.png" class="img-fluid" alt="logo.." />
                </div>
                <div class="details">
                    <h4 class="name">Mankind</h4>
                    <p class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
            <div class="product_box">
                <div class="product_img">
                    <img src="assets/images/product/MANKIND.png" class="img-fluid" alt="logo.." />
                </div>
                <div class="details">
                    <h4 class="name">Mankind</h4>
                    <p class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
            <div class="product_box">
                <div class="product_img">
                    <img src="assets/images/product/MANKIND.png" class="img-fluid" alt="logo.." />
                </div>
                <div class="details">
                    <h4 class="name">Mankind</h4>
                    <p class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!------contact-Us--------->
<section class="contactUs_sec bothSide_gap" id="getintouchId">
    <div class="cust_container">
        <div class="wraper">
            <div class="right_wrap">
                <h2 class="heading white">Get In <span>Touch</span></h2>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="yourName" class="text-white">Your Name :</label>
                        <input type="text" class="form-control" id="yourName" aria-describedby="nameHelp" placeholder="Enter your name" required="">
                    </div>
                    <div class="form-group">
                        <label for="emailAddress" class="text-white">Email address :</label>
                        <input type="email" class="form-control" id="emailAddress" aria-describedby="emailHelp" placeholder="Enter your email" required="">
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber" class="text-white">Phone Number :</label>
                        <input type="number" class="form-control" id="phoneNumber" placeholder="Enter phone number" required="">
                    </div>
                    <div class="form-group">
                        <label for="Entermessage" class="text-white">Message :</label>
                        <textarea class="form-control" id="Entermessage" rows="3" placeholder="Message....."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!------footer------>
<?php include "includes/footer.php"; ?>
