$(document).ready(function(){

  $("#eliminar_categoria").click(function(){
    $("#eliminar_categoria_dialog").addClass("active");
  });

  $(".cerrar_eliminar_categoria_dialog").click(function(){
    $("#eliminar_categoria_dialog").removeClass("active");
  });

	$("#btn_guardar, #btn_actualizar, #btn_eliminar").click(function(event){
	    event.preventDefault();

	    $.post( 
      /*url*/ _$_HOME_URL + "/categorias/"+$(this).val(), 
      /*data*/ $("#form_categoria").serialize())

      .done(function(data){
        alert(data);
        var resultado = JSON.parse(data);
        if(resultado.estado === "ok"){
            $(location).attr('href', _$_HOME_URL+"/categorias");
        }else{
            alert(resultado.mensaje);
        }
      })

      .fail( function(xhr, textStatus, errorThrown){
          alert(xhr.responseText);
      });

	});
  
});