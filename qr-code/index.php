<!DOCTYPE html>
<?php include('../text.php') ?>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">

  <!-- Page Title -->
  <title><?php echo $Company; ?></title>

  <!-- Meta Tags -->
  <meta name="description" content="<?php echo $About[0];?>">
  <meta name="keywords" content="New construction,Custom home building,Home remodel,Kitchen remodel,Bathroom remodel,Home additions,Deck additions,Sunrooms,Master suites,Office additions">
  <meta name="author" content="Maven Marketing">

  
  <!-- Viewport Meta-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Template Favicon & Icons Start -->
  <link rel="icon" href="../assets/img/favicon.png" type="image/svg+xml">
  <!-- Template Favicon & Icons End -->

  <!-- Template Styles Start -->
  <link rel="stylesheet" href="css/loaders/loader.css">
  <link rel="stylesheet" type="text/css" href="css/plugins.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Template Styles End -->

  <!-- Custom Browser Color Start -->
  <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#111111">
  <meta name="theme-color" media="(prefers-color-scheme: light)" content="#dcdce7">
  <meta name="msapplication-navbutton-color" content="#111111">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <!-- Custom Browser Color End -->
</head>

<body>

  <!-- Header Start -->
  <header id="header" class="header d-flex justify-content-between">

    <!-- Header Controls Start -->
    <div class="header__controls d-flex justify-content-end">
      <button id="color-switcher" class="color-switcher header__switcher btn" type="button" role="switch" aria-label="light/dark mode" aria-checked="true"></button>
      <a id="notify-trigger" class="header__trigger btn" href="<?php echo $MailRef;?>?subject=Hello,%20I%20am%20interested%20in%20the%20services%20you%20offer"> 
        <span class="trigger__caption">Let's Talk</span>
        <i class="ph-bold ph-chat-dots"></i>
      </a>
      <!-- Botón para abrir el modal -->
      <button class="shared_icon-mobile" id="button_share">
        <i class="fa fa-share-alt"></i>
      </button>
      <button class="shared_icon" id="openModalButton">
        <i class="fa fa-share-alt"></i>
      </button>

    </div>
    <!-- Header Controls End -->

  </header>
  <!-- Header End -->

  <!-- Modal -->
  <div class="modal-overlay" id="modalOverlay">
    <div class="modal-new">
      <div class="modal-header">
        <img src="../assets/img/favicon.png" alt="" style="width: 80px;" width="80">
        <h6>Share <?php echo $Company;?> Digital Business Card</h6>
      </div>
      <div class="modal-body">
        <!-- <div class="option" onclick="copyCardLink()">
                        <i class="fa fa-link"></i> Copy Card Link
                      </div> -->
        <div class="option">
          <a href="<?php echo $MailRef;?>">
            <img src="img/icons/icon_email.png" alt="" class="img-icon-modal"> Share via Email
            <i class="fa fa-external-link" aria-hidden="true"></i>
          </a>
        </div>
        <div class="option">
          <a href="https://wa.link/85vg59" target="_blank">
            <img src="img/icons/icon_whats.png" alt="" class="img-icon-modal"> Share to WhatsApp
            <i class="fa fa-external-link" aria-hidden="true"></i>
          </a>
        </div>
        <div class="option">
          <a href="<?php echo $facebook;?>" target="_blank">
            <img src="img/icons/icon_face.png" alt="" class="img-icon-modal"> Share to Facebook
            <i class="fa fa-external-link" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Gradient Background Start -->
  <div class="gradient-background">
    <div class="blur"></div>
    <div class="blur"></div>
    <div class="blur"></div>
  </div>
  <!-- Gradient Background End -->

  <!-- Avatar Side Block Start -->
  <div id="avatar" class="avatar">
    <div class="avatar__container d-flex flex-column justify-content-lg-between">
      <!-- image and logo -->
      <div class="avatar__block">
        <div class="avatar__logo d-flex align-items-center">
          <div class="logo__caption">
            <p><?php echo $Company; ?></p>
          </div>
        </div>
        <div class="avatar__image">
          <img src="../assets/img/logo/logo.png" alt="<?php echo $Company; ?>">
        </div>
      </div>
      <!-- data caption #1 -->
      <div class="avatar__block">
        <h6>
          <small class="top" style="font-weight: bold; font-size:xx-large;">Services:</small>
          <ul>
            <li><img class="icon-services" src="img/icons/icon-services.svg" alt="Services"><?php echo $SN[1]; ?></li><br>
            <li><img class="icon-services" src="img/icons/icon-services.svg" alt="Services"><?php echo $SN[2]; ?></li><br>
            <li><img class="icon-services" src="img/icons/icon-services.svg" alt="Services"><?php echo $SN[3]; ?></li>
          </ul>
        </h6>
      </div>
      <!-- data caption #2 -->
      
      <!-- socials and CTA button -->
      <div class="avatar__block">
        <div class="avatar__socials">
          <ul class="socials-square d-flex justify-content-center flex-wrap">
            <li class="socials-square__item">
              <a class="socials-square__link btn" href="<?php echo $PhoneRef; ?>" target="_blank"><img class="img-social-widget" src="img/icons/call.svg" alt="<?php echo $Company; ?>"></a>
            </li>
            <li class="socials-square__item">
              <a class="socials-square__link btn" href="<?php echo $MailRef; ?>" target="_blank"><img class="img-social-widget" src="img/icons/email.svg" alt="<?php echo $Company; ?>"></a>
            </li>
            <li class="socials-square__item">
              <a class="socials-square__link btn" href="sms:+19082055459?body=Hello%2C%20I%20would%20like%20information%20about%20the%20services%20you%20offer.%20%F0%9F%93%A9%F0%9F%92%BC" target="_blank">
                <img class="img-social-widget" src="img/icons/messenger.svg" alt="<?php echo $Company; ?>">
              </a>
            </li>
            <li class="socials-square__item">
              <a class="socials-square__link btn" href="<?php echo $instagram; ?>" target="_blank"><img class="img-social-widget" src="img/icons/instagram.svg" alt="<?php echo $Company; ?>"></a>
            </li>
          </ul>
        </div>
        <div class="avatar__btnholder">
          <a class="btn btn-default btn-fullwidth btn-hover btn-hover-accent" href="https://alcarallservices.com/" target="_blank">
            <span class="btn-caption">Continue to our website</span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Avatar Side Block End -->

  <!-- Page Content Start -->
  <div id="content" class="content">
    <div class="content__wrapper">


      <!-- Resume Section Start -->
      <section id="resume" class="inner resume">

        <!-- Content Block - Tools List Start -->
        <div class="content__block grid-block block-large">
          <!-- Tools List Start -->
          <div class="tools-cards d-flex justify-content-start flex-wrap">
            <!-- tools simgle item -->
            <!-- tools simgle item -->
            <div class="tools-cards__item d-flex grid-item-s animate-card-5">
              <a class="tools-cards__card" href="<?php echo $MailRef;?>">
                <img class="tools-cards__icon animate-in-up" src="img/icons-svg/gmail.svg" alt="Social Icon">
                <h6 class="tools-cards__caption animate-in-up">Gmail</h6>
              </a>
            </div>
            <!-- tools simgle item -->
            <!-- <div class="tools-cards__item d-flex grid-item-s animate-card-5">
              <a class="tools-cards__card" href="#">
                <img class="tools-cards__icon animate-in-up" src="img/icons-svg/gmb.svg" alt="Social Icon">
                <h6 class="tools-cards__caption animate-in-up">Google My Business</h6>
              </a>
            </div> -->
            
            <div class="tools-cards__item d-flex grid-item-s animate-card-5">
              <a class="tools-cards__card" href="<?php echo $instagram;?>" target="_blank">
                <img class="tools-cards__icon animate-in-up" src="img/icons-svg/instagram.svg" alt="Social Icon">
                <h6 class="tools-cards__caption animate-in-up">Instagram</h6>
              </a>
            </div>
            <!--
            <div class="tools-cards__item d-flex grid-item-s animate-card-5">
              <a class="tools-cards__card" href="#">
                <img class="tools-cards__icon animate-in-up" src="img/icons-svg/tiktok.svg" alt="Social Icon">
                <h6 class="tools-cards__caption animate-in-up">TikTok</h6>
              </a>
            </div> -->
            <!-- tools simgle item -->
            <div class="tools-cards__item d-flex grid-item-s animate-card-5">
              <a class="tools-cards__card" href="https://alcarallservices.com/">
                <img class="tools-cards__icon animate-in-up invert-img-color" src="img/icons-svg/web.svg" alt="Social Icon">
                <h6 class="tools-cards__caption animate-in-up">Web Site</h6>
              </a>
            </div>
            <div class="tools-cards__item d-flex grid-item-s animate-card-5">
              <a class="tools-cards__card" href="<?php echo $thumbtack;?>">
                <img class="tools-cards__icon animate-in-up invert-img-color" src="img/icons-svg/thumbtack.svg" alt="Social Icon">
                <h6 class="tools-cards__caption animate-in-up">Thumbtack</h6>
              </a>
            </div>
            <div class="tools-cards__item d-flex grid-item-s animate-card-5">
              <a class="tools-cards__card" href="<?php echo $google;?>">
                <img class="tools-cards__icon animate-in-up invert-img-color" src="img/icons-svg/gmb.svg" alt="Social Icon">
                <h6 class="tools-cards__caption animate-in-up">Google My Business</h6>
              </a>
            </div>
            <div class="tools-cards__item d-flex grid-item-s animate-card-5">
              <a class="tools-cards__card" href="https://wa.link/85vg59" target="_blank"> 
                <img class="tools-cards__icon animate-in-up" src="img/icons-svg/whatsapp.svg" alt="Social Icon">
                <h6 class="tools-cards__caption animate-in-up">Whatsapp</h6>
              </a>
            </div>
            
          </div>
          <!-- Tools List End -->
        </div>
        <!-- Content Block - Tools List End -->

        <!-- Content Block - Contact Data Start -->
        <div class="content__block">
          <div class="container-fluid p-0 contact-lines animate-in-up">
            <div class="row g-0 contact-lines__item">
              <!-- data item -->
              <div class="col-12 col-md-4 contact-lines__data">
                <p class="contact-lines__title animate-in-up">Location</p>
                <p class="contact-lines__text animate-in-up">
                  <a class="text-link-bold" href="<?php echo $google; ?>" target="_blank"><?php echo $Address; ?></a>
                </p>
              </div>
              <!-- data item -->
              <div class="col-12 col-md-4 contact-lines__data">
                <p class="contact-lines__title animate-in-up">Phone</p>
                <p class="contact-lines__text animate-in-up">
                  <a class="text-link-bold" href="<?php echo $PhoneRef; ?>"><?php echo $Phone; ?></a>
                </p>
              </div>
              <!-- data item -->
              <div class="col-12 col-md-4 contact-lines__data">
                <p class="contact-lines__title animate-in-up">Email</p>
                <p class="contact-lines__text animate-in-up">
                  <a class="text-link-bold" href="<?php echo $MailRef; ?>?subject=Hello%2C%20I%20would%20like%20information%20about%20the%20services%20you%20offer.%20%F0%9F%93%A9%F0%9F%92%BC"><?php echo $Mail; ?></a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- Content Block - Contact Data End -->

      </section>
      <!-- Contact Section End -->

    </div>
  </div>
  <!-- Page Content End -->

  <!-- Load Scripts Start -->
  <script src="js/libs.min.js"></script>
  <script>
    const randomX = random(-400, 400);
    const randomY = random(-200, 200);
    const randomDelay = random(0, 50);
    const randomTime = random(20, 40);
    const randomTime2 = random(5, 12);
    const randomAngle = random(-30, 150);

    const blurs = gsap.utils.toArray(".blur");
    blurs.forEach((blur) => {
      gsap.set(blur, {
        x: randomX(-1),
        y: randomX(1),
        rotation: randomAngle(-1)
      });

      moveX(blur, 1);
      moveY(blur, -1);
      rotate(blur, 1);
    });

    function rotate(target, direction) {
      gsap.to(target, randomTime2(), {
        rotation: randomAngle(direction),
        ease: Sine.easeInOut,
        onComplete: rotate,
        onCompleteParams: [target, direction * -1]
      });
    }

    function moveX(target, direction) {
      gsap.to(target, randomTime(), {
        x: randomX(direction),
        ease: Sine.easeInOut,
        onComplete: moveX,
        onCompleteParams: [target, direction * -1]
      });
    }

    function moveY(target, direction) {
      gsap.to(target, randomTime(), {
        y: randomY(direction),
        ease: Sine.easeInOut,
        onComplete: moveY,
        onCompleteParams: [target, direction * -1]
      });
    }

    function random(min, max) {
      const delta = max - min;
      return (direction = 1) => (min + delta * Math.random()) * direction;
    }
  </script>
  <script src="js/app.js"></script>
  <script src="js/gallery-init.js"></script>
  <!-- Load Scripts End -->

</body>

</html>