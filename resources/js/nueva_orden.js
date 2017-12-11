addLoadEvent(function() {

    function cerrar_modal() {
        document.getElementById("modal_producto").classList.remove("active");
        var options = document.querySelectorAll('#selector_de_productos option');
        for (var i = 0, l = options.length; i < l; i++) {
            options[i].selected = options[i].defaultSelected;
        }
    }

    document.getElementById("cerrar_modal_producto").addEventListener("click", function (){
     cerrar_modal();   
    });

    document.getElementById("fecha-slider").addEventListener("input", function() {
        this.setAttribute('value', this.value);
        this.setAttribute('data-tooltip', document.getElementById('tickmarks').childNodes[this.value].value);
        var fecha = document.getElementById("fecha");
        switch (this.value) {
            case "1":
                fecha.value = getFecha(this.value);
                break;
            case "2":
                fecha.value = getFecha(this.value);
                break;
            case "3":
                fecha.value = getFecha(this.value);
                fecha.classList.remove("d-none");
                this.classList.add("d-none")
                break;
        }
    });


    document.getElementById("cantidad-slider").addEventListener("input", function() {
        var cantidad = document.getElementById("cantidad");
        cantidad.setAttribute('value', this.value);
        if (this.value == 10) {
            cantidad.classList.remove("d-none");
            this.classList.add("d-none")
        }
    });

    document.getElementById("selector_de_productos").addEventListener("change", function() {

        var nombre      = this.children[0].value;
        var id_item     = document.getElementsByClassName("item").length;
        var id_producto = this.children[0].selectedOptions[0].getAttribute('data-id_producto');

        setModal(id_item, id_producto, nombre);

        document.getElementById("modal_producto").classList.add("active");

    });

    document.getElementById("boton-ok").addEventListener("click", function() {

        var id_item = document.getElementById("modal_producto_titulo").getAttribute("data-id_item");
    	var id_producto = document.getElementById("modal_producto_titulo").getAttribute("data-id_producto");
        var nombre = document.getElementById("modal_producto_titulo").getAttribute("data-nombre");
        var cantidad = document.getElementById("cantidad").value;
        var descuento = document.getElementById("descuento").value;

        var item = {id_item: id_item, id_producto: id_producto, nombre: nombre, cantidad: cantidad, descuento: descuento};

        try{
            findById(lista_items, item.id_item);
            editar_item(item);

        }catch(e){
            agregar_item(item)
        }

        imprimir_lista_items();

        cerrar_modal();
    });

    document.getElementById("boton-eliminar").addEventListener("click", function() {


    });

    // document.getElementById("boton-descartar").addEventListener("click", function() {


    // });

});


var lista_items = [];

function setModal(id_item, id_producto, nombre){
    try{    
        var  item = findById(lista_items, id_item);
        document.getElementById("modal_producto_titulo").innerHTML = item.nombre;
        document.getElementById("modal_producto_titulo").setAttribute("data-id_item", item.id_item);
        document.getElementById("modal_producto_titulo").setAttribute("data-id_producto" ,item.id_producto);
        document.getElementById("modal_producto_titulo").setAttribute("data-nombre" ,item.nombre);
        document.getElementById("cantidad").setAttribute('value', item.cantidad);
        document.getElementById("cantidad").value = item.cantidad;
        document.getElementById("cantidad-slider").setAttribute('value', item.cantidad);
        document.getElementById("cantidad-slider").value = item.cantidad;
        document.getElementById("descuento").value = item.descuento;
    } catch(e){
        document.getElementById("modal_producto_titulo").innerHTML = nombre;
        document.getElementById("modal_producto_titulo").setAttribute("data-id_item" , id_item);
        document.getElementById("modal_producto_titulo").setAttribute("data-id_producto", id_producto);
        document.getElementById("modal_producto_titulo").setAttribute("data-nombre", nombre );
        document.getElementById("cantidad").setAttribute('value', 1 );
        document.getElementById("cantidad").value = 1 ;
        document.getElementById("cantidad-slider").setAttribute('value',1 );
        document.getElementById("cantidad-slider").value = 1 ;
        document.getElementById("descuento").value = 0;
    }
}

function generar_item(item){
    document.querySelectorAll('.panel-body')[0].innerHTML += 
    "<div class='tile tile-centered item' \
        data-id_item     ="+item.id_item+" \
        data-id_producto ="+item.id_producto+" \
        data-nombre      ="+item.nombre+" >\
      <div class='tile-content'>\
        <div class='tile-title'>"+item.nombre+"</div>\
        <div class='tile-subtitle text-gray'>Cant: "+item.cantidad+" | Desc: "+item.descuento+"</div>\
      </div>\
      <div class='tile-action'>\
        <button class='btn btn-link editar' onclick= setModal("+item.id_item+");document.getElementById('modal_producto').classList.add('active');>\
          <i class='icon icon-edit'></i>\
        </button>\
      </div>\
        <input type='hidden' name='item[id_producto][]' value='"+item.id_producto+"'>\
        <input type='hidden' name='item[cantidad][]' value='"+item.cantidad+"'>\
        <input type='hidden' name='item[descuento][]' value='"+item.descuento+"'>\
    </div>";
}

function imprimir_lista_items(){
    document.querySelectorAll('.panel-body')[0].innerHTML ="";
	lista_items.forEach(function(producto){
		generar_item(producto);
	});
}

function agregar_item(item){
	// var id_item = lista_items.length;
	// var producto = {id_item: id_item, id_producto: id_producto, nombre: nombre, cantidad:cantidad, descuento: descuento};
	lista_items.push(item);
}

function editar_item(item){
		var item_en_lista = findById(lista_items, item.id_item);
        item_en_lista.id_producto = item.id_producto;
		item_en_lista.nombre = item.nombre;
		item_en_lista.cantidad = item.cantidad;
		item_en_lista.descuento = item.descuento;
}

function delete_item(item){
	for (var i = 0; i < lista_items.length; i++) {
	  if (lista_items[i].id_item === item.id_item) {
	    lista_items.splice(i,1);
	  }
	}
}

function findById(source, id_item){
  for (var i = 0; i < source.length; i++) {
    if (source[i].id_item == id_item) {
      return source[i];
    }
  }
  throw "no hay objeto con id: " + id_item;
}
