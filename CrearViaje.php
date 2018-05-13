<?php
    include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
    include "php/classLogin.php";
    $usuario= new usuario();
    $usuario -> session ($usuarioID, $admin);
    $ID= $_SESSION['id'];
    session_start();

    if((isset($_POST["origen"])) && ($_POST["origen"] != "") && (isset($_POST["destino"])) && ($_POST["destino"] != "") && (isset($_POST["dia"])) && ($_POST["dia"] != "") && (isset($_POST["horapartida"])) && ($_POST["horapartida"] != "") && (isset($_POST["minutospartida"])) && ($_POST["minutospartida"] != "") && (isset($_POST["duracionhoras"])) && ($_POST["duracionhoras"] != "") && (isset($_POST["duracionmin"])) && ($_POST["duracionmin"] != "") && (isset($_POST["vehiculo"])) && ($_POST["vehiculo"] != "") && (isset($_POST["precio"])) && ($_POST["precio"] != "") && (isset($_POST["texto"])) && ($_POST["texto"] != "")){ 
       $buscarViajes = "SELECT * FROM viajes WHERE idConductor=$ID AND (idEstado == 'Finalizado, sin pagar' OR fecha == $_POST[dia])";  
       $resultviajes = mysqli_query($link,$buscarViajes);
       $rUNO = mysqli_fetch_array($resultviajes);
       //$buscarCalificaciones = "SELECT * FROM calificaciones WHERE idUsuarioAutor='$ID'";
       if (!empty($rUNO)){
          $_SESSION["error"]="Verifique sus pagos, califiaciones pendientes y la fecha de viaje";
          header("Location: PublicarViaje.php");
       }
       else{  //NO TIENE VIAJES CON DEUDA, NI DEBE COINCIDE CON FECHAS INGRESADAS
         mysqli_query($link, "INSERT INTO viajes(id, fecha, hora, minuto, duracionHoras, duracionMinutos, precio, texto, idEstado, idOrigen, idDestino, idVehiculo, idConductor ) VALUES (null, '$_POST[dia]', '$_POST[horapartida]', '$_POST[minutospartida]', '$_POST[duracionhoras]', '$_POST[duracionmin]', '$_POST[precio]', '$_POST[texto]', '$_POST[Pendiente]', '$_POST[origen]', '$_POST[destino]', '$_POST[vehiculo]', '$_POST[$ID]')");
         header("Location: Inicio.php"); 
       }
    } 
    else{
      $_SESSION["error"]="No ingresó todos los datos";
      header("Location: PublicarViaje.php"); 
    }
?>