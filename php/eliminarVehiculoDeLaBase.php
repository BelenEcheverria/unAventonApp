<?php
	include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$modelo = $_POST['modelo'];
	$consulta = "(UPDATE vehiculos set (idUsuario=$usuarioID) AND (modelo=$modelo)");
?>