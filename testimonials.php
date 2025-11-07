<?php include('header2.php')?>
<!-- Footer Section Start -->
<div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/img/breadcrumb/about-breadcrumb.jpg');">
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Testimonials</h1>
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
                    Testimonials
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="wdt_100 pad_94_100">
    <div class="container">
        <div class="pad_te">
            <div class="col-lg-12 text-center">
                <h2 class="text-black"><span class="color">Let Us Know What </span>You Think About Us!</h2>
            </div>
        </div>
        <hr><br>
        <div class="row pad_tes">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 well2">
                <form method="POST" action="insert.php" class="contact_info wdt_100 pad_testi text">
                    <div class="col-md-12 pad_testi">
                        <input type="hidden" name="fecha" value='<?php echo @date('Y-m-d')?>'>
                    </div>
                    <div class="col-md-12 pad_testi text-center">
                        <h4 class="text-white pad_t">Leave Your Reviews and Rating</h4>
                        <p class="clasificacion">
                            <input id="radio1" type="radio" name="estrellas" value="5">
                            <label for="radio1"><i class="fa fa-star"></i></label>

                            <input id="radio2" type="radio" name="estrellas" value="4">
                            <label for="radio2"><i class="fa fa-star"></i></label>

                            <input id="radio3" type="radio" name="estrellas" value="3">
                            <label for="radio3"><i class="fa fa-star"></i></label>

                            <input id="radio4" type="radio" name="estrellas" value="2">
                            <label for="radio4"><i class="fa fa-star"></i></label>

                            <input id="radio5" type="radio" name="estrellas" value="1">
                            <label for="radio5"><i class="fa fa-star"></i></label>
                        </p>
                    </div>

                    <div class="col-md-12 pad_testi">
                        <label class="text-white" for="name">Name:</label>
                        <input class="form-control" type="text" id="user" name="name" required>
                    </div>
                    <div class="col-md-12 pad_testi">
                        <label class="text-white" for="city">City:</label>
                        <input class="form-control" type="text" id="city" name="city" required>
                    </div>
                    <div class="col-md-12 pad_testi">
                        <label class="text-white" for="project">Project:</label>
                        <input class="form-control" type="text" id="project" name="project" required>
                    </div>
                    <div class="col-md-12 pad_testi">
                        <label class="text-white" for="reviews">Comments:</label>
                        <textarea class="form-control" id="reviews" name="reviews" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="reviews">Write The Code:</label>
                        <img src="captcha.php" />
                        <input name="captcha" class="form-control mt-1" type="text" required>
                    </div>
                    <div class="col-md-12 pad_testi mt-5">
                        <input type="submit" value="Publish Review"
                            class="p-2 btn submit_now bg_btn smallbnt btn-primary text-white"
                            data-loading-text="Loading...">
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 mx-auto">
                <?php include 'tabla.php'; ?>
            </div>
        </div>
    </div>
</div>
<?php include ('footer.php');?>