<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

<div class="seccion"><p>Lista cuentas</p></div>

<p></p>
<form  action=<?= base_url("cuentas/buscar_elemento") ?> method="POST">
<div class="input-group">
  <input id="buscador" type="text" class="form-input" placeholder="buscar" name="texto_busqueda" value="<?= (isset($texto_busqueda))? $texto_busqueda : '' ?>">
  <button class="btn btn-primary input-group-btn"><i class="fas fa-search"></i></button>
</div>
</form>

<p></p>

<?PHP if($cuentas): ?>

<?PHP foreach($cuentas as $cuenta): ?>

  <div class="cuenta">

    <div class="cuenta-nombre"><i class="fas fa-user"></i> <?= $cuenta->nombre;?>
    <button class="btn btn-link expandir_cuenta" type="button">
      <i class='fas fa-angle-right'></i>
      <i class='fas fa-angle-down'></i>
    </button>
     </div>
    <div class="acciones">
      <a class='btn btn-link' 
         href="<?PHP echo base_url('cuentas/abm?id_cuenta='. $cuenta->id_cuenta) ?>">
         <i class='fa  fa-edit'></i>
      </a>


    </div>

     <table class="datos-cuenta">
      <tbody>
         <tr><td><i>Descripción:</i></td><td><?= $cuenta->descripcion ?></td></tr>
         <tr><td><i>Saldo:</i></td><td><?= $cuenta->saldo ?></td></tr>
         <tr><td><i>Codigo:</i></td><td><?= $cuenta->codigo ?></td></tr>
    </tbody>
     </table>

  </div>

<?PHP endforeach ?>

<?= (isset($paginador))? $paginador : "" ?>

<button id="agregar-cuenta" class="btn btn-primary"><i class="fas fa-credit-card"></i> <i class="fas fa-plus"></i></button>
</main>

<?PHP else: ?>

<div class="empty">
  <div class="empty-icon">
    <i class="fas fa-credit-card"></i>
  </div>
  <p class="empty-title h5">No hay cuentas</p>
  <p class="empty-subtitle">Has click en el botón para crear una cuenta nueva</p>
  <div class="empty-action">
    <button class="btn btn-primary"><a class="a-link" href="<?= base_url('cuentas/abm') ?>">Nueva cuenta<a></button>
  </div>
</div>

<?PHP endif; ?>
