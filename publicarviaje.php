<?php

<<<<<<< HEAD
                include_once "php/conection.php"; // conectar y seleccionar la base de datos
=======
                include_once ("php/conection.php"); // conectar y seleccionar la base de datos
>>>>>>> 2f0327af698cdb4ae7e3d8b1373fdc0c2051c223

                $link = conectar();

?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Nuevo Viaje Ocasional </title>
<meta charset="utf-8"/>
</head>
<body class="FondoInicio">
<?php
include "Header.php";
?>
<div class= "registrar">
<form method="POST" action="crearcuenta.php" class="input" onsubmit="return validar()">
  <label class="LabelFormularios"> Origen </label>
  <input type="text" id="nombre" name="nombre" class="FormularioRegistrarse" placeholder="Nombre...">
  <label class="LabelFormularios"> Destino </label>
  <input type="text" id="apellido" name="apellido" class="FormularioRegistrarse" placeholder="Apellido...">
  <label class="LabelFormularios"> Dia </label>
  <input type="date" id="nombreusuario" name="nombreusuario" class="FormularioRegistrarse" placeholder="Usuario...">
  <label class="LabelFormularios"> Hora </label>
  <input type="time" id="email" name="email" class="FormularioRegistrarse"  placeholder="E-Mail...">
  <label class="LabelFormularios"> Vehiculo </label>
  <input type="select" id="clave1" name="password" class="FormularioRegistrarse" placeholder="Contraseña...">
  <label class="LabelFormularios"> Precio </label>
  <input type="number" id="clave2" name="password2" class="FormularioRegistrarse" placeholder="Repetir Contraseña...">
  <div><input type="submit" class="BotonRegistrar" value="Agregar"></div>
</form>
</div>
<div class="LineaPiePagina"></div>
</body>
</html>

