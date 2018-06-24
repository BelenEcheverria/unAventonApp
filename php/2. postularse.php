<?php
    include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	
	if ((isset ($_POST['idViaje'])) and (isset ($_POST['idUsuario']))) {
		$usuario = $_POST['idUsuario'];
		$viaje_id = $_POST['idViaje'];
	}

	$fecha= "CURDATE()";
	echo $fecha;
	$query = "INSERT INTO postulaciones (fecha, idViaje, idUsuario, idEstado) VALUES ($fecha, $viaje_id, $usuario, 5)";
	mysqli_query($link,$query) or die ('Consulta fallida: ' .mysqli_error($link));
	$mensaje= "Se ha postulado exitosamente al viaje";
	header ("Location: ../verviaje.php?id_viaje=$viaje_id&mensaje=$mensaje");
?>