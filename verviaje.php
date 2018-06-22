<?php
     include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
    $viaje_id = $_GET['id_viaje'];
//Trae de base de datos la informacion de los viajes
	$q = "SELECT * FROM viajes where id=$viaje_id ";
   	$result = mysqli_query($link,$q);
	$row = mysqli_fetch_array($result);
	$fecha = $row['fecha'];
	$duracion = $row['duracionHoras'];
	$duracionMinutos = $row['duracionMinutos'];
	$horaPartida = $row['hora'];
	$minutosPartida = $row['minuto'];
	$precio = $row['precio'];
	$texto = $row['texto'];
	$estado =$row['idEstado'];
	$origen = $row['idOrigen'];
	$destino = $row['idDestino'];
	$id_Vehiculo = $row['idVehiculo'];

/*---------------AGREGO QUE MUESTRE El Destino---------------*/
	$consultaDestino = "SELECT * FROM ciudades where id=$destino";
	$resultadoConsultaDest = mysqli_query($link,$consultaDestino);
	$rowCiudadDest = mysqli_fetch_array($resultadoConsultaDest);
	$destinoViaje = $rowCiudadDest['ciudad'];

//---------------AGREGO QUE MUESTRE El Origen---------------
	$consultaOrigen = "SELECT * FROM ciudades where id=$origen";
	$resultadoConsulta = mysqli_query($link,$consultaOrigen);
	$rowCiudad = mysqli_fetch_array($resultadoConsulta);
	$origenViaje = $rowCiudad['ciudad'];

//---------------AGREGO QUE MUESTRE Los asientos del vehiculo---------------
	$consultaVehiculo = "SELECT * FROM vehiculos where id=$id_Vehiculo";
	$resultadoConsultaVehiculo = mysqli_query($link,$consultaVehiculo);
	$rowVehiculo = mysqli_fetch_array($resultadoConsultaVehiculo);
	$vehiculoViaje = $rowVehiculo['modelo'];
	$asientosDisponibles = $rowVehiculo['asientos'];
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
<br><br>
<div style="width:100%;height:80%;margin-left:10%;">
	<div class="ParteViajes">
	<div class="ListadoViajes">
			<table style="width:80%; margin-left:2%;font-family: Arial;">
				<tr>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Origen: " . utf8_encode($origenViaje)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Destino: " .utf8_encode($destinoViaje)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Fecha: " . utf8_encode($fecha)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Horario: " . utf8_encode($horaPartida)?><?php echo ":" . utf8_encode($minutosPartida)?>h</td>
					<?php 
					if ($duracionMinutos != 0){?>
						<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Duracion: " . utf8_encode($duracion)?>h<?php echo ":" . utf8_encode($duracionMinutos)?>min</td>
					<?php }

					else{?>
						<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Duracion: " . utf8_encode($duracion)?>h</td>
					<?php } ?>
				</tr>
				<tr>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Precio: $" . utf8_encode($precio)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Vehiculo: " . utf8_encode($vehiculoViaje)?></td>
					<td class="AlineacionCajasListaViajesHorizontal"><?php echo "Comentario: " . utf8_encode($texto)?></td>
				</tr>
				<?php 
					$consultaYaPostulado = "SELECT * FROM postulaciones WHERE idViaje=$viaje_id AND idUsuario=$usuarioID";
					$resultadoYaPostulado = mysqli_query($link,$consultaYaPostulado);
					if (mysqli_num_rows($resultadoYaPostulado) == 0 ) { ?>
						<div><input  style="width:15%;margin-top:3.5%;color:white;height:8%;border-color:white;" type="submit" class="BotonReservarAsiento" value="Reservar"></div>
					<?php } else { ?>
						<div><input  style="width:15%;margin-top:3.5%;color:white;height:8%;border-color:white;" type="submit" class="BotonReservarAsiento" value="Ya reservado"></div>
					<?php } ?>
			</table>
	</div>
</div>
</body>
</html>