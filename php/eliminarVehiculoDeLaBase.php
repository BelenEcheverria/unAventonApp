<?php
	include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$patente = $_POST['patente'];
	$ID = $_SESSION['id'];
	$consultaID = "SELECT id FROM vehiculos WHERE patente = '$patente' AND idUsuario = $ID";
	$result = mysqli_query($link,$consultaID);
	while ($idVehiculo = mysqli_fetch_array($result)) {	
		$IDDefinitivo = $idVehiculo[0];
		$consulta = "UPDATE vehiculos set estaActivo=0 WHERE id = $IDDefinitivo"; 
		$result3 = mysqli_query($link,$consulta);
	}
	$mensaje = "Su vehiculos se ha dado de baja";
	header ("Location: ../EliminarVehiculo.php?id=$id&mensajeEditar=$mensaje");
?>