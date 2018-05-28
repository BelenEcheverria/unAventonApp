<html>
<head>
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="css/Estilo5.css">
	<title> Modificar Vehiculo </title>
	<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
	<?php
	include_once ("php/conection.php"); // conectar y seleccionar la base de datos
	$link = conectar();
	include "Header.php";
	include "MenuBarra.php";
	?>
	<br><br><br>
	<?php 
	try {
		$usuario -> iniciada($usuarioID);
		$id= $_SESSION['id'];
		$idVehiculo = $_GET['id']
	?>
		<p style="color: white;text-align:center;font-family:Arial;font-weight:750;">
		<?php
		if (isset ($_GET['mensajeEditar'])){
			$mensaje = $_GET['mensajeEditar'];
			echo $mensaje;
		}
		?>
		</p>
		<div  style="font-family:Arial">
		<?php
		$query10= "SELECT * FROM vehiculos WHERE id= $idVehiculo";
		$result10 = mysqli_query ($link, $query10) or die ('Consulta fallida ' .mysqli_error($link));
		$vehiculo = mysqli_fetch_array ($result10);
		?>
		<?php
		$query20= "SELECT * FROM vehiculos WHERE id= $idVehiculo";
		$result10 = mysqli_query ($link, $query10) or die ('Consulta fallida ' .mysqli_error($link));
		$vehiculo = mysqli_fetch_array ($result10);
		if ($vehiculo['idUsuario'] == $id ) {
			?>
		</div>
			<div class= "registrar">
			<h1 style="color:white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Modificar Vehiculo </h1>
			<p style="color: white;text-align:center;font-family:Arial;font-weight:750;"> Modifique solo los campos que quiera editar </p><br>
			<form style="color:white;font-family:Arial" method="POST" action="php/editarVehiculo.php" class="input" onsubmit="return validar()">
				<span class="LabelFormularios"> Patente: <?php echo $vehiculo['patente']?>  </span> <br><br>
				<span class="LabelFormularios"> Modelo </span>
				<input type="text" name="modelo" class="FormularioRegistrarse" value="<?php echo $vehiculo['modelo']?>" > <br>
				<span class="LabelFormularios"> Marca </span>
				<input type="text" name="marca" class="FormularioRegistrarse" value="<?php echo $vehiculo['marca']?>" > <br>
				<label class="LabelFormularios"> Tipo </label>
				<select class="FormularioVehiculos" name="tipo" value="<?php echo $vehiculo ?>"> 
					<option value= "auto" <?php if ($vehiculo['tipo']== "auto") {echo "selected";} ?>> Auto  </option>
					<option value= "moto" <?php if ($vehiculo['tipo']== "moto") {echo "selected";} ?> > Moto </option>
					<option value= "camioneta" <?php if ($vehiculo['tipo']== "camioneta") {echo "selected";} ?>> Camioneta </option>
				</select>
				<span class="LabelFormularios"> Año </span>
				<input type="text" name="anio" class="FormularioRegistrarse" value="<?php echo $vehiculo['anio']?>" > <br>
				<span class="LabelFormularios"> Color </span>
				<input type="text" name="color" class="FormularioRegistrarse" value="<?php echo $vehiculo['color']?>" > <br>
				<span class="LabelFormularios"> Asientos </span>
				<input type="text" name="asientos" class="FormularioRegistrarse" value="<?php echo $vehiculo['asientos']?>" > <br>
				<input type="hidden" name="id" value="<?php echo $idVehiculo ?>">
			<div><input type="submit" class="BotonVehiculos" value="Modificar"></div>
		</form>
		</div>
	<?php
		} else {
		?>
			<div class="noIniciada">
			<br><br>
			<p> Usted no es propietario del vehiculo
			<?php echo $vehiculo['patente']?>
			, por lo que no tiene permiso para editarlo
			</p>
		</div>
		<?php
		}
		?>
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