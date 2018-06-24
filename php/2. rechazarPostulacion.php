<?php
    include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	
	if ((isset ($_POST['idVehiculo'])) and (isset ($_POST['idViaje'])) and (isset ($_POST['idPostulacion']))) {
		$vehiculo = $_POST['idVehiculo'];
		$viaje_id = $_POST['idViaje'];
		$idPostulacion= $_POST['idPostulacion'];
	}

	$query = "UPDATE postulaciones SET idEstado=2 WHERE id= $idPostulacion";
	mysqli_query($link,$query) or die ('Consulta fallida: ' .mysqli_error($link));
	
	header ("Location: ../2. MiViaje.php?id=$viaje_id");
?>