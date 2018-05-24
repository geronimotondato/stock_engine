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

  <li class="page-item <?= ($pagina_actual == 1)? 'disabled':'' ?>">
    <a href=<?= base_url() . $link.'?pagina_actual=' . ($pagina_actual -1) ?> ><</a>
  </li>

  <?PHP for ($i = $rango["x1"]; $i <= $rango["x2"]; $i++ ): ?>

  <li class="page-item <?= ($pagina_actual == $i)? 'active': ''?>" >
    <a href=<?= base_url() . $link.'?pagina_actual='.$i ?> ><?= $i ?></a>
  </li>

  <?PHP endfor ?>

  <li class="page-item <?= ($pagina_actual == $cantidad_paginas_totales)? 'disabled':'' ?>">
    <a href=<?= base_url() . $link.'?pagina_actual=' . ($pagina_actual +1) ?>>></a>
  </li>
</ul> 
</div><!-- FIN -->