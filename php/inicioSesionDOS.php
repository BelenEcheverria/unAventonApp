<?php
	include_once "conection.php";
	$link = conectar();
	include "classLoginDOS.php";
	$usuario= new usuario();
	$reactivo=$_GET['reactivo'];
	echo $reactivo;
	try {
		$usuario -> validar_usuario($link,$reactivo);
		header("Location: ../Inicio.php");
	} catch (Exception $e){
		$mensaje= $e->getMessage();
		header("Location: ../Inicio_SesionDOS.php?mensaje=$mensaje");
	}
?>
	