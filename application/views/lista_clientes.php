<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

<div class="seccion"><p>Lista Clientes</p></div>


<?PHP if($clientes): ?>

<?PHP foreach($clientes as $cliente): ?>

  <div class="cliente">

    <div class="cliente-nombre"><?= $cliente->nombre;?>
    <button class="btn btn-link expandir_cliente" type="button">
      <i class='fas fa-angle-right'></i>
      <i class='fas fa-angle-down'></i>
    </button>
     </div>
    <div class="acciones">
      <a class='btn btn-link' 
         href="<?PHP echo base_url('clientes/abm_cliente?id_cliente='. $cliente->id_cliente) ?>">
         <i class='fa  fa-edit'></i>
      </a>


    </div>

     <table class="datos-cliente">
      <tbody>
         <tr><td><i>Dirección:</i></td><td><?= $cliente->direccion ?></td></tr>
         <tr><td><i>Email:</i></td><td><?= $cliente->email ?></td></tr>
         <tr><td><i>Tel movil:</i></td><td><?= $cliente->tel_movil ?></td></tr>
         <tr><td><i>Tel fijo:</i></td><td><?= $cliente->tel_fijo ?></td></tr>
         <tr><td><i>Saldo:</i></td><td><?= $cliente->saldo ?></td></tr>
    </tbody>
     </table>

  </div>

<?PHP endforeach ?>

<button id="agregar-cliente" class="btn btn-primary"><i class="fas fa-users"></i> <i class="fas fa-plus"></i></button>
</main>

<?PHP else: ?>

<div class="empty">
  <div class="empty-icon">
    <i class="fas fa-users"></i>
  </div>
  <p class="empty-title h5">No hay clientes</p>
  <p class="empty-subtitle">Has click en el botón para crear un cliente nuevo</p>
  <div class="empty-action">
    <button class="btn btn-primary"><a class="a-link" href="clientes/abm_cliente">Nuevo Cliente<a></button>
  </div>
</div>

<?PHP endif; ?>
