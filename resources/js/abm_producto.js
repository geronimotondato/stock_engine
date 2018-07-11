$(document).ready(function(){


	/*SELECTOR DE marcas */
	$("#marca_nombre").click(function(){
	    $("#seleccionador1").trigger('desplegar');
	});

	$("#seleccionador1").each(function(index,object){

	    $(object).bind('desplegar', function() {
	        $(".modal", object).addClass("active");
	        $("#s-buscador", object).focus();
	    });

	    var limpiar = function(){
	        $("#s-buscador",object).val("");
	        $(".menu",object).empty();
	        $(".modal",object).removeClass("active");
	    }

	    $(".modal-overlay", object).click(function(){
	        limpiar();
	    });

	    $("#s-cerrar", object).click(function(){
	        limpiar();
	    });

	  $("#s-buscador",object).keyup($.debounce(250, function(event) {

	    event.preventDefault();
	    $.post( 
	    /*url*/ _$_HOME_URL+"/marcas/buscar_elemento_ajax", 
	    /*data*/ $("#s-buscador", object).serialize())

	    .done(function(data){

	        var resultado = JSON.parse(data);

	        $(".menu",object).empty();

	        resultado.map(function(elemento){
	         
	          var item = $.parseHTML("<li class='menu-item' data-s-id="+elemento.id_marca+"><a><div>"+elemento.nombre+"</div></a></li>");
	          $(item).click(function(){
	            $("#id_marca").attr("value", $(this).attr("data-s-id"));
	            $("#marca_nombre").attr("value", $("a", this).text());
	            limpiar();
	          });
	          $(".menu", object).append(item);

	        });
	    })

	    .fail( function(xhr, textStatus, errorThrown){
	        alert(xhr.responseText);
	    });

	  }));


	}); /* FIN */


	/*SELECTOR DE CATEGORIAS */
	$("#categoria_nombre").click(function(){
	    $("#seleccionador2").trigger('desplegar');
	});

	$("#seleccionador2").each(function(index,object){

	    $(object).bind('desplegar', function() {
	        $(".modal", object).addClass("active");
	        $("#s-buscador", object).focus();
	    });

	    var limpiar = function(){
	        $("#s-buscador",object).val("");
	        $(".menu",object).empty();
	        $(".modal",object).removeClass("active");
	    }

	    $(".modal-overlay", object).click(function(){
	        limpiar();
	    });

	    $("#s-cerrar", object).click(function(){
	        limpiar();
	    });

	  $("#s-buscador",object).keyup($.debounce(250, function(event) {

	    event.preventDefault();
	    $.post( 
	    /*url*/ _$_HOME_URL+"/categorias/buscar_elemento_ajax", 
	    /*data*/ $("#s-buscador", object).serialize())

	    .done(function(data){

	        var resultado = JSON.parse(data);

	        $(".menu",object).empty();

	        resultado.map(function(elemento){
	         
	          var item = $.parseHTML("<li class='menu-item' data-s-id="+elemento.id_categoria+"><a><div>"+elemento.nombre+"</div></a></li>");

	          $(item).click(function(){

	            var chip = $.parseHTML("<span class='chip'>"+elemento.nombre+"<a href='#' class='btn btn-clear' aria-label='Close' role='button'></a><input class='d-none' value="+elemento.id_categoria+" name='categorias[]'></span>");

	            $(chip).click(function(){
	            	$(this).remove();
	            })

	            $("#categorias-seleccionadas").append(chip);

	            limpiar();
	          });
	          $(".menu", object).append(item);

	        });
	    })

	    .fail( function(xhr, textStatus, errorThrown){
	        alert(xhr.responseText);
	    });

	  }));


	}); /* FIN */




	//HABILITA Y DESABILITA EL STOCK DE UN PRODUCTO
	$("[name='usa_stock']").on("change", function(){
		if($("#sumar").attr("readonly")){
			$("#sumar").attr("readonly",false);
			$("#restar").attr("readonly", false);
			$(this).parents("#contenedor-stock").css("background","#fff");
		}else{
			$("#sumar").attr("readonly",true);
			$("#restar").attr("readonly", true);
			$(this).parents("#contenedor-stock").css("background", "repeating-linear-gradient(-45deg, #f4f4f4, #f4f4f4 10px, #f1f1f1 10px, #f1f1f1 20px )");
		}
	});


	//GENERO EL POST AL HACER CLICK SOBRE LOS BOTOES DE GUARDAR, ACTUALIZAR O ELIMINAR
	$("#btn_guardar, #btn_actualizar, #btn_eliminar_confirmado").click(function(event){
	    event.preventDefault();
	    $.post( 
	    /*url*/ _$_HOME_URL+"/productos/"+ $(this).val(), 
	    /*data*/ $("#form_producto").serialize())

	    .done(function(data){
	        alert(data);
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