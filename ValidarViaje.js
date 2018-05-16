function validarviaje(){
	var origen, destino, fecha, horapartida, minutospartida, duracionhoras, duracionmin, vehiculo, precio, texto;

	origen = document.getElementById("origen").value;
	destino = document.getElementById("destino").value;
	fecha = document.getElementById("fecha").value;
	horapartida = document.getElementById("horapartida").value;
	minutospartida = document.getElementById("minutospartida").value;
	duracionhoras = document.getElementById("duracionhoras").value;
	duracionmin = document.getElementById("duracionmin").value;
	vehiculo = document.getElementById("vehiculo").value;
	precio = document.getElementById("precio").value;
	texto = document.getElementById("texto").value;
	
	if(origen === "" || destino === "" || fecha === "" || horapartida === "" || minutospartida === "" || duracionhoras === "" || duracionmin === "" || vehiculo === "" || precio === "" || texto === ""){
		alert("Todos los campos son obligatorios");
		return false;		
	}
	else {
		return true;
	}

}