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


			

			

			if (!empty($_POST["nombre"])) {
				//Si es falso entra

				//Se guarda en la variable con el metodo $_POST[]
				$user = $_POST["nombre"];
				

				/*if(isset($_POST["pormail"])){
					//Se pregunta si le han pasado ese elemento
					echo "Se tiene que enviar un mail.";
				}*/
			}else {
				$user = "Oye tu";
			}



			if (!empty($_FILES["archivo"])) {

				
    			$random = rand (10000, 99999);
				
				$hoy = getdate();
				$nombreArchivo = $_FILES["archivo"]["name"];
				$rutaTmp = $_FILES["archivo"]["tmp_name"];
				$tamanyo = $_FILES["archivo"]["size"];
				$tipo = $_FILES["archivo"]["type"];
				$extension = substr($nombreArchivo, strpos($nombreArchivo, "."));
				$rutaDestino = "files/".$hoy["year"].$hoy["mon"].$hoy["mday"].$random.$extension;
				$linkDescarga = $_SERVER["HTTP_ORIGIN"]."/$rutaDestino";

			

				if($tamanyo < 10000000 && ($extension == ".pdf" || $extension == ".png" || $extension == ".jpg" || $extension == ".rar" || $extension == ".zip")){
					$error = false;
					move_uploaded_file($rutaTmp, $rutaDestino);
				} else {
					//header("Location: upload.php");
					$error = true;
				}
				

			}else {
				header("Location: index.php");
			}

			if (isset($_POST['check'])){

				$checked = true;
				
			} else {
				$checked = false;
			}

			if (!empty($_POST["mail"])) {
				//Si es falso entra

				//Se guarda en la variable con el metodo $_POST[]
				$email = $_POST["mail"];
				
			}else {
				header("Location: index.php");
			}



			if (!empty($_POST["textArea"])) {
				//Si es falso entra

				//Se guarda en la variable con el metodo $_POST[]
				$mensaje = $_POST["textArea"];
				
			}else {
				header("Location: index.php");
			}


			
			if ($checked == true) {
				mail("$email", "Uy!Transfer", "$mensaje");
			}

			if ($error == true){
				$img1 = "images/error.png";
				$textoEnvio = "Archivo no Subido";
				$linkDescarga = " ";
				if($tamanyo < 10000000){
					$subtexto = "$user, usa un tipo de formato adecuado para tu archivo";
				}else if($extension == ".pdf" || $extension == ".png" || $extension == ".jpg" || $extension == ".rar" || $extension == ".zip"){
					$subtexto = "$user, usa un tipo de tamaño adecuado para tu archivo";
				}
				
			} else {
				$img1 = "images/upload-cloud.png";
				$textoEnvio = "Archivo enviado Correctamente";
				$subtexto = "Hola $user, usa éste link para compartir tu archivo";
			}



			echo "<div class=\"forming\">
			<div>
				<div>
					<img src=\"$img1\" id=\"cloud\" class=\"rounded float-left\" alt=\"img1\"  >
				</div>
				<br></br>
				<div class=\"text-center\">
					<h1>$textoEnvio</h1>
				</div>
				<div class=\"text-center\">
					<p>$subtexto</p>
				</div>
			</div>
			<div>
				<a class=\"nav-link float-right\" href=\"$linkDescarga\">$linkDescarga</a>
			</div>
		</div>";

		?>

		
		
		
	</body>
</html>