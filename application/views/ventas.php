<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

  <div class="seccion"><p>Ventas</p></div>

  <?PHP if($ventas): ?>

  <?PHP foreach($ventas as $venta): ?>

  <div class="container venta">
    <div class="columns">

      <div class="cabecera-venta col-10">
        <table >
          <thead>
            <tr>
              <th>→ <?= $venta["nombre"];?></th>
            </tr>
            <tr>
            <?PHP
              $aaaa_mm_dd = explode("-", $venta["fecha_venta"]);
            ?>
              <th>→ <?= $aaaa_mm_dd[2] . '/' . $aaaa_mm_dd[1] . '/' . $aaaa_mm_dd[0]?></th>
            </tr>
            <tr>
              <th>→ <?= $venta["direccion"]; ?></th>
            </tr>
          </thead>
        </table>
        </div>

      <div class="acciones  col-2">
        <table>
          <tbody>
            <tr><td>
              <button class="btn btn-link expandir_venta" type="button">
              <i class='far fa-eye'></i><i class='far fa-eye-slash'></i>
              </button>
            </td></tr>
            <tr><td>
            <button class='btn btn-link'>
              <a href="ventas/abm_venta?id_venta=<?PHP echo $venta['id_venta'];?>">
              <i class='fa  fa-edit'></i></a>
            </button>
            </td></tr>
            <tr><td>
              <button class="btn btn-link finalizar_venta" type="button" value=<?PHP echo $venta['id_venta'];?>>
              <i class='fas fa-dollar-sign'></i>
              </button>
            </td></tr>
          </tbody>
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
            <?PHP foreach($venta["items"] as $item): ?>
            <tr>
              <td><?= $item["nombre"] ?></td>
              <td><?= $item["cantidad"]?></td>
              <td><?= $item["descuento"]?></td>
              <td><?= $item["precio_venta"]?></td>
              <td><?= $item["total"]?></td>
            </tr>
            <?PHP endforeach ?>
            <tr>
              <td colspan=5>######</td>
            </tr>
            <tr>
              <td colspan=3></td>
              <td><strong>Total:</strong></td>
              <td><strong><?= $venta["total_venta"]?></strong></td>
            </tr>
          </tbody>
        </table>

      </div>

    </div>
  </div>

  <?PHP endforeach ?>

  <?= $paginador ?>

  <!-- MODAL DE FINALIZAR venta -->
  <div id="finalizar_venta_dialog" class="modal modal-sm">
    <a class="modal-overlay cerrar_finalizar_venta_dialog" aria-label="Close"></a>
    <div class="modal-container m-2">
      <p></p>
      <div class="m-2">
        <h5>Finalizar esta venta</h5>
        <p></p>
        <p></p>
          <button id="aceptar_finalizar_venta" class="btn btn-primary"  type="submit" name="id_venta" value="" >Aceptar</button>
        <button class="btn cerrar_finalizar_venta_dialog" type="button" >Cancelar</button>
      </div>
    </div>
  </div> <!--FIN MODAL -->

  <?PHP else: ?>
  <div class="empty">
    <div class="empty-icon">
      <i class="fas fa-shopping-cart"></i>
    </div>
    <p class="empty-title h5">No hay ventas</p>
    <p class="empty-subtitle">Has click en el botón para iniciar una nueva venta</p>
    <div class="empty-action">
      <button class="btn btn-primary"><a class="a-link" href="<?= base_url('ventas/abm_venta') ?>">Nueva venta<a></button>
    </div>
  </div>
  <?PHP endif; ?>
</main>
