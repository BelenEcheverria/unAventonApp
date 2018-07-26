<html>
<head>
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="2. Estilos (2).css">
	<title> Calificaciones pendientes </title>
	<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<div class= "div_body">
	<?php
	include "Header.php";
	include "MenuBarra.php";
	$viaje_id = $_GET['id_viaje'];
	$id = $_SESSION['id'];
	?>
	<p class="p_titulo"> Seleccione un usuario para calificar </p>
	<?php
	$query1= "SELECT * FROM calificacionespendientes WHERE idViaje = $viaje_id AND idUsuarioAutor = $id";
	$result1= mysqli_query ($link, $query1);
	while ($row1= mysqli_fetch_array ($result1)){
		$id1= $row1['idUsuarioCalificado'];
		$query2= "SELECT * FROM usuarios WHERE id = $id1";
		$result2= mysqli_query ($link, $query2);
		$row2= mysqli_fetch_array ($result2);
		$nombre2= $row2['nombre'] . " " . $row2['apellido'];	
	?>
		<div class= "nombreUsuario">
		<a class= "nombreUsuario" href= "3. CalificarUsuario.php?id_usuario=<?php echo $id1 ?>"> <?php echo $nombre2 ?> </a>
		<br><br></div>
	<?php
	}
	?>
</div>
</body>
</html>