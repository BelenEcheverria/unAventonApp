<?php
	include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	$pregunta = $_POST['pregunta'];
	$idUsuario = $_POST['idUsuario'];
	$viaje_id = $_POST['idViaje'];
	$fecha = date("y/m/d");
	$query = "INSERT INTO preguntas (pregunta,fecha,idViaje,idUsuario)
		VALUES ('$pregunta','$fecha', '$viaje_id', '$idUsuario')";
	mysqli_query($link,$query) or die ('Consulta fallida: ' .mysqli_error($link));
	header ("Location: ../verviaje.php?id_viaje=$viaje_id");
?>