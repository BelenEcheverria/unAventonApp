<?php
    include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	
	if ((isset ($_POST['idVehiculo'])) and (isset ($_POST['idViaje'])) and (isset ($_POST['idPostulacion']))) {
		$vehiculo = $_POST['idVehiculo'];
		$viaje_id = $_POST['idViaje'];
		$idPostulacion= $_POST['idPostulacion'];
	}

	
	function hayLugar($vehiculo, $viaje_id, $idPostulacion, $link)
	{
		$query= "SELECT * FROM vehiculos WHERE id= $vehiculo";
		$result=  mysqli_query ($link,$query);
		$vehiculo = mysqli_fetch_array($result);
		$lugaresTotales= $vehiculo['asientos'];
		$query3= "SELECT * FROM postulaciones WHERE idViaje = $viaje_id AND idEstado = 1";
		$result3= mysqli_query ($link, $query3);
		$asientosOcupados= 0;
		while ($postulacion = mysqli_fetch_array ($result3)){
			$asientosOcupados ++;
		}
		$lugaresDisponibles= ($lugaresTotales - $asientosOcupados);
		return ($lugaresTotales >= $lugaresDisponibles);
	}
	
	if (hayLugar($vehiculo, $viaje_id, $idPostulacion, $link) ) {
		$query = "UPDATE postulaciones SET idEstado=1 WHERE id= $idPostulacion";
		echo $query;
		mysqli_query($link,$query) or die ('Consulta fallida: ' .mysqli_error($link));
		$mensaje= "";
	} else {
		echo "no hay lugar";
		$mensaje= "No hay lugares disponibles";
	}
	header ("Location: ../2. MiViaje.php?id=$viaje_id");
?>