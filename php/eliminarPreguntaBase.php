<?php
	include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	$idPregunta = $_POST['idPregunta'];
	$viaje_id = $_POST['idViaje'];
	$query = "DELETE FROM preguntas WHERE id=$idPregunta";
	mysqli_query($link,$query) or die ('Consulta fallida: ' .mysqli_error($link));
	header ("Location: ../verviaje.php?id_viaje=$viaje_id");
?>