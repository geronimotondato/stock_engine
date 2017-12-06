<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type"/>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Stockeng</title>
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
    <!-- llamo a css propio de la vista -->
    <link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
    <!-- llamo a js propio de la vista -->
    <SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>
    </meta>
  </head>
  <body>

    <ul id="drawer" class="menu absolute">
      <li class="divider" data-content="StockENG"></li>
      <!-- menu item -->
      <li class="menu-item">
        <a href="#" class="active">
          <i class="icon icon-link"></i> Ordenes
        </a>
      </li>
      <!-- menu divider -->
      <li class="divider"></li>

      <li class="menu-item">
        <a href="#">
          <i class="icon icon-link"></i> Entregar
        </a>
      </li>
    </ul>

    <div id="drawer-modal"></div>

    <header class="navbar">
      <section class="navbar-section">
        <a id="drawer-toggle" class="btn btn-link"><i class="icon icon-menu"></i></a>
      </section>
      <section class="navbar-center">
        <h4>StockENG <i class="icon icon-apps"></i></h4>
      </section>
      <section class="navbar-section">
        <a href="<?PHP echo base_url('') ?>Login/log_out" class="btn btn-link"><i class="icon icon-shutdown"></i></a>
      </section>
    </header>
    <div class="divider"></div>