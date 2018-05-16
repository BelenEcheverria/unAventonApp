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
        <div class= "registrar">
        <form method="POST" action="CrearViaje.php" class="input" onsubmit="return ValidarViaje()">
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
          <br></br>
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
          <br></br>
          <label class="LabelFormularios"> Dia </label>
          <input type="text" id="fecha" name="fecha" class="FormularioVehiculos" placeholder="Ingrese fecha AAAA-MM-DD..">
          <br></br>
          <label class="LabelFormularios"> Hora de partida </label>
          <input type="int" id="horapartida" name="horapartida" class="FormularioVehiculos">
          <input type="int" id="minutospartida" name="minutospartida" class="FormularioVehiculos">
          <br></br>
          <label class="LabelFormularios"> Duracion estimada </label>
          <input type="int" id="duracionhoras" name="duracionhoras" class="FormularioVehiculos">
          <input type="int" id="duracionmin" name="duracionmin" class="FormularioVehiculos">
          <br></br>
          <label class="LabelFormularios"> Informacion adicional </label>
          <textarea class="FormularioVehiculos" name = "texto" size=200></textarea>
          <br></br>
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
          <label class="LabelFormularios"> Precio </label>
          <input type="number" id="precio" name="precio" class="FormularioVehiculos" placeholder="Ingrese precio por asiento...">
          <br></br>
          <div><input type="submit" class="BotonRegistrar" value="Agregar"></div>

        </form>
        </div>
  <?php } ?>
<div class="LineaPiePagina"></div>
</body>
</html>

