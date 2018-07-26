<?php
    include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$ID = $_SESSION['id'];
	$consulta = "UPDATE usuarios set estaActivo=0 WHERE id = $ID"; 
	$result3 = mysqli_query($link,$consulta);
	session_start();
	session_unset(); //destruir todas las variables de sesion
	session_destroy(); //destruir la sesion
	header ("Location: Bienvenida.php");
?>