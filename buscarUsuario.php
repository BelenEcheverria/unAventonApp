<?php
	include_once ("php/conection.php"); // conectar y seleccionar la base de datos
	$link = conectar();
	include "php/classLogin.php";
    $usuario= new usuario();
    $usuario -> session ($usuarioID, $admin);
?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<link rel="stylesheet" href="css/Estilo5.css">
<title> Eliminar Vehiculo </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
	include "Header.php";
	include "MenuBarra.php";
	try {
		$usuario -> iniciada($usuarioID);
		$id= $_SESSION['id'];
	?>
<br>
<p style="color: white;text-align:center;font-family:Arial;font-weight:750;">
<?php
		if (isset ($_GET['mensajeEditar'])){
			$mensaje = $_GET['mensajeEditar'];
			echo $mensaje;
		}
		?>
</p>		
<div class= "registrar">
<h1 style="color:white;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Buscar Usuario </h1> 
<form method="POST" class="input" onsubmit="return validar()">
	<select class="FormularioVehiculos" name="idUsuario" value="<?php echo $fila['id'] ?>">
                <?php
                  $consulta = "SELECT * FROM usuarios WHERE estaActivo = 1"; 
                  $result = mysqli_query($link,$consulta); ?>
                  <option value= ""> Elige un Usuario </option> <?php              
                  while($fila = mysqli_fetch_array($result)){?>
					 <option value="<?php echo $fila['id']?>"> <?php echo $fila['nombre']; echo ' '; echo $fila['apellido'];?> </option>;
				<?php	 
                  }
                ?>
          </select>
	<div><input type="submit"  formaction="verPerfilUsuario.php?id=<?php echo $id ?>" class="BotonVehiculos" value="Buscar"></div>
</form>
</div>
<?php	
	}
	catch (Exception $e) {
	?>
		<div class="noIniciada">
			<br><br>
			<p> Usted no ha iniciado sesión </p>
			<p> Por favor 
			<a href="Inicio_Sesion.php"> inicie sesión </a>
			o
			<a href="Bienvenida.php"> registrese </a>
			para ver este contenido
		</div>
	<?php
	}
	?>
</body>
</html>