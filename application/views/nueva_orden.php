<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main>

<div id="selector_de_productos" class="form-group">
  <select class="form-select">
    <option>Choose an option</option>
    <option>levite</option>
    <option>cocacola</option>
    <option>smirnoff</option>
  </select>
</div>

<div id="modal_producto" class="modal modal-sm">
  <a id="cerrar_modal_producto" class="modal-overlay" aria-label="Close"></a>
  <div id="modal_producto" class="modal-container">
    
    




<div class="card m-2">
  <div class="card-header">
    <div class="card-title h5">Seleccione</div>
  </div>
  <div class="card-body">


      <div class="form-group">
        <label class="form-label" for="">Cantidad</label>
        <input class="slider tooltip" type="range" min="1" max="10" value="1" oninput="this.setAttribute('value', this.value);">
      </div>
   
      <div class="form-group">
        <label class="form-label" for="">Descuento</label>
        <input class="form-input" type="number" id="input-example-1" placeholder="Descuento" value="0" min="0" max="100">
      </div>
    </div>


  <div class="card-footer text-right">
    <button class="btn btn-secondary">Eliminar</button>
    <button class="btn btn-primary ">ok</button>
  </div>
</div>






</main>