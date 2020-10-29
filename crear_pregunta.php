
<?php
	session_start();
	include 'cabecera.php';
?>
<main>
<?php  
			include('conexion.php');
			$conexion->set_charset("utf8");
			$sql = "SELECT * FROM Temario";
			$resultado = $conexion->query($sql);

?>
	

	<form action="guardar_pregunta.php" method="POST">
		<fieldset>	
			<legend>Crear pregunta</legend>

			<?php include 'elegir_tema_2.php' ?>

			<textarea required rows="5" cols="100%" name="enunciado" placeholder="Inserte aquí el enunciado de la pregunta"></textarea><br>
			<p><textarea required rows="3" cols="100%" name="op1" placeholder="Introduzca respuesta nº1"></textarea></p>
			<p><textarea required rows="3" cols="100%" name="op2" placeholder="Introduzca respuesta nº2"></textarea></p>
			<p><textarea required rows="3" cols="100%" name="op3" placeholder="Introduzca respuesta nº3"></textarea></p>
			<p><textarea required rows="3" cols="100%" name="op4" placeholder="Introduzca respuesta nº4"></textarea></p>
			<p>Respuesta correcta: 
				<select name="correcta">
		  			<option value="1">Opcion 1</option>
		  			<option value="2">Opcion 2</option>
		  			<option value="3">Opcion 3</option>
		  			<option value="4">Opcion 4</option>
				</select></p>
			<input type="submit" name="submit" value="Guardar pregunta"></br>
		</fieldset>
	</form>
</main>
<?php
	include 'footer.php';
?>