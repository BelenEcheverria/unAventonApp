<?php
     include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
    $viaje_id = $_GET['id_viaje'];
	
//Trae de base de datos la informacion de los viajes
	$q = "SELECT * FROM viajes where id=$viaje_id ";
   	$result = mysqli_query($link,$q);
	$row = mysqli_fetch_array($result);
	$fecha = $row['fecha'];
	$duracion = $row['duracionHoras'];
	$duracionMinutos = $row['duracionMinutos'];
	$horaPartida = $row['hora'];
	$minutosPartida = $row['minuto'];
	$precio = $row['precio'];
	$texto = $row['texto'];
	$estado =$row['idEstado'];
	$origen = $row['idOrigen'];
	$destino = $row['idDestino'];
	$id_Vehiculo = $row['idVehiculo'];
	$idConductor = $row['idConductor'];
/*---------------AGREGO QUE MUESTRE El CONDUCTOR---------------*/
	$consultaCOND = "SELECT * FROM usuarios where id=$idConductor";
	$resultadoConsultaCOND = mysqli_query($link,$consultaCOND);
	$rowCOND = mysqli_fetch_array($resultadoConsultaCOND);
	$conductorNom = $rowCOND['nombre'];
	$conductorAp = $rowCOND['apellido'];
	$usuarioConductorID= $row['idConductor'];

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
	?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<link rel="stylesheet" href="2. Estilos (1).css">
