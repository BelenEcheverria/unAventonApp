<html>
<head>
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="2. Estilos (2).css">
	<title> Calificar Usuario </title>
	<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<div class= "div_body">
	<?php
	include "Header.php";
	include "MenuBarra.php";
	$id_usuario = $_GET['id_usuario'];
	$id_viaje = $_GET['id_viaje'];
	$id = $_SESSION['id'];
	$query2= "SELECT * FROM usuarios WHERE id = $id_usuario";
	$result2= mysqli_query ($link, $query2);
	$row2= mysqli_fetch_array ($result2);
	$nombre_usuario= $row2['nombre'] . " " . $row2['apellido'];	
	?>
	<div class= "form_calificar">
		<p class= "p_titulo"> Calificacion para el usuario: <?php echo $nombre_usuario ?> </p> 
		<form method="POST" action="php/3. calificarUsuario.php">
			Calificacion &nbsp;&nbsp;
			<select name= "puntaje" class= "select_calificar" >
				<option value= "0" > Neutral </option>
				<option value= "1" > Positiva </option>
				<option value= "-1" > Negativa </option>
			</select> <br><br>
			Comentario (opcional) &nbsp;&nbsp;
			<input type= "text" name= "comentario" style= "height: 5%; width: 20%;"> <br><br>
			<input type="hidden" name="idUsuario" value="<?php echo $id_usuario ?>">
			<input type="hidden" name="idViaje" value="<?php echo $id_viaje ?>">
			<input type="hidden" name="idAutor" value="<?php echo $id ?>">
			<input type="hidden" name="rol" value="Pasajero">
			<input type="submit" class= "button_calificar" onclick="return Calificar()" value="Enviar calificacion" >
		</form>
	</div>	
</div>
</body>
</html>