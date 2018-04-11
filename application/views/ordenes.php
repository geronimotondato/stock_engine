<!-- llamo a css propio de la vista -->
<link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<main>

  <?PHP if($ordenes): ?>

  <?PHP foreach($ordenes as $orden): ?>



  <div class="tile">
    <div class="tile-icon">
      <div class="example-tile-icon">
        <i class="icon icon-file centered"></i>
      </div>
    </div>
    <div class="tile-content">
      <p class="tile-title"><?PHP echo $orden["nombre"];?> | <?PHP echo $orden["fecha_entrega"]; ?> | <?PHP echo $orden["ubicacion"]; ?> </p>
      <p class="tile-subtitle">

        <?PHP foreach($orden["items"] as $item): ?>
        <li> <?PHP echo $item["nombre"] . " Cant: ". $item["cantidad"]. " desc: ". $item["descuento"] ?> </li>
        <?PHP endforeach ?>
      </p>
    </div>
    <div class="tile-action">
      <a class='btn btn-link' href="nueva_orden?id_orden=<?PHP echo $orden['id_orden'];?>">
       <i class='icon icon-2x icon-edit'></i></a>


       <form action="ordenes/finalizar_orden" method="post">
          <button class="btn btn-link" name="id_orden" value=<?PHP echo $orden['id_orden'];?>><i class='icon icon-2x icon-check'></i></button>
       </form>
       
     </div>

   </div>
   
   <?PHP endforeach ?>

   <?PHP else: ?>
   <div id="no-hay-ordenes"> No hay ordenes pendientes </div>
   <?PHP endif; ?>
 </main>
