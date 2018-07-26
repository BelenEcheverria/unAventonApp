<html>
<head>
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="2. Estilos (2).css">
	<title> Calificaciones pendientes </title>
	<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<div class= "div_body">
	<?php
	include "Header.php";
	include "MenuBarra.php";
	?>
	<?php
	try {
		$usuario -> iniciada($usuarioID);
		$id = $_SESSION['id'];
	?>
		<div class="tituloMisViajes"> Calificaciones pendientes como Conductor </div>
		<?php	
		$query= "SELECT * FROM viajes WHERE (idEstado=3 OR idEstado=4) AND idConductor= $id ORDER BY fecha ASC";
		$result = mysqli_query($link, $query);
		while($viajes = mysqli_fetch_array($result)){ 
			$id_viaje = $viajes['id'];
			$id_Destino = $viajes['idDestino'];
			$id_Origen = $viajes['idOrigen'];
			$id_Vehiculo = $viajes['idVehiculo'];
			$dia = $viajes['fecha'];
			$horaPartida = $viajes['hora'];
			$minutosPartida = $viajes['minuto'];
			$precioTotal = $viajes['precio'];	
			$duracionHoras = $viajes['duracionHoras'];
			$duracionMinutos = $viajes['duracionMinutos'];
		    /*---------------AGREGO QUE MUESTRE El Destino---------------*/
			$consultaDestino = "SELECT * FROM ciudades where id=$id_Destino";
			$resultadoConsultaDest = mysqli_query($link,$consultaDestino);
			$rowCiudadDest = mysqli_fetch_array($resultadoConsultaDest);
			$destinoViaje = $rowCiudadDest['ciudad'];
			//---------------AGREGO QUE MUESTRE El Origen---------------
			$consultaOrigen = "SELECT * FROM ciudades where id=$id_Origen";
			$resultadoConsulta = mysqli_query($link,$consultaOrigen);
			$rowCiudad = mysqli_fetch_array($resultadoConsulta);
			$origenViaje = $rowCiudad['ciudad'];
			//---------------AGREGO QUE MUESTRE Los asientos del vehiculo---------------
			$consultaVehiculo = "SELECT * FROM vehiculos where id=$id_Vehiculo";
			$resultadoConsultaVehiculo = mysqli_query($link,$consultaVehiculo);
			$rowVehiculo = mysqli_fetch_array($resultadoConsultaVehiculo);
			$vehiculoViaje = $rowVehiculo['modelo'];
			$asientosDisponibles = $rowVehiculo['asientos'];
			//
			$query2 = "SELECT * FROM calificacionesPendientes WHERE idViaje = $id_viaje AND idUsuarioAutor = $id";
			$result2 = mysqli_query($link, $query2);
			$row2 = mysqli_fetch_array($result2);
			if (!empty($row2)){
			?>
				<div class="ListadoBotonesDelViajeComoConductor">
					<a href="3. CalificarPasajeros.php?id_viaje=<?php echo $id_viaje ?>"><div class="BotonCalificarUsuarios"> Calificar Pasajeros </div></a>
				</div>
				<div class="ListadoViajesConductor_detalle">
					<div class="div_vertical_detalle">
						<span class="InformacionViajeLineaSuperior_detalle">Origen: <?php echo utf8_encode($origenViaje);?></span> <br><br>
						<span class="InformacionViajeLineaSuperior_detalle">Destino: <?php echo utf8_encode($destinoViaje);?></span>
					</div>
					<div class="div_vertical_detalle">
						<span class="InformacionViajeLineaSuperior_detalle">Fecha: <?php echo utf8_encode($dia);?></span> <br><br>
						<span class="InformacionViajeLineaSuperior_detalle">Salida: <?php echo utf8_encode($horaPartida);?>:<?php echo ($minutosPartida);if ($minutosPartida == 0) {echo 0;}?></span>
					</div>
					<div class="div_vertical_detalle">
						<span class="InformacionViajeLineaSuperior_detalle">Vehiculo: <?php echo utf8_encode($vehiculoViaje);?></span> <br><br>
						<span class="InformacionViajeLineaSuperior_detalle">Duracion aprox: <?php echo $duracionHoras; echo 'h'; ?> <?php if ($duracionMinutos != 0) {echo $duracionMinutos; echo "min";} ?></span>
					</div>
					<div class="div_vertical_detalle">
						<span class="InformacionViajeLineaSuperior_detalle">Precio total: <?php echo '$'; echo $precioTotal; ?></span> <br><br>
						<span class="InformacionViajeLineaSuperior_detalle"> Lugares disponibles:
							<?php
							$viaje_id= $id_viaje;
							$query3= "SELECT * FROM postulaciones WHERE idViaje = $viaje_id AND idEstado = 1";
							$result3= mysqli_query ($link, $query3) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
							$asientosOcupados= 0;
							while ($postulacion = mysqli_fetch_array ($result3)){
								$asientosOcupados ++;
							}
							echo($asientosDisponibles - $asientosOcupados - 1);
							$lugaresDisponibles = ($asientosDisponibles - $asientosOcupados)
							?>
						</span>
					</div>
				</div>
		<?php
			}
		}
		?>
		<div class="tituloMisViajes"> Calificaciones pendientes como Pasajero </div>
		<?php	
		$query= "SELECT *
		FROM viajes v INNER JOIN postulaciones p ON  v.id = p.idViaje
		WHERE (v.idEstado=3 OR v.idEstado=4) AND p.idEstado = 4 AND p.idUsuario= $id
		ORDER BY v.fecha ASC";
		$result = mysqli_query($link, $query);
		while($viajes = mysqli_fetch_array($result)){ 
			$id_viaje = $viajes['idViaje'];
			$id_Destino = $viajes['idDestino'];
			$id_Origen = $viajes['idOrigen'];
			$id_Vehiculo = $viajes['idVehiculo'];
			$dia = $viajes['fecha'];
			$horaPartida = $viajes['hora'];
			$minutosPartida = $viajes['minuto'];
			$precioTotal = $viajes['precio'];	
			$duracionHoras = $viajes['duracionHoras'];
			$duracionMinutos = $viajes['duracionMinutos'];
		    /*---------------AGREGO QUE MUESTRE El Destino---------------*/
			$consultaDestino = "SELECT * FROM ciudades where id=$id_Destino";
			$resultadoConsultaDest = mysqli_query($link,$consultaDestino);
			$rowCiudadDest = mysqli_fetch_array($resultadoConsultaDest);
			$destinoViaje = $rowCiudadDest['ciudad'];
			//---------------AGREGO QUE MUESTRE El Origen---------------
			$consultaOrigen = "SELECT * FROM ciudades where id=$id_Origen";
			$resultadoConsulta = mysqli_query($link,$consultaOrigen);
			$rowCiudad = mysqli_fetch_array($resultadoConsulta);
			$origenViaje = $rowCiudad['ciudad'];
			//---------------AGREGO QUE MUESTRE Los asientos del vehiculo---------------
			$consultaVehiculo = "SELECT * FROM vehiculos where id=$id_Vehiculo";
			$resultadoConsultaVehiculo = mysqli_query($link,$consultaVehiculo);
			$rowVehiculo = mysqli_fetch_array($resultadoConsultaVehiculo);
			$vehiculoViaje = $rowVehiculo['modelo'];
			$asientosDisponibles = $rowVehiculo['asientos'];
			//
			$id_conductor = $viajes['idConductor'];
			$query2 = "SELECT * FROM calificacionesPendientes WHERE idViaje = $id_viaje";
			$result2 = mysqli_query($link, $query2);
			$row2 = mysqli_fetch_array($result2);
			if (!empty($row2)){
			?>
				<div class="ListadoBotonesDelViajeComoConductor">
					<a href="3. CalificarUsuario.php?id_usuario=<?php echo $id_conductor ?>"><div class="BotonCalificarUsuarios"> Calificar Conductor </div></a>
				</div>
				<div class="ListadoViajesConductor_detalle">
					<div class="div_vertical_detalle">
						<span class="InformacionViajeLineaSuperior_detalle">Origen: <?php echo utf8_encode($origenViaje);?></span> <br><br>
						<span class="InformacionViajeLineaSuperior_detalle">Destino: <?php echo utf8_encode($destinoViaje);?></span>
					</div>
					<div class="div_vertical_detalle">
						<span class="InformacionViajeLineaSuperior_detalle">Fecha: <?php echo utf8_encode($dia);?></span> <br><br>
						<span class="InformacionViajeLineaSuperior_detalle">Salida: <?php echo utf8_encode($horaPartida);?>:<?php echo ($minutosPartida);if ($minutosPartida == 0) {echo 0;}?></span>
					</div>
					<div class="div_vertical_detalle">
						<span class="InformacionViajeLineaSuperior_detalle">Vehiculo: <?php echo utf8_encode($vehiculoViaje);?></span> <br><br>
						<span class="InformacionViajeLineaSuperior_detalle">Duracion aprox: <?php echo $duracionHoras; echo 'h'; ?> <?php if ($duracionMinutos != 0) {echo $duracionMinutos; echo "min";} ?></span>
					</div>
					<div class="div_vertical_detalle">
						<span class="InformacionViajeLineaSuperior_detalle">Precio total: <?php echo '$'; echo $precioTotal; ?></span> <br><br>
						<span class="InformacionViajeLineaSuperior_detalle"> Lugares disponibles:
							<?php
							$viaje_id= $id_viaje;
							$query3= "SELECT * FROM postulaciones WHERE idViaje = $viaje_id AND idEstado = 1";
							$result3= mysqli_query ($link, $query3) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
							$asientosOcupados= 0;
							while ($postulacion = mysqli_fetch_array ($result3)){
								$asientosOcupados ++;
							}
							echo($asientosDisponibles - $asientosOcupados - 1);
							$lugaresDisponibles = ($asientosDisponibles - $asientosOcupados)
							?>
						</span>
					</div>
				</div>
		<?php
			}
		}
		?>
	<?php	
	} catch (Exception $e) {
	?>
		<div>
			<br><br>
			<p> Usted no ha iniciado sesion </p>
			<p> Por favor
			<a href="Inicio_Sesion.php"> inicie sesion </a>
			o
			<a href="Bienvenida.php"> registrese </a>
			para ver este contenido
		</div>
		<?php
		}
		?>
</html>