<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="m-2">

  <form id="form_cliente">
  <fieldset <?= (isset($cliente) && $cliente->dado_de_baja)? "disabled" : "" ?> >

<input type="hidden" id="id_cliente"  name="id_cliente" value='<?= isset($cliente)? $cliente->id_cliente : "0" ?>' >

<div class="form-group">
  <label class="form-label" for="nombre">Nombre</label>
  <input class="form-input" type="text" id="nombre" placeholder="Nombre" name="nombre" value='<?= isset($cliente)? $cliente->nombre : "" ?>' >
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="direccion">Dirección</label>
  <input class="form-input" type="text" id="direccion" placeholder="Dirección" name="direccion" value='<?= isset($cliente)? $cliente->direccion : ""?>'>
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="tel_movil">Tel movíl</label>
  <input class="form-input" type="tel" id="tel_movil" placeholder="Tel Movíl" name="tel_movil" value='<?= isset($cliente)? $cliente->tel_movil : ""?>' >
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="tel_fijo">Tel fijo</label>
  <input class="form-input" type="text" id="tel_fijo" placeholder="Tel Fijo" name="tel_fijo" value='<?= isset($cliente)? $cliente->tel_fijo : "" ?>'>
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="email">E-Mail</label>
  <input class="form-input" type="text" id="email" placeholder="E-mail" name="email" value='<?= isset($cliente)? $cliente->email : "" ?>'>
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="saldo_deudor">Saldo deudor</label>
  <input class="form-input" type="text" id="saldo_deudor" placeholder="Saldo deudor" name="saldo_deudor" value='<?= isset($cliente)? $cliente->saldo_deudor : "" ?>'>
</div>

<!-- form input control -->
<div class="form-group">
  <label class="form-label" for="saldo_acreedor">Saldo acreedor</label>
  <input class="form-input" type="text" id="saldo_acreedor" placeholder="Saldo acreedor" name="saldo_acreedor" value='<?= isset($cliente)? $cliente->saldo_acreedor : "" ?>'>
</div>

</fieldset>

<p></p>


<?PHP if(isset($cliente)): ?>

<div class="btn-group btn-group-block">
  <button id="btn_descartar" class="btn" type="button" onclick="location.href = <?= base_url(); ?>" >Descartar</button>
  <button id="btn_actualizar" class="btn btn-primary" type="input"  name="submit_btn" value="actualizar">Actualizar</button>
  <button id="btn_eliminar" class="btn" type="button" value="eliminar">Eliminar</button>
</div>

<?PHP else: ?>

<div class="btn-group btn-group-block">
  <button id="btn_descartar" class="btn" type="button" onclick="location.href = <?= base_url(); ?>" >Descartar</button>
  <button id="btn_guardar" class="btn btn-primary" type="input" name="submit_btn" value="guardar">Guardar</button>
</div>

<?PHP endif; ?>

</form>

</main>