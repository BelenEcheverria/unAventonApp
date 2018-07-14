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
<script type="text/javascript" src="js/validacionInicioSesion.js"></script>
<title> Inicio </title>
<meta charset="utf-8"/>
</head>
<body>
	<div class="Header">
		<table class="CajaIconoMasTitulo">
			<tr>
				<td class="CajaIconoInicio">
					<img class="IconoInicio" src= "css/Imagenes/UNAVENTON2.png">
				</td>
			<tr>
		</table>
	<?php
		if (!isset($usuarioID)){
	?>
		<table class="CajasInicioSesion">
			<form name="inicioSesion" method="post" action="php/inicioSesion.php">
			<tr class="AlineacionCajasInicioSesion">
				<td class="AlineacionCajasInicioSesion">
					<input type="text" class="FormularioInicioSesion" name="nombreU" placeholder="E-mail">
				</td>
				<td class="AlineacionCajasInicioSesion">
					<input type="password" class="FormularioInicioSesion" name="contraU" placeholder="Contraseña ...">
				</td>
				<td class="AlineacionCajasInicioSesion">
					<input type="button" class="BotonEntrar" value="Entrar" onclick="validarInicioSesion()" >
				</td>
			</tr>
			</form>
			<tr class="AlineacionCajasInicioSesion">
				<td class="AlineacionCajasInicioSesion"><a style="text-decoration: none; color: white; font-family: Verdana, Sans,Sans-serif" href="RecuperarContra.php"> Recuperar contraseña </a></td>
				<td class="AlineacionCajasInicioSesion"><a style="text-decoration: none; color: white; font-family: Verdana, Sans,Sans-serif" href="Bienvenida.php"> Crear una cuenta </a> </td>
			</tr>
		</table>
	<?php
		} else {
	?>
		<table class="CajaNombreYCierreSesion">
			<tr>
				<td class="BienvenidaUsuarioLogueado">
					¡<?php echo ("Bienvenido, " . $_SESSION['nombreUsuario']); ?>!
				</td>
				<td>
					<a href="php/cerrarSesion.php"> 
						<input type="submit" class="BotonCerrarSesion" value="Cerrar Sesion">
					</a>
				</td>
			<tr>
		</table>
		
	<?php
		}
	?>
	</div>
</body>