$(document).ready(function(){

  $("#eliminar_almacen").click(function(){
    $("#eliminar_almacen_dialog").addClass("active");
  });

  $(".cerrar_eliminar_almacen_dialog").click(function(){
    $("#eliminar_almacen_dialog").removeClass("active");
  });

	$("#btn_guardar, #btn_actualizar, #btn_eliminar").click(function(event){
	    event.preventDefault();

	    $.post( 
      /*url*/ _$_HOME_URL + "/almacenes/"+$(this).val(), 
      /*data*/ $("#form_almacen").serialize())

      .done(function(data){
        var resultado = JSON.parse(data);
        if(resultado.estado === "ok"){
            $(location).attr('href', _$_HOME_URL+"/almacenes");
        }else{
            alert(resultado.mensaje);
        }
      })

      .fail( function(xhr, textStatus, errorThrown){
          alert(xhr.responseText);
      });

	});
  
});