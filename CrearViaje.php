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
     
     $tipo=$_POST['tipo'];
     $dias=$_POST['dias'];  
     $origen=$_POST['origen'];
     $destino=$_POST['destino'];
     $fecha=$_POST['fecha'];
     echo "$fecha";
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
     $durmin=$minutospartida+$duracionmin;
     if ($durmin>60){ //LA SUMA TOTAL DE MAS DE 60 MIN, ES DECIR UNA HORA MAS
         $durhoras=$duracionhoras + ($durmin/60);
     }
     else{
         $durhoras=$duracionhoras + $durmin; 
     }
     $horarioconduracion=$horapartida+$durhoras;
   if((isset($tipo)) && (isset($dias)) && (isset($origen)) && (isset($destino)) && (isset($fecha)) OR (isset($fechainicial)) && (isset($fechafinal)) && ($horapartida != 0) && ($minutospartida !== null) && ($duracionhoras != 0) && ($duracionmin !== null) && (isset($vehiculo)) && ($precio != 0) && (isset($texto))){

      if ($tipo=="1"){ //OCASIONAL
             $buscarViajes = "SELECT * FROM viajes WHERE idConductor=$ID AND (hora>=$horapartida AND hora<=$horarioconduracion AND fecha=$fecha AND idVehiculo=$vehiculo)";
             $resultviajes = mysqli_query($link,$buscarViajes);
             $rUNO = mysqli_fetch_array($resultviajes);
             if (!empty($rUNO)){
                $mensaje = "Su viaje se superpone con otro ya ingresado, ingrese otro horario, elija otro día o cambie de vehículo.";
                header("Location: ErrorPublicarViaje.php?mensaje=$mensaje"); 
             }
             else{  //NO TIENE VIAJES CON DEUDA, NI DEBE CALIFICACIONES, NI COINCIDE CON FECHAS INGRESADAS
               mysqli_query($link, "INSERT INTO viajes(fecha, hora, minuto, duracionHoras, duracionMinutos, precio, texto, idEstado, idOrigen, idDestino, idVehiculo, idConductor ) VALUES ('$fecha', '$_POST[horapartida]', '$_POST[minutospartida]', '$_POST[duracionhoras]', '$_POST[duracionmin]', '$precio', '$_POST[texto]', '1', '$_POST[origen]', '$_POST[destino]', '$_POST[vehiculo]', '$ID')");
               header("Location: Inicio.php"); 
             }
      }
      else{//PERIODICO
            $begin = new DateTime($fechainicial);
            $end = new DateTime($fechafinal);
            date_add($end, date_interval_create_from_date_string('1 day')); //Agrego un día a fecha final por que no me imprimia el ultimo.
            echo $fechafinal;
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);
            foreach ($period as $dt) {
                $diaDeSemana = $dt->format("N");
                if (in_array($diaDeSemana, $dias)) {
                   echo $dt->format("N Y-m-d\n");
                   $fechaBase = ($dt->format("Y-m-d\n"));
                   $buscarViajes = "SELECT * FROM viajes WHERE idConductor=$ID AND (hora>=$horapartida AND hora<=$horarioconduracion AND fecha='$fechaBase' AND idVehiculo=$vehiculo)";
                   $resultviajes = mysqli_query($link,$buscarViajes);
                   $rUNO = mysqli_fetch_array($resultviajes);
                   //$buscarCalificaciones = "SELECT * FROM calificaciones WHERE idUsuarioAutor='$ID'";
                   if (!empty($rUNO)){
                      $mensaje = "Su viaje se superpone con otro ya ingresado, ingrese otro horario, elija otro día o cambie de vehículo.";
                      header("Location: ErrorPublicarViaje.php?mensaje=$mensaje"); 
                   }
                   else{  //NO TIENE VIAJES CON DEUDA, NI DEBE CALIFICACIONES, NI COINCIDE CON FECHAS INGRESADAS
                     mysqli_query($link, "INSERT INTO viajes(fecha, hora, minuto, duracionHoras, duracionMinutos, precio, texto, idEstado, idOrigen, idDestino, idVehiculo, idConductor ) VALUES ('$fechaBase', '$_POST[horapartida]', '$_POST[minutospartida]', '$_POST[duracionhoras]', '$_POST[duracionmin]', '$_POST[precio]', '$_POST[texto]', '1', '$_POST[origen]', '$_POST[destino]', '$_POST[vehiculo]', '$ID')");
                     header("Location: Inicio.php"); 
                   }
                }
            }    
        } 
    } 
    else{
      $mensaje="No ingreso los datos";
      $_SESSION["error"]="No ingresó todos los datos";
      echo "No ingreso todos los datos";
      header("Location: ErrorPublicarViaje.php?mensaje=$mensaje"); 
    } 
?>