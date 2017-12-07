<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type"/>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Stockeng</title>
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
    <link href= "<?PHP echo base_url( 'resources/css/'. basename(__FILE__, '.php') . '.css'); ?>" rel="stylesheet">
    </meta>
  </head>
  <body>
      <main>

        <div id="login-card" class="card">
          <div class="card-header">
            <div class="card-title h5">StockENG <i class="icon icon-apps"></i></div>
            <div class="card-subtitle text-gray">Control de stock by "El Mariskal"</div>
          </div>
          <div class="card-body">
            
          <form action="Login/log_in" method="POST">
            <div class="form-group">

              <label class="form-label" for="input-usuario">Usuario</label>
              <input class="form-input" type="text" id="input-usuario" placeholder="Usuario" name="user">
              <p></p>
              <label class="form-label" for="input-contrasena">Contraseña</label>
              <input class="form-input" type="password" id="input-contrasena" placeholder="Contraseña" name="pass">
              <p></p>
              <button class="btn" type="submit">INGRESAR</button>
            </div>
          </form>

          </div>
          <div class="card-footer">
            <?PHP if(null !== ($this->session->flashdata('mensaje'))): ?>
            <div class="toast toast-error"><?PHP echo $this->session->flashdata('mensaje'); ?></div>
            <?PHP endif ?>
          </div>
        </div>

      </main>
      <footer>
      </footer>
  </body>
</html>