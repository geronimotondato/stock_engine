<?PHP
function calcular_rango_paginador($pagina_actual, $cantidad_paginas_totales, $paginas_a_mostrar){


//CALCULO EL RANGO DEL PAGINDOR

	//hace que el numero de paginas a mostrar siempre sea impar para que la pagina actual quede en el centro
	if($paginas_a_mostrar%2 == 0) $paginas_a_mostrar++;

	if($cantidad_paginas_totales < $paginas_a_mostrar){
		$rango["x1"] = 1;
		$rango["x2"] = $cantidad_paginas_totales;
	}else{
		if($pagina_actual <= ceil($paginas_a_mostrar/2)){
			$rango["x1"] = 1;
			$rango["x2"] = $paginas_a_mostrar;
		}elseif($pagina_actual >= ceil($paginas_a_mostrar/2)+1 && 
				$pagina_actual <= $cantidad_paginas_totales - ceil($paginas_a_mostrar/2) ){

			$rango["x1"] = $pagina_actual - floor($paginas_a_mostrar/2);
			$rango["x2"] = $pagina_actual + floor($paginas_a_mostrar/2);

		}else{
			$rango["x1"] = $pagina_actual - ($paginas_a_mostrar-1);
			$rango["x2"] = $cantidad_paginas_totales;
		}

	}
//FIN

	return $rango;

}

