<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Eliminar Vehiculo </title>
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
<h1 style="color:white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Eliminar Vehiculo </h1> 
<form method="POST" action="crearcuenta.php" class="input" onsubmit="return validar()">
	<label class="LabelFormularios"> Vehiculo </label>
	<select id="nombre" name="nombre" class="FormularioVehiculos"></select>
</form>
</div>
</body>
</html>