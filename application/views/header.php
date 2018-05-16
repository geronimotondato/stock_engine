<!DOCTYPE html>
<html>
<head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-type">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>Stockeng</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


  <!-- llamo a css propio de la vista -->
  <link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
  <!-- llamo a js propio de la vista -->
  <SCRIPT src="<?PHP echo base_url( 'resources/js/'. basename(__FILE__, '.php') . '.js'); ?>" type="text/javascript"></SCRIPT>
    <SCRIPT src="<?PHP echo base_url( 'resources/js/'. 'global' . '.js'); ?>" type="text/javascript"></SCRIPT>
</head>
<body>
  <!-- HEADER -->
  <header class="navbar p-1">
    <section class="navbar-section">
      <button id="drawer-toggle" class="btn btn-action btn-primary ">
        <i class="fas fa-bars"></i></button>
      </section>
      <section class="navbar-center">
        <div class="btn btn-link">StockENG <i class="fas fa-boxes"></i></div>
      </section>
      <section class="navbar-section">
        <a href=<?PHP echo base_url('orden'); ?> ><button class="btn btn-action btn-primary"><i class="fas fa-truck"></i></button></a>
      </section>
    </header> <!-- FIN HEADER -->
    <!-- DRAWER LATERAL -->
    <ul id="drawer" class="menu absolute">
      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="ordenes") echo 'active' ?>" >
          <i class="fas fa-clipboard-list"></i> Lista Ordenes
        </a>
      </li>
      <!-- menu divider -->
      <li class="divider"></li>
      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('orden') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="orden") echo 'active' ?>" >
          <i class="fas fa-truck"></i> Orden
        </a>
      </li>
      <!-- menu divider -->
      <li class="divider"></li>


      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('Stock') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="stock") echo 'active' ?>" >
          <i class="fas fa-boxes"></i> Stock
        </a>
      </li>

      <!-- menu divider -->
      <li class="divider"></li>


      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('Clientes') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="clientes") echo 'active' ?>" >
          <i class="fas fa-users"></i> Clientes
        </a>
      </li>
      <!-- menu divider -->
      <li class="divider"></li>

      <!-- menu item -->
      <li class="menu-item">
        <a href="<?PHP echo base_url('') ?>Login/log_out">
          <i class="fas fa-sign-out-alt"></i> Salir
        </a>
      </li>
    </ul> <!-- FIN DRAWER -->
        <div id="drawer-modal"></div> <!-- MODAL DEL DRAWER -->