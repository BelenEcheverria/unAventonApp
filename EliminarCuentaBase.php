<?php
	include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
	$ID = $_SESSION['id'];
	$consulta = "UPDATE usuarios set estaActivo=0 WHERE id = $ID"; 
	$result3 = mysqli_query($link,$consulta);
	header ("Location: inicio.php");
?>