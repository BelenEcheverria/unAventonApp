<?php

                include_once ("php/conection.php"); // conectar y seleccionar la base de datos

                $link = conectar();

?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Inicio </title>
<meta charset="utf-8"/>
</head>
<body>
<div class="Header">
	<table class="CajasInicioSesion">
		<tr class="AlineacionCajasInicioSesion">
			<td class="AlineacionCajasInicioSesion">
				<input type="text" id="nombreusuario" class="FormularioInicioSesion" name="user" placeholder="Usuario...">
			</td>
			<td class="AlineacionCajasInicioSesion">
				<input type="text" id="nombreusuario" class="FormularioInicioSesion" name="user" placeholder="Contraseña ...">
			</td>
			<td class="AlineacionCajasInicioSesion">
				<input type="submit" class="BotonEntrar" value="Entrar" >
			</td>
		</tr>
		<tr class="AlineacionCajasInicioSesion">
			<td class="AlineacionCajasInicioSesion"></td>
			<td class="AlineacionCajasInicioSesion">¿Olvidaste tu contraseña?</td>
		</tr>
	</table>
	<table>
		<tr>
			<td class="AlineacionCajasInicioSesion">
				<img class="IconoInicio" src="Imagenes/Facebook.png"> 
			</td>
			<td class="UnAventonInicio">
				UnAventón
			</td>
		</tr>
	</table>
</div>
</body>