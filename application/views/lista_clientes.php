<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main>



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
         <tr><td><i>Dirección:  </i><?= $cliente->direccion ?></td></tr>
         <tr><td><i>Email:  </i><?= $cliente->email ?></td></tr>
         <tr><td><i>Tel movil:  </i><?= $cliente->tel_movil ?></td></tr>
         <tr><td><i>Tel fijo:  </i><?= $cliente->tel_fijo ?></td></tr>
         <tr><td><i>S. deudor:  </i><?= $cliente->saldo_deudor ?></td></tr>
         <tr><td><i>S. acreedor:  </i><?= $cliente->saldo_acreedor ?></td></tr>
    </tbody>
     </table>

  </div>

<?PHP endforeach ?>

<?PHP endif ?>
<button id="agregar-cliente" class="btn btn-primary"><i class="fas fa-users"></i> <i class="fas fa-plus"></i></button>
</main>