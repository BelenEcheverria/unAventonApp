<?php
    include_once "conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	$fecha = date("Y-m-d");
	$idAutor = $_POST['idAutor'];
	$idViaje= $_POST['idViaje'];
	$date= $_POST['nacimiento'];
	//echo "actual" . $fecha;
	//echo "tarjeta" . $date;
	if ($date < $fecha){
		//echo "vencida";
		header( "refresh:3;url=3. EstadoPagoFallido.php" );
	} else {
		//echo "no vencida";
		$queryUpdate = "UPDATE viajes SET idEstado=4 WHERE id= $idViaje";
		$resultUpdate = mysqli_query($link, $queryUpdate);
		header( "refresh:3;url=3. EstadoPagoOk.php" );
	}
?><html>
<head>
	<link rel="stylesheet" href="../css/estilos.css">
	<link rel="stylesheet" href="../css/2. Estilos (2).css">
	<title> Pagar Viaje </title>
	<meta charset="utf-8"/>
</head>
<body style="background-image: url(../Imagenes/FondoColores.jpg);
	background-size:cover;
	height:100%;">
<div style="color: white;
	font-family: Arial, sans-serif;
	font-weight: bold; text-align:center; font-size: 150%; margin-top: 15%;">
	Estamos procesando su pago <br><br>
	Espere por favor
</div>
</body>
</html>