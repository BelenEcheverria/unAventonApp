<?php
    include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
    include "php/classLogin.php";
    $usuario= new usuario();
    $usuario -> session ($usuarioID, $admin);
    $ID= $_SESSION['id']; 

     $viaje_id = $_GET['viaje_id'];  
     $origen=$_POST['origen'];
     $destino=$_POST['destino'];
     $fecha=$_POST['fecha'];
     $horapartida=$_POST['horapartida'];
     $duracion=$_POST['duracion']; 
     $vehiculo=$_POST['vehiculo']; 
     $consultaVehiculo = "SELECT * FROM vehiculos where id=$vehiculo";
     $resultadoConsultaVehiculo = mysqli_query($link,$consultaVehiculo);
     $rowVehiculo = mysqli_fetch_array($resultadoConsultaVehiculo);
     $asientosDisponibles = $rowVehiculo['asientos'];
     $precioTOTAL=$_POST['precio'];
     $precio = ceil($precioTOTAL/$asientosDisponibles);
     $texto=$_POST['texto'];
     $mensaje='$texto';
	if((!empty($origen)) && (!empty($destino)) && (!empty($fecha)) && ($horapartida != 0) && ($duracion != 0) && (!empty($vehiculo)) && ($precio != 0) && (!empty($texto))){
	   
   	$puedePublicar = true; 
    $buscarVehichulo = "SELECT * FROM viajes WHERE idVehiculo = $vehiculo";
    $resultVehiculo = mysqli_query($link,$buscarVehichulo);
	echo "<br> <br>";
	echo $buscarVehichulo;
    while ($rVehiculo = mysqli_fetch_array($resultVehiculo)){
		if ($rVehiculo['fecha'] == $fecha) {
            $horaacomparar = $rVehiculo['horaPartida'];
            $horaacomparar = date('h.i', $horaacomparar);
			$horaEnViaje= $horaacomparar + $rVehiculo['duracion'];
			if ($horapartida < $horaEnViaje) {
				$puedePublicar = false;
			}
		}
	}			 
    if ($puedePublicar == false){
        $mensaje = "Su viaje se superpone con otro ya ingresado, ingrese otro horario, elija otro día o cambie de vehículo.";
		header("Location: ErrorModificarViaje.php?mensaje=$mensaje"); 
	} else {	//NO COINCIDE CON FECHAS INGRESADAS DE OTROS VIAJES
          $queryMOD= ("UPDATE viajes SET fecha='$fecha', horaPartida='$horapartida', duracion='$duracion', precio='$precio', texto='$texto', idEstado='1', idOrigen='$origen', idDestino='$destino', idVehiculo='$vehiculo', idConductor='$ID' WHERE id = '$viaje_id'");
          $resultMOD= (mysqli_query ($link, $queryMOD) or die ('Consulta queryMOD fallida: ' .mysqli_error($link)));    
          header("Location: 2. MisViajes.php?id=$ID"); 
        }
}   
else{
	$mensaje=$_POST['origen'];
    $_SESSION["error"]="No ingresó todos los datos";
    echo "No ingreso todos los datos";
    header("Location: ErrorModificarViaje.php?mensaje=$mensaje"); 
}

?>