$(document).ready(function(){

	$("#btn_guardar, #btn_actualizar, #btn_eliminar").click(function(event){
	    event.preventDefault();
	    $.post( 
	        /*url*/ _$_HOME_URL + "/clientes/"+$(this).val(), 
	        /*data*/ $("#form_cliente").serialize(),
	        /*success*/ function(data){

          var resultado = JSON.parse(data);
          if(resultado.estado === "ok"){
              $(location).attr('href', _$_HOME_URL);
          }else{
              alert(resultado.mensaje);
          }
	    });
	});


});