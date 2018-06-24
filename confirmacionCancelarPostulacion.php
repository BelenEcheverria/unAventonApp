<?php
	include "php/conection.php"; // conectar y seleccionar la base de datos
	$link = conectar();
	include "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$idEstadoPostulacion = $_GET['estadoPostulacion'];
	$id_viaje = $_GET['idViaje'];
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href= "css/Estilo1.css" media="all" >
	<script type="text/javascript" src="js/validacionInicioSesion.js"></script>
	<title>Iniciar Sesion</title>
</head>
<body class="div_body">
<?php
	if ($idEstadoPostulacion == 1) {
?>
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
		Usted recibira una calificacion negativa por cancelar una postulacion aceptada,
		<br><br>
		¿desea continuar?
		<br><br>
		<a href="php/cancelarSolicitudViaje.php?estadoPostulacion=<?php echo $idEstadoPostulacion; ?>&idViaje=<?php echo $id_viaje ?>">Si</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="<?=$_SERVER['HTTP_REFERER'] ?>">No</a>
</div>
<?php
	} else {
		header ("Location: php/cancelarSolicitudViaje.php?estadoPostulacion= $idEstadoPostulacion&idViaje=$id_viaje");
	}
?>
</body>
</html>