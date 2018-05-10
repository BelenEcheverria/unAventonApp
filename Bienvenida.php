<?php

                include "php/conection.php"; // conectar y seleccionar la base de datos

                $link = conectar();

?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Bienvenida </title>
<meta charset="utf-8"/>
</head>
<body>
<div class="Bienvenida">
	<div class="Blanco"></div>
	<div class="BienvenidaMensaje">Bienvenido a UnAventón!
	</div>
	<div>
		<img class="IconoBienvenida" src="Imagenes/Facebook.png">
	</div>
	<div class="main-container">
	<table class="fixer-container">
		<tr>
			<td><button class="BotonIngresar"> Ingresar </button></td>
		</tr>
	</table>
	</div>
</div>
</body>
</html>