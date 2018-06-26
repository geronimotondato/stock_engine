<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

<div class="seccion"><p>Lista proveedores</p></div>

<p></p>
<form  action=<?= base_url("proveedores/buscar_elemento") ?> method="POST">
<div class="input-group">
  <input id="buscador" type="text" class="form-input" placeholder="buscar" name="texto_busqueda" value="<?= (isset($texto_busqueda))? $texto_busqueda : '' ?>">
  <button class="btn btn-primary input-group-btn"><i class="fas fa-search"></i></button>
</div>
</form>

<p></p>

<?PHP if($proveedores): ?>

<?PHP foreach($proveedores as $proveedor): ?>

  <div class="proveedor">

    <div class="proveedor-nombre"><i class="fas fa-dolly"></i> <?= $proveedor->nombre;?>
    <button class="btn btn-link expandir_proveedor" type="button">
      <i class='fas fa-angle-right'></i>
      <i class='fas fa-angle-down'></i>
    </button>
     </div>
    <div class="acciones">
      <a class='btn btn-link' 
         href="<?PHP echo base_url('proveedores/abm?id_cuenta='. $proveedor->id_cuenta) ?>">
         <i class='fa  fa-edit'></i>
      </a>


    </div>

     <table class="datos-proveedor">
      <tbody>
         <tr><td><i>Dirección:</i></td><td><?= $proveedor->direccion ?></td></tr>
         <tr><td><i>Email:</i></td><td><?= $proveedor->email ?></td></tr>
         <tr><td><i>Tel movil:</i></td><td><?= $proveedor->tel_movil ?></td></tr>
         <tr><td><i>Tel fijo:</i></td><td><?= $proveedor->tel_fijo ?></td></tr>
         <tr><td><i>Saldo:</i></td><td><?= $proveedor->saldo ?></td></tr>
    </tbody>
     </table>

  </div>

<?PHP endforeach ?>

<?= (isset($paginador))? $paginador : "" ?>

<button id="agregar-proveedor" class="btn btn-primary"><i class="fas fa-dolly"></i> <i class="fas fa-plus"></i></button>
</main>

<?PHP else: ?>

<div class="empty">
  <div class="empty-icon">
    <i class="fas fa-dolly"></i>
  </div>
  <p class="empty-title h5">No hay proveedores</p>
  <p class="empty-subtitle">Has click en el botón para crear un proveedor nuevo</p>
  <div class="empty-action">
    <button class="btn btn-primary"><a class="a-link" href="<?= base_url('proveedores/abm') ?>">Nuevo proveedor<a></button>
  </div>
</div>

<?PHP endif; ?>
