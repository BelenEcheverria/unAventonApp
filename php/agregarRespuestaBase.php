<?php
	include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	$respuesta = $_POST['respuesta'];
	$idPregunta = $_POST['idPregunta'];
	$viaje_id = $_POST['idViaje'];
	$fecha = date("y/m/d");
	$query = "INSERT INTO respuestas (respuesta,fecha,idPregunta)
		VALUES ('$respuesta','$fecha', '$idPregunta')";
	mysqli_query($link,$query) or die ('Consulta fallida: ' .mysqli_error($link));
	header ("Location: ../2. MiViaje.php?id=$viaje_id");
?>