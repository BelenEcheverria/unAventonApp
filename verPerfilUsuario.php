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
<body class="FondoPerfil">
<?php
include_once ("php/conection.php");
include "Header.php";
include "MenuBarra.php";
	?>
<div class="CajaInformacionPersonal">
	<div class="UnConductorPasajero">
		Conductor
	</div>
	<table style="width:100%;text-align:center" class="FotoYNombre">
		<tr>
			<td>
				<div class="CantidadDeVotos">
					Viajes Realizados: 25
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
					Votos positivos: 20
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
					Votos negativos: 2
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="ComentariosConductor">
					<div class="UnComentario">
						<div style="float:left;text-align:left;width:48%">
							Claudio Fernandez
						</div>
						<div style="float:right;text-align:right;width:48%">
							4-10-18
						</div>
						<br>
						El comentario
					</div>
					<div class="UnComentario">
						<div style="float:left;text-align:left;width:48%">
							Claudio Fernandez
						</div>
						<div style="float:right;text-align:right;width:48%">
							4-10-18
						</div>
						<br>
						El comentario
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
<div class="CajaInformacionPersonal">
	<div class="ImagenPerfil"><img class="LaImagenDePerfil" src="Imagenes/nube.jpg"></div>
	<table style="width:100%;text-align:center" class="FotoYNombre">
		<tr>
			<td>
				<div class="CantidadDeVotos">
				Nombre: Ian
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
				Apellido: Caballero
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
				Nacimiento: 06/10/1997
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
				E-mail: caballeroian97@gmail.com
				</div>
			</td>
		</tr>
	</table>
</div>
<div class="CajaInformacionPersonal">
	<div class="UnConductorPasajero">
		Pasajero
	</div>
	<table style="width:100%;text-align:center" class="FotoYNombre">
		<tr>
			<td>
				<div class="CantidadDeVotos">
					Viajes Realizados: 25
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
					Votos Positivos: 20
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
					Votos Negativos : 2
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="ComentariosConductor">
					<div class="UnComentario">
						<div style="float:left;text-align:left;width:48%">
							Claudio Fernandez
						</div>
						<div style="float:right;text-align:right;width:48%">
							4-10-18
						</div>
						<br>
						<br>
						Maneja muy rapido, no respeta los semaforos
					</div>
					<div class="UnComentario">
						<div style="float:left;text-align:left;width:48%">
							Claudio Fernandez
						</div>
						<div style="float:right;text-align:right;width:48%">
							4-10-18
						</div>
						<br>
						El comentario
					</div>
					<div class="UnComentario">
						<div style="float:left;text-align:left;width:48%">
							Claudio Fernandez
						</div>
						<div style="float:right;text-align:right;width:48%">
							4-10-18
						</div>
						<br>
						El comentario
					</div>
					<div class="UnComentario">
						<div style="float:left;text-align:left;width:48%">
							Claudio Fernandez
						</div>
						<div style="float:right;text-align:right;width:48%">
							4-10-18
						</div>
						<br>
						El comentario
					</div>
					<div class="UnComentario">
						<div style="float:left;text-align:left;width:48%">
							Claudio Fernandez
						</div>
						<div style="float:right;text-align:right;width:48%">
							4-10-18
						</div>
						<br>
						El comentario
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
<div class="LineaPiePagina"></div>
</div>
</body>
</html>