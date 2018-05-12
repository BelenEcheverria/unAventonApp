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
<title> Inicio </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
	include "Header.php";
	include "MenuBarra.php";
?>
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
		<?php
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
		?>
	</div>
</div>
<div class="LineaPiePagina"></div>
</body>
</html>
<!--
Cuando creamos o accedemos al contenido de variables de sesión debemos llamar a la función session_start() antes de cualquier salida de etiquetas HTML, copiar:
	include_once "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
Tengamos en cuenta que en cualquier otra página del sitio tenemos acceso a las variables de sesión sólo con llamar inicialmente a la función session_start().
-->
