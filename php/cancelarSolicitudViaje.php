<?php
	include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$idViaje = $_POST['idViaje'];
	$idPasajero = $_POST['idPasajero'];
	$ID = $_SESSION['id'];
	$consulta = "UPDATE postulaciones set idEstado=03 WHERE idViaje = $idViaje AND idUsuario=$idPasajero"; 
	$result = mysqli_query($link,$consulta)
	$consulta = "SELECT * FROM postulaciones WHERE idViaje = $idViaje"; 
	$result = mysqli_query($link,$consulta);
	while ($postulacion = mysqli_fetch_array($result)) {	
		$estadoPostulacion = $postulacion['idEstado'];
		if ( $estadoPostulacion == 1 ) {
			$comentario = 'Penalizacion por da de baja postulante aceptado';
			$puntuacion = -1;
			$literalConductor = 'conductor';
			$fecha = date("y/m/d");
			$consulta = "INSERT INTO calificacion (fecha,rol,puntuacion,comentario,idUsuarioAutor,idUsuarioCalificado)
			VALUES ('$fecha','$literalConductor','$puntuacion','$cometario','$ID','$idPasajero'"; 
			$result3 = mysqli_query($link,$consulta);
		}
	}
?>