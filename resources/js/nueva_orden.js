addLoadEvent(function(){

	document.getElementById("selector_de_productos").addEventListener("change", function(){
		document.getElementById("modal_producto").classList.add("active");
	});

	document.getElementById("cerrar_modal_producto").addEventListener("click", function(){
		document.getElementById("modal_producto").classList.remove("active");
		var options = document.querySelectorAll('#selector_de_productos option');
		for (var i = 0, l = options.length; i < l; i++) {
  			options[i].selected = options[i].defaultSelected;
		}
	});

});