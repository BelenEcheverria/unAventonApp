<html>
<head>
<link rel="stylesheet" href="estilos.css">
<title> Nuevo Viaje Ocasional </title>
<meta charset="utf-8"/>
</head>
<body>
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
  <input type="select" id="clave1" name="password" class="FormularioRegistrarse" placeholder="Contraseņa...">
  <label class="LabelFormularios"> Precio </label>
  <input type="number" id="clave2" name="password2" class="FormularioRegistrarse" placeholder="Repetir Contraseņa...">
  <div><input type="submit" class="BotonRegistrar" value="Agregar"></div>
</form>
</div>
</body>
</html>