<!-- llamo a css propio de la vista -->
<link href= "<?= base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?= base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<div id="form_data" class="d-none">
  <?= json_encode($orden); ?>
</div>
<main class="m-2">
  <form id="form_nueva_orden" action="Nueva_orden/guardar" method="POST">
    <input id="id_orden" class="form-input d-none" type="hidden" name="id_orden" value=<?= $orden["id_orden"] ?> >
    <h5>Nueva Orden</h5>
    <p></p>
    <div id="selector_de_clientes" class="form-group">

      <select class="form-select" name="cliente">
        <option disabled="disabled">Clientes</option>
        <?PHP foreach ($clientes as $cliente): ?>

        <option value= <?= $cliente->id_cliente ?> <?PHP if($cliente->id_cliente == $orden["cliente"]) echo "selected"; ?>> <?= $cliente->nombre ?> </option>

        <?PHP endforeach ?>
      </select>
    </div>

    <p></p>
    <input id="fecha" class="form-input" type="date" name="fecha" value=>
    <p></p>

    <div id="selector_de_productos" class="form-group">
      <select class="form-select">
        <option selected disabled="disabled">Productos</option>

        <?PHP foreach ($productos as $producto): ?>
        <option data-id_producto = <?= $producto->id_producto ?> > <?= $producto->nombre ?></option>
        <?PHP endforeach; ?>

      </select>
    </div>

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



    <div id="eliminar_orden_dialog" class="modal modal-sm">
      <a class="modal-overlay cerrar_eliminar_orden_dialog" aria-label="Close"></a>
      
      <div class="modal-container m-2">

        <p></p>
        <div class="m-2">
          <h5>Eliminar esta orden</h5>
          <p></p>
          <p></p>
          <button class="btn" type="input" name="submit_btn" value="Eliminar" >Eliminar</button>
          <button class="btn btn-primary cerrar_eliminar_orden_dialog" type="button" >Cancelar</button>
        </div>
        
      </div>
    </div>


    <?PHP //Si id_orden es distinto de 0 significa que se va a actualizar una orden ya existe
          //por lo cual se crean los botones [descartar][actualizar][eliminar]
          //en el caso que sea 0 se crean los botones [descartar][guardar] ?>

    <?PHP if($orden["id_orden"] == 0 ): ?>

    <div class="btn-group btn-group-block">
      <button id="btn_descartar" class="btn" type="button" onclick="location.href = <?= base_url(); ?>" >Descartar</button>
      <button id="btn_guardar" class="btn btn-primary" type="input" name="submit_btn" value="Guardar">Guardar</button>
    </div>

    <?PHP else: ?>

    <div class="btn-group btn-group-block">
      <button id="btn_descartar" class="btn" type="button" onclick="location.href = <?= base_url(); ?>" >Descartar</button>
      <button id="btn_actualizar" class="btn btn-primary" type="input"  name="submit_btn" value="Actualizar">Actualizar</button>
      <button id="btn_eliminar" class="btn" type="button">Eliminar</button>
    </div>
    <?PHP endif; ?>
  </form>
</main>