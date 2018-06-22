<?php
	include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$viaje_id = $_GET['id_viaje'];
	$ID = $_SESSION['id'];
    mysqli_query($link, "UPDATE viajes SET idEstado=5 WHERE id = $viaje_id");
    $consultaPostulaciones= "SELECT * FROM postulaciones WHERE idViaje = $viaje_id AND idEstado = 1";
	$resconsultaPostulaciones = mysqli_query($link,$consultaPostulaciones);
	$rUNO = mysqli_fetch_array($resconsultaPostulaciones);
    if (!empty($rUNO)){ //se aceptó al menos un pasajero
    	mysqli_query($link, "UPDATE postulaciones SET idEstado=6 WHERE idViaje=$viaje_id");
       	$consultacalif ="SELECT * FROM calificacion WHERE idUsuarioAutor = $ID AND rol = 'conductor'";
       	$comentario = 'Penalizacion por eliminar un viaje con postulantes aceptados';
		$puntuacion = -1;
		$literalConductor = 'conductor';
		$fecha = date("y/m/d");
		$consulta = "INSERT INTO calificacion (fecha,rol,puntuacion,comentario,idUsuarioAutor,idUsuarioCalificado)
		VALUES ('$fecha','$literalConductor','$puntuacion','$comentario','$ID','$ID')"; 
		mysqli_query($link,$consulta) or die ('Consulta fallida: ' .mysqli_error($link));
    }
	header ("Location: Inicio.php");

//Bajar puntuacion si tenia pasajeros aceptados, a los pasajeros aceptados hay que sacarlos del viaje (ID ESTADO DE POSTULACIONES = 6 VIAJE CANCELADO)
?>

