<?php
    include_once "php/conection.php"; // conectar y seleccionar la base de datos
    $link = conectar();
	include "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID, $admin);
?>
<html>
	<head>
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="css/Estilo5.css">
	<title> NombreUsuario </title>
	<meta charset="utf-8"/>
</head>
<body class="FondoPerfil">
	<?php
	include_once ("php/conection.php");
	include "Header.php";
	include "MenuBarra.php";
	?>
	<?php 
		try {
			$usuario -> iniciada($usuarioID);
			$id = $_GET['id'];
	?>
	<div class="CajaInformacionPersonal">
		<div class="UnConductorPasajero">
			Conductor
		</div>
		<table style="width:100%;text-align:center" class="FotoYNombre">
			<tr>
				<td>
					<div class="CantidadDeVotos">
						Viajes Realizados: 
						<?php
						$query= "SELECT COUNT(*) FROM viajes WHERE idConductor = $id AND (idEstado= 4 OR idEstado= 3) ";
						$result= mysqli_query ($link, $query) or die ('Consulta fallida ' .mysqli_error($link));
						$data = mysqli_fetch_array ($result);
						echo ($data[0]);
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="CantidadDeVotos">
						Votos positivos:
						<?php
						$query10= "SELECT COUNT(*) FROM calificacion WHERE idUsuarioCalificado = $id AND puntuacion= 1 AND rol= 'conductor' ";
						$result10= mysqli_query ($link, $query10) or die ('Consulta fallida ' .mysqli_error($link));
						$data10 = mysqli_fetch_array ($result10);
						echo ($data10[0]);
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="CantidadDeVotos">
						Votos negativos:
						<?php
						$query20= "SELECT COUNT(*) FROM calificacion WHERE idUsuarioCalificado = $id AND puntuacion= -1 AND rol= 'conductor' ";
						$result20= mysqli_query ($link, $query20) or die ('Consulta fallida ' .mysqli_error($link));
						$data20 = mysqli_fetch_array ($result20);
						echo ($data20[0]);
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="ComentariosConductor">
						<?php
						$query30= "SELECT * FROM calificacion WHERE idUsuarioCalificado = $id AND rol= 'conductor' ";
						$result30= mysqli_query ($link, $query30) or die ('Consulta fallida ' .mysqli_error($link));
						while ($comentario = mysqli_fetch_array ($result30)) {
						?>
							<div class="UnComentario">
								<div style="float:left;text-align:left;width:48%">
									<?php
									$id40= $comentario['idUsuarioAutor'];
									$query40= "SELECT * FROM usuarios WHERE id = $id40";
									$result40= mysqli_query ($link, $query40) or die ('Consulta fallida ' .mysqli_error($link));
									$usuarioAutor= mysqli_fetch_array ($result40);
									echo ($usuarioAutor['nombre'] . " " . $usuarioAutor['apellido'])
									?>
								</div>
								<div style="float:right;text-align:right;width:48%">
									<?php
									echo ($comentario['fecha'])
									?>
								</div>
								<span>
									<?php echo ($comentario['comentario']); ?>
									<span style="font-weight: bolder; color: LimeGreen " >
									<?php
										if ($comentario['puntuacion'] == 1) {
											echo ("+" . $comentario['puntuacion'] . " " );
										}
										else { ?>
									</span>
									<span style="font-weight: bolder; color: Red" >
										<?php echo ($comentario['puntuacion'] . " " ); } ?>
									</span>
								</span>
							</div>
						<?php
						}
						?>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="CajaInformacionPersonal">
		<div class="ImagenPerfil">
			<?php
			$query50= ("SELECT * FROM usuarios WHERE id= '$id'");
			$result50= mysqli_query ($link, $query50) or die ('Consulta fallida ' .mysqli_error($link));
			$usuario= mysqli_fetch_array ($result50);
			$imagenUsuario= $usuario['contenidoimagen'];
			if (!empty ($imagenUsuario)){
			?>
			<?php
			$class= 'class="LaImagenDePerfil"';
			echo "<img $class src= 'data:image/jpg; base64,".base64_encode($imagenUsuario). "'>";
			?>
			<?php
			} else {
			?>
			<img class="LaImagenDePerfil" src="Imagenes/anonimo2.jpg">
			<?php
			}
			?>
		</div>
		<table style="width:100%;text-align:center" class="FotoYNombre">
		<tr>
			<td>
				<div class="CantidadDeVotos">
				Nombre:
				<?php
					echo ($usuario['nombre']);
				?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
				Apellido:
				<?php
					echo ($usuario['apellido']);
				?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
				Nacimiento:
				<?php
					echo ($usuario['nacimiento']);
				?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<?php
					$consultaInformacionPersonal = "SELECT * FROM viajes v INNER JOIN postulaciones p 
					ON v.id=p.idViaje WHERE (v.idEstado=1 AND v.idConductor=$id AND p.idUsuario=$usuarioID AND p.idEstado=1) 
					OR (v.idEstado=1 AND v.idConductor=$usuarioID AND p.idUsuario=$id and p.idEstado=1)";
					$resultadoInfoPersonal = mysqli_query($link,$consultaInformacionPersonal);
					if (mysqli_num_rows($resultadoInfoPersonal) != 0 ){ ?>
						<div class="CantidadDeVotos">
							E-mail: 
							<?php	echo ($usuario['mail']);
					}?>
				</div>
			</td>
		</tr>
	</table>
</div>
<div class="CajaInformacionPersonal">
	<div class="UnConductorPasajero">
		Pasajero
	</div>
	<table style="width:100%;text-align:center" class="FotoYNombre">
		<tr>
			<td>
				<div class="CantidadDeVotos">
					Viajes Realizados:
					<?php
						$query= "SELECT COUNT(*) FROM postulaciones WHERE idUsuario= $id AND idEstado= 4";
						$result= mysqli_query ($link, $query) or die ('Consulta fallida ' .mysqli_error($link));
						$data = mysqli_fetch_array ($result);
						echo ($data[0]);
						?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
					Votos Positivos:
					<?php
						$query10= "SELECT COUNT(*) FROM calificacion WHERE idUsuarioCalificado = $id AND puntuacion= 1 AND rol= 'pasajero' ";
						$result10= mysqli_query ($link, $query10) or die ('Consulta fallida ' .mysqli_error($link));
						$data10 = mysqli_fetch_array ($result10);
						echo ($data10[0]);
					?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="CantidadDeVotos">
					Votos Negativos:
					<?php
						$query10= "SELECT COUNT(*) FROM calificacion WHERE idUsuarioCalificado = $id AND puntuacion= -1 AND rol= 'pasajero' ";
						$result10= mysqli_query ($link, $query10) or die ('Consulta fallida ' .mysqli_error($link));
						$data10 = mysqli_fetch_array ($result10);
						echo ($data10[0]);
					?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="ComentariosConductor">
						<?php
						$query30= "SELECT * FROM calificacion WHERE idUsuarioCalificado = $id AND rol= 'pasajero' ";
						$result30= mysqli_query ($link, $query30) or die ('Consulta fallida ' .mysqli_error($link));
						while ($comentario = mysqli_fetch_array ($result30)) {
						?>
							<div class="UnComentario">
								<div style="float:left;text-align:left;width:48%">
									<?php
									$id40= $comentario['idUsuarioAutor'];
									$query40= "SELECT * FROM usuarios WHERE id = $id40";
									$result40= mysqli_query ($link, $query40) or die ('Consulta fallida ' .mysqli_error($link));
									$usuarioAutor= mysqli_fetch_array ($result40);
									echo ($usuarioAutor['nombre'] . " " . $usuarioAutor['apellido'])
									?>
								</div>
								<div style="float:right;text-align:right;width:48%">
									<?php
									echo ($comentario['fecha'])
									?>
								</div>
								<span>
									<?php echo ($comentario['comentario']); ?>
									<span style="font-weight: bolder; color: LimeGreen " >
									<?php
										if ($comentario['puntuacion'] == 1) {
											echo ("+" . $comentario['puntuacion'] . " " );
										}
										else { ?>
									</span>
									<span style="font-weight: bolder; color: Red" >
										<?php echo ($comentario['puntuacion'] . " " ); } ?>
									</span>
								</span>
							</div>
						<?php
						}
						?>
				</div>
			</td>
		</tr>
	</table>
</div>
<div class="LineaPiePagina"></div>
</div>
	<?php	
	}
	catch (Exception $e) {
	?>
		<div class="noIniciada">
			<br><br>
			<p> Usted no ha iniciado sesion </p>
			<p> Por favor 
			<a href="Inicio_Sesion.php"> inicie sesion </a>
			o
			<a href="Bienvenida.php"> registrese </a>
			para ver este contenido
		</div>
	<?php
	}
	?>
</body>
</html>