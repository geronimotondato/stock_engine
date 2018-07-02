<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

<div class="seccion"><p>producto</p></div>

  <form id="form_producto">
  <fieldset <?= (isset($producto) && $producto->dado_de_baja)? "disabled" : "" ?> >

  <?PHP if(isset($producto)): ?>
    <input type="hidden" id="id_producto"  name="id_producto" value='<?= $producto->id_producto ?>' >
  <?PHP endif; ?>

<div class="form-group">
  <label class="form-label" for="nombre">Nombre</label>
  <input class="form-input" type="text" id="nombre" placeholder="Nombre" name="nombre" value='<?= isset($producto)? $producto->nombre : "" ?>' >
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="descripcion">Descripción</label>
  <input class="form-input" type="text" id="descripcion" placeholder="Descripción" name="descripcion" value='<?= isset($producto)? $producto->descripcion : ""?>'>
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="ean-13">Código de Barras</label>
  <input class="form-input" type="number" id="ean-13" placeholder="Código de Barras" name="ean-13" value='<?= isset($producto)? $producto->ean-13 : ""?>' >
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="precio_venta">Precio</label>
  <input class="form-input" type="number" id="precio_venta" placeholder="Precio" name="precio_venta" value='<?= isset($producto)? $producto->precio_venta : "" ?>'>
</div>

<!-- form input control -->


<div class="container">
 <label class="form-label" for="stock">Stock</label>
  <div class="columns">

    <div class="column col-4">
      <div class="input-group">
        <input readonly class="form-input" type="text" id="stock" placeholder="stock" name="stock" value='<?= isset($producto)? $producto->stock : "" ?>'>
      </div>
    </div>
    <div class="column col-4">
      <div class="input-group">

        <button class="btn btn-primary input-group-btn" type="button"><i class="fas fa-plus"></i></button>
        <input id="sumar" class="form-input" type="number" placeholder="+" value="0" min="0" name="sumar">
      </div>
    </div>
    <div class="column col-4">
      <div class="input-group">

        <button class="btn btn-primary input-group-btn" type="button"><i class="fas fa-minus"></i></button>
        <input id="restar" class="form-input" type="number" placeholder="-" value="0" min="0" name="restar">
      </div>

    </div>
  </div>
</div>


<div id="unidades" class="form-group">
  <select class="form-select" name="unidad">
    <option disabled selected>Lista de Unidades</option>
 
      <option value="unidad">unidad</option>
      <option value="par">par</option>
      <option value="docena">docena</option>
      <option value="pack">pack</option>
      <option value="horma">horma</option>
      <option value="miligramo">miligramo</option>
      <option value="gramo">gramo</option>
      <option value="kilogramo">kilogramo</option>
      <option value="tonelada">tonelada</option>
      <option value="milimetro">milimetro</option>
      <option value="centimetro">centimetro</option>
      <option value="metros">metros</option>
      <option value="kilometro">kilometro</option>
      <option value="metro cuadrado">metro cuadrado</option>
      <option value="milimetro cubico">milimetro cubico</option>
      <option value="centimetro cubico">centimetro cubico</option>
      <option value="metro cubico">metro cubico</option>
      <option value="mililitro">mililitro</option>
      <option value="litros">litros</option>
      <option value="otras unidades">otras unidades</option>

  </select>
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="minimo">Mínimo</label>
  <input class="form-input" type="number" id="minimo" placeholder="Mínimo" name="minimo" value='<?= isset($producto)? $producto->minimo : "" ?>'>
</div>

</fieldset>

<p></p>

<?PHP if(isset($producto)): ?>

<!-- MODAL DE ELIMINAR producto -->
<div id="eliminar_producto_dialog" class="modal modal-sm">
  <a class="modal-overlay cerrar_eliminar_producto_dialog" aria-label="Close"></a>
  <div class="modal-container m-2">
    <p></p>
    <div class="m-2">
      <h5>Dar de baja a este producto</h5>
      <p></p>
      <p></p>
      <button id="btn_eliminar" class="btn" type="button" value="eliminar">Eliminar</button>
      <button class="btn btn-primary cerrar_eliminar_producto_dialog" type="button" >Cancelar</button>
    </div>
  </div>
</div> <!--FIN MODAL -->

<div class="btn-group btn-group-block">
  <button id="btn_descartar" class="btn" type="button" onclick="location.href = '<?= base_url("productos"); ?>'" >Descartar</button>
  <button id="btn_actualizar" class="btn btn-primary" type="input"  name="submit_btn" value="actualizar">Actualizar</button>
  <button id="eliminar_producto" class="btn btn-secundary"  type="button">Eliminar</button>

</div>

<?PHP else: ?>

<div class="btn-group btn-group-block">
  <button id="btn_descartar" class="btn" type="button" onclick="location.href = '<?= base_url("productos"); ?>'" >Descartar</button>
  <button id="btn_guardar" class="btn btn-primary" type="input" name="submit_btn" value="guardar">Guardar</button>
</div>

<?PHP endif; ?>

</form>

</main>