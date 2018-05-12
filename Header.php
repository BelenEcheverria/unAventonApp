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
<link rel="stylesheet" type="text/css" href= "css/Estilo1.css" media="all" >
<title> Inicio </title>
<meta charset="utf-8"/>
</head>
<body>
<div class="div_superior">
	<div class="div_iniciar_sesion">
	<?php
		if (!isset($usuarioID)){
	?>
		<table class="CajasInicioSesion">
			<form name="inicioSesion" method="post" action="php/inicioSesion.php">
			<tr class="AlineacionCajasInicioSesion">
				<td class="AlineacionCajasInicioSesion">
					<input type="text" id="nombreusuario" class="FormularioInicioSesion" name="nombreU" placeholder="Usuario...">
				</td>
				<td class="AlineacionCajasInicioSesion">
					<input type="text" id="nombreusuario" class="FormularioInicioSesion" name="contraU" placeholder="Contraseña ...">
				</td>
				<td class="AlineacionCajasInicioSesion">
					<input type="submit" class="BotonEntrar" value="Entrar" >
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
		<div class="nombre_usuario"> &nbsp; <?php echo ("Bienvenido " . $_SESSION['nombreUsuario']); ?>
		<br> <a href="php/cerrarSesion.php"> Cerrar Sesion &nbsp;&nbsp;&nbsp; </a> </div>
	<?php
		}
	?>
	</div>
	<div class="div_titulo">
		<a href="Inicio.php" class="AlineacionCajasInicioSesion">
			<img class="IconoInicio" src= "css/Imagenes/Logo.jpg">
			<span class="UnAventonInicio2"> UnAventón </span>
		</a>
	</div>
</div>
</body>