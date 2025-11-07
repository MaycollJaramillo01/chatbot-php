<?php
	//se inicia sesion para obtener el codigo del captcha
	@session_start();

	//se establece la conexion
	include 'conex.php';

	//se verifica que el captcha_code llegue con su calor, y que sea igual al que se le mandó por medio del formulario
	if(isset($_POST["captcha"]) && $_POST["captcha"]!="" && $_SESSION["code"]==$_POST["captcha"]){
		
		//Se verifica si las varabiables estan definidas en el formulario, y su valor se guarda en nuevas variables
		//con la funcion mysqli_real_escape_string se escapan los carateres especiales de una cadena para usarla en una sentencia SQL
		$Fecha=	  mysqli_real_escape_string($con,isset($_POST["fecha"]) ? $_POST['fecha']: '');
		$Name=	  mysqli_real_escape_string($con,isset($_POST["name"]) ? $_POST['name']: '');
		$City=	  mysqli_real_escape_string($con,isset($_POST["city"]) ? $_POST['city']: '');
		$Project= mysqli_real_escape_string($con,isset($_POST["project"]) ? $_POST['project']: '');
		$reviews= mysqli_real_escape_string($con,isset($_POST["reviews"]) ? $_POST['reviews']: '');
		$Star=	  mysqli_real_escape_string($con,isset($_POST["estrellas"]) ? $_POST['estrellas']: '');

		//datos parametrizados
		$sql = $con->prepare("INSERT INTO reviews (star,name,city,project,reviews,rdate) VALUES(?,?,?,?,?,?)");
		$sql->bind_param("isssss",$Star,$Name,$City,$Project,$reviews,$Fecha);	
		$sql->execute();
		//cerramos la conexion
		mysqli_close($con);
		//redireccionamos a la pagina de testimonios
		header("Location: testimonials.php");
	}
?>