<?php
	session_start(); //iniciamos la sesion
	//creamos la clase usuario
	class usuario {
		//esta función será la encargada de comprobar si existe el usuario en la base de datos
		public function validar_usuario ($link,$reactivo) {
			//recogemos las variables post del formulario, colocamos mysql_real_scape_string para evitar inyecciones
			if ((isset ($_POST['nombreU'])) and (isset ($_POST['contraU']))){
				$nombre= $_POST['nombreU'];
				$password= $_POST['contraU'];
				//validacion del lado del servidor
				if ((strlen($nombre)>=1) and (strlen($password)>=1)){
					$nombre = mysqli_real_escape_string ($link, $_POST['nombreU']);
					$password = mysqli_real_escape_string ($link, $_POST['contraU']);
					//realizamos la consulta sql 
					if ($reactivo){
						mysqli_query($link, "UPDATE usuarios SET estaActivo=1 WHERE mail= '".$nombre."'");
					}
					$query58 = "SELECT * FROM usuarios WHERE mail= '".$nombre."' AND password= '".$password."' AND estaActivo= 1;" ;
					$resultado58 = mysqli_query($link, $query58) or die ('Consulta query58 fallida ' .mysqli_error($link));;
					/*si el número de filas devuelto por la variable resultado es 1,significa que en la base de datos blog, en la tabla usuarios existe una fila que coincide con los datos ingresados.
					luego nos envia a la pagina inicioSesion, con las variables de sesion creados y exito setado */
					if($datosUsuario =mysqli_fetch_array($resultado58)) {
						$_SESSION['nombreUsuario'] = (($datosUsuario ['nombre']). ' ' .($datosUsuario ['apellido']));
						$_SESSION['admin'] = $datosUsuario ['esAdministrador'];
						$_SESSION['id'] = $datosUsuario ['id'];
					} else {
						$query58= $query58 = "SELECT * FROM usuarios WHERE mail= '".$nombre."'";
						$resultado58 = mysqli_query($link, $query58) or die ('Consulta query58 fallida ' .mysqli_error($link));;
						if($datosUsuario =mysqli_fetch_array($resultado58)) {
							throw new Exception ('Contraseña incorrecta');
						} else {
							throw new Exception ('El nombre de usuario no se encunatra registrado');
						}
					}
				} else {
					throw new Exception ('No se completo correctamente el formulario de iniciar sesion');
				}
			} else {
				throw new Exception ('No se completo el formulario de iniciar sesion');
			}
		}
		
		public function session (&$usuarioID, &$admin){
			if (isset ($_SESSION['nombreUsuario'])){
				$usuarioNombre= $_SESSION['nombreUsuario'];
				$usuarioID= $_SESSION['id'];
				if ((isset ($_SESSION['admin'])) and ($_SESSION['admin']= true)){
					$admin= false;
				} else {
					$admin= false;
				}
			}
		}
		
		public function iniciada ($usuarioID) { //tira la exception si la sesion NO esta iniciada
			if (!isset ($usuarioID)) { 
				throw new Exception ('Es necesario iniciar sesion para acceder a este contenido');
			}
		}
		
		public function noIniciada ($usuarioID) { //tira la exception si la sesion SI esta iniciada
			if (isset ($usuarioID)) {
				throw new Exception ('Usted ya ha iniciado sesion');
			}
		}
		
		public function esAdmin ($admin){
			if ((!isset ($admin)) or ($admin != true)){
				throw new Exception ('Debe estar logueado como un usuario Administrador para acceder a este contenido');
			}
		}
	}
?>

