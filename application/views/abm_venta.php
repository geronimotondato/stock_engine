<!-- llamo a css propio de la vista -->
<link href= "<?= base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?= base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<div id="form_data" class="d-none">
  <?= json_encode($venta); ?>
</div>
<main class="margen">
<div class="seccion"><p>venta</p></div>
  <form id="form_venta">
    <input id="id_venta" class="form-input d-none" type="hidden" name="id_venta" value=<?= $venta["id_venta"] ?> >
    
    <p></p>

<!-- PANEL SELECTOR DE CLIENTES -->
<style>
  #seleccionador .modal-container{
    height: 100%;
    max-height: 90%;
  }

  #seleccionador .menu{
    box-shadow: none !important;
    padding: 0 !important;
  }

  #seleccionador .menu-item {
    border: 1px solid #ccc;
    cursor: pointer;
  }

  #seleccionador .menu-item a div{
     display: inline-block;
     vertical-align: middle;
  }

  #seleccionador .menu-item a div:nth-child(1){
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      width: 100%;
      max-width: 75%;
  }

  #seleccionador .menu-item a div:nth-child(2){
      width: 25%;
      text-align: right;
  }

</style>

<script>
  $( document ).ready(function() {

    $("#seleccionador .modal-overlay").click(function(){
      $("#seleccionador .modal").removeClass("active");
    });

    $("#seleccionador #cerrar").click(function(){
      $("#seleccionador .modal").removeClass("active");
    });



    $("#seleccionador #buscador").keyup($.debounce(250, function(event) {

      event.preventDefault();
      $.post( 
      /*url*/ _$_HOME_URL+"/Clientes/buscar_elemento_ajax", 
      /*data*/ $("#buscador").serialize())

      .done(function(data){
          var resultado = JSON.parse(data);

          $("#seleccionador .menu").empty();

          resultado.map(function(elemento){

            item = $.parseHTML("<li class='menu-item' data-id_cuenta="+elemento.id_cuenta+"><a><div>"+elemento.nombre+"</div><div>$"+elemento.saldo+"</div></a></li>");

            $(item).click(function(){
              $("#seleccionador [name=id_cuenta]").attr("value", $(this).attr("data-id_cuenta"));
               $("#seleccionador .modal").removeClass("active");
            });

            $("#seleccionador .menu").append(item);
          });
  
      })

      .fail( function(xhr, textStatus, errorThrown){
          alert(xhr.responseText);
      });

    }));

  });
</script>

<div id="seleccionador">
  <div class="modal active">
    <a href="#close" class="modal-overlay" aria-label="Close"></a>
    <div class="modal-container">
      <div class="modal-header">
        <a id="cerrar" href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
        <div class="modal-title h5">Seleccionar</div>
        <p></p>
        <div class="input-group">
          <input id="buscador" type="text" class="form-input" placeholder="buscar" name="texto_busqueda" value="" autocomplete="off">
          <button class="btn btn-primary input-group-btn" type="button"><i class="fas fa-search"></i></button>
        </div>
      </div>
    <div class="modal-body">
      <div class="content">
        <ul class="menu">
        </ul>
      </div>
     </div>
    </div> 
  </div>
  <input type="hidden" name="id_cuenta">
