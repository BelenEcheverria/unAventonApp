<?php
	include_once ("php/conection.php"); // conectar y seleccionar la base de datos
	$link = conectar();
	include "php/classLogin.php";
    $usuario= new usuario();
    $usuario -> session ($usuarioID, $admin);
?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<link rel="stylesheet" href="css/Estilo5.css">
<title> Eliminar Vehiculo </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
	include "Header.php";
	include "MenuBarra.php";
?>
<br>
<p style="color: white;text-align:center;font-family:Arial;font-weight:750;">
<?php
		if (isset ($_GET['mensajeEditar'])){
			$mensaje = $_GET['mensajeEditar'];
			echo $mensaje;
		}
		?>
</p>		
<div class= "registrar">
<h1 style="color:white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Eliminar Vehiculo </h1> 
<form method="POST" action="php/eliminarVehiculoDeLaBase.php" class="input" onsubmit="return validar()">
	<label class="LabelFormularios"> E-Mail </label>
	<input type="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="FormularioVehiculos" name="correoAlternativo" maxlength="45" value="<?php echo $usuario['mailRecuperacion']?>" required/>
	<label class="LabelFormularios"> Contraseña </label>
	<input type="password" id="clave1" name="password1" class="FormularioVehiculos" placeholder="Contraseña..." value= "<?php echo $usuario['password']?>">
	<label class="LabelFormularios"> Repita contraseña </label>
	<input type="password" id="clave2" name="password2" class="FormularioVehiculos" placeholder="Repetir Contraseña..." value= "<?php echo $usuario['password']?>">
	<div><input type="submit" class="BotonVehiculos" value="Eliminar"></div>
</form>
</div>
<?php	
	}
	catch (Exception $e) {
	?>
		<div class="noIniciada">
			<br><br>
			<p> Usted no ha iniciado sesión </p>
			<p> Por favor 
			<a href="Inicio_Sesion.php"> inicie sesión </a>
			o
			<a href="Bienvenida.php"> registrese </a>
			para ver este contenido
		</div>
	<?php
	}
	?>
</body>
</html>