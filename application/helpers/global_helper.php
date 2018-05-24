<?PHP
function calcular_rango_paginador($numero_pagina, $cantidad_paginas, $alcance){

	if($alcance%2 == 0) $alcance++;


	if($cantidad_paginas < $alcance){
		$rango["x1"] = 1;
		$rango["x2"] = $cantidad_paginas;
	}else{
		if($numero_pagina <= ceil($alcance/2)){
			$rango["x1"] = 1;
			$rango["x2"] = $alcance;
		}elseif($numero_pagina >= ceil($alcance/2)+1 && 
				$numero_pagina <= $cantidad_paginas - ceil($alcance/2) ){

			$rango["x1"] = $numero_pagina - floor($alcance/2);
			$rango["x2"] = $numero_pagina + floor($alcance/2);

		}else{
			$rango["x1"] = $numero_pagina - ($alcance-1);
			$rango["x2"] = $cantidad_paginas;
		}

	}

	return $rango;

}