<html>
<head>
<link rel="stylesheet" href="estilos.css">
<link rel="stylesheet" href="css/Estilo5.css">
<title> Agregar Vehiculo </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
	include_once ("php/conection.php"); // conectar y seleccionar la base de datos
	$link = conectar();
	include "Header.php";
	include "MenuBarra.php";
?>
	<?php 
	try {
		$usuario -> iniciada($usuarioID);
		$id= $_SESSION['id'];
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
			if (isset ($_GET['id'])){
				$id=  $_GET['id'];
				$query10= "SELECT * FROM usuarios WHERE id= $id";
				$result10 = mysqli_query ($link, $query10) or die ('Consulta fallida ' .mysqli_error($link));
				$usuario = mysqli_fetch_array ($result10);
			}
		?>
		</div>
<div class= "registrar">
<h1 style="color:white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Agregar Vehiculo </h1> 
<form method="POST" action="php/AgregarVehiculoABase.php" class="input">
	<label class="LabelFormularios"> Marca </label>
	<input type="text" id="marca" name="marca" class="FormularioVehiculos" placeholder="Ingrese la marca...">
	<label class="LabelFormularios"> Modelo </label>
	<input type="text" id="modelo" name="modelo" class="FormularioVehiculos" placeholder="Ingrese el modelo...">
	<label class="LabelFormularios"> Tipo </label>
	<select class="FormularioVehiculos" name="patente" value="<?php echo $vehiculo ?>"> 
        <option value= "auto"> Auto </option>
		<option value= "moto"> Moto </option>
		<option value= "camioneta"> Camioneta </option>
    </select>
	<label class="LabelFormularios"> Año </label>
	<input type="text" id="anio" name="anio" class="FormularioVehiculos" placeholder="Ingrese el año...">
	<label class="LabelFormularios"> Patente </label>
	<input type="text" id="patente" name="patente" class="FormularioVehiculos"  placeholder="Ingrese la patente...">
	<label class="LabelFormularios"> Color </label>
	<input type="text" id="color" name="color" class="FormularioVehiculos" placeholder="Ingrese el color...">
	<label class="LabelFormularios"> Asientos </label>
	<input type="int" id="asientos" name="asientos" class="FormularioVehiculos" placeholder="Ingrese la cantidad de asientos...">
	<div><input type="submit" class="BotonVehiculos" value="Agregar"></div>
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