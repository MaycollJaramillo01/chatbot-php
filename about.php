<?php include('header2.php')?>
<!-- Footer Section Start -->
<div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/img/breadcrumb/about-breadcrumb.jpg');">
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">About Us</h1>
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                <li>
                    <a href="index.php">
                        Home
                    </a>
                </li>
                <li>
                    <i class="fa-regular fa-chevrons-right"></i>
                </li>
                <li>
                    About
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- About Section Start -->
<section class="about-section fix section-padding">
    <div class="about-shape">
        <img src="assets/img/about/about-shape.png" alt="shape-img">
    </div>
    <div class="about-right-shape">
        <img src="assets/img/about/about-right.png" alt="shape-img">
    </div>
    <div class="container">
        <div class="about-wrapper">
            <div class="about-bg-shape">
                <img src="assets/img/about/about-bg-shape.png" alt="img">
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="about-image">
                        <img src="assets/img/about/07.jpg" alt="img">
                        <div class="about-image-2">
                            <img src="assets/img/about/08.jpg" alt="img">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title">
                            <span class="wow fadeInUp"><img src="assets/img/icon/07.svg" alt="img">About Us</span>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s"><?php echo $Phrase[1];?></h2>
                        </div>
                        <p class="mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                           <?php echo $About[0];?>
                        </p>
                        <ul class="about-list wow fadeInUp" data-wow-delay=".3s">
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <?php echo $Cover;?>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <?php echo $Experience;?>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('footer.php')?>