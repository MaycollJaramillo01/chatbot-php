<?php
	//se realiza la conexion, host, usuario, contraseña, nombre_base_de_datos
	$con= new mysqli('localhost','alcarallservbd','R$Ld#H{p;.}n','alcarallservbd')or die('Error en bd');

	//se verifica que no haya error al momento de la conexion
	if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;}
?>

