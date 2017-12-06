<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>
      <footer>
      <a href=<?PHP echo base_url('Inicio/nueva_orden'); ?> ><button id="nueva-orden" class="btn btn-action btn-primary circle absolute"><i class="icon icon-emoji"></i></button></a>
      </footer>

  </body>
</html>

