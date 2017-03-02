<?php
	// Iniciamos la sesion
	session_start();
	// Comprobamos que el usuario ha iniciado sesion correctamente y si no es correcto vuelve a login
	if(!isset($_SESSION['usuario'])){
		header("location: login.php");
	}
?>
