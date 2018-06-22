<?php
	include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$estadoPostulacion = $_GET['estadoPostulacion'];
	$idViaje = $_GET['idViaje'];
	$ID = $_SESSION['id'];
	$consulta = "UPDATE postulaciones set idEstado=3 WHERE idViaje=$idViaje AND idUsuario=$ID"; 
	$result = mysqli_query($link,$consulta);
	if ( $estadoPostulacion == 1 ) {
		$comentario = 'Penalizacion por dar de baja postulacion aceptada';
		$puntuacion = -1;
		$literalConductor = 'conductor';
		$fecha = date("y/m/d");
		$consulta = "INSERT INTO calificacion (fecha,rol,puntuacion,comentario,idUsuarioAutor,idUsuarioCalificado)
		VALUES ('$fecha','$literalConductor','$puntuacion','$comentario','125','$ID')"; 
		mysqli_query($link,$consulta) or die ('Consulta fallida: ' .mysqli_error($link));
	}
	echo 'Postulacion cancelada';
?>