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
          <div class="panel-nav">
            <!-- navigation components: tabs, breadcrumbs or pagination -->
            <ul class="tab tab-block">
              <li class="tab-item">
                <a href="#" class="active">
                <button class="btn btn-primary btn-action btn-lg">
                  <i class="icon icon-plus"></i>
                </button>
              </a>
              </li>
              <li class="tab-item">
                <a href="#">Playlists</a>
              </li>
              <li class="tab-item">
                <a href="<?PHP echo base_url('') ?>Login/log_out">Salir</a>
              </li>
            </ul>
          </div>
          <div class="panel-body">
            <input id="date" type="date">

          </div>
          <div class="panel-footer">
            <!-- buttons or inputs -->
          </div>
        </div>

      </main>
      <footer>
      </footer>
  </body>
</html>