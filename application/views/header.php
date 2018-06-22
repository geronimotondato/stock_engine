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
        <a href=<?PHP echo base_url('ventas/abm_venta'); ?> ><button class="btn btn-action btn-primary"><i class="fas fa-shopping-cart"></i></button></a>
      </section>
    </header> <!-- FIN HEADER -->
    <!-- DRAWER LATERAL -->
    <ul id="drawer" class="menu absolute">
      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="ventas") echo 'active' ?>" >
          <i class="fas fa-clipboard-list"></i> Ventas
        </a>
      </li>
      <!-- menu divider -->
      <!-- <li class="divider"></li> -->
      <!-- menu item -->
<!--       <li class="menu-item">
        <a href  ="<?PHP // echo base_url('ventas/abm_venta') ?>"
          class ="<?PHP // if($this->session->flashdata('side_bar') =="venta") echo 'active' ?>" >
          <i class="fas fa-shopping-cart"></i> Venta
        </a>
      </li> -->
      <!-- menu divider -->
      <li class="divider"></li>


      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('productos') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="stock") echo 'active' ?>" >
          <i class="fas fa-box-open"></i> Productos
        </a>
      </li>

      <!-- menu divider -->
      <li class="divider"></li>


      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('clientes') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="clientes") echo 'active' ?>" >
          <i class="fas fa-users"></i> Clientes
        </a>
      </li>

      <!-- menu divider -->
      <li class="divider"></li>

      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('proveedores') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="proveedores") echo 'active' ?>" >
          <i class="fas fa-dolly"></i> Proveedores
        </a>
      </li>

      <!-- menu divider -->
      <li class="divider"></li>

      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('categorias') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="categorias") echo 'active' ?>" >
          <i class="fas fa-tags"></i> Categorías
        </a>
      </li>
      <!-- menu divider -->
      <li class="divider"></li>

      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('almacenes') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="almacenes") echo 'active' ?>" >
          <i class="fas fa-warehouse"></i> Almacenes
        </a>
      </li>
      <!-- menu divider -->
      <li class="divider"></li>

      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('movimientos') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="movimientos") echo 'active' ?>" >
          <i class="fas fa-exchange-alt"></i> Movimientos
        </a>
      </li>
      <!-- menu divider -->

      <li class="divider"></li>

      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('cuentas') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="cuentas") echo 'active' ?>" >
          <i class="fas fa-credit-card"></i> Cuentas
        </a>
      </li>
      <!-- menu divider -->
      <li class="divider"></li>

      <!-- menu item -->
      <li class="menu-item">
        <a href  ="<?PHP echo base_url('estadisticas') ?>"
          class ="<?PHP if($this->session->flashdata('side_bar') =="estadisticas") echo 'active' ?>" >
          <i class="fas fa-chart-pie"></i> Estadistícas
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