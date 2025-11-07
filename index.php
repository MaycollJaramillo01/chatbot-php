<?php include('header.php')?>
<?php include('slider.php')?>

<!-- Marque Section Start -->
<div class="marquee-section mt-5 mb-5">
    <div class="mycustom-marque style-2">
        <div class="scrolling-wrap">
            <div class="comm">
                <div class="cmn-textslide textitalick text-custom-storke"><?php echo $SN[1];?></div>
                <div><img src="assets/img/Asterisk2.png" alt="img"></div>
              <!--<div class="cmn-textslide textitalick"><?php echo $SN[2];?></div>-->  
                <div><img src="assets/img/Asterisk2.png" alt="img"></div>
                <div class="cmn-textslide textitalick text-custom-storke"><?php echo $SN[3];?></div>
                <div><img src="assets/img/Asterisk2.png" alt="img"></div>
            </div>
            <div class="comm">
                <div class="cmn-textslide textitalick text-custom-storke"><?php echo $SN[1];?></div>
                <div><img src="assets/img/Asterisk2.png" alt="img"></div>
               <!--  <div class="cmn-textslide textitalick"><?php echo $SN[2];?></div>-->  
                <div><img src="assets/img/Asterisk2.png" alt="img"></div>
                <div class="cmn-textslide textitalick text-custom-storke"><?php echo $SN[3];?></div>
                <div><img src="assets/img/Asterisk2.png" alt="img"></div>
            </div>
            <div class="comm">
                <div class="cmn-textslide textitalick text-custom-storke"><?php echo $SN[1];?></div>
                <div><img src="assets/img/Asterisk2.png" alt="img"></div>
              <!--  <div class="cmn-textslide textitalick"><?php echo $SN[2];?></div>-->  
                <div><img src="assets/img/Asterisk2.png" alt="img"></div>
                <div class="cmn-textslide textitalick text-custom-storke"><?php echo $SN[3];?></div>
                <div><img src="assets/img/Asterisk2.png" alt="img"></div>
            </div>
        </div>
    </div>
</div>



<!-- About Section Start -->
<section class="about-section fix section-padding bg-cover"
    style="background-image: url('assets/img/about/about-bg.jpg');">
    <div class="container">
        <div class="about-wrapper-2">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="assets/img/about/03.jpg" alt="img" class="wow fadeInUp">
                        <div class="about-image-2 wow fadeInUp" data-wow-delay=".5s">
                            <img src="assets/img/about/04.jpg" alt="img">
                            <!-- <a href="https://www.youtube.com/watch?v=Cn4G2lZ_g2I" class="video-btn ripple video-popup">
                                <i class="fa-solid fa-play"></i>
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title">
                            <span class="wow fadeInUp"><img src="assets/img/icon/07.svg" alt="img">About Us</span>
                            <h2 class="text-white wow fadeInUp" data-wow-delay=".3s"><?php echo $Phrase[4];?></h2>
                        </div>
                        <p class="mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                            <?php echo $Home[0];?>
                        </p>
                        <a href="about.php" class="theme-btn wow fadeInUp mt-3" data-wow-delay=".5s">Discover More <i
                                class="fa-regular fa-angles-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info Section Start -->
<section class="contact-info-section">
    <div class="container">
        <div class="contact-info-wrapper">
            <div class="contact-img">
                <img src="assets/img/contact-info-img.png" alt="img">
            </div>
            <div class="line-shape-2">
                <img src="assets/img/line-shape-2.png" alt="img">
            </div>
            <div class="row g-4">
                <div class="col-sm-6"></div>
                <div class="col-xxl-6">
                    <div class="contact-info-items">
                        <div class="icon">
                            <i class="fa-sharp fa-regular fa-phone-volume"></i>
                        </div>
                        <div class="content">
                            <h3 class="wow fadeInUp">Get Free or call us for Consultancy</h3>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s"><a href="<?php echo $PhoneRef;?>"><?php echo $Phone;?></a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- services Section Start -->
<section class="team-section fix section-padding">
    <div class="container">
        <div class="section-title text-center">
            <span class=" justify-content-center wow fadeInUp"><img src="assets/img/icon/07.svg" alt="img">Our</span>
            <h2 class="wow fadeInUp" data-wow-delay=".3s">Services</h2>
        </div>
        <div class="row">
            <?php
             // Código original: imprimía las posiciones 1, 2 y 3 del array usando un bucle for
            // for ($i = 1; $i <= 3; $i++) { ... }

            // Modificación: imprimir solo las posiciones 1 y 3 manualmente
            foreach ([1, 3] as $i) { ?>
                <div class="col-xl-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="team-box-items">
                        <div class="team-image">
                            <img src="assets/img/team/0<?php echo $i;?>.jpg" alt="img">
                        </div>
                        <div class="team-content">
                            <h3><a href="services.php"><?php echo $SN[$i];?></a></h3>
                            <p><?php echo $ExSD[$i];?></p>
                        </div>
                    </div>
                </div>
            <?php };?>
        </div>
    </div>
</section>
<!-- <div class="container">
    <div class="row">
        <div class="col-md-6 col-12 d-flex m-auto ">
            <video controls poster="assets/img/videos/video.jpg" class="rounded" width="100%">
            <source src="assets/img/videos/video.mp4" type="video/mp4" class="rounded">
            Your browser does not support the video tag.
            </video>
        </div>
    </div>
</div> -->
<!-- Service Section Start -->
 <section class="service-section-2 fix section-padding">
    <div class="arrow-shape">
        <img src="assets/img/arrow-shape.png" alt="img">
    </div>
    <div class="container">
        <div class="section-title text-center">
            <h2 class="wow fadeInUp" data-wow-delay=".3s">We Value Your Opinion</h2>
        </div>
        <div class="row g-3">
            <div class="col-xl-4 col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay=".3s">
                <a href="<?php echo $facebook;?>" target="_blank">
                    <img src="assets/img/icon/face.png" width="100%">
                </a>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay=".3s">
                <a href="<?php echo $instagram;?>" target="_blank">
                    <img src="assets/img/icon/instagram.png" width="100%">
                </a>
            </div><div class="col-xl-4 col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay=".3s">
                <a href="<?php echo $google;?>" target="_blank">
                    <img src="assets/img/icon/gl.png" width="100%">
                </a>
            </div>
        </div>
    </div>
</section> 
<!-- Project Section Start -->
<section class="project-section fix section-padding">
    <div class="container">
        <div class="section-title">
            <span class="wow fadeInUp"><img src="assets/img/icon/07.svg" alt="img">Latest Gallery</span>
            <h2 class="wow fadeInUp" data-wow-delay=".3s"><?php echo $Phrase[4];?></h2>
        </div>
        <div class="row">
            <?php
            for ($i = 1; $i <= 5; $i++) {;?>
                <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="project-items">
                        <div class="project-image">
                            <img src="assets/img/project/<?php echo $i;?>.jpg" alt="project-img">
                            <div class="project-content">
                                <h3>
                                    <a href="gallery.php"><?php echo $Company;?></a>
                                </h3>
                                <a href="gallery.php" class="icon">
                                    <i class="fa-regular fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php };?>
        </div>
        <div class="project-button text-center mt-5 wow fadeInUp" data-wow-delay=".3s">
            <a href="gallery.php" class="theme-btn">
                ALL PROJECTS
                <i class="fa-regular fa-angles-right"></i>
            </a>
        </div>
    </div>
</section>

<?php include('footer.php')?>