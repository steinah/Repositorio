<?php
	require "header.php";

	$incioSesion = false;

			if (!empty($_POST)) {

		
				$usuario = $_POST["username"];
				$contrasenya = $_POST["pass"];

				$sql = "SELECT * FROM clients
						WHERE nom_usuari = '$usuario' AND contrasenya = '$contrasenya'";
				
				$result = $conn->query($sql);

				// OPCIÓN 1
				/*if ($result->num_rows > 0) {
					
					$row = $result->fetch_assoc();
					$_SESSION["user"] = $row["id_usuari"];

					$incioSesion = true;

				}*/

				// OPCIÓN 2
				
				$row = $result->fetch_assoc();
				if ($row) {	
					
					$_SESSION["user"] = $row["id_client"];
					
					$incioSesion = true;

				}

				
			}

			if ($incioSesion) {
				//echo "inicia sesion";
				header("Location: comprar.php");
			} 

			
			$conn->close();


	
?>
		<div class="container m-5 mx-auto col-4 offset-4 text-white">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<div class="form-group">
					<label for="username">Nom d'usuari:</label>
					<input type="text" class="form-control" name="username" id="username" />
				</div>
				<div class="form-group">
					<label for="pass">Contrasenya:</label>
					<input type="password" class="form-control" name="pass" id="pass" />
				</div>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-default">Entrar</button>
				</div>
			</form>
		</div>
	</body>
</html>
