<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Registrar </title>
<meta charset="utf-8"/>
</head>
<body>
<?php
include_once ("php/conection.php");
?>
<div class= "registrar">
<h1 style="color: black;text-align:center;font-family:Arial;font-weight:750;text-shadow:5px 5px 5px #aaa;"> Informacion Personal </h1> 
<form method="POST" action="crearcuenta.php" class="input" onsubmit="return validar()">
  <label class="LabelFormularios"> Nombre </label>
  <input type="text" id="nombre" name="nombre" class="FormularioRegistrarse" placeholder="Nombre...">
  <label class="LabelFormularios"> Apellido </label>
  <input type="text" id="apellido" name="apellido" class="FormularioRegistrarse" placeholder="Apellido...">
  <label class="LabelFormularios"> Nombre de usuario </label>
  <input type="text" id="nombreusuario" name="nombreusuario" class="FormularioRegistrarse" placeholder="Usuario...">
  <label class="LabelFormularios"> Mail </label>
  <input type="text" id="email" name="email" class="FormularioRegistrarse"  placeholder="E-Mail...">
  <label class="LabelFormularios"> Contraseña </label>
  <input type="password" id="clave1" name="password" class="FormularioRegistrarse" placeholder="Contraseña...">
  <label class="LabelFormularios"> Repetir contraseña </label>
  <input type="password" id="clave2" name="password2" class="FormularioRegistrarse" placeholder="Repetir Contraseña...">
  <div><input type="submit" class="BotonRegistrar" value="Editar"></div>
</form>
</div>
</body>
</html>