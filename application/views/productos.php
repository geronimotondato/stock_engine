<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">
<div class="seccion"><p>Productos</p></div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Unid.</th>
      <th>Precio</th>
      <th>Disp.</th>
      <th>Comp.</th>
      <th>En_total</th>
    </tr>
  </thead>
  <tbody>

<?PHP foreach ($productos as $row): ?>

<tr>
  <td><?= $row->producto?></td>
  <td><?= (isset($row->stock_total))? $row->unidades : "X"?></td>
  <td><?= $row->precio_venta?></td>
  <td><?= (isset($row->stock_total))? $row->disponibles : "X"?></td>
  <td><?= (isset($row->stock_total))? $row->comprometidos : "X" ?></td>
  <td><?= (isset($row->stock_total))? $row->stock_total : "X"?></td>
</tr> 
<?PHP endforeach; ?>
  </tbody>
</table>


</main>