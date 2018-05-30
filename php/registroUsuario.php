<?php
	include "conection.php";
	$link = conectar();
	$cumple= false;
	$cumple1= false;
	$mensaje= "";
	if ((isset ($_POST['nombre'])) and (isset ($_POST['apellido']))) {
		$nombre= $_POST['nombre'];
		$apellido= $_POST['apellido'];
		if (isset ($_POST['nombreUsuario'])){
			$usuario= $_POST['nombreUsuario'];
			if ((isset ($_POST['contrasenia1'])) and (isset ($_POST['contrasenia2'])) and ($_POST['contrasenia2']==$_POST['contrasenia1'])){
				$contra= $_POST['contrasenia1'];
				if ((strlen($contra)) >= 8){
					$mayus= 0;
					$nro= 0;
					for ($i=0; $i<strlen($contra);$i++){
						$caracter= $contra[$i];
						if (ctype_upper($caracter)){
							$mayus ++;
						} elseif (ctype_digit($caracter)){
							$nro ++;
						}
					}
					if (($mayus <> 0) and ($nro <> 0)) {
						$cumple1= true;							
					} else {
						$mensaje="La contraseña debe tener al menos una mayuscula y un numero";
					}
				} else {
						$mensaje= "La contraseña debe tener 8 caracteres como minimo";
				} 
			} else {
				$mensaje="Las contraseñas no fueron introducidas, o no coinciden";
			}					
		} else {
				$mensaje= "No se ingreso el e-mail";
		}
	} else {
			$mensaje= "No se ingreso el nombre y/o apellido";
	}
	
	$cumple2=true;
		if ($cumple1 == true){
		$query25= ("SELECT mail FROM usuarios");
		$result25= mysqli_query ($link, $query25) or die ('Consulta fallida ' .mysqli_error());
		while ($usuarioTabla= mysqli_fetch_array ($result25)){
			if ($usuario == $usuarioTabla['mail']){
				$cumple2= false;
				$mensaje="El mail ingresado ya tiene una cuenta asociada, por favor ingrese otro";
			}
		}
	}
		
	$date= $_POST['nacimiento'];
	function isBirthDate($date)
	{
		if (empty($date) || $date == '0000-00-00')
			return false;
		if (preg_match('/^([0-9]{4})-((?:0?[1-9])|(?:1[0-2]))-((?:0?[1-9])|(?:[1-2][0-9])|(?:3[01]))([0-9]{2}:[0-9]{2}:[0-9]{2})?$/', $date, $birth_date))
		{
		    if (date('Y')-$birth_date[1]<=18)
		        return false;  
			if ($birth_date[1] > date('Y') && $birth_date[2] > date('m') && $birth_date[3] > date('d'))
				return false;
			return true;
		}
		return false;
	}
	$cumple3= isBirthDate($date);
	if ($cumple3== false){
		$mensaje= "Debe ser mayor de 18 años, para poder registrarse";
	}	
	
	if (($cumple1== true) and ($cumple2== true) and ($cumple3== true)){
		$query31= "INSERT INTO usuarios (mail, password, nombre, apellido, nacimiento) values ('$_POST[nombreUsuario]', '$_POST[contrasenia1]', '$_POST[nombre]', '$_POST[apellido]', '$_POST[nacimiento]')";
		$result31= mysqli_query ($link, $query31) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
		$exito= true;
	}
	
	if (!empty($_FILES['foto']['name'])){
			if ((($_FILES['foto']['type'] == "image/gif") || ($_FILES["foto"]["type"] == "image/jpeg") || ($_FILES["foto"]["type"] == "image/pjpeg"))){
			$imagen = $_FILES['foto']['tmp_name'];
			$aux = file_get_contents ($imagen);
			$aux = addslashes($aux);
			$tipoimagen = $_FILES['foto']['type'];
			$query63= "UPDATE usuarios SET contenidoimagen= '$aux', tipoimagen= '$tipoimagen' WHERE mail = '$_POST[nombreUsuario]'";
			$result63= mysqli_query ($link, $query63) or die ('Consuluta query63 fallida: ' .mysqli_error($link));
			$mensaje ="Usuario agregado con foto";
			} else {
				$mensaje= "El formato de la imagen no es valido";
			}
	} 
?>
<html>
<head> 
	<title> Registro </title>
	<link rel="stylesheet" type="text/css" href= " ../css/Estilo4.css" media="all" > 
</head>
<body>
	<div class="body_registro"> <br> <br>
		<?php if ((isset($exito)) and (($exito==true))){ ?>
			Usuario regitrado exitosamente <br><br>
			<a href="../Inicio.php"> Click aqui para iniciar sesion &nbsp;&nbsp;&nbsp; </a>
		<?php } else { ?>
			Error al completar el formulario. <br><br>
			<?php echo ($mensaje); ?> <br><br>
			Por favor intente nuevamente <br> <br>
			<a href="../Bienvenida.php"> Click aqui para volver a intenar &nbsp;&nbsp;&nbsp; </a>
		<?php } ?>

	</div>
</body>
</html>
	



