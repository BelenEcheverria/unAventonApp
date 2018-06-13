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
	<title> Mis Viajes </title>
	<meta charset="utf-8"/>
</head>
<body class="FondoInicio">	
	<?php
	include "Header.php";
	include "MenuBarra.php";
	?>
	<div>
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
			?>	
				imprimir los datos del viaje
				(origen, destino, auto, duracion, precio, asientos totales )
				<!-- mostrar el origen, el destino, y los asientos esta hecho en unViaje.php se puede usar de guia -->
				<a href= "2. MiViaje.php?id=<?php echo $viajes['id']?>">
					Ver Postulaciones
				</a>
				<br><br>
				
			<?php
			}
			?>
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