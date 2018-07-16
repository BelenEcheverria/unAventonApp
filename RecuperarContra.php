<?php
	include_once ("php/conection.php"); // conectar y seleccionar la base de datos
	$link = conectar();
	include "php/classLogin.php";
    $usuario= new usuario();
    $usuario -> session ($usuarioID, $admin);
?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<link rel="stylesheet" href="css/Estilo5.css">
<title> Recuperar contraseña </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
	include "Header.php";
	include "MenuBarra.php";
?>
<br>
<p style="color: white;text-align:center;font-family:Arial;font-weight:750;">
<?php
		if (isset ($_GET['mensajeRecuperar'])){
			$mensaje = $_GET['mensajeRecuperar'];
			echo $mensaje;
		}
		?>
</p>		
<div class= "registrar">
<h1 style="color:white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Recuperar contraseña </h1> 
<form method="POST" action="php/EnviarContraNueva.php" class="input" onsubmit="return validar()">
	<label class="LabelFormularios"> E-Mail </label>
	<input type="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="FormularioVehiculos" name="correoOriginal" maxlength="45" placeholder="Ingrese su mail" required/>
	<label class="LabelFormularios"> Contraseña </label>
	<input type="password" name="password1" class="FormularioVehiculos" placeholder="Contraseña nueva..." required/>
	<label class="LabelFormularios"> Repita contraseña </label>
	<input type="password" name="password2" class="FormularioVehiculos" placeholder="Repetir Contraseña..." required/>
	<br><br>
	<div><input type="submit" class="BotonVehiculos" value="Enviar"></div>
</form>
</div>
</body>
</html>