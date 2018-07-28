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
  $partida = $fecha.' '.$horapartida.':00';
  $fechaInicio = date_create_from_format("Y-m-d H:i:s", $partida);
	//CREO LLEGADA CON DURACION
  $Llegada = date_create_from_format("Y-m-d H:i:s", $partida);
	$PT = 'PT';
	$min = 'H00M';
	$cadena = $PT.$duracion.$min;
	$intervalo = new DateInterval($cadena);
  $fechaFin =  date_create_from_format("Y-m-d H:i:s", date_format($Llegada, "Y-m-d H:i:s"));
  $fechaFin->add($intervalo);
  $result = $fechaFin->format('Y-m-d-H-i-s');
  $krr = explode('-',$result);
  $llegada = implode("",$krr);
	if((isset($tipo)) && (!empty($origen)) && (!empty($destino)) && ((!empty($fecha)) OR ((isset($fechainicial)) && (isset($fechafinal)))) && (isset($horapartida)) && (($duracion != 0) && (isset($vehiculo)) && ($precio != 0) && (isset($texto)))){

      if ($tipo=="1"){ //OCASIONAL
      	  $puedePublicar = false;
          $buscarVehichulo = "SELECT * FROM viajes WHERE idVehiculo = $vehiculo";
          $resultVehiculo = mysqli_query($link,$buscarVehichulo);
          $rVehiculo = mysqli_fetch_array($resultVehiculo);
          if (!empty($rVehiculo)){
              $resultVehiculo = mysqli_query($link,$buscarVehichulo); 
              while ($rVehiculo = mysqli_fetch_array($resultVehiculo)){
                $horapartida = $rVehiculo['horaPartida'];
                $horapartida = substr($rVehiculo['horaPartida'],0,5);
                $fecha = $rVehiculo['fecha'];
                $cadenaUno = $fecha.' '.$horapartida.':00';
                $Inicio = date_create_from_format("Y-m-d H:i:s", $cadenaUno);
                $duracion=$rVehiculo['duracion'];
                $PT = 'PT';
                $min = 'H00M';
                $cadena = $PT.$duracion.$min;
                $intervalo = new DateInterval($cadena);
                $cadenaDos = date_create_from_format("Y-m-d H:i:s", date_format($Inicio, "Y-m-d H:i:s"));
                $cadenaDos->add($intervalo);
                echo 'Partida:';
                echo $partida;
                echo '<br>';
                echo 'Llegada:';
                echo date_format($fechaFin, "Y-m-d H:i:s");
                echo '<br>';
                echo 'CadenaUno:';
                echo $cadenaUno;
                echo '<br>';
                echo 'CadenaDos:';
                echo date_format($cadenaDos, "Y-m-d H:i:s");
                echo '<br>';
                $ano = substr($llegada,0,4);
                echo $ano;
                echo '<br>';
                $mes = substr($llegada,4,2);
                echo $mes;
                echo '<br>';
                $dia = substr($llegada,6,2);
                echo $dia;
                echo '<br>';
                $hora = substr($llegada,8,2);
                echo $hora;
                echo '<br>';
                $minuto = substr($llegada,10,2);
                echo $minuto;
                echo '<br>';
                $segundo = substr($llegada,12,2);
                echo $segundo;
                echo '<br>';
                $llegada = $ano.'-'.$mes.'-'.$dia.' '.$hora.':'.$minuto.':'.$segundo;
                echo 'String:';
                echo $llegada;
                echo '<br>';
                var_dump($partida < $cadenaUno);
                echo '<br>';
                var_dump($llegada < $cadenaUno);
                echo '<br>';
                var_dump($fechaInicio > $cadenaDos);
                echo '<br>';
                var_dump($fechaFin > $cadenaDos);
                echo '<br>';
                if ((($partida < $cadenaUno) && ($fechaFin < $cadenaUno)) || 
                    (($fechaInicio > $cadenaDos) && ($fechaFin > $CadenaDos))) {
                    $puedePublicar = true;  
                }
                if (($partida < $cadenaUno) && ($llegada < $cadenaUno)){
                  echo 'El viaje es anterior';
                  echo '<br>';
                }
                if (($fechaInicio > $cadenaDos) && ($fechaFin > $CadenaDos)){
                  echo 'El viaje es posterior';
                  echo '<br>';
                }
                if (($partida > $cadenaUno) && ($fechaInicio < $cadenaDos)){
                  echo 'La partida esta en el medio';
                  echo '<br>';
                }
                if (($llegada > $cadenaUno) && ($fechaFin < $cadenaDos)){
                  echo 'La llegada esta en el medio';
                  echo '<br>';
                }
              }
          $puedePublicar = false;
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