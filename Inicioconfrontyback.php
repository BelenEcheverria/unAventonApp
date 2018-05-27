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
<div style="width:100%;height:81%">
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
		<?php $sql= "SELECT v.id,v.fecha,v.hora,v.minuto,v.duracionhoras,v.duracionminutos,v.precio,v.texto,v.idEstado,v.idOrigen,v.idDestino,v.idVehiculo,v.idConductor FROM viajes v";
		$result = mysqli_query($link, $sql); //traer los viajes
		echo "$result";
	   	$tamaño_paginas = 10;
	   	if(isset($_GET["pagina"])){
	   		$pagina=$_GET["pagina"];
	   	}
	   	else{	
	   		$pagina = 1;
		 }
	   	$empezar_desde =($pagina-1)*$tamaño_paginas;
	   	if($result){
	   		$cantidad_viajes = mysqli_num_rows($result);
	   	} //Obtener la cantidad todal de viajes
	   	$total_paginas = ceil($cantidad_viajes/$tamaño_paginas);
	   	if(isset($_GET['genero']) && $_GET['genero'] != ""){
	   			  $sql2 = $sql." LIMIT $empezar_desde,$tamaño_paginas";
	   		   	$sql_limite = mysqli_query($link, $sql2);
	   			//traigo solo la cantidad que quiero
	   	}
	   	else{
	   		$sql_limite = mysqli_query($link, $sql . " LIMIT $empezar_desde,$tamaño_paginas");
	   	}?>
		<table style="width:80%; margin-left:2%;">
			<tr>
		    <?php
			while($row = mysqli_fetch_array($sql_limite)){ 
					$id_Destino = $row['idDestino']:
					$id_Origen = $row['idOrigen'];
					$id_Vehiculo = $row['idVehiculo'];
					$dia = $row['fecha'];
					$horaPartida = $row['duracionHoras'];
					$minutosPartida = $row['duracionMinutos'];

					/*---------------AGREGO QUE MUESTRE El Destino---------------*/
					$consultaDestino = "SELECT * FROM ciudades where id=$id_Destino";
					$resultadoConsultaDest = mysqli_query($link,$consultaDestino);
					$rowCiudadDest = mysqli_fetch_array($resultadoConsultaDest);
					$destinoViaje = $rowCiudadDest['ciudad']

					//---------------AGREGO QUE MUESTRE El Origen---------------
					$consultaOrigen = "SELECT * FROM ciudades where id=$id_Origen";
					$resultadoConsulta = mysqli_query($link,$consultaOrigen);
					$rowCiudad = mysqli_fetch_array($resultadoConsulta);
					$origenViaje = $rowCiudad['ciudad']

					//---------------AGREGO QUE MUESTRE Los asientos del vehiculo---------------
					$consultaVehiculo = "SELECT * FROM ciudades where id=$id_Vehiculo";
					$resultadoConsultaVehiculo = mysqli_query($link,$consultaVehiculo);
					$rowVehiculo = mysqli_fetch_array($resultadoConsultaVehiculo);
					$vehiculoViaje = $rowVehiculo['modelo'];
					$asientosDisponibles = $rowVehiculo['asientos'];
					?>

					<td class="AlineacionViajesInfoHorizontal"><?php echo utf8_encode($origenViaje);?></td> //Origen
					<td class="AlineacionViajesInfoHorizontal"><?php echo utf8_encode($destinoViaje);?></td> //Destino
					<td class="AlineacionViajesInfoHorizontal"><?php echo utf8_encode($row[$fecha]);?></td> //Dia
					<td class="AlineacionViajesInfoHorizontal"><?php echo utf8_encode($horaPartida); 
					echo utf8_encode($minutosPartida);?></td> //Hora
					<td class="AlineacionViajesInfoHorizontal"><?php echo utf8_encode($vehiculoViaje);?></td> //Vehiculo
					<td class="AlineacionViajesInfoHorizontal"><?php echo utf8_encode($asientosDisponibles);?></td> //Asientos
				<?php } ?>
			</tr>
		</table>
		

		<div class="ViajesInfoHorizontal">
		</div>
		<?php
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
			include "unViaje.php";
		?>
	</div>
	 <footer>
   		<div class="paginado">	
   			<?php
   			mysqli_free_result($result);
   	    	for($i=1; $i<=$total_paginas; $i++){ ?>
   			 	<?php echo "<a href=?pagina=" . $i . "&nombre_peli=" . $filtro_nombre . "&genero=" . $filtro_genero . "&orden=" . $orden . "&anio=" . $filtro_anio . ">" . $i . " </a> ";?>
 			<?php
 		 	}
 		 	?>		
 		</div>
 	</footer>
</div>
<div class="LineaPiePagina"></div>
</body>
</html>
<!--
Cuando creamos o accedemos al contenido de variables de sesión debemos llamar a la función session_start() antes de cualquier salida de etiquetas HTML, copiar:
	include_once "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
Tengamos en cuenta que en cualquier otra página del sitio tenemos acceso a las variables de sesión sólo con llamar inicialmente a la función session_start().
-->
