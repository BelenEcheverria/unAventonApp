<?php
	include_once ("php/conection.php"); // conectar y seleccionar la base de datos
	$link = conectar();
	include "php/classLogin.php";
    $usuario= new usuario();
    $usuario -> session ($usuarioID, $admin);
?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Eliminar Vehiculo </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
	include "Header.php";
	include "MenuBarra.php";
?>
<br>
<div class= "registrar" style="height:30%;">
<h1 style="color:white;font-size:25px;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Desea agregar una foto de perfil? </h1> <br>
	<table style="float:left;margin-left:20%;margin-top:3%;">
		<tr>
			<td>
				<a href="Inicio.php"><input type="submit" class="BotonMasTarde" value="No"></a>
			<td>
		</tr>
	</table>
	<table style="float:right;margin-right:20%;margin-top:3%;">
		<tr>
			<td>
			
				<a href="EditarMisDatos.php"><input type="submit" class="BotonMasTarde" value="Si"></a>
			</td>
		</tr>
	</table>
</div>
</body>
</html>