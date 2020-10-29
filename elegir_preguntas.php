<?php
	include('conexion.php');
	$conexion->set_charset("utf8");
	$sql = "SELECT * FROM Temario";
	$resultado = $conexion->query($sql);	
?>			
	<form action="guardar_pregunta.php" method="POST">
		<fieldset>
			<legend>Elegir tema de las pregunta de test</legend>

			<p>Elige un tema específico:</p>
			<p><select name="tema" >

<?php 	
		$contador = 0;

		while ($linea = $resultado->fetch_assoc()) {
			if ($contador == 0) {							?>			
				<optgroup label='Temario general:'>
					<option value= <?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> 
					</option>  ?>
<?php       	$contador++;
			} elseif ($contador<16) {							?>									
			    	<option value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  ?>			  	
<?php		  	$contador++;
			} elseif ($contador == 16) {						?>				
				</optgroup>;
				<optgroup label='Temario específico:' >
					<optgroup label="Producción agraria, sanidad animal y comercialización agraria">
<?php       	$contador++;
			} elseif ($contador<38) {							?>									
			    	<option value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  ?>
			  	
<?php			$contador++;
			} elseif ($contador == 38) {						?>				
				</optgroup>;
					<optgroup label="Prevención y promoción de la salud">						
<?php       	$contador++;
			} elseif ($contador<49) {							?>									
			    	<option value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  ?>
			  	
<?php		  	$contador++;
			} elseif ($contador == 49) {						?>				
				</optgroup>;
					<optgroup label="Sanidad ambiental">
<?php       	$contador++;
			} elseif ($contador<59) {							?>									
			    	<option value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  ?>
			  	
<?php			$contador++;
			} elseif ($contador == 59) {						?>				
				</optgroup>;
					<optgroup label="Higiene y seguridad alimentaria">
<?php       	$contador++;
			} else {											?>									
			    	<option value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  ?>
			  	
<?php		  $contador++;	
			}

		}
?>
			  </optgroup>
			</select></p>