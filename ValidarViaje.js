//escucha lo que pasa en window cuando se carga.
function cambioTipoDeViaje(){
	const kind = document.getElementById("travelKindSelect");
	kind.addEventListener("change", function(e){
		var tipoDeViajeSeleccionado = e.target.value
		if (tipoDeViajeSeleccionado == "1") {
			var viajePeriodico = document.getElementById("viajePeriodico");
			var viajeOcasional = document.getElementById("viajeOcasional");	
			$("#viajePeriodico").fadeTo("slow", 0);
			$("#viajeOcasional").fadeTo("slow", 1);
			console.log(viajeOcasional);
		}
		if (tipoDeViajeSeleccionado == "2") {
			var viajeOcasional = document.getElementById("viajeOcasional");
			var viajePeriodico = document.getElementById("viajePeriodico");
			$("#viajeOcasional").fadeTo("slow", 0);
			$("#viajePeriodico").fadeTo("slow", 1);
			console.log(viajePeriodico);
		}
	})
    $('.js-example-basic-multiple').select2();
}
//La funcion, crea una variable que obtiene el valor del tipo de viaje deseado  e-->hace referencia al evento que se ejecutó

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

window.addEventListener("load", cambioTipoDeViaje);

