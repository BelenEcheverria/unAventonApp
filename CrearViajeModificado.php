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
     $minutospartida=$_POST['minutospartida'];
     $duracionhoras=$_POST['duracionhoras']; 
     $duracionmin=$_POST['duracionmin'];
     $vehiculo=$_POST['vehiculo']; 
     $consultaVehiculo = "SELECT * FROM vehiculos where id=$vehiculo";
     $resultadoConsultaVehiculo = mysqli_query($link,$consultaVehiculo);
     $rowVehiculo = mysqli_fetch_array($resultadoConsultaVehiculo);
     $asientosDisponibles = $rowVehiculo['asientos'];
     $precioTOTAL=$_POST['precio'];
     $precio = ceil($precioTOTAL/$asientosDisponibles);
     $texto=$_POST['texto'];
     $mensaje='$texto';
   if((!empty($origen)) && (!empty($destino)) && (!empty($fecha)) && ($horapartida != 0) && ($minutospartida !== null) && ($duracionhoras != 0) && ($duracionmin !== null) && (!empty($vehiculo)) && ($precio != 0) && (!empty($texto))){
        $buscarViajes = "SELECT * FROM viajes WHERE idConductor=$ID AND (hora = $horapartida AND fecha = '$fecha' AND id!=$viaje_id)";
        $resultviajes = mysqli_query($link,$buscarViajes);
        $rUNO = mysqli_fetch_array($resultviajes);
        if (!empty($rUNO)){ //COINCIDE CON FECHA INGRESADA DE OTRO VIAJE DISTINTO 
          $mensaje = "Su viaje se superpone con otro ya ingresado, ingrese otro horario u elija otro día.";
          header("Location: ErrorModificarViaje.php?mensaje=$mensaje"); 
        }
        else{  //NO COINCIDE CON FECHAS INGRESADAS DE OTROS VIAJES
          $queryMOD= ("UPDATE viajes SET fecha='$fecha', hora='$horapartida', minuto='$minutospartida', duracionHoras='$duracionhoras', duracionMinutos='$duracionmin', precio='$precio', texto='$texto', idEstado='1', idOrigen='$origen', idDestino='$destino', idVehiculo='$vehiculo', idConductor='$ID' WHERE id = '$viaje_id'");
          $resultMOD= (mysqli_query ($link, $queryMOD) or die ('Consulta queryMOD fallida: ' .mysqli_error($link)));    
          header("Location: Inicio.php"); 
        }
      }   
    else{
      $mensaje=$_POST['origen'];
      $_SESSION["error"]="No ingresó todos los datos";
      echo "No ingreso todos los datos";
      header("Location: ErrorModificarViaje.php?mensaje=$mensaje"); 
    } 
?>