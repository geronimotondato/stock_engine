$(document).ready(function(){

	$(".cliente-nombre").click(function(){
			var cliente = $(this).closest(".cliente");
			cliente.find(".datos-cliente").toggle();
			cliente.find(".fa-angle-down").toggle();
			cliente.find(".fa-angle-right").toggle();

	});

	$("#agregar-cliente").click(function(){
			$(location).attr('href', _$_HOME_URL+"/clientes/abm");
	});

});