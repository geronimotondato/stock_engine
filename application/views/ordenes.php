<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main>

  <?PHP if($ordenes): ?>

  <?PHP foreach($ordenes as $orden): ?>

  <div class="container orden">
    <div class="columns">

        <div class="cabecera-orden column col-12">
        <table class="table">
          <thead>
            <tr>
              <th width=33%><?= $orden["nombre"];?></th>
              <th width=33%><?= $orden["fecha_entrega"]; ?></th>
              <th width=33%><?= $orden["ubicacion"]; ?></th>
            </tr>
          </thead>
        </table>
        </div>

      <div class="column col-12">



        <table class="table tabla-productos">
          <thead>
            <tr>
              <th>Prod</th>
              <th>Cant</th>
              <th>Desc%</th>
              <th>$</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?PHP foreach($orden["items"] as $item): ?>
            <tr>
              <td><?= $item["nombre"] ?></td>
              <td><?= $item["cantidad"]?></td>
              <td><?= $item["descuento"]?></td>
              <td><?= $item["precio_venta"]?></td>
              <td><?= $item["total"]?></td>
            </tr>
            <?PHP endforeach ?>
            <tr >
              <td colspan=5>######</td>
            </tr>
            <tr>
              <th colspan=3></th>
              <th>Total:</th>
              <th><?= $orden["total_orden"]?></th>
            </tr>
          </tbody>
        </table>

      </div>
        <div class="column col-6 acciones">
          <a class='btn btn-link' href="nueva_orden?id_orden=<?PHP echo $orden['id_orden'];?>">
           <i class='icon icon-2x icon-edit'></i></a>
         </div>
         <div class="column col-6 acciones">
           <form action="ordenes/finalizar_orden" method="post">
            <button id="finalizar-orden"class="btn btn-link" name="id_orden" value=<?PHP echo $orden['id_orden'];?>><i class='icon icon-2x icon-check'></i></button>
            </form>
        </div>

    </div>
  </div>

  <?PHP endforeach ?>

  <?PHP else: ?>
  <div id="no-hay-ordenes"> No hay ordenes pendientes </div>
  <?PHP endif; ?>
</main>
