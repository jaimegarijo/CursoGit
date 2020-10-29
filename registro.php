<?php
	include 'conexion.php'

	if (isset($_POST)) {
		$user = $_POST['user'];
		$password = $POST['password'];
	} else {
		die("Error, no tiene acceso.");
	}

	$sql = "SELECT * FROM usuario WHERE user = ?"

	$stmt = $conexion->prepare($sql);
	$stmt = bind_param("ss", $user, $password);
	$stmt->execute();

	$resultado = $stmt->get_result();

	if (count($resultado) != 0) {
		echo "Bienvenido";
	} else {
		echo "Usuario no existe. Vuelva a intentarlo.";
	}