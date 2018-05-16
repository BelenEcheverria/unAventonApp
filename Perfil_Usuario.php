<?php
    include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href= "css/Estilo3.css" media="all" >
	<?php
	$id = $_GET['id'];
	$query10= ("SELECT * FROM usuarios WHERE id= '$id'");
	$result10= mysqli_query ($link, $query10) or die ('Consulta 10 fallida ' .mysqli_error($link));
	$usuario= mysqli_fetch_array ($result10);
	$imagenUsuario= $usuario['contenidoimagen'];
	$titulo= ($usuario['nombre'] . " " . $usuario['apellido'])
	?>
	<title> <?php echo ($titulo) ?> </title>
</head>
<body class="body_usuarios" >
	<?php
	include "Header.php";
	include "MenuBarra.php";
	?>
	<div class="div_body_usuarios" >
		<div class="div_imagen">
			<?php echo "<img src= 'data:image/jpg; base64,".base64_encode($imagenUsuario). "'>";?>
		</div>
		<div>
		</div>
	</div>	
</body>
</html>