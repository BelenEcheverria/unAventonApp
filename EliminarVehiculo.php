<?php
	include_once ("php/conection.php"); // conectar y seleccionar la base de datos
	$link = conectar();
	include "php/classLogin.php";
    $usuario= new usuario();
    $usuario -> session ($usuarioID, $admin);
    $ID= $_SESSION['id'];
?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Eliminar Vehiculo </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
	include "Header.php";
	include "MenuBarra.php";
?>
<div class= "registrar">
<h1 style="color:white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Eliminar Vehiculo </h1> 
<form method="POST" action="php/eliminarVehiculoDeLaBase.php" class="input" onsubmit="return validar()">
	<label class="LabelFormularios"> Vehiculo </label>
	<select class="FormularioVehiculos" name="patente" value="<?php echo $vehiculo ?>"> 
                <?php
                  $consulta_vehiculos = "SELECT * FROM vehiculos WHERE idUsuario=$ID"; 
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
</body>
</html>