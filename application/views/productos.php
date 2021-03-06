<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main class="margen">
<div class="seccion"><p>Productos</p></div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Id Producto</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Stock</th>
    </tr>
  </thead>
  <tbody>

<?PHP foreach ($productos as $row): ?>

<tr>
  <td><?= $row->id_producto?></td>
  <td><?= $row->nombre?></td>
  <td><?= $row->precio_venta?></td>
  <td><?= (isset($row->stock))? $row->stock : "X"?></td>
</tr> 
<?PHP endforeach; ?>
  </tbody>
</table>


</main>