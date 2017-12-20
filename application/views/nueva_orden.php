<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="m-2">
<form id="form_nueva_orden" action="Nueva_orden/guardar" method="POST">
<h5>Nueva Orden</h5>
<p></p>
<div id="selector_de_clientes" class="form-group">
  <select class="form-select">

  <?PHP

  if($orden["cliente"] == -1) echo '<option selected disabled="disabled">Clientes</option>';
  foreach ($clientes as $cliente)
  {
      if($orden["cliente"] == $cliente->id_cliente){
        echo "<option data-id_cliente = ".$cliente->id_cliente." selected>".$cliente->nombre."</option>"; 
      }else{
        echo "<option data-id_cliente = ".$cliente->id_cliente.">".$cliente->nombre."</option>";
      }
  }
  
  ?>

  </select>
  <input id="cliente" type="hidden" name="cliente">
</div>

<div id="selector_de_fecha" class="form-group">
  <label class="form-label" for=""></label>
  <input id="fecha-slider" class="slider tooltip" type="range" list="tickmarks"
   min="1" max="3" value="1" data-tooltip="Mañana">
  <datalist id="tickmarks">
    <option value="Mañana">
    <option value="Pasado">
    <option value="Fecha Específica">
  </datalist>
  <input id="fecha" class="form-input d-none" type="date" name="fecha">
</div>

<p></p>
<div id="selector_de_productos" class="form-group">
  <select class="form-select">
    <option selected disabled="disabled">Productos</option>
    <?PHP
        foreach ($productos as $producto)
    {
          echo "<option data-id_producto = ".$producto->id_producto.">".$producto->nombre."</option>";
    }
    ?>
    
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

<div class="btn-group btn-group-block">
  <button id="btn_descartar" class="btn" type="button" onclick="location.href = <?PHP echo base_url(); ?>" >Descartar</button>
  <button id="btn_guardar" class="btn btn-primary" type="button">Guardar</button>
</div>
</form>
</main>