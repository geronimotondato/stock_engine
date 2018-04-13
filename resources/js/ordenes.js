addLoadEvent(function() {


	document.querySelectorAll(".finalizar_orden").forEach(function(element){

		element.addEventListener("click", function() {

			document.getElementById("finalizar_orden_dialog").classList.add("active");
			document.getElementById("aceptar_finalizar_orden").value = element.value;

		});

	});


	document.querySelectorAll(".cerrar_finalizar_orden_dialog").forEach( function(element){

		element.addEventListener("click", function() {

			document.getElementById("finalizar_orden_dialog").classList.remove("active");
			document.getElementById("aceptar_finalizar_orden").value = "";

		});
	});

});