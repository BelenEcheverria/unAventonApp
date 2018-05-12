<?php
	include_once "conection.php";
	$link = conectar();
	include "classLogin.php";
	$usuario= new usuario();
	try {
		$usuario -> validar_usuario($link);
		header("Location: ../Inicio.php");
	} catch (Exception $e){
		$mensaje= $e->getMessage();
		header("Location: ../Inicio_Sesion.php?mensaje=$mensaje");
	}
?>
	
