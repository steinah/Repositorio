<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Uy!Transfer</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="icon" type="image/x-icon" href="images/favicon.png" />
		<link rel="stylesheet" href="css/estilos.css" />
	</head>

	<body >

		<?php
			

			include "header.php";

			
		?>

		
		<form name="subir" action="upload.php" method="post" enctype="multipart/form-data" class="forming">
			<div class="form-group">
			
			    <input type="text" class="form-control" id="exampleInputName" name="nombre" placeholder="Nombre">
			    
			</div>
			<div class="form-group">
			    	
					<div class="input-group mb-3">
					  <div class="custom-file">
					  	
					  		<input type="file" class="custom-file-input" id="inputGroupFile01" name="archivo">
					   	 	<label class="custom-file-label" for="inputGroupFile01">Selecciona un archivo</label>
						
					  </div>
					</div>
			</div>
			 
			
			<br></br>
			<div class="form-check">
			    <input type="checkbox" class="form-check-input" id="exampleCheck1">
			    <label class="form-check-label" for="exampleCheck1">Quiero enviar el link de descarga por email</label>
			</div>
			<br></br>
			<div class="form-group">
			    
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email del destinatario">
			</div>
			<div class="input-group">
				<div class="input-group-prepend">
				    <span class="input-group-text">Mensaje</span>
				</div>
				<textarea class="form-control" aria-label="With textarea"></textarea>
			</div>
			<br></br>
			<button type="submit" class="btn btn-primary" id="Subir">Subir archivo</button>
			
		</form>
	

		
	



	</body>
	
</html>