<?php


                include_once "php/conection.php"; // conectar y seleccionar la base de datos

                $link = conectar();

?>
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