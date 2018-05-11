<html>
<meta charset="utf-8"/>
<body>
<?php

                include ('php/conection.php'); // conectar y seleccionar la base de datos
                $link = conectar();
                $viaje_id = $_GET['id'];

//Trae de base de datos la informacion de los viajes
	$q = "SELECT * FROM viajes where id=$viaje_id ";
   	$result = mysqli_query($link,$q);
	$row = mysqli_fetch_array($result);
	$id_viaje = $row['id'];
	$fecha = $row['fecha'];
	$duracion = $row['duracion'];
	$precio = $row['precio'];
	$texto = $row['texto'];
	$estado =$row['idEstado'];
	$origen = $row['idOrigen'];
	$destino = $row['idDestino'];
	$tipo_vehiculo = $row['idVehiculo'];
	$nombre_Conductor = $row['idConductor'];
?>
<h1 style="color: black;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Viaje a <?php echo utf8_encode($origen)?> </h1> 
<div>

  <label class="LabelFormularios"> <?php echo "Origen: " . utf8_encode($origen)?> </label>
  <label class="LabelFormularios"> <?php echo "Destino: " .utf8_encode($destino)?> </label>
  <label class="LabelFormularios"> <?php echo "Fecha: " . utf8_encode($fecha)?> </label>
  <label class="LabelFormularios"> <?php echo "Duracion: " . utf8_encode($duracion)?> </label>
  <label class="LabelFormularios"> <?php echo "Vehiculo: " . utf8_encode($tipo_vehiculo)?> </label>
  <label class="LabelFormularios"> <?php echo "texto: " . utf8_encode($texto)?> </label>
  <label class="LabelFormularios"> <?php echo "Precio: " . utf8_encode($precio)?> </label>

</div>
</body>
</html>