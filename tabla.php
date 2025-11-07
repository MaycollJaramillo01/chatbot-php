<?php
  
  include 'conex.php';
  @session_start();

  	//Trae un conteo del total de reviews en la tabla reviews
    $total_reviews = mysqli_query($con,"SELECT count(1) as countReviews FROM reviews");
 
 	//Se socia el resultado de la consulta y se le asigna a la variable $countReviews -> equivale a tener un arreglo
    $countReviews = mysqli_fetch_array($total_reviews, MYSQLI_ASSOC);
    $countReviewsInt = $countReviews["countReviews"];
    $total_reviews_mostrar = 3;
    $numero_paginas = ceil( $countReviewsInt / $total_reviews_mostrar);
    $pagina_actual = isset( $_GET['page']) ? $_GET['page'] : 1;
    $paginacion_parametros =  ($pagina_actual * $total_reviews_mostrar) - $total_reviews_mostrar;
    $queryAllReview = ("SELECT * FROM reviews ORDER BY id DESC LIMIT ".$paginacion_parametros.",".$total_reviews_mostrar);
    $sentencia_busqueda = mysqli_query($con, $queryAllReview);?>

	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center mb-5"> 
	    <ul class="pagination display-inline-item-li">
	      <?php for ($i = 1; $i <= $numero_paginas; $i++) { ?>
	      <li class="ml-2 btn btn-sm bg-color1 <?php if($pagina_actual==$i){ echo "active"; }elseif($pagina_actual==0){ echo "active"; } ?>"><a class="text-white" href="testimonials.php?page=<?php echo $i; ?>" ><?php echo $i; ?></a>
	      </li>                          
	      <?php } ?>
	    </ul>
	</div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <?php 
        while ($resultInArray = mysqli_fetch_array($sentencia_busqueda, MYSQLI_ASSOC)) {
     ?>
         <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 well mt-2">
            <h4 class="color-navigation"><i class="fa fa-user"></i> <?php echo $resultInArray['name']. ' in '.$resultInArray['city'] ?> <small><?php for ($i=1; $i <= $resultInArray['star'] ; $i++) { 
                echo "<i class='fa fa-star t-gold'></i>";
            } ?> - <?php echo $resultInArray['star'].'.0'; ?> </small></h4>
            <small class="text-black"><i class="fa fa-calendar-o"></i> Date: <?php echo $resultInArray['rdate'] ?></small><br>
            <p class="text-black"><i class="fa fa-folder-open"></i>Project: <strong><?php echo $resultInArray['project'] ?></strong></p>
            <p class="text-black"><i class="fa fa-comment"></i> <?php echo $resultInArray['reviews'] ?></p>
        </div>
    <?php } ?>
</div>