<?php
	include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$viaje_id = $_POST['viaje_id'];
	$ID = $_SESSION['id'];
	$consultaPostulaciones = "SELECT * FROM viajes WHERE id = $viaje_id AND idConductor = $ID INNER JOIN postulaciones WHERE idUsuario = $ID and idEstado = 1 "; // id Estado = 1 significa que aceptó un pasajero
	$resconsultaPostulaciones = mysqli_query($link,$consultaPostulaciones);
	$rUNO = mysqli_fetch_array($resconsultaPostulaciones);
    if (!empty($rUNO)){
       	$consultacalif ="SELECT puntuacion FROM calificacion WHERE id= $ID AND rol = 'conductor'"
       	$puntuacion= $puntuacion-1
       	$rescalif= mysqli_query($link,$consultacalif);
       	$rDOS = mysqli_fetch_array();
        $mensaje = "Se le descuenta 1 pto al conductor.";
        $actualizarptos = "UPDATE calificacion SET puntuacion = '$puntuacion' WHERE id = $ID AND rol = 'conductor'";
    }
    mysqli_query($link, "UPDATE viajes SET idEstado='5' WHERE id = $viaje_id");
    header("Location: Inicio.php"); 
	$consultaID = "SELECT * FROM viajes WHERE id = $viaje_id AND idConductor = $ID";
	$result = mysqli_query($link,$consultaID);
	while ($idViaje = mysqli_fetch_array($result)) {	
		$IDDefinitivo = $idViaje[0];
		$consulta = "UPDATE viajes set idEstado=5 WHERE id = $IDDefinitivo"; 
		$result3 = mysqli_query($link,$consulta);
	}
	$mensaje = "Su vehiculos se ha dado de baja";
	header ("Location: ../EliminarVehiculo.php?id=$id&mensajeEditar=$mensaje");
?>