$(document).ready(function(){


	$(".expandir_orden").click(function(){

		$(this).closest(".orden").find(".tabla-productos").toggle();
		$(this).find(".fa-eye").toggle();
		$(this).find(".fa-eye-slash").toggle();

	});


	$(".finalizar_orden").click(function(){

		$("#finalizar_orden_dialog").addClass("active");
		$("#aceptar_finalizar_orden").attr("value", this.value);

	});

	$(".cerrar_finalizar_orden_dialog").click(function(){

		$("#finalizar_orden_dialog").removeClass("active");
		$("#aceptar_finalizar_orden").attr("value", "");

	});

	$("#aceptar_finalizar_orden").click(function(event){
	    event.preventDefault();
	    
	    $.post( 
	    /*url*/ _$_HOME_URL+"/orden/finalizar", 
	    /*data*/ {id_orden : $(this).val()})

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