<?php
	session_start();
	include('conexion.php');

	if (isset($_POST)) {
		
		$tema = intval($_POST['tema']);

		$_SESSION['tema']=$_POST['tema'];

		


		$enunciado = $_POST['enunciado'];		
		$op1 = $_POST['op1'];
		$op2 = $_POST['op2'];
		$op3 = $_POST['op3'];
		$op4 = $_POST['op4'];
		$respuesta = intval($_POST['correcta']);

		$sql="INSERT INTO preguntas (tema, enunciado, op1, op2, op3, op4, correcta)
				VALUES (?, ?, ?, ?, ?, ?, ?)";

		$stmt = $conexion->prepare($sql);
		if (!$stmt) {
			echo "Prepare failed: (" . $conexion->errno . ") " . $conexion->error;
		}
    	
    	$stmt->bind_param('isssssi', $tema, $enunciado, $op1, $op2, $op3, $op4, $respuesta);
    	$stmt->execute();	

    	$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'crear_pregunta.php';
		header("Location: http://$host$uri/$extra");
		exit;
	} else {
		die("ERROR: Could not connect. " . $conexion->errno);
	}
	
?>