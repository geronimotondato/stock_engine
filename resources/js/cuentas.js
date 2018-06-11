$(document).ready(function(){

	$(".cuenta-nombre").click(function(){
			var cuenta = $(this).closest(".cuenta");
			cuenta.find(".datos-cuenta").toggle();
			cuenta.find(".fa-angle-down").toggle();
			cuenta.find(".fa-angle-right").toggle();

	});

	$("#agregar-cuenta").click(function(){
			$(location).attr('href', _$_HOME_URL+"/cuentas/abm");
	});

});