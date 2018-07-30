<html>
<head>
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="2. Estilos (2).css">
	<title> Pagos pendientes </title>
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
		<div class="tituloMisViajes"> Pagos pendientes como Conductor </div>
		<?php	
		$query= "SELECT * FROM viajes WHERE idEstado=3 AND idConductor= $id ORDER BY fecha ASC";
		$result = mysqli_query($link, $query);
		while($viajes = mysqli_fetch_array($result)){ 
			$id_viaje = $viajes['id'];
				$id_Destino = $viajes['idDestino'];
				$id_Origen = $viajes['idOrigen'];
				$id_Vehiculo = $viajes['idVehiculo'];
				$dia = $viajes['fecha'];
				$horaPartida = $viajes['horaPartida'];
				$precioTotal = $viajes['precio'];	
				$duracionHoras = $viajes['duracion'];
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
			?>
				<div class="ListadoBotonesDelViajeComoConductor">
					<a href="3. PagarViaje.php?id_viaje=<?php echo $id_viaje ?>"><div class="BotonCalificarUsuarios"> PagarViaje </div></a>
				</div>
				<div class="ListadoViajesConductor_detalle">
						<div class="div_vertical_detalle">
							<span class="InformacionViajeLineaSuperior_detalle">Origen: <?php echo utf8_encode($origenViaje);?></span> <br><br>
							<span class="InformacionViajeLineaSuperior_detalle">Destino: <?php echo utf8_encode($destinoViaje);?></span>
						</div>
						<div class="div_vertical_detalle">
							<span class="InformacionViajeLineaSuperior_detalle">Fecha: <?php echo utf8_encode($dia);?></span> <br><br>
							<span class="InformacionViajeLineaSuperior_detalle">Salida: <?php echo substr($horaPartida,0,5);?></span>
						</div>
						<div class="div_vertical_detalle">
							<span class="InformacionViajeLineaSuperior_detalle">Vehiculo: <?php echo utf8_encode($vehiculoViaje);?></span> <br><br>
							<span class="InformacionViajeLineaSuperior_detalle">Duracion aprox: <?php echo $duracionHoras; echo 'hs'; ?></span>
						</div>
						<div class="div_vertical_detalle">
							<span class="InformacionViajeLineaSuperior_detalle">Precio total: <?php echo '$'; echo $precioTotal; ?></span> <br><br>
							<span class="InformacionViajeLineaSuperior_detalle"> Comision a pagar:
							<?php echo '$'; echo round ($precioTotal * 0.05); ?>
							</span>
						</div>
					</div>
		<?php
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