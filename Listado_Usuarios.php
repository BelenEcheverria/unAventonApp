<head>
	<link rel="stylesheet" href="estilos.css">
	<title> Listado de usuarios </title>
</head>
<body class= "FondoInicio" >
	<?php
	include "Header.php";
	include "MenuBarra.php";
?>
<div style="width:100%;height:81%">
	<div class="Menu">
		<div class="CajaMenuBusqueda">
			<form class= "form_buscar_usuario" name= "buscarUsuario" action= "Listado_Usuarios.php" method= "get" >
				<label class="LabelFormularios"> Nombre </label>
				<input type="password" id="clave1" name="password" class="FormularioMenuBusqueda" value= "<?php if (isset($_GET['nombre'])) {echo ($_GET['nombre']);} ?>">
				<label class="LabelFormularios"> Apellido </label>
				<input type="password" id="clave1" name="password" class="FormularioMenuBusqueda" value= "<?php if (isset($_GET['apellido'])) {echo ($_GET['apellido']);} ?>">		
				<label class="LabelFormularios"> Ordenar por </label>
				<select class="FormularioMenuBusqueda" name="ordenar">
					<option value= ""> </option>
					<option value="nombre ASC" <?php if ((isset ($_GET['ordenar'])) and ($_GET['ordenar']== "nombre ASC")) {echo "selected";} ?>> Nombre ascendente </option> 
					<option value="nombre DESC" <?php if ((isset ($_GET['ordenar'])) and ($_GET['ordenar']== "nombre DESC")) {echo "selected";} ?>> Nombre descendente </option>
					<option value="apellido ASC" <?php if ((isset ($_GET['ordenar'])) and ($_GET['ordenar']== "apellido ASC")) {echo "selected";} ?>> Apellido ascendente </option> 
					<option value="apellido DESC" <?php if ((isset ($_GET['ordenar'])) and ($_GET['ordenar']== "apellido DESC")) {echo "selected";} ?>> Apellido descendente </option> 
				</select> <br><br><br>
				<div><input type="submit" class="BotonBuscar" value="Buscar"></div>
			</form>
		</div>
	</div>
</div>
	<div class= "div_body_usuarios">
		<div class= "div_listado_usuarios">
			<p class="p_titulo_listado" > Usuarios de unAventon </p>
			<?php
			include "php/buscarYordenar.php";
			buscar($apellido, $nombre);
			ordenar($ordenar);
			?>	
			<?php
			$parte2= " WHERE ";
			if ((isset($apellido)) and ($apellido != NULL)) {
				$parteA= "apellido " . "= '" . $apellido . "' AND ";
				$parte2= $parte2 . $parteA;
			}
			if ((isset($nombre)) and ($nombre != NULL)) {
				$parteN= "nombre " . "= '" . $nombre . "' AND ";
				$parte2= $parte2 . $parteN;
			}
			$parte2= $parte2 . "estaActivo= true AND ";
			if ((isset ($ordenar)) and ($ordenar!= NULL)) {
				$parteO= " ORDER BY " . $ordenar;
			} else {
				$parteO= "";
			}
			$parte1= "SELECT id, nombre, apellido FROM usuarios ";
			$parte2= $parte2 . "1=1" . $parteO;
			$queryFinal = $parte1 .$parte2 ;
			$result = mysqli_query ($link, $queryFinal) or die ('Consulta query fallida: ' .mysqli_error($link)); 
			$coincidencias= 0;
			while ($usuario = mysqli_fetch_array ($result)) {
				$coincidencias ++;				
			?>
				<div class= "div_nombre_usuario">
					<a href= "Perfil_Usuario.php?id=<?php echo $usuario['id']?>">
						<?php echo $usuario['nombre']?> <?php echo $usuario['apellido']?>
					</a> <br><br><br>
				</div>
			<?php
			} if ($coincidencias == 0) {
			?>
				<p> No se encontraron usuarios </p>
			<?php
			}
			?>
		</div>
	</div>
	<table class="TablaListadoUsuarios">
		<tr style="border-radius:8px">
			<td class="ImagenPerfilListado">
				Aca va la Imagen
			</td>
			<td class="NombreApellidoListado">
				Carlos Carlitos
			</td>
			<td class="ImagenPerfilListado">
				Aca va la Imagen
			</td>
			<td class="NombreApellidoListado">
				Carlos Carlitos
			</td>
			<td class="ImagenPerfilListado">
				Aca va la Imagen
			</td>
			<td class="NombreApellidoListado">
				Carlos Carlitos
			</td>
			<td class="ImagenPerfilListado">
				Aca va la Imagen
			</td>
			<td class="NombreApellidoListado">
				Carlos Carlitos
			</td>
		</tr>
		<tr>
			<td class="ImagenPerfilListado">
				Aca va la Imagen
			</td>
			<td class="NombreApellidoListado">
				Carlos Carlitos
			</td>
			<td class="ImagenPerfilListado">
				Aca va la Imagen
			</td>
			<td class="NombreApellidoListado">
				Carlos Carlitos
			</td>
			<td class="ImagenPerfilListado">
				Aca va la Imagen
			</td>
			<td class="NombreApellidoListado">
				Carlos Carlitos
			</td>
			<td class="ImagenPerfilListado">
				Aca va la Imagen
			</td>
			<td class="NombreApellidoListado">
				Carlos Carlitos
			</td>
		</tr>
	</table>
</body>
