$(document).ready(function(){

	$(".marca-nombre").click(function(){
			var marca = $(this).closest(".marca");
			marca.find(".datos-marca").toggle();
			marca.find(".fa-angle-down").toggle();
			marca.find(".fa-angle-right").toggle();

	});

	$("#agregar-marca").click(function(){
			$(location).attr('href', _$_HOME_URL+"/marcas/abm");
	});

});