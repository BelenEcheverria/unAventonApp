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

<script type="text/javascript" src="ValidarViaje.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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
<br/>

<form method="POST" style="width:100%;height:81%;font-family: Arial; action="CrearViaje.php" class="input" onsubmit="return ValidarViaje()">
<table class="FormularioPublicarViaje">
	<tr>
		  <td>
          <label class="LabelFormularios"> Tipo de viaje </label>
          <select id="travelKindSelect" class= "FormularioVehiculos" name = "tipo">
            <option value= "1"> Ocasional </option>
            <option value= "2"> Periodico </option>
          </select>
      </td>
      <td id="selectorDeDias">
            <label for="dias" class="LabelFormularios"> Dias </label>
            <br/>
            <select class="js-example-basic-multiple" id = "dias" name="dias[]" multiple="multiple">
              <option value='1'>Lunes</option>
              <option value='2'>Martes</option>
              <option value='3'>Miercoles</option>
              <option value='4'>Jueves</option>
              <option value='5'>Viernes</option>
              <option value='6'>Sabado</option>
              <option value='7'>Domingo</option>
            </select>
      </td>
      <td id="viajeOcasional">
  			<label class="LabelFormularios"> Dia </label>
  			<input type="text" id="fecha" name="fecha" class="FormularioVehiculos" placeholder="Ingrese fecha AAAA-MM-DD..">
      </td>
  </tr>
  <tr>
    <td id="rangoDeFechas">
      <label class="LabelFormularios"> Fecha </label>
      <input type="date" id="fechainicio" name="fechainicio" class="FormularioVehiculos" placeholder="Fecha inicial..."/>
      <input type="date" id="fechafinal" name="fechafinal" class="FormularioVehiculos" placeholder="Fecha final..."/>
    </td>

      <div>
          <td>
              <label class="LabelFormularios"> Origen </label>
              <select class="FormularioVehiculos" id = "origen" name = "origen" value="<?php echo $destino ?>">          
                        <?php
                          $consulta_ciudades = "SELECT * FROM ciudades ORDER BY ciudad ASC";
                          $result_Destino = mysqli_query($link,$consulta_ciudades); ?>
                          <option value= "">Ingrese desde donde viaja</option> <?php              
                          while($fila = mysqli_fetch_array($result_Destino)){
                            echo "<option value='". $fila['id'] . "'>" . $fila['ciudad'] . " </option>";
                            echo "<a href='?ciudad=" . $fila['id'] . "'>" . $id . " </a> ";
                          }
                        ?>
              </select>
              <label class="LabelFormularios"> Destino </label>
              <select class="FormularioVehiculos" id = "destino" name = "destino" value="<?php echo $destino ?>">          
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
        			<label class="LabelFormularios"> Precio </label>
        			<input type="number" id="precio" name="precio" class="FormularioVehiculos" placeholder="Ingrese precio total del viaje...">
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<label class="LabelFormularios"> Vehiculo </label>
        			<select class="FormularioVehiculos" id = "vehiculo" name = "vehiculo" value="<?php echo $vehiculo ?>"> 
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
        			<textarea class="FormularioVehiculos" id = "texto" name = "texto" size=200 placeholder="Informacion que quiera agregar..."></textarea>
        		</td>
        	</tr>
        	<tr>
        		<td>
				<div><input type="submit" class="BotonRegistrar" value="Agregar"></div>
       </div>

			
		<td>
	</tr>
</table>
</form>
  <?php } ?>
</body>
</html>

