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
				<input type="text" id="nombreusuario" class="FormularioInicioSesion" name="user" placeholder="Usuario...">
			</td>
			<td class="AlineacionCajasInicioSesion">
				<input type="submit" class="BotonEntrar" value="Entrar" >
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td class="AlineacionCajasInicioSesion">
				<img class="IconoInicio" src="Facebook.png">
			</td>
			<td class="UnAventonInicio">
				UnAventón
			</td>
		</tr>
	</table>
</div>
<div style="width:100%;height:81%">
	<div class="Menu">
		<div class="CajaMenuBusqueda">
			<form method="POST" style="margin-top:15px"action="crearcuenta.php" class="input" onsubmit="return validar()">
				<label class="LabelFormularios"> Origen </label>
				<input type="password" id="clave1" name="password" class="FormularioMenuBusqueda" placeholder="Ingresa desde dónde viajas">
				<label class="LabelFormularios"> Destino </label>
				<input type="password" id="clave2" name="password2" class="FormularioMenuBusqueda" placeholder="Ingresa hacia dónde viajas">
				<label class="LabelFormularios"> Fecha </label>
				<input type="date" class="FormularioMenuBusqueda" name="fecha">
				<div><input type="submit" class="BotonBuscar" value="Buscar"></div>
			</form>
		</div>
	</div>
	<div class="ParteViajes">
		<div>
			<ul>
				<li><a href="index.php"> Publicar </a></li>
				<li><a href="index.php"> Mis Viajes </a></li>
			</ul>
		</div>
		<div class="ViajesInfoHorizontal">
			<table style="width:80%; margin-left:2%;">
				<tr>
					<td class="AlineacionViajesInfoHorizontal">Origen</td>
					<td class="AlineacionViajesInfoHorizontal">Destino</td>
					<td class="AlineacionViajesInfoHorizontal">Dia</td>
					<td class="AlineacionViajesInfoHorizontal">Hora</td>
					<td class="AlineacionViajesInfoHorizontal">P.Asiento</td>
					<td class="AlineacionViajesInfoHorizontal">A.Disponibles</td>
				</tr>
			</table>
		</div>
		<div class="ListadoViajes">
			<table style="width:80%; margin-left:2%;">
				<tr>
					<td class="AlineacionCajasListaViajesHorizontal">La Plata</td>
					<td class="AlineacionCajasListaViajesHorizontal">Rosario</td>
					<td class="AlineacionCajasListaViajesHorizontal">26/05</td>
					<td class="AlineacionCajasListaViajesHorizontal">15:00</td>
					<td class="AlineacionCajasListaViajesHorizontal">$500</td>
					<td class="AlineacionCajasListaViajesHorizontal">3</td>
				</tr>
				<div><input type="submit" class="BotonReservarAsiento" value="Reserver Asiento"></div>
			</table>
		</div>
		<div class="ListadoViajes">
			<table style="width:80%; margin-left:2%;">
				<tr>
					<td class="AlineacionCajasListaViajesHorizontal">La Plata</td>
					<td class="AlineacionCajasListaViajesHorizontal">Rosario</td>
					<td class="AlineacionCajasListaViajesHorizontal">26/05</td>
					<td class="AlineacionCajasListaViajesHorizontal">15:00</td>
					<td class="AlineacionCajasListaViajesHorizontal">$500</td>
					<td class="AlineacionCajasListaViajesHorizontal">3</td>
				</tr>
				<div><input type="submit" class="BotonReservarAsiento" value="Reserver Asiento"></div>
			</table>
		</div>
		<div class="ListadoViajes">
			<table style="width:80%; margin-left:2%;">
				<tr>
					<td class="AlineacionCajasListaViajesHorizontal">La Plata</td>
					<td class="AlineacionCajasListaViajesHorizontal">Rosario</td>
					<td class="AlineacionCajasListaViajesHorizontal">26/05</td>
					<td class="AlineacionCajasListaViajesHorizontal">15:00</td>
					<td class="AlineacionCajasListaViajesHorizontal">$500</td>
					<td class="AlineacionCajasListaViajesHorizontal">3</td>
				</tr>
				<div><input type="submit" class="BotonReservarAsiento" value="Reserver Asiento"></div>
			</table>
		</div>
	</div>
</div>
<div class="CajaPaginacion"> </div>
<div class="LineaPiePagina"></div>
</body>
</html>