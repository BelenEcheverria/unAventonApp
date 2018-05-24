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
				<td class="ImagenPerfil"><img class="LaImagenDePerfil" src="Imagenes/nube.jpg"></td>
				<td class="ImagenPerfil">					
					<div class="NombreYApellido">
						Nombre: Ian
						<br><br>Apellido: Caballero
						<br><br>Nacimiento: 06/10/97
						<br><br>Informacion de contacto (si se hace click aca y se tiene permiso aparece el mail)
						<br><br>E-mail: caballeroian97@gmail.com
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
					<div class="AlineacionVotosNYP">
						-Viajes Realizados: 25
					</div>
					<div class="AlineacionVotosNYP">
						-Votos positivos: 20
					</div>
					<div class="AlineacionVotosNYP">
						-Votos negativos: 2
					</div>
				</td>
				<td class="ImagenPerfil">
					<div class="UnConductorPasajero">
						Pasajero
					</div>
					<div class="AlineacionVotosNYP">
						-Viajes Realizados: 5
					</div>
					<div class="AlineacionVotosNYP">
						-Votos positivos: 4
					</div>
					<div class="AlineacionVotosNYP">
						-Votos negativos: 0
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="SeMeTerminoLaOriginalidad">
	Comentarios como Conductor
</div>
<div class="SeMeTerminoLaOriginalidad">
	Comentarios como Pasajero
</div>

<div class="ComentariosConductor">
	<div class="UnComentario">
		<div>
			Claudio Fernandez
			<br>
			4-10-18
		</div>
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