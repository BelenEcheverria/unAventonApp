<?php
             include_once "php/conection.php"; // conectar y seleccionar la base de datos
             $link = conectar();
             include "php/classLogin.php";
             $usuario= new usuario();
             $usuario -> session ($usuarioID, $admin);
             $ID= $usuarioID;
?>
<?php
include_once "php/conection.php"; // conectar y seleccionar la base de datos
$link = conectar();
//$viaje_id = $_GET['id_viaje'];
//Trae de base de datos la informacion de los viajes
  $viaje_id = $_GET['id_viaje'];
  $q = "SELECT * FROM viajes where id=$viaje_id "; //$viaje_id
  $result = mysqli_query($link,$q);
  $row = mysqli_fetch_array($result);
  $fecha = $row['fecha'];
  $duracion = $row['duracion'];
  $horaPartida = $row['hora'];
  $precio = $row['precio'];
  $texto = $row['texto'];
  $estado =$row['idEstado'];
  $origen = $row['idOrigen'];
  $destino = $row['idDestino'];
  $id_Vehiculo = $row['idVehiculo'];

/*---------------AGREGO QUE MUESTRE El Destino---------------*/
  $consultaDestino = "SELECT * FROM ciudades where id=$destino";
  $resultadoConsultaDest = mysqli_query($link,$consultaDestino);
  $rowCiudadDest = mysqli_fetch_array($resultadoConsultaDest);
  $destinoViaje = $rowCiudadDest['ciudad'];

//---------------AGREGO QUE MUESTRE El Origen---------------
  $consultaOrigen = "SELECT * FROM ciudades where id=$origen";
  $resultadoConsulta = mysqli_query($link,$consultaOrigen);
  $rowCiudad = mysqli_fetch_array($resultadoConsulta);
  $origenViaje = $rowCiudad['ciudad'];

//---------------AGREGO QUE MUESTRE Los asientos del vehiculo---------------
  $consultaVehiculo = "SELECT * FROM vehiculos where id=$id_Vehiculo";
  $resultadoConsultaVehiculo = mysqli_query($link,$consultaVehiculo);
  $rowVehiculo = mysqli_fetch_array($resultadoConsultaVehiculo);
  $vehiculoViaje = $rowVehiculo['modelo'];
  $asientosDisponibles = $rowVehiculo['asientos'];
//PREGUNTAR POR PRECIO 
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
<body class="FondoPerfil">
<?php
include "Header.php";
include "MenuBarra.php";
?>
<br/><?php
if(isset($ID)){ //SI INICIO SESION?>
	
		<?php
		$queryPostulaciones = "SELECT * FROM postulaciones WHERE idViaje = $viaje_id AND (idEstado = 1 OR idEstado = 5)";
		$resultPostulaciones =  mysqli_query($link,$queryPostulaciones); 
		$rowPostulaciones = mysqli_fetch_array ($resultPostulaciones);
		if (empty ($rowPostulaciones)) {
		?> 
	
	
          <form method="POST" style="width:100%;height:81%;font-family:Arial;" action="CrearViajeModificado.php?viaje_id=<?php echo 
          $viaje_id ?>" class="input" onsubmit="return ValidarViaje()">
          <table class="FormularioPublicarViaje">
          <td id="viajeOcasional">
          <label class="LabelFormularios"> Dia </label>
          <input type="date" id="fecha" name="fecha" class="FormularioVehiculos" value= <?php echo $fecha ?> >
          </td>
          </tr>
          <tr>
      <div>
          <td>
          <label class="LabelFormularios"> Origen </label>
          <select class="FormularioVehiculos" id = "origen" name = "origen" value="<?php echo $origen ?>">          
          <?php
          $consulta_ciudades = "SELECT * FROM ciudades ORDER BY ciudad ASC";
          $result_Destino = mysqli_query($link,$consulta_ciudades);              
          while($fila = mysqli_fetch_array($result_Destino)){
            echo "<option value='". $fila['id'] . "'" . (($fila['id'] == $origen) ? ("selected") : ("")) . " >" . $fila['ciudad'] . " </option>";
            echo "<a href='?ciudad=" . $fila['id'] . "'>" . $id . " </a> ";
          }
          ?>
          </select>
          <label class="LabelFormularios"> Destino </label>
          <select class="FormularioVehiculos" id = "destino" name = "destino" value="<?php echo $destino ?>">          
          <?php
          $consulta_ciudades = "SELECT * FROM ciudades ORDER BY ciudad ASC";
          $result_Destino = mysqli_query($link,$consulta_ciudades);               
          while($fila = mysqli_fetch_array($result_Destino)){
            echo "<option value='". $fila['id'] . "'" . (($fila['id'] == $destino) ? ("selected") : ("")) . " >" . $fila['ciudad'] . " </option>";
            echo "<a href='?ciudad=" . $fila['id'] . "'>" . $id . " </a> ";
          }
          ?>
          </select>
          </td>
          </tr>
          <tr>
          <td>
          <label class="LabelFormularios"> Duracion estimada </label>
          <input type="int" id="duracionhoras" name="duracion" class="FormularioVehiculos" value=<?php echo $duracion ?>>
          <br>
          </td>
          <td>
          <label class="LabelFormularios"> Hora de partida </label>
          <input type="time" id="horapartida" name="horapartida" class="FormularioVehiculos" value=<?php echo substr($horaPartida,0,5) ?>>
          <br>
          </td>
          </tr>
          <tr>
          <td>
          <label class="LabelFormularios"> Precio </label>
          <input type="number" id="precio" name="precio" class="FormularioVehiculos" value=<?php echo $precio ?>>
          </td>
          </tr>
          <tr>
          <td>
          <label class="LabelFormularios"> Vehiculo </label>
          <select class="FormularioVehiculos" id = "vehiculo" name = "vehiculo" value="<?php echo $vehiculoViaje ?>"> 
          <?php
           $consulta_vehiculos = "SELECT * FROM vehiculos WHERE idUsuario=$ID AND estaActivo = '1'"; 
           $result_vehiculos = mysqli_query($link,$consulta_vehiculos);            
           while($fila = mysqli_fetch_array($result_vehiculos)){
               echo "<option value='". $fila['id'] . "'" . (($fila['id'] == $id_Vehiculo) ? ("selected") : ("")) . " >" . $fila['patente'] . " </option>";
               echo "<a href='?patente=" . $fila['id'] . "'>" . $id . " </a> ";
           }
           ?>
           </select>
         </td>
         <td>
         <label class="LabelFormularios"> Informacion adicional </label>
         <textarea class="FormularioVehiculos" id = "texto" name = "texto" size=200 ><?php echo $texto ?></textarea>
         <br></br>
         <div><input type="submit" class="BotonPublicar" value="Modificar"></div>
         </td>
         </tr>
         <tr>
         <td>
         </div>
         <td>
       </tr>
     </table>
     </form>
	 <div class="LineaPiePagina"></div>
	 
	<?php
	} else {
	?>	
	<div style="font-family:Arial; text-align: center; font-weight: bold; color: white; font-size: 150%;">
	<br><br><br><br>
		No se puede modificar el viaje, porque tiene postulaciones pendientes o aceptadas
		<br><br>
		<a style= "text-decoration: none; color: white;" href="2. MiViaje.php?id=<?php echo $viaje_id;?>" >
		Por favor cancele las postulaciones aceptadas, o rechace las pendientes antes de continuar 
		</a>
		<br><br><br><br>
	</div>
	
	 
<?php
}
}//END DEL IF SI ES QUE ESTA INICIADO SESION
?>

</body>
</html>

