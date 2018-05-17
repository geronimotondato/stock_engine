$(document).ready(function(){

	$(".cliente-nombre").click(function(){
			var cliente = $(this).closest(".cliente");
			cliente.find(".datos-cliente").toggle();
			cliente.find(".fa-angle-down").toggle();
			cliente.find(".fa-angle-right").toggle();

	});

});