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
    <tr>
      <td>producto</td>
      <td>5</td>
      <td>15.5</td>
      <td>20</td>
      <td>20</td>
      <td>40</td>
    </tr>
    <tr>
      <td>producto</td>
      <td>5</td>
      <td>15.5</td>
      <td>20</td>
      <td>20</td>
      <td>40</td>
    </tr>
    <tr>
      <td>producto</td>
      <td>5</td>
      <td>15.5</td>
      <td>20</td>
      <td>20</td>
      <td>40</td>
    </tr>
  </tbody>
</table>


</main>