<?php

	include 'cabecera.php';
	include 'conexion.php';
?>
<div class='middle'>
<main>
<?php
	if (!isset($_POST['tema'])) {
		die("Error, no hay tema elegido");
	}

	$tema=intval($_POST['tema']);
	$numero_preguntas=intval($_POST['numero_preguntas']);

	$sql="SELECT * FROM preguntas WHERE tema=? ORDER BY RAND() LIMIT ?";
	$stmt=$conexion->prepare($sql);
	$stmt->bind_param('ii', $tema, $numero_preguntas);
	$stmt->execute();

	$resultado=$stmt->get_result();


?>
	<!-- Creo un formulario -->
	<form action="corregir_test.php" method="POST">
		
<?php
	$contador = 1;

	while ($fila = $resultado->fetch_assoc()) {
 		
?>

		<p><fieldset>
			<legend>Pregunta <?php echo $contador; ?></legend>
<?php  
			$respuestas= "respuesta".$contador;
			$id_pregunta= "id_pregunta".$contador;
?>
			<p><?php echo $fila['enunciado'];?></p>

			<p><input type="hidden" value="null" name=<?php echo "\"". $respuestas . "\""; ?> ></p>

			<p><input type="radio" value="1" name= <?php echo "\"". $respuestas . "\""; ?> >
<?php
			echo $fila['op1'] . "</p>";
?>  
			<p><input type="radio" value="2" name= <?php echo "\"". $respuestas . "\""; ?> > 
<?php
			echo $fila['op2'] . "</p>";
?>  
			<p><input type="radio" value="3" name= <?php echo "\"". $respuestas . "\""; ?> >
<?php
			echo $fila['op3'] . "</p>";
?>  
			<p><input type="radio" value="4" name= <?php echo "\"". $respuestas . "\""; ?> >
<?php
			echo $fila['op4'] . "</p>";	  		
?>
			<p><input type="hidden" name= <?php echo "\"". $id_pregunta . "\""; ?> value= <?php echo "\"". $fila['id']. "\""; ?>></p>

		</fieldset></p>
<?php	
		$contador++; 
 	}
?>
		<input type="hidden" name="tema" value=<?php echo "\"". $tema . "\""; ?>>
		<input type="submit" name="submit" value="Corregir Test">		

		<input type="reset" value="Borrar todas las respuestas">
	</form>
</main>
<aside>
<?php
	$sql="SELECT * FROM test ORDER BY fecha DESC LIMIT 10";
	$stmt=$conexion->prepare($sql);
	$stmt->execute();

	$resultado=$stmt->get_result();
?>	

	<h2><p>Histórico</p></h2>
	<table style='width: 100%'>
	  <tr>
	    <th>Últimos Test</th>
	    <th>Tema<sup>1</sup></th> 
	    <th>Aciertos</th> 
	    <th>Errores</th>
	    <th>NS/NC</th>
	    <th>Calificación</th>
	  </tr>
<?php

	while ($fila=$resultado->fetch_assoc()) {
		echo "<tr>";
		$fecha=date("d.m.y h:m",$fila['fecha']);
		echo "<td>$fecha</td>";
		$tema = $fila['id_tema'];
		$temaInt=0;
		if ($tema<16) {
			$temaInt+=intval($tema);
			$tema= $temaInt . " g";
		} else {
			$temaInt=intval($tema)-16;
			$tema= $temaInt . " e";
		}
		echo "<td>$tema</td>";
		$aciertos=intval($fila['aciertos']);
		echo "<td>$aciertos</td>";
		$errores=intval($fila['errores']);
		echo "<td>$errores</td>";
		$blancos=intval($fila['blanco']);
		echo "<td>$blancos</td>";
		$nota=floor((($aciertos-$errores/3)*10 / ($aciertos+$errores+$blancos))*1000)/1000;
		echo "<td>$nota</td></tr>";

		
	}
?>
	</table>
	<sup>1</sup> e: temario <b>e</b>specífico /	g: temario <b>g</b>eneral<br>
</aside>
</div>
<?php
	include 'footer.php';
?>	