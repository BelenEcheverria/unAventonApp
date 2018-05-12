<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Agregar Vehiculo </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
	include_once ("php/conection.php"); // conectar y seleccionar la base de datos
	$link = conectar();
	include "Header.php";
	include "MenuBarra.php";
?>
<div class= "registrar">
<h1 style="color:white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Agregar Vehiculo </h1> 
<form method="POST" action="crearcuenta.php" class="input" onsubmit="return validar()">
	<label class="LabelFormularios"> Marca </label>
	<input type="text" id="nombre" name="nombre" class="FormularioVehiculos" placeholder="Ingrese la marca...">
	<label class="LabelFormularios"> Marca </label>
	<input type="text" id="nombre" name="nombre" class="FormularioVehiculos" placeholder="Ingrese la marca...">
	<label class="LabelFormularios"> Modelo </label>
	<input type="text" id="apellido" name="apellido" class="FormularioVehiculos" placeholder="Ingrese el modelo...">
	<label class="LabelFormularios"> Año </label>
	<input type="text" id="nombreusuario" name="nombreusuario" class="FormularioVehiculos" placeholder="Ingrese el año...">
	<label class="LabelFormularios"> Patente </label>
	<input type="text" id="email" name="email" class="FormularioVehiculos"  placeholder="Ingrese la patente...">
	<label class="LabelFormularios"> Color </label>
	<input type="password" id="clave1" name="password" class="FormularioVehiculos" placeholder="Ingrese el color...">
	<label class="LabelFormularios"> Asientos </label>
	<input type="password" id="clave2" name="password2" class="FormularioVehiculos" placeholder="Ingrese la cantidad de asientos...">
	<div><input type="submit" class="BotonRegistrar" value="Registrar"></div>
</form>
</div>
</body>
</html>