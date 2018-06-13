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
	<title> Mis Viajes </title>
	<meta charset="utf-8"/>
</head>
<body background="Imagenes/FondoColores.jpg">
<div class= "div_body">
	<?php
	include "Header.php";
	include "MenuBarra.php";
	?>	
	<div>
	<?php 
	try {
		$usuario -> iniciada($usuarioID);
	?>
		<?php
		$viaje_id = $_GET['id'];
		//Trae de base de datos la informacion de los viajes
		$q = "SELECT * FROM viajes where id= $viaje_id ";
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
		// AGREGO QUE MUESTRE El Destino---------------*/
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
		<div>
			<p class="p_titulo"> Detalles del viaje </p>
			<div class="body_detalle">
				<span> <?php echo "Origen: " . utf8_encode($origenViaje)?> </span>
				<span class="span_detalle"> <?php echo "Destino: " .utf8_encode($destinoViaje)?> </span>
				<span class="span_detalle"> <?php echo "Fecha: " . utf8_encode($fecha)?> </span>
				<span class="span_detalle"> <?php echo "Horario de salida: " . utf8_encode($horaPartida)?><?php echo ":" . utf8_encode($minutosPartida)?> </span>
				<span class="span_detalle"> <?php echo "Vehiculo: " . utf8_encode($vehiculoViaje)?> </span>
				<br><br>
				<?php 
				if ($duracionMinutos != 0){
				?>
					<span> <?php echo "Duracion aproximada: " . utf8_encode($duracion)?><?php echo ":" . utf8_encode($duracionMinutos)?> Hs </span>
				<?php
				} else {
				?>
					<span> <?php echo "Duracion aproximada: " . utf8_encode($duracion)?> Hs </span>
				<?php
				}
				?>
				<span class="span_detalle"> <?php echo "Precio total: " . utf8_encode($precio)?> </span>
				<span class="span_detalle"> <?php echo "Precio por persona: " . utf8_encode($precio)?> </span>
				<?php 
				if (!empty($texto)){
				?>
					<br><br>
					<span> <?php echo "Aclaraciones: " . utf8_encode($texto)?> </span>
				<?php
				}
				?>							
			</div>
			<div>
				<br> <hr>
				<p class="p_titulo"> Postulaciones </p>
			</div>
		</div>		
	<?php	
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
</div>
</body>
</html>
<!--
TO DO
calcular precio por persona
 -->