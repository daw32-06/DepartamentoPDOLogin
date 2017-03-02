<?php

	define('DB_SERVIDOR','localhost');
	define('DB_NOMBREDB','practicasDAW32');
	define('DB_USUARIO','ntweb');
	define('DB_PASSWORD','toor');


	$conexiondb = mysqli_connect(DB_SERVIDOR,DB_USUARIO,DB_PASSWORD);
	if($conexiondb){
		$dbselect = mysqli_select_db($conexiondb,DB_NOMBREDB);

		if(!$dbselect)
		{
			die('Error! No se puede usar la base de datos');
		}

	}else{
		die('Error! No se puede conectar al servidor de la base de datos');
	}

	// Esta linea sirve para mostrar las Ñ y los acentos
	mysqli_set_charset($conexiondb,'utf8');



?>
