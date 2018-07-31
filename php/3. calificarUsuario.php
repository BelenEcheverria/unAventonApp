<?php
    include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	
	$fecha = date("y/m/d");
	$rol = $_POST['rol'];
	$puntuacion = $_POST['puntaje'];
	$comentario = $_POST['comentario'];
	$usuario_id = $_POST['idUsuario'];
	$idAutor = $_POST['idAutor'];
	$idViaje= $_POST['idViaje'];
	
	$query= "INSERT INTO calificacion (fecha, rol, puntuacion, comentario, idUsuarioAutor, idUsuarioCalificado) VALUES ('$fecha','$rol','$puntuacion','$comentario','$idAutor','$usuario_id')"; 
	mysqli_query($link,$query);
	
	$query2= "DELETE FROM calificacionespendientes WHERE idUsuarioAutor= $idAutor AND idUsuarioCalificado= $usuario_id AND idViaje = $idViaje";
	mysqli_query($link,$query2);
	echo $query2;
	
	header ("Location: ../verPerfilUsuario.php?id=$usuario_id");
?>