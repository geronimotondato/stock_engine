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

<p></p>
<div class="form-group">
  <label class="form-label" for="nombre">Nombre</label>
  <input class="form-input" type="text" id="nombre" placeholder="Nombre" name="nombre" value='<?= isset($producto)? $producto->nombre : "" ?>' >
</div>




<div class="form-group">
<label class="form-label" for="marca_nombre">Marca</label>
<input id="id_marca" type="hidden" name="id_marca">
<input id="marca_nombre" class="form-input" type="text" readonly placeholder="Marca">
<div id="agregar_nuevo_marca">
  <a class="btn btn-primary" href="<?= base_url('marcas/abm') ?>">
  <i class="fas fa-trademark"></i> <i class="fas fa-plus"></i>
  </a>
</div>
</div>

  <!-- INICIO SELECCIONADOR -->
  <div id="seleccionador1" class="seleccionador">
    <div class="modal">
      <a href="#close" class="modal-overlay" aria-label="Close"></a>
      <div class="modal-container">
        <div class="modal-header">
          <a id="s-cerrar" href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
          <div class="modal-title h5">Seleccionar marca</div>
          <p></p>
          <div class="input-group">
            <input id="s-buscador" type="text" class="form-input" placeholder="buscar" name="texto_busqueda" value="" autocomplete="off">
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
  </div><!-- FIN -->


  <div class="form-group">
  <label class="form-label" for="categoria_nombre">Categorías</label>
  <input id="id_categoria" type="hidden" name="id_categoria">
  <input id="categoria_nombre" class="form-input" type="text" readonly placeholder="Categoría">
  <div id="agregar_nuevo_categoria">
    <a class="btn btn-primary" href="<?= base_url('categorias/abm') ?>">
    <i class="fas fa-tag"></i> <i class="fas fa-plus"></i>
    </a>
  </div>
  </div>

<div id="categorias-seleccionadas" class="container contenedor-decorado">

  <p>Categorías Seleccionadas:</p>

</div>

    <!-- INICIO SELECCIONADOR -->
    <div id="seleccionador2" class="seleccionador">
      <div class="modal">
        <a href="#close" class="modal-overlay" aria-label="Close"></a>
        <div class="modal-container">
          <div class="modal-header">
            <a id="s-cerrar" href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
            <div class="modal-title h5">Seleccionar categoría</div>
            <p></p>
            <div class="input-group">
              <input id="s-buscador" type="text" class="form-input" placeholder="buscar" name="texto_busqueda" value="" autocomplete="off">
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
    </div><!-- FIN -->






<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="descripcion">Descripción</label>
  <textarea class="form-input" id="descripcion" placeholder="Descripción" rows="3" value='<?= isset($producto)? $producto->descripcion : ""?>'></textarea>


</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="ean-13">Código de Barras</label>
  <input class="form-input" type="number" id="ean-13" placeholder="Código de Barras" name="ean-13" value='<?= isset($producto)? $producto->ean-13 : ""?>' >
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="precio_venta">Precio $</label>
  <input class="form-input" type="number" id="precio_venta" placeholder="Precio $" name="precio_venta" value='<?= isset($producto)? $producto->precio_venta : "" ?>'>
</div>

<div id="unidades" class="form-group">

  <label class="form-label" for="unidades">Unidades</label>
  <select class="form-select" name="unidad">
    <option disabled selected>Unidades</option>
 
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


<label class="form-label" for="contenedor-stock">Stock</label>
<!-- form input control -->
<div id="contenedor-stock" class="container contenedor-decorado">

  <!-- form switch control -->
  <div>Stock</div>
  <div class="form-group">
    <label class="form-switch">
      <input type="checkbox" checked name="usa_stock" ><i class="form-icon"></i></input>
    </label>
  </div>

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