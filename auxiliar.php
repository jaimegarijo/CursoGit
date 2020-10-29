<?php  

	function desactivar($contador, $res){

		for ($i=0; $i < count($res); $i++) { 
			if ($res[$i] == $contador) {
				return "";	 	
			}
		}
		
		return 'disabled style="color:grey"';
	}

	function seleccionado($contador,$tema) {

		if (!isset($_SESSION['tema'])) {
			return "";
		} else if(strcmp($contador,$tema-1)==0) {
			return "selected";
		} else {
			return "";
		}
	}
	

	function extraer_temario($fichero, $inicio, $fin){

		$lineas=file($fichero);

		return $lineas;
	}

	function corregir ($tema, $id_preguntas, $id_respuestas) {
		include('conexion.php');

		$numero_preguntas = count($id_respuestas);
		//para devolver errores y aciertos meter variables aquí

		$respuestas[0]=0;
		$respuestas[1]=0;
		$respuestas[2]=0;
		$respuestas[3]=null;
		for ($i=0; $i<$numero_preguntas; $i++) { 
			
			$id_pregunta = $id_preguntas[$i];
			$id_respuesta = $id_respuestas[$i];	

			$sql_test="SELECT * FROM preguntas WHERE id=$id_pregunta AND correcta=$id_respuesta";
			$sql_enunciados = "SELECT * FROM preguntas WHERE id=$id_pregunta";

			$resultado_test=$conexion->query($sql_test);
			$enunciados=$conexion->query($sql_enunciados);		
			
			$resultado=$resultado_test->fetch_assoc();
			$datos_in=$enunciados->fetch_assoc();

			$enunciado=$datos_in['enunciado'];
			
			// Son strings
			$op1=$datos_in['op1'];
			$op2=$datos_in['op2'];
			$op3=$datos_in['op3'];
			$op4=$datos_in['op4'];

			// Es un int
			$correcta=$datos_in['correcta'];

			$a=$i+1;
			?>
			<fieldset>
				<legend>Pregunta <?php echo $a; ?></legend>
			<?php
			echo "<p>$a   $enunciado</p>";

			for ($j=1; $j<5 ; $j++) { 

			
				switch ($j) {
					case '1':
						if ($correcta==1) {
						 	echo "$op1 ✓<br>";
						}
						elseif (($id_respuesta==$j) AND ($correcta != $j)) {
							echo "$op1 ✘<br>";
						} else {						
							echo "$op1<br>";
						}
						break;
					
					case '2': 
						if ($correcta==2) {
						 	echo "$op2 ✓<br>";
						} elseif (($id_respuesta==$j) AND ($correcta != $j)) {
							echo "$op2 ✘<br>";																	
						} else {						
							echo "$op2<br>";
						}
						break;

					case '3': 
						if ($correcta==3) {
						 	echo "$op3 ✓<br>";				
						} elseif (($id_respuesta==$j) AND ($correcta != $j)) {
							echo "$op3 ✘<br>";													
						} else {						
							echo "$op3<br>";
						}
						break;

					case '4': 
						if ($correcta==4) {
						 	echo "$op4 ✓<br>";						
						} elseif (($id_respuesta==$j) AND ($correcta != $j)) {
							echo "$op4 ✘<br>";													
						} else {						
							echo "$op4<br>";
						}
						break;

					default:
						die("Algún error ocurrió...");
						break;
				}
			}
			if ($resultado_test->num_rows == 0) {				
				echo "<p id='acierto'>Error</p>";
				if ($id_respuesta==NULL) {
					$respuestas[2] = $respuestas[2]+1;
				} else {
					$respuestas[1] = $respuestas[1]+1;
				}

			} else {
				echo "<p id='acierto'>Acierto</p>";
				$respuestas[0]=$respuestas[0]+1;
			}
			?>
			</fieldset>
<?php
		}		

		$fecha = time();
		$sentencia = "INSERT INTO test (id_tema, aciertos, errores, blanco, fecha) VALUES (?,?,?,?,?)";
		
		$stmt=$conexion->prepare($sentencia);
		$stmt->bind_param("iiiii", $tema, $respuestas[0], $respuestas[1], $respuestas[2], $fecha);
	
		$stmt->execute();

		
	return $respuestas;
	}
?>
