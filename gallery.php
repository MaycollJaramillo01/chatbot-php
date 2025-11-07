<?php include('header2.php'); ?>

<!-- Bradcrumb Section Start -->
<div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/img/breadcrumb/about-breadcrumb.jpg');">
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Gallery</h1>
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                <li><a href="index.php">Home</a></li>
                <li><i class="fa-regular fa-chevrons-right"></i></li>
                <li>Gallery</li>
            </ul>
        </div>
    </div>
</div>

<!-- Project Section Start -->
<section class="project-section fix section-padding">
    <div class="container">
        <ul class="nav nav-tabs">
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
                <div class="row">
                    <?php
                    for ($i = 39; $i >= 1; $i--) { ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                        <div class="project-items mt-5 style-3">
                            <div class="project-image">
                                <img src="assets/img/project/gallery/remodeling/<?php echo $i; ?>.jpg" alt="Remodeling Image">
                                <div class="project-content">
                                    <h3><?php echo $Company; ?></h3>
                                    <a href="assets/img/project/gallery/remodeling/<?php echo $i; ?>.jpg" class="icon" data-fancybox="remodeling">
                                        <i class="fa-regular fa-search"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Roofing Tab -->
            <div id="roofing" class="tab-pane fade">
                <div class="row">
                    <?php
                    for ($i = 89; $i >= 1; $i--) { ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                        <div class="project-items mt-5 style-3">
                            <div class="project-image">
                                <img src="assets/img/project/gallery/roofing/<?php echo $i; ?>.jpg" alt="Roofing Image">
                                <div class="project-content">
                                    <h3><?php echo $Company; ?></h3>
                                    <a href="assets/img/project/gallery/roofing/<?php echo $i; ?>.jpg" class="icon" data-fancybox="roofing">
                                        <i class="fa-regular fa-search"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
Fancybox.bind("[data-fancybox]", {});
</script>

<?php include('footer.php'); ?>
