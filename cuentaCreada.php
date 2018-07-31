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
	<link rel="stylesheet" href="css/Estilo5.css">
	<title>Volver a unAventon</title>
	<script src="ValidarViaje.js"></script>
	<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
	<?php
	include "Header.php";
	include "MenuBarra.php";
	?>
	<?php 
	try { ?> 
		<br></br>
		<div class= "registrar">
			<h1 style="color:white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Desea volver a ser parte de un aventon? </h1> 
			<a href="Inicio_SesionDOS.php"><button class="BotonCancelarModificar">  Si  </button></a>
			<a class="BotonCancelarModificar" href="Inicio.php">  No  </a>
		</div>		
	<?php }
	catch (Exception $e) {
	?>
		<div class="noIniciada">
			<br><br>
			<p> Usted no ha iniciado sesion </p>
			<p> Por favor 
			<a href="Inicio_Sesion.php"> inicie sesion </a>
			o
			<a href="Bienvenida.php"> registrese </a>
			para ver este contenido </p>
		</div>
	<?php
	}
	?>
</body>
</html>