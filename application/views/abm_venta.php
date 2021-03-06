<!-- llamo a css propio de la vista -->
<link href= "<?= base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
<!-- llamo a js propio de la vista -->
<SCRIPT src="<?= base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>

<!-- JSON CON LA INFORMACION DE LA VENTA (si la hubiese) -->
<div id="form_data" class="d-none">
  <?= json_encode($venta); ?>
</div><!-- FIN -->

<main class="margen">
<div class="seccion"><p>venta</p></div>
  <form id="form_venta">

    <!--ID VENTA -->
    <input id="id_venta" class="form-input d-none" type="hidden" name="id_venta" value=<?= $venta["id_venta"] ?> ><!-- FIN -->
    
    <p></p><!-- ESPACIO -->

    <!-- SELECTOR DE FECHA DE ENTREGA -->
    <input id="fecha" class="form-input" type="date" name="fecha" value="">
    <!-- FIN -->

    <p></p><!-- ESPACIO -->

    <!-- SELECTOR DE CLIENTES -->
    <?PHP 
      /*Si id_venta es igual a 0 significa que se va a crear una venta nueva
      Caso contrario, se trata de una actualizacion de una venta preexistente*/ 
    ?>

    <?PHP if($venta["id_venta"] == 0 ): ?>

    <input id="id_cliente" type="hidden" name="id_cuenta">
    <input id="cliente_nombre" class="form-input" type="text" readonly placeholder="Seleccionar cliente">
    <div id="agregar_nuevo_cliente">
      <a class="btn btn-primary" href="<?= base_url('clientes/abm') ?>" target="_blank">
      <i class="fas fa-users"></i> <i class="fas fa-plus"></i>
      </a>
    </div>

      <!-- INICIO SELECCIONADOR -->
      <div id="seleccionador1" class="seleccionador">
        <div class="modal">
          <a href="#close" class="modal-overlay" aria-label="Close"></a>
          <div class="modal-container">
            <div class="modal-header">
              <a id="s-cerrar" href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
              <div class="modal-title h5">Seleccionar Cliente</div>
              <p></p>
              <div class="input-group">
                <input id="s-buscador" type="text" class="form-input" placeholder="buscar" name="texto_busqueda" value="" autocomplete="off">
                <button class="btn btn-primary input-group-btn" type="button"><i class="fas fa-search"></i></button>
              </div>
            </div>
          <div class="modal-body">
            <div class="content">
              <ul class="menu">
              </ul>
            </div>
           </div>
          </div> 
        </div>
      </div><!-- FIN -->

    <?PHP else: ?>

        <?PHP if($venta["cliente"]["dado_de_baja"] == 0 ): ?>

          <strong>Cliente: <a href="<?= base_url('clientes/abm?id_cuenta=' . $venta['cliente']['id_cuenta']) ?>" target="_blank" > <?= $venta['cliente']['nombre'] ?> </a></strong>

        <?PHP else: ?>

          <strong>Cliente: <?= $venta['cliente']['nombre'] ?></strong>

        <?PHP endif; ?>
        
    <?PHP endif; ?><!-- FIN -->
   
    <p></p><!-- ESPACIO -->

    <!-- INICIO SELECCIONADOR -->
    <div id="seleccionador2" class="seleccionador">
      <div class="modal">
        <a href="#close" class="modal-overlay" aria-label="Close"></a>
        <div class="modal-container">
          <div class="modal-header">
            <a id="s-cerrar" href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
            <div class="modal-title h5">Seleccionar Producto</div>
            <p></p>
            <div class="input-group">
              <input id="s-buscador" type="text" class="form-input" placeholder="buscar" name="texto_busqueda" value="" autocomplete="off">
              <button class="btn btn-primary input-group-btn" type="button"><i class="fas fa-search"></i></button>
            </div>
          </div>
        <div class="modal-body">
          <div class="content">
            <ul class="menu">
            </ul>
          </div>
         </div>
        </div> 
      </div>
    </div><!-- FIN -->


    <p></p><!-- ESPACIO -->

    <!-- INICIO MODAL PRODUCTO -->
    <div id="modal_producto" class="modal modal-sm" data-modal-index="">
      <a id="cerrar_modal_producto" class="modal-overlay" aria-label="Close"></a>
      <div id="" class="modal-container m-2">
        <div class="m-2">
          <h5 id="modal_producto_titulo">Seleccione</h5>
        </div>
        <div class="form-group m-2">
          <label class="form-label" for="">Cantidad</label>
          <input id="cantidad-slider" class="slider tooltip" type="range" min="1" max="10" value="1">
          <input id="cantidad" class="form-input" type="number" min="1" value="">
          <label class="form-label" for="">Descuento</label>
          <div class="input-group">
            <input id="descuento" class="form-input" type="number" placeholder="Descuento" value="0" min="0" max="100">
            <button class="btn btn-primary input-group-btn" type="button">%</button>
          </div>
        </div>
        <p></p>
        <p></p>
        <div class="text-right m-2">
          <button id = "boton-eliminar" class="btn btn-secondary" type="button">Eliminar</button>
          <button id = "boton-ok" class="btn btn-primary " type="button">Ok</button>
        </div>
        <p></p>
      </div>
    </div> <!-- FIN -->

    <!-- PANEL DE PRODUCTOS -->
    <div id="panel_productos" class="panel">
      <div class="panel-header">
      <button id="boton_seleccionar_producto" type="button" class="btn">Seleccionar Producto</button>
        <div class="divider"></div>
        <!-- <div class="panel-title">Productos seleccionados</div> -->
      </div>
      <div class="panel-nav">
      </div>
      <div class="panel-body">
      </div>
      <div class="panel-footer">
      </div>
    </div><!-- FIN-->

    <p></p><!-- ESPACIO -->

    <!-- MODAL DE ELIMINAR VENTA -->
    <div id="eliminar_venta_dialog" class="modal modal-sm">
      <a class="modal-overlay cerrar_eliminar_venta_dialog" aria-label="Close"></a>
      <div class="modal-container m-2">
        <p></p>
        <div class="m-2">
          <h5>Eliminar esta venta</h5>
          <p></p>
          <p></p>
          <button  id="btn_eliminar_confirmado"class="btn" type="input" name="submit_btn" value="eliminar">Eliminar</button>
          <button class="btn btn-primary cerrar_eliminar_venta_dialog" type="button" >Cancelar</button>
        </div>
      </div>
    </div> <!-- FIN -->

    <!-- MODAL DE PRODUCTOS FALTANES -->
    <div id="faltantes" class="modal modal-sm">
      <a class="modal-overlay cerrar_faltantes" aria-label="Close"></a>
      <div class="modal-container m-2">
        <p></p>
        <div class="m-2">
          <h5>Stock Insuficiente</h5>
          <div id="lista_faltantes">
          </div>
          <button class="btn btn-primary cerrar_faltantes" type="button" >Aceptar</button>
        </div>
      </div>
    </div> <!-- FIN -->

    <?PHP 
      /*Si id_venta es igual a 0 significa que se va a crear una venta nueva
      por lo que solo se desplieagan los botones de DESCARTAR y GUARDAR,
      caso contrario aparecen los botones de DESCARTAR, ACTUALIZAR y ELIMINAR*/ 
    ?>
    <?PHP if($venta["id_venta"] == 0 ): ?>

      <div class="btn-group btn-group-block">
        <button id="btn_descartar" class="btn" type="button" onclick="location.href = <?= base_url(); ?>" >Descartar</button>
        <button id="btn_guardar" class="btn btn-primary" type="input" name="submit_btn" value="guardar">Guardar</button>
      </div>

    <?PHP else: ?>

      <div class="btn-group btn-group-block">
        <button id="btn_descartar" class="btn" type="button" onclick="location.href = <?= base_url(); ?>" >Descartar</button>
        <button id="btn_actualizar" class="btn btn-primary" type="input"  name="submit_btn" value="actualizar">Actualizar</button>
        <button id="btn_eliminar" class="btn" type="button">Eliminar</button>
      </div>

    <?PHP endif; ?>

  </form>
</main>