<?php

	include 'cabecera.php';
?>
<div class="middle">
	<main>
<?php
	include 'auxiliar.php';
	
	$tema = $_POST['tema'];
	$contador=1;

	$total_datos_POST=count($_POST)-2;
	foreach ($_POST as $key => $value) {
		if (($total_datos_POST==$contador-2) || ($total_datos_POST==$contador-1)) {

		}

		elseif ($contador % 2 == 0) {
			$pregunta=intval($value);;
			$id_preguntas[]=$pregunta;

		} else {
			$respuesta=intval($value);
			$id_respuestas[]=$respuesta;
		}
		$contador++;
	}
	$resultado = corregir($tema, $id_preguntas, $id_respuestas);


?>
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
	    <th>Tema</th>
	    <th>Aciertos</th> 
	    <th>Errores</th>
	    <th>NS/NC</th>
	    <th>Calificación</th>
	  </tr>
<?php

	while ($fila=$resultado->fetch_assoc()) {
		echo "<tr>";
		$fecha=date("d.m.y - h.m", $fila['fecha']);
		echo "<td>$fecha</td>";
		$tema=$fila['id_tema'];
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
	<sup>1</sup> e: temario <b>e</b>specífico / g: temario <b>g</b>eneral<br>
</aside>
</div>
<?php
	include 'footer.php';
?>