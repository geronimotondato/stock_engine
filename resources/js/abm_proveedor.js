$(document).ready(function(){



  $("#eliminar_proveedor").click(function(){
    $("#eliminar_proveedor_dialog").addClass("active");
  });

  $(".cerrar_eliminar_proveedor_dialog").click(function(){
    $("#eliminar_proveedor_dialog").removeClass("active");
  });

  if ((saldo = $("#saldo")).val() < 0){
    saldo.addClass("is-error");
  }else{
    saldo.addClass("is-success");
  }


	$("#btn_guardar, #btn_actualizar, #btn_eliminar").click(function(event){
	    event.preventDefault();

	    $.post( 
      /*url*/ _$_HOME_URL + "/proveedores/"+$(this).val(), 
      /*data*/ $("#form_proveedor").serialize())

      .done(function(data){
        alert(data);
        var resultado = JSON.parse(data);
        if(resultado.estado === "ok"){
            $(location).attr('href', _$_HOME_URL+"/proveedores");
        }else{
            alert(resultado.mensaje);
        }
      })

      .fail( function(xhr, textStatus, errorThrown){
          alert(xhr.responseText);
      });


	});
});