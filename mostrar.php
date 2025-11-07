<?php
  //se inicia sesion
  @session_start();

  //se establece conexion 
  include 'conex.php';

  //seleccionamos todo de la tabla reviews en orden descendente por fecha
  $sql="SELECT * FROM reviews ORDER BY rdate DESC";
  
  //se ejecuta la consulta y los resultados se guardan en ejecutar
    $ejecutar=mysqli_query($con,$sql) or die('Error');

    // $sql = "SELECT * FROM reviews";
    // $sentencias = $con->prepare($sql);
    // $sentencias->execute();

    // $resultado = $sentencias->fetchAll();
    // $paginacion = 3;
    // $total_paginacion = $sentencias->rowCount();
    // $paginas = $total_paginacion/3;
    // $paginas = ceil($paginas);
    // echo $paginas;



    mysqli_close($con);   

?>