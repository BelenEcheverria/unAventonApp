<?php
	include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$viaje_id = $_GET['id_viaje'];
	$ID = $_SESSION['id'];
	$consultaPostulaciones = "SELECT * FROM viajes WHERE id = $viaje_id AND idConductor = $ID INNER JOIN postulaciones WHERE idUsuario = $ID and idEstado = 1 "; // id Estado = 1 significa que aceptó un pasajero
	$resconsultaPostulaciones = mysqli_query($link,$consultaPostulaciones);
	$rUNO = mysqli_fetch_array($resconsultaPostulaciones);
    if (!empty($rUNO)){ //se aceptó al menos un pasajero
       	$consultacalif ="SELECT * FROM calificacion WHERE idUsuarioAutor = $ID AND rol = 'conductor'";
       	$rescalif = mysqli_query($link,$consultacalif);
       	$puntuacion = $rescalif['puntuacion'];
       	$puntuacion = $puntuacion-1;
        $actualizarptos = "UPDATE calificacion SET puntuacion = '$puntuacion' WHERE id = $ID AND rol = 'conductor'";
        $resptos= mysqli_query($link,$actualizarptos);
    }
    mysqli_query($link, "UPDATE viajes SET idEstado='5' WHERE id = $viaje_id");
	header ("Location: Inicio.php")

//Bajar puntuacion si tenia pasajeros aceptados, a los pasajeros aceptados 

?>

