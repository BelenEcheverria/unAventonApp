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
    // foreach ($_POST['dias'] as $dia) {
    //     echo $dia;
    // } //imprime valores
     
     $tipo=$_POST['tipo'];
    // $dias=$_POST['dias'];  
     $origen=$_POST['origen'];
     $destino=$_POST['destino'];
     $fecha=$_POST['fecha'];
     $fechainicial=$_POST['fechainicio'];
     $fechafinal=$_POST['fechafinal'];
     $horapartida=$_POST['horaPartida'];
     $duracion=$_POST['duracion'];
     $vehiculo=$_POST['vehiculo']; 
     $consultaVehiculo = "SELECT * FROM vehiculos where id=$vehiculo";
     $resultadoConsultaVehiculo = mysqli_query($link,$consultaVehiculo);
     $rowVehiculo = mysqli_fetch_array($resultadoConsultaVehiculo);
     $asientosDisponibles = $rowVehiculo['asientos'];
     $precioTOTAL=$_POST['precio'];
     $precio = ceil($precioTOTAL/$asientosDisponibles);
     $texto=$_POST['texto'];
	 //CREO PARTIDA CON FECHA Y HORA
	$partida = $fecha.' '.$horapartida;
	$partida = new DateTime($partida);
	//CREO LLEGADA CON DURACION
	$PT = 'PT';
	$min = 'H00M';
	$cadena = $PT.$duracion.$min;
	$intervalo = new DateInterval($cadena);
	echo date_format($partida, "d/m/y h:i:s");
  echo '<br>';
	$llegada = $partida;
	echo date_format($llegada, "d/m/y h:i:s");
  echo '<br>';
  $llegada->add($intervalo);
	if((isset($tipo)) && (!empty($origen)) && (!empty($destino)) && ((!empty($fecha)) OR ((isset($fechainicial)) && (isset($fechafinal)))) && (isset($horapartida)) && (($duracion != 0) && (isset($vehiculo)) && ($precio != 0) && (isset($texto)))){

      if ($tipo=="1"){ //OCASIONAL
      	  $puedePublicar = true;
          $buscarVehichulo = "SELECT * FROM viajes WHERE idVehiculo = $vehiculo";
          $resultVehiculo = mysqli_query($link,$buscarVehichulo);
          $rVehiculo = mysqli_fetch_array($resultVehiculo);
          if (!empty($rVehiculo)){
              $resultVehiculo = mysqli_query($link,$buscarVehichulo); 
              while ($rVehiculo = mysqli_fetch_array($resultVehiculo)){
                $cadenaUno=$rVehiculo['fecha'].$rVehiculo['horaPartida'];
                $cadenaUno= new DateTime($cadenaUno);
                echo 'CadenaUNO:';
                echo date_format($cadenaUno, "d/m/y h:i:s");
                echo '<br>';
                $duracion=$rVehiculo['duracion'];
                $PT = 'PT';
                $min = 'H00M';
                $cadena = $PT.$duracion.$min;
                $intervalo = new DateInterval($cadena);
                $cadenaDos = $cadenaUno;
                $cadenaDos->add($intervalo);
                echo 'CadenaDOS:';
                echo date_format($cadenaDos, "d/m/y h:i:s");
                echo '<br>';
                var_dump($partida > $cadenaDos);
                var_dump($partida > $cadenaUno);
                if (($cadenaUno > $partida)){
                  echo 'partida';
                  $puedePublicar = false;
                }
                var_dump($llegada > $cadenaDos);
                var_dump($llegada > $cadenaUno);
                if (($llegada < $cadenaDos)){
                    $puedePublicar = false;
                    echo 'llegada';
                }
              }
            }      
          if ($puedePublicar == false){
              $mensaje = "Su viaje se superpone con otro ya ingresado, ingrese otro horario, elija otro día o cambie de vehículo.";
              //header("Location: ErrorPublicarViaje.php?mensaje=$mensaje"); 
          }    
          else{  //NO TIENE VIAJES CON DEUDA, NI DEBE CALIFICACIONES, NI COINCIDE CON FECHAS INGRESADAS
              mysqli_query($link, "INSERT INTO viajes(fecha, horaPartida, duracion, precio, texto, idEstado, idOrigen, idDestino, idVehiculo, idConductor ) VALUES ('$fecha', '$_POST[horaPartida]', '$_POST[duracion]', '$precio', '$_POST[texto]', '1', '$_POST[origen]', '$_POST[destino]', '$_POST[vehiculo]', '$ID')");
              echo 'Se publico el viaje';
    			    //header ("Location: Inicio.php"); 
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
                   $buscarViajes = "SELECT * FROM viajes WHERE idConductor = $ID AND (hora >= $horapartida AND hora <= $horarioconduracion AND fecha = '$fechaBase' AND idVehiculo = $vehiculo)";
                   $resultviajes = mysqli_query($link,$buscarViajes);
                   $rUNO = mysqli_fetch_array($resultviajes);
                   //$buscarCalificaciones = "SELECT * FROM calificaciones WHERE idUsuarioAutor='$ID'";
                   if (!empty($rUNO)){
                      $mensaje = "Su viaje se superpone con otro ya ingresado, ingrese otro horario, elija otro día o cambie de vehículo.";
                      header("Location: ErrorPublicarViaje.php?mensaje=$mensaje"); 
                   }
                   else{  //NO TIENE VIAJES CON DEUDA, NI DEBE CALIFICACIONES, NI COINCIDE CON FECHAS INGRESADAS
                     mysqli_query($link, "INSERT INTO viajes(fecha, horaPartida, duracion, precio, texto, idEstado, idOrigen, idDestino, idVehiculo, idConductor ) VALUES ('$fechaBase', '$_POST[horapartida]', '$_POST[duracion]', '$_POST[precio]', '$_POST[texto]', '1', '$_POST[origen]', '$_POST[destino]', '$_POST[vehiculo]', '$ID')");
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
      //header("Location: ErrorPublicarViaje.php?mensaje=$mensaje"); 
    }
?>