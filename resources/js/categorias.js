$(document).ready(function(){

	$(".categoria-nombre").click(function(){
			var categoria = $(this).closest(".categoria");
			categoria.find(".datos-categoria").toggle();
			categoria.find(".fa-angle-down").toggle();
			categoria.find(".fa-angle-right").toggle();

	});

	$("#agregar-categoria").click(function(){
			$(location).attr('href', _$_HOME_URL+"/categorias/abm");
	});

});