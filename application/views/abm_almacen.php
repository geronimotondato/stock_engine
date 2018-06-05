<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

<div class="seccion"><p>Almacen</p></div>

<form id="form_almacen">
<fieldset >

<?PHP if(isset($almacen)): ?>
  <input type="hidden" id="id_almacen"  name="id_almacen" value='<?= $almacen->id_almacen ?>' >
<?PHP endif; ?>

<div class="form-group">
  <label class="form-label" for="nombre">Nombre</label>
  <input class="form-input" type="text" id="nombre" placeholder="Nombre" name="nombre" value='<?= isset($almacen)? $almacen->nombre : "" ?>' >
</div>
<div class="form-group">
  <label class="form-label" for="nombre">Direccion</label>
  <input class="form-input" type="text" id="direccion" placeholder="Dirección" name="direccion" value='<?= isset($almacen)? $almacen->direccion : "" ?>' >
</div>
<div class="form-group">
  <label class="form-label" for="nombre">Teléfono</label>
  <input class="form-input" type="text" id="telefono" placeholder="Teléfono" name="telefono" value='<?= isset($almacen)? $almacen->telefono : "" ?>' >
</div>


</fieldset>

<p></p>


<?PHP if(isset($almacen)): ?>

  <!-- MODAL DE ELIMINAR almacen -->
  <div id="eliminar_almacen_dialog" class="modal modal-sm">
    <a class="modal-overlay cerrar_eliminar_almacen_dialog" aria-label="Close"></a>
    <div class="modal-container m-2">
      <p></p>
      <div class="m-2">
        <h5>Dar de baja esta almacen</h5>
        <p></p>
        <p></p>
        <button id="btn_eliminar" class="btn" type="button" value="eliminar">Eliminar</button>
        <button class="btn btn-primary cerrar_eliminar_almacen_dialog" type="button" >Cancelar</button>
      </div>
    </div>
  </div> <!--FIN MODAL -->

  <div class="btn-group btn-group-block">
    <button id="btn_descartar" class="btn" type="button" onclick="location.href = '<?= base_url("almacenes"); ?>'" >Descartar</button>
    <button id="btn_actualizar" class="btn btn-primary" type="input"  name="submit_btn" value="actualizar">Actualizar</button>
    <button id="eliminar_almacen" class="btn btn-secundary"  type="button">Eliminar</button>
  </div>

<?PHP else: ?>

  <div class="btn-group btn-group-block">
    <button id="btn_descartar" class="btn" type="button" onclick="location.href = '<?= base_url("almacenes"); ?>'" >Descartar</button>
    <button id="btn_guardar" class="btn btn-primary" type="input" name="submit_btn" value="guardar">Guardar</button>
  </div>

<?PHP endif; ?>

</form>

</main>