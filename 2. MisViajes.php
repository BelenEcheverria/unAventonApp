<?php
include_once "php/conection.php"; // conectar y seleccionar la base de datos
$link = conectar();
include_once "php/classLogin.php";
$usuario= new usuario();
$usuario -> session ($usuarioID, $admin);
?>
<html>
<head>
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="2. Estilos (2).css">
	<link rel="stylesheet" href="estilos.css">
	<title> Mis Viajes </title>
	<script src="ValidarViaje.js"></script>
	<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
	<div class= "div_body">
		<?php
		include "Header.php";
		include "MenuBarra.php";
		?>
		<div class="tituloMisViajes"> Viajes como Conductor </div>
		<?php
		try {
			$usuario -> iniciada($usuarioID);
			$id = $_GET['id'];
			?>
			<?php	
			$query= "SELECT * FROM viajes WHERE idEstado=1 AND idConductor= $id ORDER BY fecha ASC";
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
			?>
				<div>
					<div class="ListadoBotonesDelViajeComoConductor">
						<a href="modificarViaje.php?id_viaje=<?php echo $id_viaje ?>"><div class="BotonCancelarModificar">Editar</div></a>
						<a href="EliminarViaje.php?id_viaje=<?php echo $id_viaje ?>"><button class="BotonCancelarModificar" onclick="return Eliminar()">Cancelar</button></a>
						<a href="2. MiViaje.php?id=<?php echo $id_viaje; ?>"><div class="BotonCancelarModificar">Postulantes</div></a>
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
				</div>
			<?php	
			/*<div class="BotonReservarAsiento">
			<a href="modificarViaje.php?id_viaje=<?php echo $id_viaje ?>"> Editar </a>
			<a href="EliminarViaje.php?id_viaje=<?php echo $id_viaje ?>"> Cancelar </a>
			</div>*/
			}
		}
		catch (Exception $e) {
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
	<br><hr>
	<div class="tituloMisViajes"> Viajes como pasajero </div>
	<?php
	try {
		$usuario -> iniciada($usuarioID);
		$id = $_GET['id'];
	?>
		<?php
		$consulta = "SELECT *,p.idEstado AS estadoPostulacion FROM postulaciones p INNER JOIN viajes v ON p.idViaje=v.id WHERE (v.idEstado=1 OR v.idEstado=5) AND p.idUsuario=$id";
		$result2 = mysqli_query($link, $consulta);
		while($viajes = mysqli_fetch_array($result2)){
			$id_viaje = $viajes['id'];
			$id_Destino = $viajes['idDestino'];
			$id_Origen = $viajes['idOrigen'];
			$id_Vehiculo = $viajes['idVehiculo'];
			$dia = $viajes['fecha'];
			$horaPartida = $viajes['hora'];
			$minutosPartida = $viajes['minuto'];
			$precio= $viajes['precio'];	
			$idEstadoViaje = $viajes['idEstado'];
			$idConductor = $viajes['idConductor'];
			$idEstadoPostulacion = $viajes['estadoPostulacion'];
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
			$vehiculoViaje = $rowVehiculo['modelo'] . " " . $rowVehiculo['patente'];
			$asientosDisponibles = $rowVehiculo['asientos'];
			//---------------AGREGO EL ESTADO DE LA POSTULACION----------------------
			$consultaEstadoPostulacion = "SELECT estado FROM estadospostulacion WHERE id=$idEstadoPostulacion";
			$result3 = mysqli_query($link,$consultaEstadoPostulacion);
			$estadoPostulacion = mysqli_fetch_array($result3);
			//--------------AGREGO EL NOMBRE DE CONDUCTOR-------------------------
			$consultaNombreConductor = "SELECT * FROM usuarios WHERE id=$idConductor";
			$result4 = mysqli_query($link,$consultaNombreConductor);
			$nombreConductor = mysqli_fetch_array($result4);
			//--------------AGREGO EL ESTADO DEL VIAJE---------------------------------
			$consultaEstadoViaje = "SELECT * FROM estadosviaje WHERE id=$idEstadoViaje";
			$result5 = mysqli_query($link,$consultaEstadoViaje);
			$estadoViaje = mysqli_fetch_array($result5);
			?>	
		<div>
			<div class="ListadoBotonesDelViajeComoConductor">
				<?php
				if (($idEstadoPostulacion != 3) and ($idEstadoPostulacion != 6) and ($idEstadoPostulacion != 7)) { ?>
					<a href="confirmacionCancelarPostulacion.php?estadoPostulacion=<?php echo $idEstadoPostulacion; ?>&idViaje=<?php echo $id_viaje ?>"> <div class="BotonCancelarModificar">Cancelar</div> </a>
				<?php
				} ?>
				<div class="estadoPostulacion">Postulacion: <?php echo $estadoPostulacion['estado'];
				if ($idEstadoPostulacion == 6) { echo " por el condutor"; }
				if ($idEstadoPostulacion == 3) { echo " por el usuario"; } ?> </div>
			</div>
			<div class="ListadoViajesPasajero_detalle">
				<div class= "div_vertical_detalle" >
					<span class="InformacionViajeLineaSuperior_detalle">Origen: <?php echo $origenViaje; ?></span> <br><br>
					<span class="InformacionViajeLineaSuperior_detalle">Destino: <?php echo $destinoViaje; ?> </span> <br><br>
					<span class="InformacionViajeLineaSuperior_detalle">Estado: <?php echo $estadoViaje['estado'] ?> </span>
				</div>
				<div class= "div_vertical_detalle">
					<span class="InformacionViajeLineaSuperior_detalle">Fecha: <?php echo $dia; ?></span> <br><br>
					<span class="InformacionViajeLineaSuperior_detalle">Salida: <?php echo $horaPartida; ?>:<?php echo $minutosPartida; if ($minutosPartida == 0) { echo "0";} ?></span> <br><br>
					<span class="InformacionViajeLineaSuperior_detalle">Duracion aprox: <?php echo $duracionHoras; echo 'h'; ?><?php if ($duracionMinutos != 0 ) {echo $duracionMinutos; echo 'min';}?></span>
				</div>
				<div class= "div_vertical_detalle">
					<span class="InformacionViajeLineaSuperior_detalle">Vehiculo: <?php echo $vehiculoViaje; ?></span> <br><br>
					<span class="InformacionViajeLineaSuperior_detalle">Conductor: <a href= "verPerfilUsuario.php?id=<?php echo $idConductor?>"><?php echo $nombreConductor['apellido']; echo ' '; echo $nombreConductor['nombre']; ?> </a></span>
				</div>
				<div class= "div_vertical_detalle">
					<span class="InformacionViajeLineaSuperior_detalle">Precio por persona: <?php echo '$'; echo $precio/($asientosDisponibles); ?></span> <br><br>
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
		</div>
		<?php } ?>
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
</div>	
</body>
</html>
</html>