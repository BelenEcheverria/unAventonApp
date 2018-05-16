<?php
	include_once("conection.php"); // conectar y seleccionar la base de datos
	$link = conectar();
	$id= $_GET['id'];//se recibe el valor que identifica a la imagen en la tabla
	$sql= "SELECT contenidoimagen, tipoimagen FROM usuarios WHERE id=$id"; //se recupera la informacion de la imagen
	$result= mysqli_query ($link, $sql);
	$row= mysqli_fetch_array ($result);
	mysqli_close($link);
	//se imprime la imagen y se le avisa al navegador que lo que se le esta enviando no es texto, sino que es una imagende un tipo en particular 
	header("Content-type: ". $row['tipoimagen']);
	echo $row['contenidoimagen'];
?>