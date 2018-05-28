<?php
	include "conection.php"; 
	$link = conectar();
	$mensaje1="";
	$mensaje2="";
	if (isset ($_POST['id'])){
		$id= $_POST['id'];
	}
	if ((isset ($_POST['id'])) and (isset($_POST['modelo'])) and (isset($_POST['marca'])) and (isset($_POST['tipo'])) and (isset ($_POST['anio'])) and (isset ($_POST['color'])) and (isset ($_POST['asientos'])) ){
		$id= $_POST['id'];
		$marca= $_POST['marca'];
		$modelo= $_POST['modelo'];
		$color= $_POST['color'];
		$anio= $_POST['anio'];
		$tipo= $_POST['tipo'];
		$asientos= $_POST['asientos'];
		if ((!empty($marca)) and (!empty($modelo)) and (!empty($color)) and (!empty($anio)) and (!empty($tipo)) and (!empty($asientos)) ){
			$query72= ("UPDATE vehiculos SET modelo='$modelo', marca='$marca', anio='$anio', color='$color', asientos='$asientos', tipo='$tipo' WHERE id='$id'");
				$result72= (mysqli_query ($link, $query72) or die ('Consuluta query72 fallida: ' .mysqli_error($link)));		
				$mensaje1= "Los datos del vehiculo se han actualizado correctamente";
		} else {
			$mensaje1="Por favor, no deje ningun campo en blanco ";
		}
	} else {
		$mensaje1="Por favor, no deje ningun campo en blanco";
	}
	
	$mensajeEditar = $mensaje1 . $mensaje2;
	header ("Location: ../ModificarVehiculo.php?id=$id&mensajeEditar=$mensajeEditar");
?>