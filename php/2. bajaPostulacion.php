<?php
    include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	
	if ((isset ($_POST['idVehiculo'])) and (isset ($_POST['idViaje'])) and (isset ($_POST['idPostulacion']))) {
		$vehiculo = $_POST['idVehiculo'];
		$viaje_id = $_POST['idViaje'];
		$idPostulacion= $_POST['idPostulacion'];
		$usuario_id= $_POST['usuario_id'];
	}

	$query = "UPDATE postulaciones SET idEstado=6 WHERE id= $idPostulacion";
	echo $query;
	mysqli_query($link,$query) or die ('Consulta fallida: ' .mysqli_error($link));
	
	$comentario = 'Penalizacion por dar de baja postulacion aceptada';
	$puntuacion = -1;
	$literalConductor = 'Conductor';
	$fecha = date("y/m/d");
	$consulta = "INSERT INTO calificacion (fecha,rol,puntuacion,comentario,idUsuarioAutor,idUsuarioCalificado)
	VALUES ('$fecha','$literalConductor','$puntuacion','$comentario','125','$usuario_id')"; 
	echo $consulta;
	mysqli_query($link,$consulta) or die ('Consulta fallida: ' .mysqli_error($link));
		
	header ("Location: ../2. MiViaje.php?id=$viaje_id");
?>