<?php
	include "conection.php"; 
	$link = conectar();
	$mensaje1="";
	$mensaje2="";
	if (isset ($_POST['id'])){
		$id= $_POST['id'];
	}
	if ((isset ($_POST['id'])) and (isset($_POST['nombre'])) and (isset($_POST['apellido'])) and (isset($_POST['password1'])) and (isset ($_POST['password2']))){
		$id= $_POST['id'];
		$mailOriginal= $_POST['nombreUsuario'];
		$nombre= $_POST['nombre'];
		$apellido= $_POST['apellido'];
		$contra1= $_POST['password1'];
		$contra2= $_POST['password2'];
		$correoAlternativo = $_POST['correoAlternativo'];
		if ((!empty($nombre)) and (!empty($apellido)) and (!empty($contra1)) and (!empty($contra2)) and (!empty($correoAlternativo))){
			if (($correoAlternativo) != ($mailOriginal)){
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
			if ($cumple1 == true) {
				$query72= ("UPDATE usuarios SET nombre='$nombre', apellido='$apellido', password='$contra1', mailRecuperacion='$correoAlternativo' WHERE id='$id'");
				$result72= (mysqli_query ($link, $query72) or die ('Consuluta query72 fallida: ' .mysqli_error($link)));		
				$mensaje1= "Sus datos se han actualizado correctamente";
			}
			} else {
				$mensaje1="El mail principal y alternativo deben ser diferentes";
			}
		} else{
			$mensaje1="Por favor, no deje ningun campo en blanco (excepto la imagen, que es opcional)";
		}
	} else {
		$mensaje1="Por favor, no deje ningun campo en blanco (excepto la imagen, que es opcional)";
	}
	
	if (!empty($_FILES['foto']['name'])){
			if ((($_FILES['foto']['type'] == "image/gif") || ($_FILES["foto"]["type"] == "image/jpeg") || ($_FILES["foto"]["type"] == "image/pjpeg"))){
			$imagen = $_FILES['foto']['tmp_name'];
			$aux = file_get_contents ($imagen);
			$aux = addslashes($aux);
			$tipoimagen = $_FILES['foto']['type'];
			$query63= "UPDATE usuarios SET contenidoimagen= '$aux', tipoimagen= '$tipoimagen' WHERE id = $id";
			$result63= mysqli_query ($link, $query63) or die ('Consuluta query63 fallida: ' .mysqli_error($link));
			$mensaje2 =", y se modifico la imagen de perfil";
			} else {
				$mensaje2= "El formato de la imagen no es valido";
			}
	} else {
		$mensaje= "Usuario registrado, sin foto de perfil";
	}
	
	$mensajeEditar = $mensaje1 . $mensaje2;
	header ("Location: ../EditarMisDatos.php?id=$id&mensajeEditar=$mensajeEditar");
?>