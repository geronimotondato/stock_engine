$(document).ready(function(){

  $("#eliminar_marca").click(function(){
    $("#eliminar_marca_dialog").addClass("active");
  });

  $(".cerrar_eliminar_marca_dialog").click(function(){
    $("#eliminar_marca_dialog").removeClass("active");
  });

	$("#btn_guardar, #btn_actualizar, #btn_eliminar").click(function(event){
	    event.preventDefault();

	    $.post( 
      /*url*/ _$_HOME_URL + "/marcas/"+$(this).val(), 
      /*data*/ $("#form_marca").serialize())

      .done(function(data){
        alert(data);
        var resultado = JSON.parse(data);
        if(resultado.estado === "ok"){
            $(location).attr('href', _$_HOME_URL+"/marcas");
        }else{
            alert(resultado.mensaje);
        }
      })

      .fail( function(xhr, textStatus, errorThrown){
          alert(xhr.responseText);
      });

	});
  
});