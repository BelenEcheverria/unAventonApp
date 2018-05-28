<?php
    include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
?>
<html>
<head>
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="css/Estilo5.css">
	<title> Editar Perfil </title>
	<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
	<?php
	include "Header.php";
	include "MenuBarra.php";
	?>
	<br><br><br>
	<?php 
	try {
		$usuario -> iniciada($usuarioID);
		$id= $_GET['id'];
	?>
		<p style="color: white;text-align:center;font-family:Arial;font-weight:750;">
		<?php
		if (isset ($_GET['mensajeEditar'])){
			$mensaje = $_GET['mensajeEditar'];
			echo $mensaje;
		}
		?>
		</p>
		<div class= "registrar" style="font-family:Arial">
			<?php
			if (isset ($_GET['id'])){
				$id=  $_GET['id'];
				$query10= "SELECT * FROM usuarios WHERE id= $id";
				$result10 = mysqli_query ($link, $query10) or die ('Consulta fallida ' .mysqli_error($link));
				$usuario = mysqli_fetch_array ($result10);
			}
		?>
			<h1 style="color: white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Informacion Personal </h1> 
			<p style="color: white;text-align:center;font-family:Arial;font-weight:750;"> Modifique solo los campos que quiera editar </p><br>
			<form method="POST" action="php/editar.php" class="input" onsubmit="return validar()" enctype="multipart/form-data" >
				<span class="LabelFormularios"> Mail: <?php echo $usuario['mail']?>  </span> <br><br>
				<span class="LabelFormularios"> Fecha de nacimiento: <?php echo $usuario['nacimiento']?>  </span> <br>
				<span class="LabelFormularios"> Nombre </span>
				<input type="text" name="nombre" class="FormularioRegistrarse" placeholder="Nombre..." value="<?php echo $usuario['nombre']?>" >
				<br>
				<span class="LabelFormularios"> Apellido </span>
				<input type="text" id="apellido" name="apellido" class="FormularioRegistrarse" placeholder="Apellido..." value="<?php echo $usuario['apellido']?>">
				<br>
				<span class="LabelFormularios"> Contraseña </span>
				<input type="password" id="clave1" name="password1" class="FormularioRegistrarse" placeholder="Contraseña..." value= "<?php echo $usuario['password']?>">
				<span class="LabelFormularios"> Repita contraseña </span>
				<input type="password" id="clave2" name="password2" class="FormularioRegistrarse" placeholder="Repetir Contraseña..." value= "<?php echo $usuario['password']?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<span class="LabelFormularios"> Foto de perfil </span> <br>
				<div class="ImagenPerfil">
					<?php
					$imagenUsuario= $usuario['contenidoimagen'];
					if (!empty ($imagenUsuario)){
					?>
						<?php
						$class= 'class="LaImagenDePerfil"';
						echo "<img $class src= 'data:image/jpg; base64,".base64_encode($imagenUsuario). "'>";
					?>
					<?php
					} else {
					?>
						<img class="LaImagenDePerfil" src="Imagenes/anonimo2.jpg">
						<span class="LabelFormularios">  Usted no ha cargado ninguna foto de perfil </span>
					<?php
					}
					?>
				</div>
				<input class="FormularioRegistrarse" name="foto" type="file"/>
				<div> <input type="submit" class="BotonRegistrar" value="Editar"> </div>
			</form>
		</div>
	<?php	
	}
	catch (Exception $e) {
	?>
		<div class="noIniciada">
			<br><br>
			<p> Usted no ha iniciado sesion </p>
			<p> Por favor 
			<a href="Inicio_Sesion.php"> inicie sesion </a>
			o
			<a href="Bienvenida.php"> registrese </a>
			para ver este contenido
		</div>
	<?php
	}
	?>
</body>
</html>