<?php
	include "conection.php"; 
	$link = conectar();
	$cumple1=false;
	if ((isset($_POST['password1'])) and (isset ($_POST['password2'])) and (isset ($_POST['correoOriginal']))){
		$contra1= $_POST['password1'];
		$contra2= $_POST['password2'];
		$correoOriginal = $_POST['correoOriginal'];
		$consulta = "SELECT * FROM usuarios WHERE mail='$correoOriginal'";
		if (!empty($consulta)){
			if ($contra1 == $contra2){
						if ((strlen($contra1)) >= 6){
							$mayus= 0;
							$simbolo= 0;
							$nro= 0;
							for ($i=0; $i<strlen($contra1);$i++){
								$caracter= $contra1[$i];
								if (ctype_upper($caracter)){
									$mayus ++;
								} elseif (!ctype_alnum ($caracter)) {
									$simbolo ++;
								} elseif (ctype_digit($caracter)){
									$nro ++;
								}
							}
							if (($mayus <> 0) and ($nro <> 0)) {
								$cumple1= true;							
							} else {
								$mensaje1="La contraseña debe tener al menos una mayuscula y un numero";
							}
						} else {
							$mensaje1= "La contraseña debe tener 6 caracteres como minimo";
						} 
			} else {
				$mensaje1="Las contraseñas no coinciden";
			}
		} else {
			$mensaje1="Usted no dispone de una cuenta activa";
		}
	} else {
		$mensaje1="Debe completar todos los campos";
	}
	if ($cumple1 == true) {
				$query72= ("UPDATE usuarios SET password='$contra1' WHERE mail='$correoOriginal'");
				$result72= (mysqli_query ($link, $query72) or die ('Consuluta query72 fallida: ' .mysqli_error($link)));		
				$mensaje1= "Se ha enviado un mail de confirmacion a su correo alternativo. Por favor confirme el cambio para que se haga efectivo";
	}
?>
<html>
<head> 
	<title> Recuperar contraseña </title>
	<link rel="stylesheet" type="text/css" href= " ../css/Estilo4.css" media="all" >
</head>
<body>
	<div class="body_registro"> <br> <br>
		<?php if (($cumple1==true)){
			echo $mensaje1; ?> <br><br>
			<a href="../Inicio.php"> Click aqui para iniciar sesion &nbsp;&nbsp;&nbsp; </a>
		<?php } else {
			echo $mensaje1; ?>
			<br><br>
			Por favor intente nuevamente <br> <br>
			<a href="../RecuperarContra.php"> Click aqui para volver a intenar &nbsp;&nbsp;&nbsp; </a>
		<?php } ?>

	</div>
</body>
</html>