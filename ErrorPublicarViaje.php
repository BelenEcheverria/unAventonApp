<?php
	include "php/conection.php"; // conectar y seleccionar la base de datos
	$link = conectar();
	include "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href= "css/Estilo1.css" media="all" >
	<script type="text/javascript" src="js/validacionInicioSesion.js"></script>
	<title>Iniciar Sesion</title>
</head>
<body class="div_body">
<div class="div_body">
<div class= "div_superior">
		<div class="div_titulo">
			<br><br>
			<a href="Inicio.php"> 
				<img src= "css/Imagenes/Logo.jpg" class="IconoInicio" alt="Logo de unAventon" /> 
				 <span class= "unAventon"> Un Aventon </span>
			</a>
		</div>
	</div>
	<div class="imagenInicioSesion"> <br>
		<?php 
				if (isset($_GET['mensaje'])){
				echo ($_GET['mensaje'] . "<br><br>");
				echo ("Por favor intente nuevamente");
			}
		?>
		<br><br>
		<a href="PublicarViaje.php"> Click aqui para volver a la pagina principal </a>
</div>
</body>
</html>