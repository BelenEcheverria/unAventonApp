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
	?>

<table class="TablaMisVehiculos">
	<tr>
		<td class="DescripcionMisVehiculos"><td>
		<td class="DescripcionMisVehiculos">AA000AA<td>
		<td class="DescripcionMisVehiculos">Volkswagen<td>
		<td class="DescripcionMisVehiculos">Gol<td>
		<td class="DescripcionMisVehiculos">Auto<td>
		<td class="DescripcionMisVehiculos">Gris<td>
		<td class="DescripcionMisVehiculos">4<td>
		<td class="DescripcionMisVehiculos"><input type="submit" class="BotonEditarMisVehiculos" value="Editar"><td>
	</tr>
</table>
<table class="TablaMisVehiculos">
	<tr>
		<td class="DescripcionMisVehiculos"><td>
		<td class="DescripcionMisVehiculos">AA000AA<td>
		<td class="DescripcionMisVehiculos">Volkswagen<td>
		<td class="DescripcionMisVehiculos">Gol<td>
		<td class="DescripcionMisVehiculos">Auto<td>
		<td class="DescripcionMisVehiculos">Gris<td>
		<td class="DescripcionMisVehiculos">4<td>
		<td class="DescripcionMisVehiculos"><input type="submit" class="BotonEditarMisVehiculos" value="Editar"><td>
	</tr>
</table>
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