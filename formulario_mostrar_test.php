<?php
	include 'cabecera.php';
?>

<main>
	<form action="mostrar_test.php" method="POST">
				<fieldset>
				<legend> Selección de tema de Test</legend>
				<?php include 'elegir_tema.php'; ?>		
				<p>Número de preguntas: <input type="text" required name="numero_preguntas"></p>		
				<input type="submit" value="Generar Test">
				</fieldset>
			</form>

	</main>

<?php
	include 'footer.php';
?>		

