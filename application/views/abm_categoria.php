<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

<div class="seccion"><p>categoría</p></div>

<form id="form_categoria">
<fieldset >

<?PHP if(isset($categoria)): ?>
  <input type="hidden" id="id_categoria"  name="id_categoria" value='<?= $categoria->id_categoria ?>' >
<?PHP endif; ?>

<div class="form-group">
  <label class="form-label" for="nombre">Nombre</label>
  <input class="form-input" type="text" id="nombre" placeholder="Nombre" name="nombre" value='<?= isset($categoria)? $categoria->nombre : "" ?>' >
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="direccion">Descripción</label>
  <textarea class="form-input" type="text" id="direccion" placeholder="Descripcion" name="descripcion" rows="3"><?= isset($categoria)? $categoria->descripcion : ""?></textarea>
</div>

</fieldset>

<p></p>


<?PHP if(isset($categoria)): ?>

  <!-- MODAL DE ELIMINAR categoria -->
  <div id="eliminar_categoria_dialog" class="modal modal-sm">
    <a class="modal-overlay cerrar_eliminar_categoria_dialog" aria-label="Close"></a>
    <div class="modal-container m-2">
      <p></p>
      <div class="m-2">
        <h5>Dar de baja esta categoría</h5>
        <p></p>
        <p></p>
        <button id="btn_eliminar" class="btn" type="button" value="eliminar">Eliminar</button>
        <button class="btn btn-primary cerrar_eliminar_categoria_dialog" type="button" >Cancelar</button>
      </div>
    </div>
  </div> <!--FIN MODAL -->

  <div class="btn-group btn-group-block">
    <button id="btn_descartar" class="btn" type="button" onclick="location.href = '<?= base_url("categorias"); ?>'" >Descartar</button>
    <button id="btn_actualizar" class="btn btn-primary" type="input"  name="submit_btn" value="actualizar">Actualizar</button>
    <button id="eliminar_categoria" class="btn btn-secundary"  type="button">Eliminar</button>
  </div>

<?PHP else: ?>

  <div class="btn-group btn-group-block">
    <button id="btn_descartar" class="btn" type="button" onclick="location.href = '<?= base_url("categorias"); ?>'" >Descartar</button>
    <button id="btn_guardar" class="btn btn-primary" type="input" name="submit_btn" value="guardar">Guardar</button>
  </div>

<?PHP endif; ?>

</form>

</main>