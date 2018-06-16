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
<body background="Imagenes/FondoColores.jpg">
<div class= "div_body">
	<?php
	include "Header.php";
	include "MenuBarra.php";
	?>
<br><br>
<div class="ListadoConBotonesConductor">
	<div class="ListadoBotonesDelViajeComoConductor"><input type="submit" class="BotonCancelarModificar" value="Editar">
													 <input type="submit" class="BotonCancelarModificar" value="Cancelar">
													 <input type="submit" class="BotonCancelarModificar" value="Postulantes">
	</div>
	<div class="ListadoViajesConductor">
		<div class="InformacionViajeLineaSuperior">Origen:</div><div class="InformacionViajeLineaSuperior">Destino:</div><div class="InformacionViajeLineaSuperior">Fecha:</div>
		<div class="InformacionViajeLineaSuperior">Salida:</div><div class="InformacionViajeLineaSuperior">Vehiculo:</div>
		
		<div class="InformacionViajeLineaInferior">Duracion aproximada:</div><div class="InformacionViajeLineaInferior">Precio total:</div>
		<div class="InformacionViajeLineaInferior">Precio por persona:</div>
	</div>
</body>
</html>
