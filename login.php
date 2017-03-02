<?php
	//Libreria para la conexion con la base de datos
	include_once "conexiondb.php";
	//Libreria para el registro de eventos en el login
	include_once "func/userlog.php";

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Mantenimiento departamento</title>
	<link rel="stylesheet" href="css/login_style.css">
</head>
<body>
	<div id="centrado">
		<h1>Mantenimiento Departamento</h1>
		<form action="login.php" method="post" name="formulario">
			<input id="usuario" name="usuario" type="text">
			<br>
			<input id="password" name="password" type="password" >
			<br>

			<div id="msg"></div>

			<input type="submit" value="ENVIAR" class="bgblue">

		</form>
	</div>


	<?php
	if(!empty($_POST))
	{
		// Si los campos usuario o contraseña estan vacios detenemos la ejecucion y mostramos un mensaje con javascript
		if(empty($_POST['usuario'])||empty($_POST['password']))
		{
			echo "<script>document.getElementById(\"msg\").innerHTML='Introduce usuario y contraseña'; </script>";
			die();
		}

		//filter_var sirve para sanear el codigo y evitar la inyeccion SQL
		$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_MAGIC_QUOTES);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_MAGIC_QUOTES);

		//Conectamos con la base de datos
		try{
			$db = new PDO("mysql:host=$hostdb;dbname=$nombredb", $usuariodb,$passdb);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e) {
			//!!!!!! $e->getCode() es una funcion no puede ir dentro del string tiene que concatenarse
			print "Error en la conexion con la base de datos, codigo: ".$e->getCode()."<br>";

			//En caso de encontrarse un error detenemos la ejecucion del codigo
			die();
		}

		// Si la conexion ha sido correcta continuamos
		try{
			// String de la consulta
			$str_query = "select * from Usuario where codUsuario='$usuario' and password='".hash("sha256",$password)."'";


			// Guardamos el resultado del query
			$resultado = $db->query($str_query);

			// Comprobamos si existe el usuario y la contraseña
			if($resultado->rowCount()>0)
			{
				// llamamos a la funcion de la libreria userlog.php para insertar una linea en el log de eventos
					login_ok();
				// Si existe iniciamos una sesion, guardamos el usuario en $_SERVER['usuario'] y redireccionamos a la pagina de busqueda
				session_start();
				$_SESSION['usuario']=$usuario;
				header("location: buscar.php");

			}else{
				// En caso contrario mostramos un mensaje de error con JS
				echo "<script>document.getElementById(\"msg\").innerHTML='Usuario o contraseña erroneos';</script>";

				// Llamamos a la funcion de la libreria userlog.php para crear un registro en el log de que ha habido un intento fallido
				login_error();
			}
			die();


		}catch(PDOException $e) {
			print "<br>Error en la consulta, error: \n".$e->getMessage()."<br>";
		}
	}

?>

</body>
</html>
