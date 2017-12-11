<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Stockeng</title>
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
    <!-- llamo a css propio de la vista -->
    <link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
    <!-- llamo a js propio de la vista -->
    <SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>
  </head>
  <body>
    <!-- HEADER -->
    <header class="navbar p-1">
      <section class="navbar-section">
        <button id="drawer-toggle" class="btn btn-action btn-primary ">
        <i class="icon icon-menu"></i></button>
      </section>
      <section class="navbar-center">
        <div class="btn btn-link">StockENG <i class="icon icon-stock"></i></div>
      </section>
      <section class="navbar-section">
        <a href=<?PHP echo base_url('Nueva_orden'); ?> ><button class="btn btn-action btn-primary icon-truck-white"></button></a>
      </section>
      </header> <!-- FIN HEADER -->
      <!-- DRAWER LATERAL -->
      <ul id="drawer" class="menu absolute">
        <!-- menu item -->
        <li class="menu-item">
          <a href  ="<?PHP echo base_url('') ?>"
            class ="<?PHP if($this->session->flashdata('header_tab') =="dashboard") echo 'active' ?>" >
            <i class="icon icon-orden"></i> Ordenes
          </a>
        </li>
        <!-- menu divider -->
        <li class="divider"></li>
        <!-- menu item -->
        <li class="menu-item">
          <a href  ="<?PHP echo base_url('Nueva_orden') ?>"
            class ="<?PHP if($this->session->flashdata('header_tab') =="nueva_orden") echo 'active' ?>" >
            <i class="icon icon-truck-black"></i> Nueva Orden
          </a>
        </li>
        <!-- menu divider -->
        <li class="divider"></li>
        <!-- menu item -->
        <li class="menu-item">
          <a href="<?PHP echo base_url('') ?>Login/log_out">
            <i class="icon icon-shutdown"></i> Salir
          </a>
        </li>
        </ul> <!-- FIN DRAWER -->
        <div id="drawer-modal"></div> <!-- MODAL DEL DRAWER -->