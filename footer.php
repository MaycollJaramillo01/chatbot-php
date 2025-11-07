<!-- Footer Section Start -->
<footer class="footer-section fix">
    <div class="shape-1">
        <img src="assets/img/footer/shape-1.png" alt="img">
    </div>
    <div class="shape-2">
        <img src="assets/img/footer/shape-2.png" alt="img">
    </div>
    <div class="container">
        <div class="footer-widgets-wrapper style-2">
            <div class="row">
                <div class="col-xl-4 col-sm-6 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <a href="index.php">
                                <img src="assets/img/logo/logo.png" alt="logo-img">
                            </a>
                        </div>
                        <div class="footer-content">
                            <p><?php echo $ExHome;?></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Sitemap</h3>
                        </div>

                        <ul class="list-items">
                            <li><a href="index.php"><i class="fa-regular fa-arrow-right-long"></i>Home</a></li>
                            <li><a href="about.php"><i class="fa-regular fa-arrow-right-long"></i>About Us</a></li>
                            <li><a href="services.php"><i class="fa-regular fa-arrow-right-long"></i>Services</a></li>
                            <li><a href="gallery.php"><i class="fa-regular fa-arrow-right-long"></i>Gallery</a></li>
                            <li><a href="testimonials.php"><i
                                        class="fa-regular fa-arrow-right-long"></i>Testimonials</a></li>
                            <li><a href="contact.php"><i class="fa-regular fa-arrow-right-long"></i>>Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Our Services</h3>
                        </div>
                        <ul class="list-items">
                        <?php
    // Código original imprimía los elementos 1 al 3 con: for ($i = 1; $i <= 3; $i++)
    // Modificación: solo imprimir los elementos 1 y 3
                       foreach ([1, 3] as $i) { ?>
                       <li>
                       <a href="services.php">
                       <i class="fa-regular fa-arrow-right-long"></i>
                       <?php echo $SN[$i]; ?>
                      </a>
                      </li>
                     <?php } ?>
                    </ul>

                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Contact Info</h3>
                        </div>

                        <ul class="list-items">
                            <li><a href="<?php echo $PhoneRef;?>"><i
                                        class="fa-regular fa-phone"></i><?php echo $Phone;?></a></li>
                            <li><a href="<?php echo $MailRef;?>"><i
                                        class="fa-regular fa-envelope"></i><?php echo $Mail;?></a></li>
                            <li><a href="#"><i class="fa-regular fa-clock"></i><?php echo $Schedule;?></a></li>
                            <li><a href="#"><i class="fa-regular fa-map-marker-alt"></i><?php echo $Address;?></a></li>
                            <li><a href="#"><i class="fa-regular fa-credit-card"></i><?php echo $Payment;?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-wrapper">
                    <p>
                        © Copyright <?php echo date("Y");?> <?php echo $Company;?> All rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'chatbot.php'; ?>
</footer>

<!--<< All JS Plugins >>-->
<script src="assets/js/jquery-3.7.1.min.js"></script>
<!--<< Viewport Js >>-->
<script src="assets/js/viewport.jquery.js"></script>
<!--<< Bootstrap Js >>-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--<< Nice Select Js >>-->
<script src="assets/js/jquery.nice-select.min.js"></script>
<!--<< Waypoints Js >>-->
<script src="assets/js/jquery.waypoints.js"></script>
<!--<< Counterup Js >>-->
<script src="assets/js/jquery.counterup.min.js"></script>
<!--<< Swiper Slider Js >>-->
<script src="assets/js/swiper-bundle.min.js"></script>
<!--<< MeanMenu Js >>-->
<script src="assets/js/jquery.meanmenu.min.js"></script>
<!--<< Magnific Popup Js >>-->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!--<< Wow Animation Js >>-->
<script src="assets/js/wow.min.js"></script>
<!--<< Main.js >>-->
<script src="assets/js/main.js"></script>
</body>

</html>