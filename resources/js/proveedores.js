$(document).ready(function(){

	$(".proveedor-nombre").click(function(){
			var proveedor = $(this).closest(".proveedor");
			proveedor.find(".datos-proveedor").toggle();
			proveedor.find(".fa-angle-down").toggle();
			proveedor.find(".fa-angle-right").toggle();

	});

	$("#agregar-proveedor").click(function(){
			$(location).attr('href', _$_HOME_URL+"/proveedores/abm");
	});

});