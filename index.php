<?php

	session_start();
	$text="1";
	$_SESSION['tema']=$text;
		
	include 'cabecera.php';
	include 'cuerpo.php';
	include 'auxiliar.php';
	include 'footer.php';
?>