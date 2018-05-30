<head>
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="css/Estilo5.css">
	<title> Listado de vehiculos </title>
</head>
<body class= "FondoInicio" >
	<?php
	include "Header.php";
	include "MenuBarra.php";
	?>
	<?php 
	try {
		$usuario -> iniciada($usuarioID);
		$id= $_GET['id'];
		?>
		<br>
		<div  style="font-family:Arial">
			<?php
			if (isset ($_GET['id'])){
				$id=  $_GET['id'];
				$query10= "SELECT * FROM vehiculos WHERE idUsuario= $id";
				$result10 = mysqli_query ($link, $query10) or die ('Consulta fallida ' .mysqli_error($link));
			}
		?>
		</div>
		<div class="FondoListaModificarVehiculos">
		<div style="font-family:Arial; color: white; font-weight: bold; text-align: center; font-size: 125%;">
			<p style="font-size: 150%;" > Seleccione el vehiculo que desea editar </p>
			<div>
			<?php
			while ($vehiculo = mysqli_fetch_array ($result10)) {
			?>
				<a href= "ModificarVehiculo.php?id=<?php echo $vehiculo['id']?>">
					<?php echo "Patente: " . $vehiculo['patente']?> 
				</a> <br><br><br>
			<?php
			}
			?>
			</div>
			</div>
		</div>
		</div>
	<?php	
	}
	catch (Exception $e) {
	?>
		<div class="noIniciada">
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
