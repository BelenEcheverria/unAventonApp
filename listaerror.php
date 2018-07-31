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
	<title> Editar Perfil </title>
	<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
	<?php
	include "Header.php";
	include "MenuBarra.php";
	?>
	<h1>Lo sentimos, no se han encontrado viajes con los datos solicitados</h1> 
    
</body>
</html>