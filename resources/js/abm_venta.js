$( document ).ready(function() {

    var venta_data = JSON.parse($("#form_data").text());

    for (var i = 0; i < venta_data.items.length; i++){
      delete venta_data.items[i].id_item;
    }

    var lista_items = {

        items : venta_data.items,

        agregar_item : function(item){
            this.items.push(item);
        },

        editar_item : function (item, id_item){
            this.items[id_item] = item;
        },

        eliminar_item : function (id_item){
            this.items.splice(id_item, 1);
        },

        total_items : function(){
            return this.items.length;
        },

        existe_item : function(id_item){
            if(this.items[id_item] != null){
                return true;
            }else{
                return false;
            }
        },

        get_item : function(id_item){
            if(this.existe_item(id_item)){
                return this.items[id_item];
            }else{
                return false;
            }
        }

    }

    function generar_item(index,item){

        var elemento = $.parseHTML(
        "<div class='tile tile-centered item' \
            data-id_item     ="+index+" \
            data-id_producto ="+item.id_producto+" \
            data-nombre      ="+"\""+item.nombre+"\""+" >\
          <div class='tile-content'>\
            <div class='tile-title'>"+item.nombre+"</div>\
            <div class='tile-subtitle text-gray'>Cant: "+item.cantidad+" | Desc: "+item.descuento+"</div>\
          </div>\
          <div class='tile-action'>\
            <button class='btn btn-link editar' type='button'>\
              <i class='fas fa-edit'></i>\
            </button>\
          </div>\
            <input type='hidden' name='items["+index+"][id_producto]' value='"+item.id_producto+"'>\
            <input type='hidden' name='items["+index+"][cantidad]' value='"+item.cantidad+"'>\
            <input type='hidden' name='items["+index+"][descuento]' value='"+item.descuento+"'>\
        </div>"
        );

        $(elemento).click(function(){
            setModal(index);
            $("#modal_producto").addClass("active");
        });

        $(".panel-body").append(elemento);

    }

    function imprimir_lista_items(){
        $(".panel-body").empty();
        if(lista_items.total_items() > 0){
            $.each(lista_items.items, function(index, item){
                generar_item(index, item);
            });
        }
    }

    function setModal(id_item, id_producto, nombre){
        if(item = lista_items.get_item(id_item)){

            $("#modal_producto_titulo").html(item.nombre);
            $("#modal_producto_titulo").attr("data-id_item", id_item);
            $("#modal_producto_titulo").attr("data-id_producto" ,item.id_producto);
            $("#modal_producto_titulo").attr("data-nombre", item.nombre);

            $("#cantidad").attr('value', item.cantidad);
            $("#cantidad").val(item.cantidad);

            $("#cantidad-slider").attr('value', item.cantidad);
            $("#cantidad-slider").val(item.cantidad);

            $("#descuento").val(item.descuento);

            if(item.cantidad >= 10){
                $("#cantidad-slider").css("display","none");
                $("#cantidad").css("display","block");
            }else{
                $("#cantidad-slider").css("display","block");
                $("#cantidad").css("display","none");
            }

        }else{

            $("#modal_producto_titulo").html(nombre);
            $("#modal_producto_titulo").attr("data-id_item" , id_item);
            $("#modal_producto_titulo").attr("data-id_producto", id_producto);
            $("#modal_producto_titulo").attr("data-nombre", nombre );
            $("#cantidad").attr('value', 1 );
            $("#cantidad").val(1);
            $("#cantidad-slider").attr('value',1 );
            $("#cantidad-slider").val(1);
            $("#descuento").val(0);

            $("#cantidad-slider").css("display","block");
            $("#cantidad").css("display","none");

        }
    }

    function cerrar_modal() {
      $("#modal_producto").removeClass("active");
    }

    //SETEO LA FECHA
    $("#fecha").attr("value", venta_data.fecha);

    //IMPRIMO POR PRIMERA VEZ LA LISTA DE ITEMS
    imprimir_lista_items();


    /*SELECTOR DE CLIENTES */
    $("#cliente_nombre").click(function(){
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
        /*url*/ _$_HOME_URL+"/Clientes/buscar_elemento_ajax", 
        /*data*/ $("#s-buscador", object).serialize())

        .done(function(data){

            var resultado = JSON.parse(data);

            $(".menu",object).empty();

            resultado.map(function(elemento){
             
              item = $.parseHTML("<li class='menu-item' data-s-id="+elemento.id_cuenta+"><a><div>"+elemento.nombre+" </div><div>$"+elemento.saldo+"</div></a></li>");
              $(item).click(function(){
                $("#id_cliente").attr("value", $(this).attr("data-s-id"));
                $("#cliente_nombre").attr("value", $("a", this).text());
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


    /*SELECTOR DE PRODUCTOS */
    $("#boton_seleccionar_producto").click(function(){
          $("#seleccionador2").trigger('desplegar');
    });

    $("#seleccionador2").each(function(index,object){

        var limpiar = function (){
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

        $(object).bind('desplegar', function() {
            $(".modal", object).addClass("active");
            $("#s-buscador", object).focus();
        });

        $("#s-buscador",object).keyup($.debounce(250, function(event) {

          event.preventDefault();
          $.post( 
          /*url*/ _$_HOME_URL+"/Productos/buscar_elemento_ajax", 
          /*data*/ $("#s-buscador", object).serialize())

          .done(function(data){

              var resultado = JSON.parse(data);

              $(".menu",object).empty();

              resultado.map(function(elemento){

                item = $.parseHTML("<li class='menu-item' data-s-id="+elemento.id_producto+"><a><div>"+elemento.nombre+" </div><div>"+elemento.stock+"</div></a></li>");

                $(item).click(function(){

                    var id_item     = lista_items.total_items();
                    var nombre      = elemento.nombre;
                    var id_producto = elemento.id_producto;

                    setModal(id_item, id_producto, nombre);
                    $("#modal_producto").addClass("active");

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

    //MANTENGO CON EL MISMO VALOR EL SLIDER CANTIDAD Y EL INPUT CANTIDAD
    //DECIDO CUANDO MOSTRAR CADA UNO
    $("#cantidad-slider").on("input", function(){
        $("#cantidad-slider").attr("value", $(this).val());
        $("#cantidad").attr("value", $(this).val());
        $("#cantidad").val($(this).val());
        if ($(this).val() == 10) {
            $("#cantidad").css("display", "block");
            $(this).css("display", "none");
        }
    });

    //EVENTO PARA CERRAR EL MODAL PRODUCTO
    $("#cerrar_modal_producto").click(function(){
        cerrar_modal();
    });

    //CONFIRMA LA INSERCION DEL ITEM EN LA LISTA DE ITEMS
    $("#boton-ok").click(function(){

        var id_item     = $("#modal_producto_titulo").attr("data-id_item");

        var item = {
            id_producto : $("#modal_producto_titulo").attr("data-id_producto"),
            nombre      : $("#modal_producto_titulo").attr("data-nombre"),
            cantidad    : $("#cantidad").val(),
            descuento   : $("#descuento").val()
        };

        if(lista_items.existe_item(id_item)){
            lista_items.editar_item(item, id_item);
        }else{
            lista_items.agregar_item(item);
        }

        imprimir_lista_items();

        cerrar_modal();

    });

    //ELIMINA EL ITEM SELECCIONADO DE LA LISTA DE ITEMS
    $("#boton-eliminar").click(function(){

        var id_item = $("#modal_producto_titulo").attr("data-id_item");

        if(lista_items.existe_item(id_item)){
            lista_items.eliminar_item(id_item);
            imprimir_lista_items();
            cerrar_modal();
        }else{
            cerrar_modal();
        }

    });

    //GENERO EL POST AL HACER CLICK SOBRE LOS BOTOES DE GUARDAR, ACTUALIZAR O ELIMINAR
    $("#btn_guardar, #btn_actualizar, #btn_eliminar_confirmado").click(function(event){
        event.preventDefault();
        $.post( 
        /*url*/ _$_HOME_URL+"/ventas/"+ $(this).val(), 
        /*data*/ $("#form_venta").serialize())

        .done(function(data){
            alert(data);
            var resultado = JSON.parse(data);

            if(resultado.estado === "ok"){
                $(location).attr('href', _$_HOME_URL);
            }else if(resultado.estado === "sin_stock"){
                $.each(resultado.faltantes , function(index, faltante){
                    $("#lista_faltantes").append("<p>Faltan "+ faltante.cantidad +" de "+faltante.nombre+"</p>");
                });
                $("#faltantes").addClass("active");
            }else{
                alert(resultado.mensaje);
            }
        })

        .fail( function(xhr, textStatus, errorThrown){
            alert(xhr.responseText);
        });
    });
    
    //EVENTO PARA CERRAR EL MODAL DE PRODUCTOS FALTANTES
    $(".cerrar_faltantes").click(function(e){
        $("#faltantes").removeClass("active");
        $("#lista_faltantes").empty();
    });

    //DESPLIEGA EL MENU DE ELIMINAR VENTA
    $("#btn_eliminar").click(function(){
        $("#eliminar_venta_dialog").addClass("active");
    });

    //EVENTO PARA CERRAR EL MENU DE ELIMINAR VENTA
    $(".cerrar_eliminar_venta_dialog").click(function(){
        $("#eliminar_venta_dialog").removeClass("active");
    });

});


