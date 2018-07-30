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
	$id_viaje = $_GET['id_viaje'];
	$id = $_SESSION['id'];
	$query2= "SELECT * FROM viajes WHERE id = $id_viaje";
	$result2= mysqli_query ($link, $query2);
	$row2= mysqli_fetch_array ($result2);
	$precioTotal = $row2['precio'];
	?>
	<div class= "form_calificar">
		<p class= "p_titulo"> Ingrese los datos para efectuar el pago </p>
		<p> Monto a pagar: <?php echo '$'; echo round ($precioTotal * 0.05); ?> </p>
		<form method="POST" action="php/3. pagarViaje.php">
			Tipo de tarjeta &nbsp;&nbsp;
			<select name= "puntaje" class= "select_calificar" >
				<option value= "0" > Debito </option>
				<option value= "1" > Credito </option>
			</select> <br><br>
			Numero de tarjeta &nbsp;&nbsp;
			<input type= "text" name= "comentario" style= "height: 5%; width: 15%;" pattern="\d*"minlength=16/ maxlength=16/ required/> <br><br>
			Vencimiento
			<input type="date" name="nacimiento" style= "height: 5%; width: 15%;" required/> <br><br>
			<input type="hidden" name="idAutor" value="<?php echo $id ?>">
			<input type="hidden" name="idViaje" value="<?php echo $id_viaje ?>">
			<input type="submit" class= "button_calificar" onclick="return Calificar()" value="Pagar viaje" >
		</form>
	</div>	
</div>
</body>
</html>