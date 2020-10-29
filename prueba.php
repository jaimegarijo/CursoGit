<?php 
 
 	// Establecer conexión con la base de datos
	$database="oposicion";
	$server="localhost";
	$user="root";
	$password="";

	$conexion=new mysqli($server, $user, $password, $database);

	if (!$conexion) {		
		echo "Fallo en la conexión";
	}

	$conexion->set_charset("utf8");

	// Comprobar que los datos del formulario son correctos
	if (!isset($_POST['tema'])) {
		die("Error, no hay tema elegido");
	}

	$numero_preguntas=intval($_POST['numero_preguntas']);

	// Consulta
	$sql="SELECT * FROM preguntas WHERE tema=?";
	$stmt=$conexion->prepare($sql);
	$stmt->bind_param('i', $_POST['tema']);
	$stmt->execute();

	$resultado=$stmt->get_result();


	// Crear formulario
?>
	<form action="corregir_test.php" method="POST">
		
<?php

	// Para cada pregunta, hacer una delimitación por fieldset
	
	while ($fila = $resultado->fetch_assoc()) {

		// Indicar el número de pregunta a través de un contador
 		$contador = 1;
?>
		<fieldset>
			<legend>Pregunta <?php echo $contador;?></legend>


			
			<p><input type="radio" name="respuesta" value="op1">
<?php
			echo $fila['op1'] . "</br>";
?>  
			<p><input type="radio" name="respuesta" value="op2"> 
<?php
			echo $fila['op2'] . "</br>";
?>  
			<p><input type="radio" name="respuesta" value="op3">
<?php
			echo $fila['op3'] . "</br>";
?>  
			<p><input type="radio" name="respuesta" value="op4">
<?php
			echo $fila['op4'] . "</br><p>";	  		
?>
		</fieldset>
<?php	
		$contador++;
 	}
?>

		<input type="submit" name="submit" value="Corregir">
		
	</form>