</div>






    <!-- SELECTOR DE CLIENTES -->
    <?PHP //Si id_venta es igual a 0 significa que se va a crear una venta nueva
          //Caso contrario, se trata de una actualizacion de una venta preexistente
     ?>
    <?PHP if($venta["id_venta"] == 0 ): ?>
      <div id="selector_de_clientes" class="form-group">
        <select class="form-select" name="id_cuenta">
          <option disabled selected>Lista de Clientes</option>
          <?PHP foreach ($clientes as $cliente): ?>
            <option value= <?= $cliente->id_cuenta ?>> <?= $cliente->nombre ?> </option>
          <?PHP endforeach ?>
        </select>
      </div>
      <div id="agregar_nuevo_cliente">
          <a class="btn btn-primary" href="<?= base_url('clientes/abm') ?>">
          <i class="fas fa-users"></i> <i class="fas fa-plus"></i>
          </a>
      </div>
    <?PHP else: ?>
        <?PHP if($venta["cliente"]["dado_de_baja"] == 0 ): ?>
          <strong>Cliente: <a href="<?= base_url('clientes/abm?id_cuenta=' . $venta['cliente']['id_cuenta']) ?>" target="_blank" > <?= $venta['cliente']['nombre'] ?> </a></strong>
        <?PHP else: ?>
          <strong>Cliente: <?= $venta['cliente']['nombre'] ?></strong>
        <?PHP endif; ?>
    <?PHP endif; ?>
    <!-- FIN -->
 

    <p></p>
    <!-- SELECTOR DE FECHA DE ENTREGA -->
    <input id="fecha" class="form-input" type="date" name="fecha" value=>
    <!-- FIN -->
    <p></p>

    <!-- SELECTOR DE PRODUCTOS -->
    <div id="selector_de_productos" class="form-group">
      <select class="form-select">
        <option selected disabled="disabled">Productos</option>

        <?PHP foreach ($productos as $producto): ?>
        <option data-id_producto = <?= $producto->id_producto ?> > <?= $producto->nombre ?></option>
        <?PHP endforeach; ?>

      </select>
    </div> <!-- FIN -->

    <!-- INICIO MODAL PRODUCTO -->
    <div id="modal_producto" class="modal modal-sm" data-modal-index="">
      <a id="cerrar_modal_producto" class="modal-overlay" aria-label="Close"></a>
      <div id="" class="modal-container m-2">
        <p></p>
        <div class="m-2">
          <h5 id="modal_producto_titulo">Seleccione</h5>
        </div>
        <p></p>
        <p></p>
        <div class="form-group m-2">
          <label class="form-label" for="">Cantidad</label>

          <input id="cantidad-slider" class="slider tooltip" type="range" min="1" max="10" value="1">

          <input id="cantidad" class="form-input" type="number" min="1" value="">

          <label class="form-label" for="">Descuento</label>
          <div class="input-group">
            <input id="descuento" class="form-input" type="number" placeholder="Descuento" value="0" min="0" max="100">
            <button class="btn btn-primary input-group-btn" type="button">%</button>
          </div>
        </div>
        <p></p>
        <p></p>
        <div class="text-right m-2">
          <button id = "boton-eliminar" class="btn btn-secondary" type="button">Eliminar</button>
          <button id = "boton-ok" class="btn btn-primary " type="button">Ok</button>
        </div>
        <p></p>
      </div>
    </div> <!-- FIN -->


    <p></p>


    <div id="panel_productos" class="panel">
      <div class="panel-header">
        <div class="panel-title">Productos seleccionados</div>
      </div>
      <div class="panel-nav">
        <!-- navigation components: tabs, breadcrumbs or pagination -->
      </div>
      <div class="panel-body">


      </div>
      <div class="panel-footer">
        <!-- buttons or inputs -->
      </div>
    </div>

    <p></p>



    <div id="eliminar_venta_dialog" class="modal modal-sm">
      <a class="modal-overlay cerrar_eliminar_venta_dialog" aria-label="Close"></a>
      
      <div class="modal-container m-2">

        <p></p>
        <div class="m-2">
          <h5>Eliminar esta venta</h5>
          <p></p>
          <p></p>
          <button  id="btn_eliminar_confirmado"class="btn" type="input" name="submit_btn" value="eliminar">Eliminar</button>
          <button class="btn btn-primary cerrar_eliminar_venta_dialog" type="button" >Cancelar</button>
        </div>
        
      </div>
    </div>


    <div id="faltantes" class="modal modal-sm">
      <a class="modal-overlay cerrar_faltantes" aria-label="Close"></a>
      
      <div class="modal-container m-2">

        <p></p>
        <div class="m-2">
          <h5>Stock Insuficiente</h5>
          <div id="lista_faltantes">
          </div>
          <button class="btn btn-primary cerrar_faltantes" type="button" >Aceptar</button>
        </div>
        
      </div>
    </div>

    <?PHP if($venta["id_venta"] == 0 ): ?>

    <div class="btn-group btn-group-block">
      <button id="btn_descartar" class="btn" type="button" onclick="location.href = <?= base_url(); ?>" >Descartar</button>
      <button id="btn_guardar" class="btn btn-primary" type="input" name="submit_btn" value="guardar">Guardar</button>
    </div>

    <?PHP else: ?>

    <div class="btn-group btn-group-block">
      <button id="btn_descartar" class="btn" type="button" onclick="location.href = <?= base_url(); ?>" >Descartar</button>
      <button id="btn_actualizar" class="btn btn-primary" type="input"  name="submit_btn" value="actualizar">Actualizar</button>
      <button id="btn_eliminar" class="btn" type="button">Eliminar</button>
    </div>
    <?PHP endif; ?>
  </form>
</main>