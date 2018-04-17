<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Unidades</th>
      <th>Precio Venta</th>
      <th>Disponibles</th>
      <th>Comprometidos</th>
      <th>Reales</th>
    </tr>
  </thead>
  <tbody>

<?PHP foreach ($productos as $row): ?>
<tr>
  <td><?= $row->producto?></td>
  <td><?= $row->unidades?></td>
  <td><?= $row->precio_venta?></td>
  <td><?= $row->disponibles?></td>
  <td><?= $row->comprometidos?></td>
  <td><?= $row->stock_total?></td>
</tr>
<?PHP endforeach; ?>
  </tbody>
</table>


</main>