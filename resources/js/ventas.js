$(document).ready(function(){


	$(".expandir_venta").click(function(){

		$(this).closest(".venta").find(".tabla-productos").toggle();
		$(this).find(".fa-eye").toggle();
		$(this).find(".fa-eye-slash").toggle();

	});


	$(".finalizar_venta").click(function(){

		$("#finalizar_venta_dialog").addClass("active");
		$("#aceptar_finalizar_venta").attr("value", this.value);

	});

	$(".cerrar_finalizar_venta_dialog").click(function(){

		$("#finalizar_venta_dialog").removeClass("active");
		$("#aceptar_finalizar_venta").attr("value", "");

	});

	$("#aceptar_finalizar_venta").click(function(event){
	    event.preventDefault();
	    
	    $.post( 
	    /*url*/ _$_HOME_URL+"/ventas/finalizar", 
	    /*data*/ {id_venta : $(this).val()})

	    .done(function(data){
			var resultado = JSON.parse(data);
			if(resultado.estado === "ok"){
			  $(location).attr('href', _$_HOME_URL);
			}else{
			  alert(resultado.mensaje);
			}
	    })

	    .fail( function(xhr, textStatus, errorThrown){
	        alert(xhr.responseText);
	    });
	});

});