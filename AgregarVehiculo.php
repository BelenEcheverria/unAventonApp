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
<form method="POST" action="php/AgregarVehiculoABase.php" class="input">
	<label class="LabelFormularios"> Marca </label>
	<input type="text" id="marca" name="marca" class="FormularioVehiculos" placeholder="Ingrese la marca...">
	<label class="LabelFormularios"> Modelo </label>
	<input type="text" id="modelo" name="modelo" class="FormularioVehiculos" placeholder="Ingrese la marca...">
	<label class="LabelFormularios"> Tipo </label>
	<input type="text" id="tipo" name="tipo" class="FormularioVehiculos" placeholder="Ingrese el modelo...">
	<label class="LabelFormularios"> Año </label>
	<input type="text" id="anio" name="anio" class="FormularioVehiculos" placeholder="Ingrese el año...">
	<label class="LabelFormularios"> Patente </label>
	<input type="text" id="patente" name="patente" class="FormularioVehiculos"  placeholder="Ingrese la patente...">
	<label class="LabelFormularios"> Color </label>
	<input type="text" id="color" name="color" class="FormularioVehiculos" placeholder="Ingrese el color...">
	<label class="LabelFormularios"> Asientos </label>
	<input type="int" id="asientos" name="asientos" class="FormularioVehiculos" placeholder="Ingrese la cantidad de asientos...">
	<div><input type="submit" class="BotonVehiculos" value="Agregar"></div>
</form>
</div>
</body>
</html>