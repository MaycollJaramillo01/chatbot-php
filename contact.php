<?php include('header2.php')?>

<!-- Bradcrumb Section Start -->
<div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/img/breadcrumb/about-breadcrumb.jpg');">
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Contact</h1>
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
                    Contact
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Contact Info Section Start -->
<section class="contact-info-section-22 fix section-padding">
    <div class="container-fluid">
        <div class="contact-info-wrapper-22">
            <div class="icon-items wow fadeInUp" data-wow-delay=".3s">
                <div class="icon">
                    <img src="assets/img/icon/phone.svg" alt="img" width="50">
                </div>
                <div class="content">
                    <h2>Call Us Anytime</h2>
                    <h4 class="mb-2"><a href="<?php echo $PhoneRef;?>"><?php echo $Phone;?></a></h4>
                </div>
            </div>
            <div class="icon-items wow fadeInUp" data-wow-delay=".5s">
                <div class="icon">
                    <img src="assets/img/icon/email.svg" alt="img" width="50">
                </div>
                <div class="content">
                    <h2>Send Us Mail</h2>
                    <h4 class="mb-2"><a href="<?php echo $MailRef;?>"><?php echo $Mail;?></a></h4>
                </div>
            </div>
            <div class="icon-items wow fadeInUp" data-wow-delay=".7s">
                <div class="icon">
                    <img src="assets/img/icon/location.svg" alt="img" width="50">
                </div>
                <div class="content">
                    <h2>Visit Our Office</h2>
                    <h4><?php echo $Address;?></h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section Start -->
<div class="contact-section-22 section-padding">
    <div class="container">
        <div class="contact-wrapper-11">
            <div class="row g-4 justify-content-between">
                <div class="col-lg-5">
                    <?php echo $GoogleMap;?>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form-area">
                        <form action="mail.php" id="contact-form" method="POST">
                            <div class="row g-4">
                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                                    <div class="form-clt">
                                        <input type="text" name="name" id="name" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                    <div class="form-clt">
                                        <input type="text" name="email" id="email21" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-lg-12 wow fadeInUp" data-wow-delay=".3s">
                                    <div class="form-clt">
                                        <textarea name="message" id="message" placeholder="Enter Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                    <button type="submit" class="theme-btn ">
                                        Send Message<i class="fa-solid fa-arrow-right-long"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php')?>