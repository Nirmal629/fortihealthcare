<!-----Header------>
<?php include "includes/header.php"; ?>

<!------innerbanner---->
<section class="innerbanner_sec" style="background-image: url(assets/images/innerbanner.png);">
    <div class="cust_container">
        <div class="content">
            <h2 class="innerbanner_head">Contact Us</h2>
            <nav aria-label="breadcrumb" class="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" role="button" tabindex="0">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#" role="button" tabindex="1">demo</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>
</section>


<!------------------>
<div class="row">
    <div class="col-xl-7 col-lg-6 col-md-12 col-12">
        <div class="contactUs_sec bothSide_gap">
            <div class="cust_container">
                <div class="wraper">
                    <div class="right_wrap">
                        <h2 class="heading white">Stay <span>With us</span></h2>
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
        </div>
    </div>
    <div class="col-xl-5 col-lg-6 col-md-12 col-12">
        <div class="contactinfo_wrap bothSide_gap">
            <h2 class="heading">Contact <span>info</span></h2>
            <ul>
                <li>
                    <h6 class="head">Email:</h6>
                    <p class="desc">test125456@gmail.com</p>
                </li>
                <li>
                    <h6 class="head">Address:</h6>
                    <p class="desc">Registered Office : Akshya Nagar 1st Block 1st Cross, Rammurthy nagar, Bangalore-560016</p>
                </li>
                <li>
                    <h6 class="head">Phone:</h6>
                    <p class="desc">+91 1234567890</p>
                </li>
            </ul>
        </div>
    </div>
</div>



<!------footer------>
<?php include "includes/footer.php"; ?>