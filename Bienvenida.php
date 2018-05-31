<?php
	include_once "php/conection.php"; // conectar y seleccionar la base de datos
	$link = conectar();
?>
<html>
<head>
	<link rel="stylesheet" href="estilos.css">
	<title> Bienvenida </title>
	<meta charset="utf-8"/>
</head>
<body class="FondoBienvenida">
	<div class="BienvenidaMensaje">Bienvenido a UnAventón!</div>
	<div class="CajaBienvenida">
	<div class="CrearUnaCUenta">Crear una cuenta</div>
		<form name="registro" method="post" action="php/registroUsuario.php" enctype="multipart/form-data">
			<table class="CajaRegistro">
				<tr>
					<td>
						<input type="text" id="nombreusuario" class="FormularioRegistrarse" style="width:90%" name="nombre" maxlength="45" placeholder="Nombre..." required/>
					</td>
					<td>
						<input type="text" id="nombreusuario" class="FormularioRegistrarse" style="width:90%" name="apellido" maxlength="45" placeholder="Apellido..." required/>
					</td>
				</tr>
				<tr>
					<td>
						<input type="E-mail" id="nombreusuario" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="FormularioRegistrarse" style="width:192%" name="nombreUsuario" maxlength="45" placeholder="mail@ejemplo.com" required/>
					</td>
				</tr>
				<tr>
					<td>
						<div class="FechaNacimiento"> Fecha Nacimiento</div >
					</td>
				</tr>
				<tr>
					<td >
						<input type="date" value="2013-01-08" id="nombreusuario" class="FormularioRegistrarse" name="nacimiento" required/>
					</td>
				</tr>
				<tr>
					<td>
						<input type="password" id="nombreusuario" class="FormularioRegistrarse" style="width:192%" name="contrasenia1" maxlength="32" placeholder="Contraseña..." />
					</td>
				</tr>
				<tr>
					<td>
						<input type="password" id="nombreusuario" class="FormularioRegistrarse" style="width:192%"name="contrasenia2" placeholder="Repetri contraseña..." />
					</td>
				</tr>
			</table>
			<input type="submit" class="BotonRegistrar" value="Registrar">
		</form>
	</div>
	<div class="CajaDerechaCajaBienvenida">
		<div class="FraseCompartiendoDestinos"> Ve a donde quieras, desde donde quieras. </div>
		<div class="main-container">
			<div class="fixer-container">
				<a href="Inicio.php"><input type="submit" class="BotonIngresar" value="Ingresar" ></a>
			</div>
		</div>
	</div>
</body>
</html>
