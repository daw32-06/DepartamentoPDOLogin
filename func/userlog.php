<?php
	//El formato del registro sera:
	// 212.183.234.125 | [2015/11/12 02:32:58] | Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.148 Safari/537.36 Vivaldi/1.4.589.38

	// Abrimos los ficheros en modo "a" - Apertura para sólo escritura; coloca el puntero del fichero al final del mismo. Si el fichero no existe, se intenta crear

	// AVISO La carpeta de logs tiene que tener permiso de escritura

	date_default_timezone_set("Europe/Madrid");

	function login_error()
	{
		$archivo = @fopen("logs/access_error.log", "a");

		if($archivo!=false){
			$timestamp = date("[Y/m/d h:i:s]");

			$s_cadena = $_SERVER["REMOTE_ADDR"]." | ".$timestamp." | ".$_POST['usuario']." | ".$_SERVER["HTTP_USER_AGENT"]."\n";

			fwrite($archivo,$s_cadena);
			fclose($archivo);
		}else{
			echo "<script>alert('Error en la creacion o acceso de access_error.log');</script>";

		}


	}

	function login_ok()
	{
		$archivo = @fopen("logs/access.log", "a");
		if($archivo!=false){
			$timestamp = date("[Y/m/d h:i:s]");

			$s_cadena = $_SERVER["REMOTE_ADDR"]." | ".$timestamp." | ".$_POST['usuario']." | ".$_SERVER["HTTP_USER_AGENT"]."\n";

			fwrite($archivo,$s_cadena);
			fclose($archivo);
		}else{
			echo "<script>alert('Error en la creacion o acceso de access.log');</script>";

		}
	}
