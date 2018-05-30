<html>
<head>
<link rel="stylesheet" href="estilos.css">
<link rel="stylesheet" href="css/Estilo5.css">
<title> Mis Vehiculos </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
	include_once ("php/conection.php"); // conectar y seleccionar la base de datos
	$link = conectar();
	include "Header.php";
	include "MenuBarra.php";
	try {
		$usuario -> iniciada($usuarioID);
		$id= $_SESSION['id'];
		$elSelect = "SELECT * FROM vehiculos WHERE idUsuario = $id AND estaActivo = '1'";
		$sql = mysqli_query($link,$elSelect);
		While ($vehiculo = mysqli_fetch_array($sql)){ ?> 
			
			<table class="TablaMisVehiculos">
				<tr>
					<td class="DescripcionMisVehiculos"><?php echo utf8_encode($vehiculo['patente']);?><td>
					<td class="DescripcionMisVehiculos"><?php echo utf8_encode($vehiculo['marca']);?><td>
					<td class="DescripcionMisVehiculos"><?php echo utf8_encode($vehiculo['modelo']);?><td>
					<td class="DescripcionMisVehiculos"><?php echo utf8_encode($vehiculo['anio']);?><td>
					<td class="DescripcionMisVehiculos"><?php echo utf8_encode($vehiculo['color']);?><td>
					<td class="DescripcionMisVehiculos"><?php echo utf8_encode($vehiculo['tipo']);?><td>
					<td class="DescripcionMisVehiculos"><?php echo utf8_encode($vehiculo['asientos']);?><td>
					<td class="DescripcionMisVehiculos"><a href="ModificarVehiculo.php?id=<?php echo $vehiculo['id']?>"><input type="submit" class="BotonEditarMisVehiculos" value="Editar"></a><td>
				</tr>
			</table>	
		
		<?php } ?>


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
</body>
</html>