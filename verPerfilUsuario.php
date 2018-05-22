<?php

                include_once "php/conection.php"; // conectar y seleccionar la base de datos

                $link = conectar();

?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> NombreUsuario </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
include_once ("php/conection.php");
include "Header.php";
include "MenuBarra.php";
	?>
<div class="CajaInformacionUsuario">
	<div class="CajaInformacionPersonal">
		<table class="FotoYNombre">
			<tr class="ImagenPerfil">
				<td class="ImagenPerfil">Aca va la foto de Perfil</td>
				<td class="ImagenPerfil">					
					<div class="NombreYApellido">Nombre
						<br><br>Apellido
						<br><br>Nacimiento(No se si va esto)
						<br><br>Informacion de contacto (si se hace click aca y se tiene permiso aparece el mail)
						<br><br>El mail
						</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="CajaInformacionPersonal">
		<table class="FotoYNombre">
			<tr class="ImagenPerfil">
				<td class="ImagenPerfil">
					<div class="UnConductorPasajero">
						Conductor
					</div>
					<div class="AlineacionVotosNYP" style="margin-top:30%">
						Votos positivos:
					</div>
					<div class="AlineacionVotosNYP">
						Votos negativos:
					</div>
				</td>
				<td class="ImagenPerfil">
					<div class="UnConductorPasajero">
						Pasajero
					</div>
					<div class="AlineacionVotosNYP" style="margin-top:30%">
						Votos positivos:
					</div>
					<div class="AlineacionVotosNYP">
						Votos negativos:
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="ComentariosConductor">
	<div class="UnComentario">
		El comentario
	</div>
	<div class="UnComentario">
		El comentario
	</div>
</div>
<div class="ComentariosPasajero">
	<div class="UnComentario">
		El comentario
	</div>
	<div class="UnComentario">
		El comentario
	</div>
</div>
<div class="LineaPiePagina"></div>
</div>
</body>
</html>