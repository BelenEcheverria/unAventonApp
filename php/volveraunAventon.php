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
	$usuario=$_GET['usuario'];
	include "Header.php";
	include "MenuBarra.php";
	?>
		<p style="color: white;text-align:center;font-family:Arial;font-weight:750;">
		<?php
		if (isset ($_GET['mensajeEditar'])){
			$mensaje = $_GET['mensajeEditar'];
			echo $mensaje;
		}
		?>
		</p>
		<div class= "registrar" style="font-family:Arial;">
			<?php
			if (isset ($_GET['usuario'])){
				$usuario=  $_GET['usuario'];
				$query10= "SELECT * FROM usuarios WHERE mail=$usuario";
				$result10 = mysqli_query ($link, $query10) or die ('Consulta fallida ' .mysqli_error($link));
				$usuario = mysqli_fetch_array ($result10);
			}
			?>
			<h1 style="color: white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Informacion Personal </h1>
			<form method="POST" action="php/editar.php" class="input" onsubmit="return validar()" enctype="multipart/form-data" >
				<label class="LabelFormularios"> Mail: <?php echo $usuario['mail']?>  </label><br><br>
				<input type="hidden" name="nombreUsuario" class="FormularioVehiculos" value="<?php echo $usuario['mail']?>" >
				<label class="LabelFormularios"> Fecha de nacimiento: <?php echo $usuario['nacimiento']?>  </label><br><br>
				<label class="LabelFormularios"> Nombre </label>
				<input type="text" name="nombre" class="FormularioVehiculos" placeholder="Nombre..." value="<?php echo $usuario['nombre']?>" >
				<label class="LabelFormularios"> Apellido </span>
				<input type="text" id="apellido" name="apellido" class="FormularioVehiculos" placeholder="Apellido..." value="<?php echo $usuario['apellido']?>">
				<label class="LabelFormularios"> Correo alternativo </span>
				<input type="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="FormularioVehiculos" name="correoAlternativo" maxlength="45" value="<?php echo $usuario['mailRecuperacion']?>" required/>
				<label class="LabelFormularios"> Contraseña </label>
				<input type="password" id="clave1" name="password1" class="FormularioVehiculos" placeholder="Contraseña..." value= "" required>
				<label class="LabelFormularios"> Repita contraseña </label>
				<input type="password" id="clave2" name="password2" class="FormularioVehiculos" placeholder="Repetir Contraseña..." value= "" required>
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<label class="LabelFormularios"> Foto de perfil </label>
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
</body>
</html>