$(document).ready(function(){

	$(".almacen-nombre").click(function(){
			var almacen = $(this).closest(".almacen");
			almacen.find(".datos-almacen").toggle();
			almacen.find(".fa-angle-down").toggle();
			almacen.find(".fa-angle-right").toggle();

	});

	$("#agregar-almacen").click(function(){
			$(location).attr('href', _$_HOME_URL+"/almacenes/abm_almacen");
	});

});