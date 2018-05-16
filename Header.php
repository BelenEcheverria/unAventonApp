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
					<img class="IconoInicio" src= "css/Imagenes/Logo.jpg">
				</td>
				<td class="UnAventonInicio"> UnAventón </td>

			<tr>
		</table>
	<?php
		if (!isset($usuarioID)){
	?>
		<table class="CajasInicioSesion">
			<form name="inicioSesion" method="post" action="php/inicioSesion.php">
			<tr class="AlineacionCajasInicioSesion">
				<td class="AlineacionCajasInicioSesion">
					<input type="text" id="nombreusuario" class="FormularioInicioSesion" name="nombreU" placeholder="Usuario..."
				</td>
				<td class="AlineacionCajasInicioSesion">
					<input type="password" id="nombreusuario" class="FormularioInicioSesion" name="contraU" placeholder="Contraseña ...">
				</td>
				<td class="AlineacionCajasInicioSesion">
					<input type="button" class="BotonEntrar" value="Entrar" onclick="validarInicioSesion()" >
				</td>
			</tr>
			</form>
			<tr class="AlineacionCajasInicioSesion">
				<td class="AlineacionCajasInicioSesion"></td>
				<td class="AlineacionCajasInicioSesion">¿Olvidaste tu contraseña?</td>
			</tr>
		</table>
	<?php
		} else {
	?>
		<table class="CajaNombreYCierreSesion">
			<tr>
				<td class="BienvenidaUsuarioLogueado">
					&nbsp; <?php echo ("Bienvenido, " . $_SESSION['nombreUsuario']); ?>
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