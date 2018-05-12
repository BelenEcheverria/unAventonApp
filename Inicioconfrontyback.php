<?php
    include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Inicio </title>
<meta charset="utf-8"/>
</head>
<?php
	include "Header.php";
	include "MenuBarra.php";
?>
<body background="Imagenes/FondoColores.jpg">
	<?php
	$sql= "SELECT v.id,v.fecha,v.hora,v.minuto,v.duracionhoras,v.duracionminutos,v.precio,v.texto,v.idEstado,v.idOrigen,v.idDestino,v.idVehiculo,v.idConductor FROM viajes v INNER JOIN ciudades c1 c2 ON ((c1.id=v.idOrigen)&(c2.id=v.vidDestino))"
	$result = mysqli_query($link, $sql); //traer los viajes
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
   	}
   	?>
   	<div class="listaPeliculas"> <?php  		 
   	 	while($row = mysqli_fetch_array($sql_limite)){ 
	   	  $id = $row['id'];
	   	 	$contenidoimagen = $row['contenidoimagen'];
	   	 	$tipoimagen = $row['tipoimagen']; 
	   	 	$id_genero = $row['generos_id'];
	   	  ?>
			<div class="viaje">
					<div class= "titulo">
			   		<?php echo "<a href=verviaje.php?id=" . $id . ">" ?>
					<p><?php echo utf8_encode($row['nombre']) ?></p>
				  </div>
					<a>
						<?php
						echo "<a href=Movie.php?id=" . $id . ">";    
						echo "<img src = 'data:image/jpeg; base64," .base64_encode($contenidoimagen) . "'>"; ?>	
					</a>


					<p><?php echo utf8_encode($row['sinopsis']);?></p>
					
					<p><?php echo "Año: " . utf8_encode($row['anio']);?></p>
					<?php
					//---------------AGREGO QUE MUESTRE EL GENERO---------------//
					$consulta = "SELECT * FROM generos where id=$id_genero";
					$resultadoConsulta = mysqli_query($link,$consulta);
					$rowGenero = mysqli_fetch_array($resultadoConsulta);
					$genero_peli = $rowGenero['genero']?>
					<p><?php echo "Genero: " . utf8_encode($genero_peli);?></p>
				</div><?php 
					
		}?> 
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
</body>
</html>