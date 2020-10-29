<?php  
	function extraer_temario($fichero, $inico, $fin){

	}
	$lineas=file('datos/' . $fichero);

	for ($i=$inico; $i <$fin ; $i++) { 
		echo $lineas[$i] . '</br>';
	}
?>