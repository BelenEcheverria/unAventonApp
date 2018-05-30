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
	try {
		$usuario -> iniciada($usuarioID);
		$id= $_SESSION['id'];
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
	<label class="LabelFormularios"> Vehiculo </label>
	<select class="FormularioVehiculos" name="patente" value="<?php echo $vehiculo ?>"> 
                <?php
                  $consulta_vehiculos = "SELECT * FROM vehiculos WHERE idUsuario=$usuarioID AND estaActivo = 1"; 
                  $result_vehiculos = mysqli_query($link,$consulta_vehiculos); ?>
                  <option value= ""> Elige un auto </option> <?php              
                  while($fila = mysqli_fetch_array($result_vehiculos)){?>
					 <option value="<?php echo $fila['patente']?>"><?php echo $fila['patente']?></option>;
				<?php	 
                  }
                ?>
          </select>
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