<meta charset="utf-8"/>
</head>
<body background="Imagenes/FondoColores.jpg">
<?php
include "Header.php";
include "MenuBarra.php";
?>
<br><br>
	<div class= "div_body">
		<div>
			<p class="p_titulo"> Detalles del viaje </p>
			<div class="div_body_detalle">
				<div class="div_vertical" id="div_left_corner" >
					<span> <?php echo "Origen: " . utf8_encode($origenViaje)?> </span>
					<br><br>
					<span class="span_detalle"> <?php echo "Destino: " .utf8_encode($destinoViaje)?> </span>
				</div>
				<div class="div_vertical">
					<span class="span_detalle"> <?php echo "Horario de salida: " .utf8_encode($horaPartida)?><?php echo":" . utf8_encode($minutosPartida); if ($minutosPartida == 0) { echo 0;}?>
					</span>
					<br><br>
					<?php 
					if ($duracionMinutos != 0){
					?>
						<span> <?php echo "Duracion aproximada: " . utf8_encode($duracion)?><?php echo ":" . utf8_encode($duracionMinutos)?> Hs </span>
					<?php
					} else {
					?>
						<span> <?php echo "Duracion aproximada: " . utf8_encode($duracion)?> Hs </span>
					<?php
					}
					?>
				</div>
				<div class="div_vertical">
					<span class="span_detalle"> <?php echo "Precio total: $" . utf8_encode($precio)?> </span>
					<br><br>
					<span class="span_detalle"> Precio por persona: $
					<?php echo(round($precio/$asientosDisponibles));?>
					</span>
				</div>
				<div class="div_vertical">
					<span class="span_detalle"> Lugares totales: <?php echo($asientosDisponibles) ?> </span>
					<br><br>
					<span class="span_detalle"> Lugares disponibles:
					<?php
					$query3= "SELECT * FROM postulaciones WHERE idViaje = $viaje_id AND idEstado = 1";
					$result3= mysqli_query ($link, $query3) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
					$asientosOcupados= 0;
					while ($postulacion = mysqli_fetch_array ($result3)){
						$asientosOcupados ++;
					}
					echo($asientosDisponibles - $asientosOcupados -1);
					$lugaresDisponibles = ($asientosDisponibles - $asientosOcupados -1)
					?>
					</span>
				</div>
				<div class="div_vertical">
					<span class="span_detalle"> <?php echo "Fecha: " . utf8_encode($fecha)?> </span>
					<br><br>
					<span class="span_detalle"> <?php echo "Vehiculo: " . utf8_encode($vehiculoViaje)?> </span>
				</div>	
				<div class="div_vertical" id="div_right_corner">
					<span class="span_detalle">
					<a href= "verPerfilUsuario.php?id=<?php echo $usuarioConductorID?>"> Conductor <a/> </span>
					<br><br>
					<span class="span_detalle">
					<?php 
					$query2 = "SELECT * FROM usuarios WHERE id = $usuarioConductorID";
					$result2 = mysqli_query ($link, $query2) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
					$usuarioConductorNombre = mysqli_fetch_array ($result2);
					?>
					<a href= "verPerfilUsuario.php?id=<?php echo $usuarioConductorID?>"> <?php echo ($usuarioConductorNombre ['nombre'] . ' ' . $usuarioConductorNombre ['apellido']); ?>
					<a/>
					</span>
				</div>
				<br><br><br><br>
			</div>	
		</div>
		<div class="div_submit">
			<?php
			$query2 = "SELECT * FROM postulaciones WHERE idViaje = $viaje_id AND idUsuario = $usuarioID AND (idEstado = 1 OR idEstado = 5)";
			$result2 = mysqli_query ($link, $query2) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
			$postulacion = mysqli_fetch_array ($result2);
			if (empty($postulacion) and (!isset ($_GET['mensaje']))) {
			?>			
				<form name="formulario" method="post" action="php/2. postularse.php" >
					<input type="hidden" name="idViaje" value="<?php echo $viaje_id ?>">
					<input type="hidden" name="idUsuario" value="<?php echo $usuarioID ?>">
					<input type="submit" value="Postularse" class= "boton_postulacion_viaje">
				</form>
			<?php
			} elseif (isset ($_GET['mensaje'])) {
			?>
				<br><br><br>
				<span> <?php echo $_GET['mensaje']; ?> </span>
			<?php
			} elseif ($postulacion['idEstado'] == 1) {
			?>
				<br><br><br>
				<span> Usted ya tiene una postulacion aceptada para este viaje </span> <br><br><br>
				<?php
				$idEstadoPostulacion= $postulacion['idEstado'];
				$id_viaje = $_GET['id_viaje'];
				?>
				<a href="confirmacionCancelarPostulacion.php?estadoPostulacion=<?php echo $idEstadoPostulacion; ?>&idViaje=<?php echo $id_viaje ?>"> <span class= "boton_cancelar_viaje"> Cancelar Postulacion	</span> </a>
			<?php
			} elseif ($postulacion['idEstado'] == 5) {
			?>
				<br><br><br>
				<span> Usted ya tiene una postulacion pendiente para este viaje </span> <br><br><br>
				<?php
				$idEstadoPostulacion= $postulacion['idEstado'];
				$id_viaje = $_GET['id_viaje'];
				?>
				<a href="confirmacionCancelarPostulacion.php?estadoPostulacion=<?php echo $idEstadoPostulacion; ?>&idViaje=<?php echo $id_viaje ?>"> <span class= "boton_cancelar_viaje"> Cancelar Postulacion </span> </a>
			<?php } ?>
		</div>
	</div>
	<hr><br>
	<p class="p_titulo"> Preguntas al conductor </p>
	<div class="PreguntaViaje">
		<?php
		$query30= "SELECT * FROM preguntas WHERE idViaje = $viaje_id";
		$result30= mysqli_query ($link, $query30) or die ('Consulta fallida ' .mysqli_error($link));
		while ($pregunta = mysqli_fetch_array ($result30)) { ?>
			<div class="UnaPregunta">
				<div style="margin-top:0.5%;float:left;text-align:left;width:48%;margin-left:2%;">
					<?php $usuarioPregunta= $pregunta['idUsuario'];
					$idPregunta = $pregunta['id'];
					$query40= "SELECT * FROM usuarios WHERE id = $usuarioPregunta";
					$result40= mysqli_query ($link, $query40) or die ('Consulta fallida ' .mysqli_error($link));
					$usuarioAutor= mysqli_fetch_array ($result40);
					echo ($usuarioAutor['nombre'] . " " . $usuarioAutor['apellido'])
					?>
				</div>
				<div style="float:right;text-align:right;width:48%;margin-right:2%;margin-top:0.5%;">
				<?php echo ($pregunta['fecha'])?>
				</div>
				<div style="float:left;width:48%;margin-left:2%;margin-top:1%;">
				<?php echo ($pregunta['pregunta'])?>
				</div>
			</div>
			<?php
			$consultaRespuesta = "SELECT * FROM respuestas WHERE idPregunta = $idPregunta";
			$resultConsulta = mysqli_query ($link, $consultaRespuesta) or die ('Consulta fallida ' .mysqli_error($link));
			$respuesta = mysqli_fetch_array ($resultConsulta);
			if (!empty($respuesta)){ ?>
				<div class="Respuesta">
					<div style="float:right;text-align:right;width:48%;margin-right:2%;margin-top:0.5%;">
					<?php echo $respuesta['fecha']?>
					</div>
					<div style="float:left;margin-left:5%;margin-top:3%;">
					<?php echo $respuesta['respuesta']?>
					</div>
				</div> <?php
			} else {
				if ($pregunta['idUsuario'] == ($usuarioID)){ ?>
					<form action="php/eliminarPreguntaBase.php" method="post">
						<input type="hidden" name="idViaje" value="<?php echo $viaje_id ?>">
						<input type="hidden" name="idPregunta" value="<?php echo $pregunta['id']; ?>">
						<input type="submit" class="BotonEliminarPregunta" value="Eliminar pregunta">
					</form>	<?php
				}
			}
		}	?>
	</div>
	<p class="p_titulo"> Hacer una pregunta </p>
	<div class="PreguntaViaje">
		<form action="php/agregarPreguntaBase.php" method="post">
			<input type="text" name="pregunta" class="EscribirUnaRespuesta" style="margin-top:3%;" placeholder="Escribe una pregunta" required/>
			<input type="hidden" name="idUsuario" value="<?php echo $usuarioID; ?>">
			<input type="hidden" name="idViaje" value="<?php echo $viaje_id ?>">
			<input type="submit" class="BotonEnviarRespuesta" value="Preguntar">
		</form>	
	</div>
</body>
</html>