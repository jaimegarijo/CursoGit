<?php  
	
	$database="eshos_26025215_oposicion";
	$server="sql311.eshost.com.ar";
	$user="eshos_26025215";
	$password="Gurufo77";

	$conexion=new mysqli($server, $user, $password, $database);

	if (!$conexion) {		
		echo "Fallo en la conexión";
	}

	$conexion->set_charset("utf8");