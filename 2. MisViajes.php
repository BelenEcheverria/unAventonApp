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
	<link rel="stylesheet" href="2. Estilos.css">
	<link rel="stylesheet" href="estilos.css">
	<title> Mis Viajes </title>
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
		$id= $_GET['id'];
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
				$precio= $viajes['precio'];	
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
<div class="ListadoConBotonesConductor">
	<div class="ListadoBotonesDelViajeComoConductor"><input type="submit" class="BotonCancelarModificar" value="Editar">
													 <input type="submit" class="BotonCancelarModificar" value="Cancelar">
													 <input type="submit" class="BotonCancelarModificar" value="Postulantes">
	</div>
	<div class="ListadoViajesConductor">
		<div class="InformacionViajeLineaSuperior">Origen: <?php echo utf8_encode($origenViaje);?></div>
		<div class="InformacionViajeLineaSuperior">Destino: <?php echo utf8_encode($destinoViaje);?></div>
		<div class="InformacionViajeLineaSuperior">Fecha: <?php echo utf8_encode($dia);?></div>
		<div class="InformacionViajeLineaSuperior">Salida: <?php echo utf8_encode($horaPartida);?>:<?php
							echo utf8_encode($minutosPartida);?></div>
		<div class="InformacionViajeLineaSuperior">Vehiculo: <?php echo utf8_encode($vehiculoViaje);?></div>
		
		<div class="InformacionViajeLineaInferior">Duracion aproximada: <?php echo $duracionHoras; ?>:<?php echo $duracionMinutos;?></div>
		<div class="InformacionViajeLineaInferior">Precio total: <?php echo utf8_encode($precio);?></div>
		<div class="InformacionViajeLineaInferior">Precio por persona: </div>
	</div>
	<?php	
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
			$idEstadoPostulacion = $viajes['estadoPostulacion'];
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
			$consultaEstadoPostulacion = "SELECT estado FROM estadospostulacion WHERE id=$idEstadoPostulacion";
			$result3 = mysqli_query($link,$consultaEstadoPostulacion);
			$estadoPostulacion = mysqli_fetch_array($result3);
	?>	
<div class="ListadoConBotonesConductor">
	<div class="ListadoBotonesDelViajeComoConductor">
		<a href="php/cancelarSolicitudViaje.php?estadoPostulacion=<?php echo $idEstadoPostulacion; ?>&idViaje=<?php echo $id_viaje ?>">
			<div class="BotonCancelarModificar">Cancelar</div>
		</a>
			<div class="estadoPostulacion">Postulacion: <?php echo $estadoPostulacion['estado']; ?> </div>
	</div>
	<div class="ListadoViajesConductor">
		<div class="InformacionViajeLineaSuperior">Origen: <?php echo $origenViaje; ?></div>
		<div class="InformacionViajeLineaSuperior">Destino: <?php echo $destinoViaje; ?> </div>
		<div class="InformacionViajeLineaSuperior">Fecha: <?php echo $dia; ?></div>
		<div class="InformacionViajeLineaSuperior">Salida: <?php echo $horaPartida; ?>:<?php echo $minutosPartida;?></div>
		<div class="InformacionViajeLineaSuperior">Vehiculo: <?php echo $vehiculoViaje; ?></div>
		
		<div class="InformacionViajeLineaInferior">Duracion aproximada: <?php echo $duracionHoras; ?>:<?php echo $duracionMinutos;?></div>
		<div class="InformacionViajeLineaInferior">Precio total: <?php echo $precio; ?></div>
		<div class="InformacionViajeLineaInferior">Precio por persona: </div>
	</div>
</div>
		<?php } ?>
</body>
</html>