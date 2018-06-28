<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

<div class="seccion"><p>Lista marcas</p></div>

<p></p>
<form  action=<?= base_url("marcas/buscar_elemento") ?> method="POST">
<div class="input-group">
  <input id="buscador" type="text" class="form-input" placeholder="buscar" name="texto_busqueda" value="<?= (isset($texto_busqueda))? $texto_busqueda : '' ?>">
  <button class="btn btn-primary input-group-btn"><i class="fas fa-search"></i></button>
</div>
</form>

<p></p>

<?PHP if($marcas): ?>

<?PHP foreach($marcas as $marca): ?>

  <div class="marca">

    <div class="marca-nombre"><i class="fas fa-trademark"></i> <?= $marca->nombre;?>
    <button class="btn btn-link expandir_marca" type="button">
      <i class='fas fa-angle-right'></i>
      <i class='fas fa-angle-down'></i>
    </button>
     </div>
    <div class="acciones">
      <a class='btn btn-link' 
         href="<?PHP echo base_url('marcas/abm?id_marca='. $marca->id_marca) ?>">
         <i class='fa  fa-edit'></i>
      </a>


    </div>

     <table class="datos-marca">
      <tbody>

    </tbody>
     </table>

  </div>

<?PHP endforeach ?>

<?= (isset($paginador))? $paginador : "" ?>

<button id="agregar-marca" class="btn btn-primary"><i class="fas fa-trademark"></i> <i class="fas fa-plus"></i></button>
</main>

<?PHP else: ?>

<div class="empty">
  <div class="empty-icon">
    <i class="fas fa-trademark"></i>
  </div>
  <p class="empty-title h5">No hay marcas</p>
  <p class="empty-subtitle">Has click en el botón para crear un marca nuevo</p>
  <div class="empty-action">
    <button class="btn btn-primary"><a class="a-link" href="<?= base_url('marcas/abm') ?>">Nuevo marca<a></button>
  </div>
</div>

<?PHP endif; ?>
