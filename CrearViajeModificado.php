<?php
    include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
    include "php/classLogin.php";
    $usuario= new usuario();
    $usuario -> session ($usuarioID, $admin);
    $ID= $_SESSION['id']; 

    //IMPRIMI TODO ANTES DE EMPEZAR A CARGAR LA BASE.
    //echo $_REQUEST['dias']; //imprime tipo de dato (array)
    //echo $_POST['fechainicio']; 2018-05-31
    //echo $_POST['fechafinal']; //2018-06-21
    //Paso a datetime
     foreach ($_POST['dias'] as $dia) {
         echo $dia;
     } //imprime valores
     $viaje_id = $_GET['viaje_id'];
     $tipo=$_POST['tipo'];
     $dias=$_POST['dias'];  
     $origen=$_POST['origen'];
     $destino=$_POST['destino'];
     $fecha=$_POST['fecha'];
     $fechainicial=$_POST['fechainicio'];
     $fechafinal=$_POST['fechafinal'];
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
     
   if((isset($dias)) && (isset($origen)) && (isset($destino)) && (isset($fecha)) OR (isset($fechainicial)) && (isset($fechafinal)) && ($horapartida != 0) && ($minutospartida !== null) && ($duracionhoras != 0) && ($duracionmin !== null) && (isset($vehiculo)) && ($precio != 0) && (isset($texto))){

             $buscarViajes = "SELECT * FROM viajes WHERE idConductor=$ID AND (hora = $horapartida AND fecha = '$fecha')";
             $resultviajes = mysqli_query($link,$buscarViajes);
             $rUNO = mysqli_fetch_array($resultviajes);
             //$buscarCalificaciones = "SELECT * FROM calificaciones WHERE idUsuarioAutor='$ID'";
             if (!empty($rUNO)){
                $mensaje = "Su viaje se superpone con otro ya ingresado, ingrese otro horario u elija otro día.";
                header("Location: ErrorModificarViaje.php?mensaje=$mensaje"); 
             }
             else{  //NO TIENE VIAJES CON DEUDA, NI DEBE CALIFICACIONES, NI COINCIDE CON FECHAS INGRESADAS
               mysqli_query($link, "INSERT INTO viajes WHERE id = $viaje_id (fecha, hora, minuto, duracionHoras, duracionMinutos, precio, texto, idEstado, idOrigen, idDestino, idVehiculo, idConductor ) VALUES ('$fecha', '$_POST[horapartida]', '$_POST[minutospartida]', '$_POST[duracionhoras]', '$_POST[duracionmin]', '$precio', '$_POST[texto]', '1', '$_POST[origen]', '$_POST[destino]', '$_POST[vehiculo]', '$ID')");
               header("Location: Inicio.php"); 
             }
      }
    else{
      $mensaje="No ingreso los datos";
      $_SESSION["error"]="No ingresó todos los datos";
      echo "No ingreso todos los datos";
      header("Location: ErrorModificarViaje.php?mensaje=$mensaje"); 
    } 
?>