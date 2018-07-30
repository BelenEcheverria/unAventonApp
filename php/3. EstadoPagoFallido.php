<?php
	include "../php/conection.php"; // conectar y seleccionar la base de datos
	$link = conectar();
	include "../php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
?>
<html>
<head>
	<link rel="stylesheet" href="../css/estilos.css">
	<link rel="stylesheet" href="../css/2. Estilos (2).css">
	<title> Pagar Viaje </title>
	<meta charset="utf-8"/>
</head>
<body style="background-image: url(../Imagenes/FondoColores.jpg);
	background-size:cover;
	height:100%;">
<div style="color: white;
	font-family: Arial, sans-serif;
	font-weight: bold; text-align:center; font-size: 150%; margin-top: 15%;">
	No se pudo completar el pago <br><br>
	Su tarjeta se encuentra vencida <br><br>
	<a href="../3. PagosPendientes.php" style="color: white;"> Click aqui para volver a intentar </a>
	
</div>
</body>
</html>