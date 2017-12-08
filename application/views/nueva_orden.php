<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="m-2">
<h5>Nueva Orden</h5>
<p></p>
<div id="selector_de_clientes" class="form-group">
  <select class="form-select">
    <option>Cliente</option>
    <option>Juan</option>
    <option>Rosa</option>
    <option>Muñeco</option>
  </select>
</div>

<div id="selector_de_fecha" class="form-group">
  <label class="form-label" for=""></label>
  <input id="fecha-slider" class="slider tooltip" type="range" list="tickmarks"
   min="1" max="3" value="1" data-tooltip="Mañana" name="fecha">
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
    <option>Producto</option>
    <option>levite</option>
    <option>cocacola</option>
    <option>smirnoff</option>
  </select>
</div>

<!-- INICIO MODAL PRODUCTO -->
<div id="modal_producto" class="modal modal-sm">
  <a id="cerrar_modal_producto" class="modal-overlay" aria-label="Close"></a>
  <div id="modal_producto" class="modal-container m-2">
    <p></p>
    <div class="m-2">
      <h5 id="modal_producto_titulo">Seleccione</h5>
    </div>
    <p></p>
    <p></p>
    <div class="form-group m-2">
      <label class="form-label" for="">Cantidad</label>
      <input id="cantidad-slider"class="slider tooltip" type="range" min="1" max="10" value="1" oninput="this.setAttribute('value', this.value);">
      <input id="cantidad" class="form-input d-none" type="number" name="cantidad" min="1">
      <label class="form-label" for="">Descuento</label>
      <div class="input-group">
        <input class="form-input" type="number" placeholder="Descuento" value="0" min="0" max="100">
        <button class="btn btn-primary input-group-btn">%</button>
      </div>
    </div>
    <p></p>
    <p></p>
    <div class="text-right m-2">
      <button class="btn btn-secondary">Eliminar</button>
      <button class="btn btn-primary ">ok</button>
    </div>
    <p></p>
  </div>
</div> <!-- FIN -->


<p></p>


<div class="panel">
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
  <button class="btn">Descartar</button>
  <button class="btn btn-primary">Guardar</button>
  <button class="btn">Finalizar</button>
</div>




</main>