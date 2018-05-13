function esAlfanumerico(str){ 
	return /^[a-zA-Z0-9]+$/.test(str);
}
function validarInicioSesion(){
	var valorNombre = document.inicioSesion.nombreU.value;
	var valorPassword = document.inicioSesion.contraU.value;
	if(valorNombre.length >= 1 && valorPassword.length >= 1){
		document.inicioSesion.submit();
	}else{
		alert('Por favor complete ambos campos antes de continuar')
	}
}