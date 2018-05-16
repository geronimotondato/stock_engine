<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main>



<?PHP if($clientes): ?>

<?PHP foreach($clientes as $cliente): ?>

<div class="container cliente">
  <div class="columns">

      <div class="cabecera-cliente column col-12">
      <table class="table">
        <thead>
          <tr>
            <th width=80%><?= $cliente->nombre;?></th>
            <th width=10%>
            	
            <a class='btn btn-link' href="<?PHP echo base_url('clientes/abm_cliente?id_cliente='. $cliente->id_cliente) ?>">
             <i class='fa  fa-edit'></i></a>

            </th>
            <th width=10%>
            	
            <button class="btn btn-link expandir_cliente" type="button"><i class='far fa-eye'></i><i class='far fa-eye-slash'></i></button>

            </th>
          </tr>
        </thead>
      </table>
      </div>

    <div class="column col-12">

      <table class="table tabla-cliente">
          <tr>
            <th>Dirección</th>
            <th><?= $cliente->direccion ?></th>
          </tr>
          <tr>
            <th>Tel movil</th>
            <th><?= $cliente->tel_movil ?></th>
          </tr>
          <tr>
            <th>Tel fijo</th>
            <th><?= $cliente->tel_fijo ?></th>
          </tr>
          <tr>
            <th>Email</th>
            <th><?= $cliente->email ?></th>
          </tr>
          <tr>
            <th>Saldo deudor</th>
            <th><?= $cliente->saldo_deudor ?></th>
          </tr>
          <tr>
            <th>Saldo acreedor</th>
            <th><?= $cliente->saldo_acreedor ?></th>
          </tr>
      </table>

    </div>
  </div>
</div>

<?PHP endforeach ?>

<?PHP endif ?>



</main>