<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$version = date('Y-m-d h:i:s'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header-links.php"; ?>
</head>

<body>
    <!------Main Header------->
    <section class="main_header" id="main_Header">
        <div class="cust_container">
            <div class="wraper">

                <a href="index.php?v=<?=$version?>">
                    <!-- <figure class="Logo_area m-0">
                        <img src="assets/images/logo/logo.png" class="img-fluid" alt="logo" />
                    </figure> -->
                    <h4 class="logotext" style="font-weight: 600; text-align: center; margin: 0;">
                        Fortier <br /> Healthcare Pvt. Ltd.
                    </h4>
                </a>

                <div class="menubar_box">

                    <div class="top_area">
                        <!-- <a href="index.php" class="Logo_area btn">
                            <img src="assets/images/logo/logo.png" class="img-fluid" alt="logo" />
                        </a> -->
                        <h4 class="logotext" style="font-weight: 600;  margin: 0; color: #fff;">
                            Fortier <br /> Healthcare Pvt. Ltd.
                        </h4>
                    </div>

                    <ul class="navber_wrap">
                        <li class="current-menu-item"><a href="index.php" class="nav_link btn">Home</a></li>
                        <li><a href="about-us.php" class="nav_link btn">About Us</a></li>
                        <li><a href="javascript:void(0)" class="nav_link btn">Services</a>
                            <span class="icon"></span>
                            <ul class="sub-menu">
                                <li><a href="terms-conditions.php">Terms & Conditions</a></li>
                                <li><a href="privacy-policy.php">Return of Goods Policy</a></li>
                            </ul>
                        </li>
                        <li><a href="all-product.php?v=<?=$version?>" class="nav_link btn">Our Products</a></li>
                        <li><a href="contact-us.php" class="nav_link btn">Contact Us</a></li>
                    </ul>

                    <ul class="socialIcon_all">
                        <li><a href="javascript:void(0)" class="link_" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="javascript:void(0)" class="link_" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        <li><a href="javascript:void(0)" class="link_" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="javascript:void(0)" class="link_" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                    </ul>

                </div>

                <div class="button_wrap">
                    <!-- <button class="btn learnmore_btn">Enquire Now</button> -->
                    <button class="responsivemenubar_btn btn" id="open_Sidebar">
                        <span class="menuBar_line"></span>
                    </button>
                </div>

            </div>
        </div>
    </section>