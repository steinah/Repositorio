<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Uy!Transfer</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="icon" type="image/x-icon" href="images/favicon.png" />
		<link rel="stylesheet" href="css/estilos.css" />
	</head>

	<body>

		<?php
			include "header.php";



			print_r($_POST);
			print_r($_FILES);

			if (!empty($_POST["nombre"])) {
				//Si es falso entra

				//Se guarda en la variable con el metodo $_POST[]
				$user = $_POST["nombre"];
				

				/*if(isset($_POST["pormail"])){
					//Se pregunta si le han pasado ese elemento
					echo "Se tiene que enviar un mail.";
				}*/
			}else {
				header("Location: index.php");
			}



			if (!empty($_FILES["archivo"])) {

				$nombreArchivo = $_FILES["archivo"]["name"];
				$rutaTmp = $_FILES["archivo"]["tmp_name"];
				$extension = substr($nombreArchivo, strpos($nombreArchivo, "."));
				$rutaDestino = "files/".time().$extension;
				$linkDescarga = $_SERVER["HTTP_ORIGIN"]."/$rutaDestino";

				move_uploaded_file($rutaTmp, $rutaDestino);

			}else {
				header("Location: index.php");
			}

			if ($_POST['sendEmail'] == 'value1'){
				mail("$mail", "Guapo", "$mensaje");
			}
			
			



			echo "<div class=\"forming\">
			<div>
				<div>
					<img src=\"images/upload-cloud.png\" id=\"cloud\" class=\"rounded float-left\" alt=\"upload-cloud\"  >
				</div>
				<br></br>
				<div class=\"text-center\">
					<h1>Archivo enviado Correctamente</h1>
				</div>
				<div class=\"text-center\">
					<p>Hola $user, usa éste link para compartir tu archivo</p>
				</div>
			</div>
			<div>
				<a class=\"nav-link float-right\" href=\"$linkDescarga\">$linkDescarga</a>
			</div>
		</div>";

		?>

		
		
		
	</body>
</html>