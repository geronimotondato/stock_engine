<style>
  .pagination-container {
    vertical-align: top;
    text-align: center;
    display: block;
    width: 100%
    position: relative;
    height: 100px;
  }
  .pagination{
    display: inline-flex;
  }
</style>

<!-- INICIO PAGINADOR -->
<div class="pagination-container">
<ul class="pagination"> 

  <li class="page-item <?= ($numero_pagina == 1)? 'disabled':'' ?>">
    <a href=<?= base_url() . $seccion.'?numero_pagina=' . ($numero_pagina -1) ?> ><</a>
  </li>

  <?PHP for ($i = $rango["x1"]; $i <= $rango["x2"]; $i++ ): ?>

  <li class="page-item <?= ($numero_pagina == $i)? 'active': ''?>" >
    <a href=<?= base_url() . $seccion.'?numero_pagina='.$i ?> ><?= $i ?></a>
  </li>

  <?PHP endfor ?>

  <li class="page-item <?= ($numero_pagina == $cantidad_paginas)? 'disabled':'' ?>">
    <a href=<?= base_url() . $seccion.'?numero_pagina=' . ($numero_pagina +1) ?>>></a>
  </li>
</ul> 
</div><!-- FIN -->