<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">

  <div class="seccion"><p>Lista Ordenes</p></div>

  <?PHP if($ordenes): ?>

  <?PHP foreach($ordenes as $orden): ?>

  <div class="container orden">
    <div class="columns">

      <div class="cabecera-orden col-10">
        <table >
          <thead>
            <tr>
              <th>→ <?= $orden["nombre"];?></th>
            </tr>
            <tr>
              <th>→ <?= $orden["fecha_entrega"]; ?></th>
            </tr>
            <tr>
              <th>→ <?= $orden["direccion"]; ?></th>
            </tr>
          </thead>
        </table>
        </div>

      <div class="acciones  col-2">
        <table>
          <tbody>
            <tr><td>
              <button class="btn btn-link expandir_orden" type="button">
              <i class='far fa-eye'></i><i class='far fa-eye-slash'></i>
              </button>
            </td></tr>
            <tr><td>
            <button class='btn btn-link'>
              <a href="orden?id_orden=<?PHP echo $orden['id_orden'];?>">
              <i class='fa  fa-edit'></i></a>
            </button>
            </td></tr>
            <tr><td>
              <button class="btn btn-link finalizar_orden" type="button" value=<?PHP echo $orden['id_orden'];?>>
              <i class='fas fa-clipboard-check'></i>
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
            <?PHP foreach($orden["items"] as $item): ?>
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
              <td><strong><?= $orden["total_orden"]?></strong></td>
            </tr>
          </tbody>
        </table>

      </div>

    </div>
  </div>

  <?PHP endforeach ?>

  <!-- MODAL DE FINALIZAR ORDEN -->
  <div id="finalizar_orden_dialog" class="modal modal-sm">
    <a class="modal-overlay cerrar_finalizar_orden_dialog" aria-label="Close"></a>
    <div class="modal-container m-2">
      <p></p>
      <div class="m-2">
        <h5>Finalizar esta orden</h5>
        <p></p>
        <p></p>
          <button id="aceptar_finalizar_orden" class="btn btn-primary"  type="submit" name="id_orden" value="" >Aceptar</button>
        <button class="btn cerrar_finalizar_orden_dialog" type="button" >Cancelar</button>
      </div>
    </div>
  </div> <!--FIN MODAL -->

  <?PHP else: ?>
  <div class="empty">
    <div class="empty-icon">
      <i class="fas fa-truck"></i>
    </div>
    <p class="empty-title h5">No hay ordenes</p>
    <p class="empty-subtitle">Has click en el botón para iniciar una nueva orden</p>
    <div class="empty-action">
      <button class="btn btn-primary"><a class="a-link" href="orden">Nueva Orden<a></button>
    </div>
  </div>
  <?PHP endif; ?>
</main>
