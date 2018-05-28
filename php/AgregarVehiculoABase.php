<?php
    include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$marca = $_POST['marca'];
	$modelo = $_POST['modelo'];
	$anio = $_POST['anio'];
	$tipo = $_POST['tipo'];
	$color = $_POST['color'];
	$patente = $_POST['patente'];
	$asientos = $_POST['asientos'];
	$yaExiste = ("SELECT * FROM vehiculos WHERE (idUsuario = '$usuarioID') AND (patente = '$patente')");
	$result = mysqli_query ($link,$yaExiste) or die ('Consulta fallida: ' .mysqli_error($link));
	$cumple = true;
	while ($patenteTabla = mysqli_fetch_array($result)){
		if ($patente == $patenteTabla['patente']){
			$cumple = false;
			$mensaje = 'El vehiculo ingresado ya se encuentra cargado en sus vehiculos';
		}
	}
	if ($cumple) {
		$var = "INSERT INTO vehiculos (idUsuario,patente,tipo,asientos,modelo,color,marca,anio)
		VALUES ('$usuarioID','$patente', '$tipo', '$asientos','$modelo','$color','$marca','$anio')";
		mysqli_query($link,$var) or die ('Consulta fallida: ' .mysqli_error($link));
		$mensaje= "El vehiculo se agrego correctamente";
	}
	header ("Location: ../AgregarVehiculo.php?&mensajeEditar=$mensaje");
?>