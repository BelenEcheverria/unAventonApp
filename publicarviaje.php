<?php
             include_once "php/conection.php"; // conectar y seleccionar la base de datos
             $link = conectar();
             include "php/classLogin.php";
             $usuario= new usuario();
             $usuario -> session ($usuarioID, $admin);
             $ID= $_SESSION['id'];
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
    if (isset($usuarioID)){
    ?>
        <div class= "publicarUnviaje">
        <form method="POST" action="crearviaje.php" class="input" onsubmit="return validarviaje()">
          <label class="LabelFormularios"> Origen </label>
          <select name = "origen_id" value="<?php echo $origen_id ?>"> 
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
          <select name = "destino_id" value="<?php echo $destino_id ?>"> 
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
          <input type="text" id="fecha" name="fecha" class="FormularioCrearviaje" placeholder="Ingrese fecha AAAA-MM-DD..">
          <br></br>
          <label class="LabelFormularios"> Hora de partida </label>
          <input type="int" id="horapartida" name="hora" class="FormularioCrearviaje"  placeholder="">
          <input type="int" id="minutospartida" name="minutospartida" class="FormularioCrearviaje"  placeholder="">
          <br></br>
          <label class="LabelFormularios"> Duracion estimada </label>
          <input type="int" id="duracionhoras" name="hora" class="FormularioCrearviaje"  placeholder="">
          <input type="int" id="duracionmin" name="hora" class="FormularioCrearviaje"  placeholder="">
          <br></br>
          <label class="LabelFormularios"> Informacion adicional </label>
          <textarea class="enmarcado" name = "texto" size=200></textarea>
          <br></br>
          <label class="LabelFormularios"> Vehiculo </label>
          <select name = "vehiculo_id" value="<?php echo $vehiculo_id ?>"> 
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
          <input type="number" id="precio" name="precio" class="FormularioCrearviaje" placeholder="Ingrese precio por asiento...">
          <br></br>
          <div><input type="submit" class="BotonCrearViaje" value="Agregar"></div>

        </form>
        </div>
  <?php } ?>
<div class="LineaPiePagina"></div>
</body>
</html>

