<?php
	session_start();
	session_unset(); //destruir todas las variables de sesion
	session_destroy(); //destruir la sesion
	header("Location: ../Inicio.php");
?>