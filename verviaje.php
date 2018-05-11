<?php
    include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
    $viaje_id = $_GET['id'];
//Trae de base de datos la informacion de los viajes
	$q = "SELECT * FROM viajes where id=$viaje_id ";
   	$result = mysqli_query($link,$q);
	$row = mysqli_fetch_array($result);
	$id_viaje = $row['id'];
	$fecha = $row['fecha'];
	$duracion = $row['duracion'];
	$precio = $row['precio'];
	$texto = $row['texto'];
	$estado =$row['idEstado'];
	$origen = $row['idOrigen'];
	$destino = $row['idDestino'];
	$tipo_vehiculo = $row['idVehiculo'];
	$nombre_Conductor = $row['idConductor'];
?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<meta charset="utf-8"/>
</head>
<body background="Imagenes/FondoColores.jpg">
<?php
include "Header.php";
include "MenuBarra.php";
?>
<div style="width:100%;height:81%">
	<div class="ParteViajesDeAUno">
	<div class="ListadoViajes">
			<table style="width:80%; margin-left:2%;">
				<tr>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Origen: " . utf8_encode($origen)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Destino: " .utf8_encode($destino)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Fecha: " . utf8_encode($fecha)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Duracion: " . utf8_encode($duracion)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Precio: " . utf8_encode($precio)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "texto: " . utf8_encode($texto)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Vehiculo: " . utf8_encode($tipo_vehiculo)?></td>	
				</tr>
				<div><input type="submit" class="BotonReservarAsiento" value="Reservar Asiento"></div>
			</table>
	</div>
</div>
</body>
</html>