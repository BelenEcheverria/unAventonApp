<?php
             include_once "php/conection.php"; // conectar y seleccionar la base de datos
             $link = conectar();
             include "php/classLogin.php";
             $usuario= new usuario();
             $usuario -> session ($usuarioID, $admin);
             $ID= $usuarioID;
?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Nuevo Viaje </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
include "Header.php";
include "MenuBarra.php";
    if (isset($usuarioID)){
    ?>
<form method="POST" action="CrearViaje.php" class="input" onsubmit="return ValidarViaje()">
<table class="FormularioPublicarViaje">
	<tr>
		<td>
			<label class="LabelFormularios"> Origen </label>
			<select class="FormularioVehiculos" name = "origen" value="<?php echo $origen ?>"> 
                <?php
                  $consulta_ciudades = "SELECT * FROM ciudades ORDER BY ciudad ASC"; 
                  $result_origen = mysqli_query($link,$consulta_ciudades); ?>
                  <option value= "">Ingrese desde donde viaja</option> <?php              
                  while($fila = mysqli_fetch_array($result_origen)){
                    print_r($fila);
                    echo "<option value='". $fila['id'] . "'>" . $fila['ciudad'] . " </option>";
                    echo "<a href='?ciudad=" . $fila['id'] . "'>" . $id . " </a> ";
                  }
                ?>
          </select>
		</td>
		<td>
			<label class="LabelFormularios"> Destino </label>
			<select class="FormularioVehiculos" name = "destino" value="<?php echo $destino ?>"> 
                <?php
                  $consulta_ciudades = "SELECT * FROM ciudades ORDER BY ciudad ASC";
                  $result_Destino = mysqli_query($link,$consulta_ciudades); ?>
                  <option value= "">Ingrese hacia donde viaja</option> <?php              
                  while($fila = mysqli_fetch_array($result_Destino)){
                    echo "<option value='". $fila['id'] . "'>" . $fila['ciudad'] . " </option>";
                    echo "<a href='?ciudad=" . $fila['id'] . "'>" . $id . " </a> ";
                  }
                ?>
          </select>
		</td>
	</tr>
	<tr>
		<td>
			<label class="LabelFormularios"> Duracion estimada </label>
			<input type="int" id="duracionhoras" name="duracionhoras" class="FormularioVehiculos" placeholder="Horas...">
			<br>
			<input type="int" id="duracionmin" name="duracionmin" class="FormularioVehiculos" placeholder="Minutos...">
			
		</td>
		<td>
			<label class="LabelFormularios"> Hora de partida </label>
			<input type="text" id="horapartida" name="horapartida" class="FormularioVehiculos" placeholder="Horas...">
			<br>
			<input type="int" id="minutospartida" name="minutospartida" class="FormularioVehiculos" placeholder="Minutos...">
		</td>
	</tr>
	<tr>
		<td>
			<label class="LabelFormularios"> Dia </label>
			<input type="text" id="fecha" name="fecha" class="FormularioVehiculos" placeholder="Ingrese fecha AAAA-MM-DD..">
		</td>
		<td>
			<label class="LabelFormularios"> Precio </label>
			<input type="number" id="precio" name="precio" class="FormularioVehiculos" placeholder="Ingrese precio total del viaje...">
		</td>
	</tr>
	<tr>
		<td>
			<label class="LabelFormularios"> Vehiculo </label>
			<select class="FormularioVehiculos" name = "vehiculo" value="<?php echo $vehiculo ?>"> 
                <?php
                  $consulta_vehiculos = "SELECT * FROM vehiculos WHERE idUsuario=$ID"; 
                  $result_vehiculos = mysqli_query($link,$consulta_vehiculos); ?>
                  <option value= ""> Elige un auto </option> <?php              
                  while($fila = mysqli_fetch_array($result_vehiculos)){
                    echo "<option value='". $fila['id'] . "'>" . $fila['modelo'] . " </option>";
                    echo "<a href='?modelo=" . $fila['id'] . "'>" . $id . " </a> ";
                  }
                ?>
			</select>
		</td>
		<td>
			<label class="LabelFormularios"> Informacion adicional </label>
			<textarea class="FormularioVehiculos" name = "texto" size=200 placeholder="Informacion que quiera agregar..."></textarea>
		</td>
	</tr>
	<tr>
		<td>
			<div><input type="submit" class="BotonRegistrar" value="Agregar"></div>
		<td>
	</tr>
</table>
</form>
  <?php } ?>
<div class="LineaPiePagina"></div>
</body>
</html>

