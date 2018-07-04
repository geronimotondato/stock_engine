addLoadEvent(function() {


    venta_data = JSON.parse(document.getElementById("form_data").innerText);
    lista_items = venta_data.items;

    document.getElementById("fecha").setAttribute("value", venta_data.fecha);

    document.getElementById("selector_de_productos").addEventListener("change", function() {

        var nombre      = this.children[0].value;
        var id_item     = document.getElementsByClassName("item").length;
        var id_producto = this.children[0].selectedOptions[0].getAttribute('data-id_producto');

        setModal(id_item, id_producto, nombre);

        document.getElementById("modal_producto").classList.add("active");

    });


    document.getElementById("cantidad-slider").addEventListener("input", function() {
        this.setAttribute('value', this.value);
        var cantidad = document.getElementById("cantidad");
        cantidad.setAttribute('value', this.value);
        cantidad.value = this.value;
        if (this.value == 10) {
            cantidad.style.display = "block";
            this.style.display = "none";
        }
    });



    document.getElementById("boton-ok").addEventListener("click", function() {

        var id_item     = document.getElementById("modal_producto_titulo").getAttribute("data-id_item");
        var id_producto = document.getElementById("modal_producto_titulo").getAttribute("data-id_producto");
        var nombre      = document.getElementById("modal_producto_titulo").getAttribute("data-nombre");
        var cantidad    = document.getElementById("cantidad").value;
        var descuento   = document.getElementById("descuento").value;

        var item = {
            id_item     : id_item, 
            id_producto : id_producto,
            nombre      : nombre, 
            cantidad    : cantidad, 
            descuento   : descuento
        };

        if(findById(lista_items, item.id_item)){
            editar_item(item);

        }else{
            agregar_item(item)
        }

        imprimir_lista_items();

        cerrar_modal();
    });

    document.getElementById("boton-eliminar").addEventListener("click", function() {

       var id_item = document.getElementById("modal_producto_titulo").getAttribute("data-id_item");
     
        if (findById(lista_items, id_item)) { 
            delete_item(id_item);
            imprimir_lista_items();
            cerrar_modal();
        }else{
            cerrar_modal();
        }

    });

    document.getElementById("cerrar_modal_producto").addEventListener("click", function (){
     cerrar_modal();   
    });


    imprimir_lista_items();
    

    document.getElementById("btn_eliminar").addEventListener("click", function() {

        document.getElementById("eliminar_venta_dialog").classList.add("active");

    });

    document.querySelectorAll(".cerrar_eliminar_venta_dialog").forEach( function(element){

        element.addEventListener("click", function() {

            document.getElementById("eliminar_venta_dialog").classList.remove("active");

        });
    });
});







$( document ).ready(function() {


    $(".cerrar_faltantes").click(function(e){
        $("#faltantes").removeClass("active");
        $("#lista_faltantes").empty();
    });


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


  /*SELECTOR DE CLIENTES */
    $("#seleccionador").each(function(index,object){

      $(".modal-overlay", object).click(function(){
        $(".modal", object).removeClass("active");
      });

      $("#s-cerrar", object).click(function(){
        $(".modal",object).removeClass("active");
      });

      $("input", object).click(function(){
        $(".modal", object).addClass("active");
        $("#s-buscador", object).focus();
      });

      $("#s-buscador",object).keyup($.debounce(250, function(event) {

        event.preventDefault();
        $.post( 
        /*url*/ _$_HOME_URL+"/Clientes/buscar_elemento_ajax", 
        /*data*/ $("#s-buscador").serialize())

        .done(function(data){
            var resultado = JSON.parse(data);

            $(".menu",object).empty();

            resultado.map(function(elemento){

              item = $.parseHTML("<li class='menu-item' data-s-id="+elemento.id_cuenta+"><a><div>"+elemento.nombre+" </div><div>$"+elemento.saldo+"</div></a></li>");

              $(item).click(function(){
                $("#s-id",object).attr("value", $(this).attr("data-s-id"));
                $("#s-nombre",object).attr("value", $("a", this).text());
                $("#s-buscador",object).val("");
                $(".menu",object).empty();
                $(".modal",object).removeClass("active");
              });

              $(".menu", object).append(item);
            });
      
        })

        .fail( function(xhr, textStatus, errorThrown){
            alert(xhr.responseText);
        });

      }));


    });
    /* FIN SELECTOR */


});



