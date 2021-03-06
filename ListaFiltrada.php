<?php
    include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include_once "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Inicio </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
	include "Header.php";
	include "MenuBarra.php";
$origen=$_POST['origen'];
$destino=$_POST['destino'];
$fechapedida=$_POST['fecha'];
?>
<div style="width:100%;height:81%;font-family: Arial;">
	<br>
	<div class="ParteViajes">
				<div class="ViajesInfoHorizontal">
						<table style=" height:60%;width:85%; margin-left:2%;font-weight: bold; color: white;">
							<tr >
							<td class="AlineacionViajesInfoHorizontal">Origen</td> 
							<td class="AlineacionViajesInfoHorizontal">Destino</td> 
							<td class="AlineacionViajesInfoHorizontal">Fecha</td> 
							<td class="AlineacionViajesInfoHorizontal">Hora</td>
							<td class="AlineacionViajesInfoHorizontal">Precio asiento</td>
							<td class="AlineacionViajesInfoHorizontal">Vehiculo</td> 
							<td class="AlineacionViajesInfoHorizontal">A.disponibles</td>
							</tr>
						</table>	
				<div>
		<?php 
		$fecha_actual = date('Y/m/d');
		$query= "SELECT * FROM viajes";
		$result = mysqli_query($link, $query);
		// cambiar el estado a los viajes pasados
		while ($viajes = mysqli_fetch_array($result)){ 
			$fecha_viaje = $viajes['fecha'];
			$dt = new DateTime($fecha_viaje);
			$fecha_viaje = ($dt->format('Y/m/d'));
			if ($fecha_actual > $fecha_viaje){
				$id_viaje_update= $viajes['id'];
				$queryUpdate = "UPDATE viajes SET idEstado=3 WHERE id= $id_viaje_update";
				$resultUpdate = mysqli_query($link, $queryUpdate);
				// agregar las calificaciones pendientes
				$conductor= $viajes['idConductor'];
				$queryPasajeros= "SELECT * FROM postulaciones WHERE idViaje= $id_viaje_update AND idEstado= 1";
				$resultPasajeros= mysqli_query($link, $queryPasajeros);
				while ($rowPasajeros = mysqli_fetch_array($resultPasajeros)){
					$pasajero= $rowPasajeros['idUsuario'];
					$query7= "INSERT INTO calificacionesPendientes (idUsuarioAutor, idUsuarioCalificado, idViaje) VALUES ($conductor, $pasajero, $id_viaje_update)";
					$result7= mysqli_query($link, $query7);
					$query8= "INSERT INTO calificacionesPendientes (idUsuarioAutor, idUsuarioCalificado, idViaje) VALUES ($pasajero, $conductor, $id_viaje_update)";
					$result8= mysqli_query($link, $query8);
					$id_postulacion_update = $rowPasajeros['id'];
					$query5= "UPDATE postulaciones SET idEstado=4 WHERE id= $id_postulacion_update";
					$result5= mysqli_query($link, $query5);
				}
			}
		}	
		$fecha = date('Y-m-d');
		$nuevafecha = strtotime ( '+30 day' ,strtotime($fecha));
		$nuevafecha = date( 'Y-m-d' , $nuevafecha);
		if(!empty($fechapedida)){
		    $sql= "SELECT * FROM viajes WHERE idEstado=1 AND idOrigen=$origen AND idDestino=$destino AND DATE(fecha)='$fechapedida' ORDER BY horaPartida ASC";
		}
		else{
			$sql= "SELECT * FROM viajes WHERE idEstado=1 AND idOrigen=$origen AND idDestino=$destino ORDER BY fecha, horaPartida ASC";
		}
		$result = mysqli_query($link, $sql); //traer los viajes vector de vectores
	   	if($result){
	   		$cantidad_viajes = mysqli_num_rows($result);
	   	} //Obtener la cantidad total de viajes
	   	if ($cantidad_viajes !=0){
				   	$tamaño_paginas = 7;
				   	if(isset($_GET["pagina"])){
				   		$pagina=$_GET["pagina"];
				   	}
				   	else{	
				   		$pagina = 1;
					}
				   	$empezar_desde =($pagina-1)*$tamaño_paginas;
				   	$total_paginas = ceil($cantidad_viajes/$tamaño_paginas);
				   	$sql_limite = mysqli_query($link, $sql . " LIMIT $empezar_desde,$tamaño_paginas");
				   	?>
					<tr>
					<div class="ListadoViajes">
					    <?php
						while ($viajes = mysqli_fetch_array($sql_limite)){
							if ( $viajes['fecha']<= $nuevafecha) {
								$id_viaje = $viajes['id'];
								$id_Destino = $viajes['idDestino'];
								$id_Origen = $viajes['idOrigen'];
								$id_Vehiculo = $viajes['idVehiculo'];
								$dia = $viajes['fecha'];
								$horaPartida = $viajes['horaPartida'];
								$precio= $viajes['precio'];
								$conductor_id = $viajes['idConductor'];

								/*---------------AGREGO QUE MUESTRE El Destino---------------*/
								$consultaDestino = "SELECT * FROM ciudades where id=$id_Destino";
								$resultadoConsultaDest = mysqli_query($link,$consultaDestino);
								$rowCiudadDest = mysqli_fetch_array($resultadoConsultaDest);
								$destinoViaje = $rowCiudadDest['ciudad'];

								//---------------AGREGO QUE MUESTRE El Origen---------------
								$consultaOrigen = "SELECT * FROM ciudades where id=$id_Origen";
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
								<div class="ListadoViajes">
									<table style="width:80%; margin-left:2%;">
										<tr>
										<td class="AlineacionCajasListaViajesHorizontal"><?php echo utf8_encode($origenViaje);?></td> 
										<td class="AlineacionCajasListaViajesHorizontal"><?php echo utf8_encode($destinoViaje);?></td> 
										<td class="AlineacionCajasListaViajesHorizontal"><?php echo utf8_encode($dia);?></td> 
										<td class="AlineacionCajasListaViajesHorizontal"><?php echo substr($horaPartida,0,5);?></td>
										<td class="AlineacionCajasListaViajesHorizontal">$<?php echo utf8_encode((round($precio/$asientosDisponibles)));?></td>
										<td class="AlineacionCajasListaViajesHorizontal"><?php echo utf8_encode($vehiculoViaje);?></td> 
										<td class="AlineacionCajasListaViajesHorizontal"><?php echo utf8_encode($asientosDisponibles-1);?></td> 
										</tr>
										
									<div class="BotonReservarAsiento">
										<?php
										if ( $conductor_id == $usuarioID )
										{ ?>
										<a href="2. MiViaje.php?id=<?php echo $id_viaje; ?>"> Ver viaje </a>
									<?php } else { ?>
										<a href="verviaje.php?id_viaje=<?php echo $id_viaje ?>"> Ver viaje </a>
									<?php } ?>
									</div>
								</table>
							    </div>
							<?php } }?>
						</tr>	<?php
					} //fin cantidad
					else{
							header('Location: Listaerror.php');
					}?>
	</div>
</div>
	 <footer>
   		<div class="paginado">	
   			<?php
   			mysqli_free_result($result);
   	    	for($i=1; $i<=$total_paginas; $i++){ ?>
   			 	<?php echo "<a href=?pagina=". $i . ">" . $i . "</a>";?>
 			<?php
 		 	}
 		 	?>		
 		</div>
 	</div>
 	</footer>
</body>
</html>