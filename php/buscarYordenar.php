<?php

function buscar(&$apellido, &$nombre){
	if (isset($_GET['apellido']) and (!empty($_GET['apellido']))){
		$apellido= $_GET['apellido'];
	}
	if (isset($_GET['nombre']) and (!empty($_GET['nombre']))){
		$nombre= $_GET['nombre'];
	}
}

function ordenar(&$ordenar){
	if ((isset($_GET['ordenar'])) and (!empty($_GET['ordenar']))){
		$ordenar= $_GET['ordenar'];
	}
}

?>