function agregar_item(item){
	lista_items.push(item);
}

function editar_item(item){
    var item_en_lista         = findById(lista_items, item.id_item);
    item_en_lista.id_producto = item.id_producto;
    item_en_lista.nombre      = item.nombre;
    item_en_lista.cantidad    = item.cantidad;
    item_en_lista.descuento   = item.descuento;
}

function delete_item(id_item){
	for (var i = 0; i < lista_items.length; i++) {
	  if (lista_items[i].id_item === id_item) {
	    lista_items.splice(i,1);
	  }
	}
}

function findById(lista_items, id_item){
  for (var i = 0; i < lista_items.length; i++) {
    if (lista_items[i].id_item == id_item) {
      return lista_items[i];
    }
  }
  return false;
}

function setModal(id_item, id_producto, nombre){
    if (findById(lista_items, id_item)) {  
        var  item = findById(lista_items, id_item);
        document.getElementById("modal_producto_titulo").innerHTML = item.nombre;
        document.getElementById("modal_producto_titulo").setAttribute("data-id_item", item.id_item);
        document.getElementById("modal_producto_titulo").setAttribute("data-id_producto" ,item.id_producto);
        document.getElementById("modal_producto_titulo").setAttribute("data-nombre", item.nombre);
        document.getElementById("cantidad").setAttribute('value', item.cantidad);
        document.getElementById("cantidad").value                  = item.cantidad;
        document.getElementById("cantidad-slider").setAttribute('value', item.cantidad);
        document.getElementById("cantidad-slider").value           = item.cantidad;
        document.getElementById("descuento").value                 = item.descuento;

        if(item.cantidad >= 10){
            document.getElementById("cantidad-slider").style.display = "none";
            document.getElementById("cantidad").style.display = "block";
        }else{
            document.getElementById("cantidad-slider").style.display = "block";
            document.getElementById("cantidad").style.display = "none";
        }

    } else{
        document.getElementById("modal_producto_titulo").innerHTML = nombre;
        document.getElementById("modal_producto_titulo").setAttribute("data-id_item" , id_item);
        document.getElementById("modal_producto_titulo").setAttribute("data-id_producto", id_producto);
        document.getElementById("modal_producto_titulo").setAttribute("data-nombre", nombre );
        document.getElementById("cantidad").setAttribute('value', 1 );
        document.getElementById("cantidad").value = 1 ;
        document.getElementById("cantidad-slider").setAttribute('value',1 );
        document.getElementById("cantidad-slider").value = 1 ;
        document.getElementById("descuento").value = 0;

        document.getElementById("cantidad-slider").style.display = "block";
        document.getElementById("cantidad").style.display = "none";


    }
}

function cerrar_modal() {
    document.getElementById("modal_producto").classList.remove("active");
    var options = document.querySelectorAll('#selector_de_productos option');
    for (var i = 0, l = options.length; i < l; i++) {
        options[i].selected = options[i].defaultSelected;
    }
}


function imprimir_lista_items(){
    document.querySelectorAll('.panel-body')[0].innerHTML ="";
    if(lista_items != null){
        lista_items.forEach(function(producto){
            generar_item(producto);
        });
    }   
}

function generar_item(item){
    document.querySelectorAll('.panel-body')[0].innerHTML += 
    "<div class='tile tile-centered item' \
        data-id_item     ="+item.id_item+" \
        data-id_producto ="+item.id_producto+" \
        data-nombre      ="+"\""+item.nombre+"\""+" >\
      <div class='tile-content'>\
        <div class='tile-title'>"+item.nombre+"</div>\
        <div class='tile-subtitle text-gray'>Cant: "+item.cantidad+" | Desc: "+item.descuento+"</div>\
      </div>\
      <div class='tile-action'>\
        <button class='btn btn-link editar' type='button' onclick= setModal("+item.id_item+");document.getElementById('modal_producto').classList.add('active');>\
          <i class='fas fa-edit'></i>\
        </button>\
      </div>\
        <input type='hidden' name='items["+item.id_item+"][id_producto]' value='"+item.id_producto+"'>\
        <input type='hidden' name='items["+item.id_item+"][cantidad]' value='"+item.cantidad+"'>\
        <input type='hidden' name='items["+item.id_item+"][descuento]' value='"+item.descuento+"'>\
    </div>";
}