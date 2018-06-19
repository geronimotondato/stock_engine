$(document).ready(function(){



  $("#eliminar_cuenta").click(function(){
    $("#eliminar_cuenta_dialog").addClass("active");
  });

  $(".cerrar_eliminar_cuenta_dialog").click(function(){
    $("#eliminar_cuenta_dialog").removeClass("active");
  });

  if ((saldo = $("#saldo")).val() < 0){
    saldo.addClass("is-error");
  }else{
    saldo.addClass("is-success");
  }


	$("#btn_guardar, #btn_actualizar, #btn_eliminar").click(function(event){
	    event.preventDefault();

	    $.post( 
      /*url*/ _$_HOME_URL + "/cuentas/"+$(this).val(), 
      /*data*/ $("#form_cuenta").serialize())

      .done(function(data){
        alert(data);
        var resultado = JSON.parse(data);
        if(resultado.estado === "ok"){
            $(location).attr('href', _$_HOME_URL+"/cuentas");
        }else{
            alert(resultado.mensaje);
        }
      })

      .fail( function(xhr, textStatus, errorThrown){
          alert(xhr.responseText);
      });


	});
});