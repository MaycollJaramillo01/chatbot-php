<?php include('header2.php')?>


<!-- Bradcrumb Section Start -->
<div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/img/breadcrumb/about-breadcrumb.jpg');">
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Services</h1>
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
                    Services
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Service Section Start -->
<section class="project-section fix section-padding">
    <div class="container">

        <!-- Tabs -->
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#remodeling">Remodeling</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#roofing">Roofing</a>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <!-- Remodeling Tab -->
            <div id="remodeling" class="tab-pane fade show active">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="card shadow-sm border-0" style="border-radius:12px;">
                            <img src="assets/img/project/gallery2.jpg" alt="Remodeling" 
                                 style="width:100%;height:auto;border-top-left-radius:12px;border-top-right-radius:12px;">
                            <div class="card-body text-center p-4">
                                <h3 style="font-size:1.6rem;font-weight:700;"><?php echo $SN[1];?></h3>
                                <p style="line-height:1.7;font-size:1.05rem;"><?php echo $SD[1];?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other Services Card -->
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-6 col-md-8">
                        <div class="card shadow-sm border-0" style="border-radius:12px;">
                            <div class="card-body text-center p-4">
                                <h4 class="mb-4" style="font-weight:700;font-size:1.4rem;">Other Services</h4>
                                <ul class="list-unstyled mb-0" style="line-height:1.9;font-size:1.05rem;">
                                    <li>Drywall</li>
                                    <li>Painting</li>
                                    <li>Texturing</li>
                                    <li>Baseboard installation</li>
                                    <li>Floor tile installation</li>
                                    <li>Luxury Vinyl Plank installation</li>
                                    <li>Bathroom tiling</li>
                                    <li>Kitchen Cabinetry installation</li>
                                    <li>Countertop installation</li>
                                </ul>
                                <p class="mt-3 mb-0">
                                    <strong>We do not provide any structural modification services.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Roofing Tab -->
            <div id="roofing" class="tab-pane fade">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="card shadow-sm border-0" style="border-radius:12px;">
                            <img src="assets/img/service/serv3.jpg" alt="Roofing" 
                                 style="width:100%;height:auto;border-top-left-radius:12px;border-top-right-radius:12px;">
                            <div class="card-body text-center p-4">
                                <h3 style="font-size:1.6rem;font-weight:700;"><?php echo $SN[3];?></h3>
                                <p style="line-height:1.7;font-size:1.05rem;"><?php echo $SD[3];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service Section End -->




<?php include('footer.php')?>