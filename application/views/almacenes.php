<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

<div class="seccion"><p>Lista almacenes</p></div>

<p></p>
<form  action=<?= base_url("almacenes/buscar_almacen") ?> method="POST">
<div class="input-group">
  <input id="buscador" type="text" class="form-input" placeholder="buscar" name="texto_busqueda" value="<?= (isset($texto_busqueda))? $texto_busqueda : '' ?>">
  <button class="btn btn-primary input-group-btn"><i class="fas fa-search"></i></button>
</div>
</form>

<p></p>

<?PHP if($almacenes): ?>

<?PHP foreach($almacenes as $almacen): ?>

  <div class="almacen">

    <div class="almacen-nombre"><i class="fas fa-warehouse"></i> <?= $almacen->nombre;?>
    <button class="btn btn-link expandir_almacen" type="button">
      <i class='fas fa-angle-right'></i>
      <i class='fas fa-angle-down'></i>
    </button>
     </div>
    <div class="acciones">
      <a class='btn btn-link' 
         href="<?PHP echo base_url('almacenes/abm_almacen?id_almacen='. $almacen->id_almacen) ?>">
         <i class='fa  fa-edit'></i>
      </a>


    </div>

     <table class="datos-almacen">
      <tbody>
         <tr><td><i>Dirección:</i></td><td><?= $almacen->direccion ?></td></tr>
         <tr><td><i>Telefono:</i></td><td><?= $almacen->telefono ?></td></tr>
    </tbody>
     </table>

  </div>

<?PHP endforeach ?>

<?= (isset($paginador))? $paginador : "" ?>

<button id="agregar-almacen" class="btn btn-primary"><i class="fas fa-warehouse"></i> <i class="fas fa-plus"></i></button>
</main>

<?PHP else: ?>

<div class="empty">
  <div class="empty-icon">
    <i class="fas fa-warehouse"></i>
  </div>
  <p class="empty-title h5">No hay almacenes</p>
  <p class="empty-subtitle">Has click en el botón para crear una categoría nueva</p>
  <div class="empty-action">
    <button class="btn btn-primary"><a class="a-link" href="<?= base_url('almacenes/abm_almacen') ?>">Nueva categoría<a></button>
  </div>
</div>

<?PHP endif; ?>
