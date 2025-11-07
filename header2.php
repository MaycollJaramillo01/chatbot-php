<!DOCTYPE html>
<html lang="en">
<?php include 'text.php'; ?>

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ======== Page title ============ -->
    <title><?php
        if ($page_name=='about.php') {echo "$Company | About Us";}
        elseif ($page_name=='services.php') {echo "$Company | Services";}
        elseif ($page_name=='gallery.php') {echo "$Company | Gallery";}
        elseif ($page_name=='404.php') {echo "$Company | 404";}
        
        elseif ($page_name=='contact.php') {echo "$Company | Contact Us";}?>
    </title>
    <!--<< Favcion >>-->
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--<< All Min Css >>-->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!--<< Magnific Popup.css >>-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <!--<< Swiper Bundle.css >>-->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!--<< Nice Select.css >>-->
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <!--<< Color.css >>-->
    <link rel="stylesheet" href="assets/css/color.css">
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="assets/css/main.css">


    <?php
        if ($page_name=='gallery.php') {echo "<script src='https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js'></script>
            <link
            rel='stylesheet'
            href='https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css'
            />";}?>
    <?php
        if ($page_name=='testimonials.php') {echo "<link rel='stylesheet' href='assets/css/star.css'>";}?>

</head>

<body>

    <!-- Back To Top Start -->
    <button id="back-top" class="back-to-top">
        <i class="fa-regular fa-arrow-up"></i>
    </button>

    <!--<< Mouse Cursor Start >>-->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <!-- Offcanvas Area Start -->
    <div class="fix-area">
        <div class="offcanvas__info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                    <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                        <div class="offcanvas__logo">
                            <a href="index.php">
                                <img src="assets/img/logo/logo2.png" alt="logo-img">
                            </a>
                        </div>
                        <div class="offcanvas__close">
                            <button>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mobile-menu fix mb-3"></div>
                    <div class="offcanvas__contact">
                        <h4>Contact Info</h4>
                        <ul>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="#"><?php echo $Address;?></a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="<?php echo $MailRef;?>"><span
                                            class="mailto:info@example.com"><?php echo $Mail;?></span></a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-clock"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="#"><?php echo $HeaderTime;?></a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="far fa-phone"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="<?php echo $PhoneRef;?>"><?php echo $Phone;?></a>
                                </div>
                            </li>
                        </ul>
                        <div class="header-button mt-4">
                            <a href="contact.php" class="theme-btn text-center">
                                <span>get A Quote<i class="fa-solid fa-arrow-right-long"></i></span>
                            </a>
                        </div>
                        <div class="social-icon d-flex align-items-center">
                            <a href="<?php echo $thumbtack;?>" target="_blank"><i class="fa-solid fa-thumbtack"></i></a>
                            <a href="<?php echo $instagram;?>" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="<?php echo $google;?>" target="_blank"><i class="fab fa-google"></i></a>
                            <a href="<?php echo $facebook;?>" target="_blank"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__overlay"></div>

    <!-- Header Section Start -->
    <header id="header-sticky" class="header-2 style-2">
        <div class="container">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="logo">
                        <a href="index.php" class="header-logo">
                            <img src="assets/img/logo/logo2.png" alt="logo-img">
                        </a>
                    </div>
                    <div class="header-left">
                        <div class="mean__menu-wrapper">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="about.php">About Us</a></li>
                                        <li><a href="services.php">Services</a></li>
                                        <li><a href="gallery.php">Gallery</a></li>
                                         <li><a href="Youtube.php">Youtube</a></li>
                                        <li><a href="testimonials.php">Testimonials</a></li>
                                        <li><a href="contact.php">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="header-right d-flex justify-content-end align-items-center">
                        <div class="header-button">
                            <a href="contact.php" class="theme-btn">
                                <span>
                                    Get a quote
                                    <i class="fa-regular fa-angles-right"></i>
                                </span>
                            </a>
                        </div>
                        <div class="header__hamburger d-xl-none my-auto">
                            <div class="sidebar__toggle">
                                <img src="assets/img/logo/bar.png" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>