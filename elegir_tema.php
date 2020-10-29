<?php  
		include('conexion.php');
		include('auxiliar.php');
		$conexion->set_charset("utf8");

		// Buscar en la base de datos, aquellas entradas que tienen preguntas y almacenarlas.

		$sql = "SELECT tema FROM preguntas";

		$resultado = $conexion->query($sql);

		$contador = 0;

		$res = [];

		while ($otro = $resultado->fetch_assoc()) {

			$repetido = false;

			for ($i = 0; $i < $contador; $i++) { 
				if ($res[$i] == $otro['tema']) {
					$repetido = true;
				}
			}

			if (!$repetido) { 
				$res[$contador] = $otro['tema'];	
				$contador += 1;
			}

		}

		
		// Las que no estén, se deben desactivar, cambiándoles el color



		$sql = "SELECT * FROM temario ";
		$resultado = $conexion->query($sql);

		$contador = 0;
?>


			<p>Elige un tema:</p>
			<p><select name="tema" >

<?php 	
		

		while ($linea = $resultado->fetch_assoc()) {
			if ($contador == 0) {							?>			
				<optgroup label='Temario general:'>
					<option <?php echo desactivar($contador+1,$res);?> value= <?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> 
					</option>  ?>
<?php       	$contador++;
			} elseif ($contador<15) {							?>									
			    	<option <?php echo desactivar($contador+1,$res);?> value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  ?>			  	
<?php		  	$contador++;
			} elseif ($contador == 15) {						?>				
				<option <?php echo desactivar($contador+1,$res);?> value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  
				</optgroup>;
				<optgroup label='Temario específico:' >
					<optgroup label="Producción agraria, sanidad animal y comercialización agraria">
<?php       	$contador++;
			} elseif ($contador<37) {							?>									
			    	<option <?php echo desactivar($contador+1,$res);?> value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  
<?php			$contador++;
			} elseif ($contador == 37) {						?>				
					<option <?php echo desactivar($contador+1,$res);?> value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option> 
					</optgroup>;
					<optgroup label="Prevención y promoción de la salud">						
<?php       	$contador++;
			} elseif ($contador<48) {							?>									
			    	<option <?php echo desactivar($contador+1,$res);?> value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  
			  	
<?php		  	$contador++;
			} elseif ($contador == 48) {						?>	
					<option <?php echo desactivar($contador+1,$res);?> value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  
					</optgroup>;
					<optgroup label="Sanidad ambiental">
<?php       	$contador++;
			} elseif ($contador<58) {							?>									
			    	<option <?php echo desactivar($contador+1,$res);?> value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  
			  	
<?php			$contador++;
			} elseif ($contador == 58) {						?>		
					<option <?php echo desactivar($contador+1,$res);?> value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  
					</optgroup>;
					<optgroup label="Higiene y seguridad alimentaria">
<?php       	$contador++;
			} else {											?>									
			    	<option <?php echo desactivar($contador+1,$res);?> value=<?php echo "'".$linea['id']."'"; ?> > <?php echo substr($linea['descripcion'], 0, 120) . "..."; ?> </option>  
			  	
<?php		  $contador++;	
			}
?>
<?php
		}
?>
			  </optgroup>
			</select></p>			    
