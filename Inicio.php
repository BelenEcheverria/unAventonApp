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
?>
<div style="width:100%;height:81%;font-family: Arial;">
	<div class="Menu">
		<div class="CajaMenuBusqueda">
			<form method="POST" style="margin-top:15px"action="crearcuenta.php" class="input" onsubmit="return validar()">
				<label class="LabelFormularios"> Origen </label>
				<input type="password" id="clave1" name="password" class="FormularioMenuBusqueda" placeholder="Ingresa desde dónde viajas">
				<label class="LabelFormularios"> Destino </label>
				<input type="password" id="clave2" name="password2" class="FormularioMenuBusqueda" placeholder="Ingresa hacia dónde viajas">
				<label class="LabelFormularios"> Fecha </label>
				<input type="date" class="FormularioMenuBusqueda" name="fecha">
				<div><input type="submit" class="BotonBuscar" value="Buscar"></div>
			</form>
		</div>
	</div>

	<div class="ParteViajes">
				<div class="ViajesInfoHorizontal">
						<table style="width:85%; margin-left:2%;">
							<tr>
							<td class="AlineacionViajesInfoHorizontal">Origen</td> 
							<td class="AlineacionViajesInfoHorizontal">Destino</td> 
							<td class="AlineacionViajesInfoHorizontal">Fecha</td> 
							<td class="AlineacionViajesInfoHorizontal">Hora</td>
							<td class="AlineacionViajesInfoHorizontal">Precio</td>
							<td class="AlineacionViajesInfoHorizontal">Vehiculo</td> 
							<td class="AlineacionViajesInfoHorizontal">A.disponibles</td>
							</tr>
						</table>	
				<div>
		<?php 
		$sql= "SELECT * FROM viajes where idEstado=1";
		$result = mysqli_query($link, $sql); //traer los viajes vector de vectores
	   	if($result){
	   		$cantidad_viajes = mysqli_num_rows($result);
	   	} //Obtener la cantidad todal de viajes
	   	$tamaño_paginas = 8;
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
			while($viajes = mysqli_fetch_array($sql_limite)){ 
					$id_viaje = $viajes['id'];
					$id_Destino = $viajes['idDestino'];
					$id_Origen = $viajes['idOrigen'];
					$id_Vehiculo = $viajes['idVehiculo'];
					$dia = $viajes['fecha'];
					$horaPartida = $viajes['hora'];
					$minutosPartida = $viajes['minuto'];
					$precio= $viajes['precio'];

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
							<td class="AlineacionCajasListaViajesHorizontal"><?php echo utf8_encode($horaPartida);?>:<?php
							echo utf8_encode($minutosPartida);?></td>
							<td class="AlineacionCajasListaViajesHorizontal"><?php echo utf8_encode($precio);?></td>
							<td class="AlineacionCajasListaViajesHorizontal"><?php echo utf8_encode($vehiculoViaje);?></td> 
							<td class="AlineacionCajasListaViajesHorizontal"><?php echo utf8_encode($asientosDisponibles);?></td> 
							</tr>
						<div class="BotonReservarAsiento">
							<?php echo "<a href=/unAventon/VerViaje.php?id_viaje=" . $id_viaje . ">" . "Ver viaje" . "</a>";?>
						</div>
					</table>
				    </div>
				<?php } ?>
			</tr>	
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
<!--
Cuando creamos o accedemos al contenido de variables de sesión debemos llamar a la función session_start() antes de cualquier salida de etiquetas HTML, copiar:
	include_once "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
Tengamos en cuenta que en cualquier otra página del sitio tenemos acceso a las variables de sesión sólo con llamar inicialmente a la función session_start().
-->
