<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type"/>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Stockeng</title>
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
    </meta>
  </head>
  <body>
      <main>
        <div class="panel">
          <div class="panel-header">
            <div class="panel-title">
                <h2>StockENG <i class="icon icon-2x icon-apps"></i></h2>
            </div>

          </div>
          <div class="panel-nav">
            <!-- navigation components: tabs, breadcrumbs or pagination -->
          </div>
          <div class="panel-body">
            <!-- contents -->

            <form action="Login/log_in" method="POST">
              <div class="form-group">

                <label class="form-label" for="input-usuario">Usuario</label>
                <input class="form-input" type="text" id="input-usuario" placeholder="Usuario" name="user">
                <p></p>
                <label class="form-label" for="input-contrasena">Contraseña</label>
                <input class="form-input" type="text" id="input-contrasena" placeholder="Contraseña" name="pass">
                <p></p>
                <button class="btn" type="submit">INGRESAR</button>
              </div>
            </form>
          </div>
          <div class="panel-footer">
            <!-- buttons or inputs -->
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