<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

<div class="seccion"><p>proveedor</p></div>

  <form id="form_proveedor">
  <fieldset <?= (isset($proveedor) && $proveedor->dado_de_baja)? "disabled" : "" ?> >

  <?PHP if(isset($proveedor)): ?>
    <input type="hidden" id="id_cuenta"  name="id_cuenta" value='<?= $proveedor->id_cuenta ?>' >
  <?PHP endif; ?>

<div class="form-group">
  <label class="form-label" for="nombre">Nombre</label>
  <input class="form-input" type="text" id="nombre" placeholder="Nombre" name="nombre" value='<?= isset($proveedor)? $proveedor->nombre : "" ?>' >
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="direccion">Dirección</label>
  <input class="form-input" type="text" id="direccion" placeholder="Dirección" name="direccion" value='<?= isset($proveedor)? $proveedor->direccion : ""?>'>
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="tel_movil">Tel movíl</label>
  <input class="form-input" type="tel" id="tel_movil" placeholder="Tel Movíl" name="tel_movil" value='<?= isset($proveedor)? $proveedor->tel_movil : ""?>' >
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="tel_fijo">Tel fijo</label>
  <input class="form-input" type="text" id="tel_fijo" placeholder="Tel Fijo" name="tel_fijo" value='<?= isset($proveedor)? $proveedor->tel_fijo : "" ?>'>
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="email">E-Mail</label>
  <input class="form-input" type="text" id="email" placeholder="E-mail" name="email" value='<?= isset($proveedor)? $proveedor->email : "" ?>'>
</div>

<!-- form input control -->


<div class="container">
 <label class="form-label" for="saldo">Saldo</label>
  <div class="columns">

    <div class="column col-4">
      <div class="input-group">
        <input readonly class="form-input" type="text" id="saldo" placeholder="Saldo" name="saldo" value='<?= isset($proveedor)? $proveedor->saldo : "" ?>'>
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








</fieldset>

<p></p>


<?PHP if(isset($proveedor)): ?>

<!-- MODAL DE ELIMINAR proveedor -->
<div id="eliminar_proveedor_dialog" class="modal modal-sm">
  <a class="modal-overlay cerrar_eliminar_proveedor_dialog" aria-label="Close"></a>
  <div class="modal-container m-2">
    <p></p>
    <div class="m-2">
      <h5>Dar de baja a este proveedor</h5>
      <p></p>
      <p></p>
      <button id="btn_eliminar" class="btn" type="button" value="eliminar">Eliminar</button>
      <button class="btn btn-primary cerrar_eliminar_proveedor_dialog" type="button" >Cancelar</button>
    </div>
  </div>
</div> <!--FIN MODAL -->

<div class="btn-group btn-group-block">
  <button id="btn_descartar" class="btn" type="button" onclick="location.href = '<?= base_url("proveedores"); ?>'" >Descartar</button>
  <button id="btn_actualizar" class="btn btn-primary" type="input"  name="submit_btn" value="actualizar">Actualizar</button>
  <button id="eliminar_proveedor" class="btn btn-secundary"  type="button">Eliminar</button>

</div>

<?PHP else: ?>

<div class="btn-group btn-group-block">
  <button id="btn_descartar" class="btn" type="button" onclick="location.href = '<?= base_url("proveedores"); ?>'" >Descartar</button>
  <button id="btn_guardar" class="btn btn-primary" type="input" name="submit_btn" value="guardar">Guardar</button>
</div>

<?PHP endif; ?>

</form>

</main>