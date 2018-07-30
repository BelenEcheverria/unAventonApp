
<div class="menuBarra">
		<ul>
			<li><a href="Inicio.php">Inicio</a></li>
			<li><a href="PublicarViaje.php">Publicar</a></li>
			<li><a href="#">Vehiculos</a>
				<ul>
					<li><a href="MisVehiculos.php">Mis vehiculos</a></li>
					<li><a href="AgregarVehiculo.php">Agregar</a></li>
					<li><a href="ListaModificarVehiculos.php?id=<?php echo $usuarioID ?> "> Modificar vehiculo </a></li>
					<li><a href="EliminarVehiculo.php">Eliminar</a></li>
				</ul>
			</li>
			<li><a href="verPerfilUsuario.php?id=<?php echo $usuarioID ?> "> Mi Perfil</a></li>
			<li><a href="EditarMisDatos.php?id=<?php echo $usuarioID ?> "> Editar Perfil</a></li>
			<li><a href="2. MisViajes.php?id=<?php echo $usuarioID ?> "> Mis viajes </a></li>
			<li><a href="3. CalificacionesPendientes.php "> Calificar </a></li>
			<li><a href="3. PagosPendientes.php "> Pagar </a></li>
			<li><a href="EliminarCuenta.php">Eliminar cuenta</a></li>
		</ul>
	</div>