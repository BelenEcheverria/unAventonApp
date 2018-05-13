function validarviaje(){
	var origen, destino, dia, hora, vehiculo, precio;

	origen = document.getElementById("origen").value;
	destino = document.getElementById("destino").value;
	dia = document.getElementById("dia").value;
	hora = document.getElementById("hora").value;
	vehiculo = document.getElementById("vehiculo").value;
	precio = document.getElementById("precio").value;
	
	if(origen === "" || destino === "" || dia === "" || hora === "" || vehiculo === "" || precio === ""){
		alert("Todos los campos son obligatorios");
		return false;		
	}
	else {
		return true;
	}

}