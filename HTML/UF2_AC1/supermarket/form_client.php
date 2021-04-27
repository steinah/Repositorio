<?php
	
	
	require "common/validacions.php";

	if (!empty($_POST)) {


			$username = $_POST["username"];
			$pass = $_POST["pass"];
			$passRep = $_POST["rp_pass"];
			$nombre = $_POST["nombre"];
			$apellidos = $_POST["apellidos"];
			$nif = $_POST["nif"];
			$direccion = $_POST["direccion"];
			$CP= $_POST["codigo_postal"];
			$poblacion = $_POST["poblacion"];
			$telf = $_POST["telefono"];
			$mail = $_POST["mail"];

			$sql = "INSERT INTO clients (nom_usuari, contrasenya, nom, cognoms, nif, adreca, codi_postal, poblacio, telefon, email) 
					VALUES ('$username', '$pass', '$nombre', '$apellidos', '$nif', '$direccion', '$CP', $poblacion, '$telf', '$mail')";

			//echo $sql;

			$result = $conn->query($sql);

			if ($result) {
				header("Location: entrar.php");
				
			} else {
				$error = 1;
			}

			//echo "$error";
			

		} else {
			$username = "";
			$pass =  "";
			$passRep =  "";
			$nombre =  "";
			$apellidos =  "";
			$nif =  "";
			$direccion =  "";
			$CP=  "";
			$poblacion = "";
			$telf =  "";
			$mail =  "";
		} 
		

		require "header.php";
	
?>
		<div class="container m-5 mx-auto text-white">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<div class="row">
					<div class="col-4 offset-2">
						<div class="form-group">
							<label for="username">Nom d'usuari (obligatori):</label>
							<input type="text" class="form-control" name="username" id="username" />
							<?php
							if (isset($error)){
								$valid = nomUsuariValid($username);

								if(!$valid){
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Introduce un nombre de usuario válido
										</div>";
								}
								/*if (isset($error)) {
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  No se ha podido registrar el usuario
										</div>";
								}*/
							}

							?>
						</div>
						<div class="form-group">
							<label for="pass">Contrasenya (obligatori):</label>
							<input type="password" class="form-control" name="pass" id="pass" />
							<?php
								if (isset($error)){
								$grauSeguretat = seguretatContrasenya($pass);

								if($grauSeguretat < 3){
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Introduce una contraseña válida. (Usa mayúsculas, dígitos y simbolos)
										</div>";
								}
							}
								

							?>
						</div>
						<div class="form-group">
							<label for="rp_pass">Repeteix la contrasenya (obligatori):</label>
							<input type="password" class="form-control" name="rp_pass" id="rp_pass" />
							<?php

								if ($pass != $passRep) {
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Las contraseñas no coinciden
										</div>";
								}

							?>
						</div>
						<div class="form-group">
							<label for="nombre">Nom (obligatori):</label>
							<input type="text" class="form-control" name="nombre" id="nombre" />
							<?php

								if (isset($error)) {
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Introduce un Nombre
										</div>";
								}

							?>
						</div>
						<div class="form-group">
							<label for="apellidos">Cognoms (obligatori):</label>
							<input type="text" class="form-control" name="apellidos" id="apellidos" />
							<?php

								if (isset($error)) {
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Introduce los apellidos
										</div>";
								}

							?>
						</div>
						<div class="form-group">
							<label for="nif">NIF (obligatori):</label>
							<input type="text" class="form-control" name="nif" id="nif" />
							<?php
							if (isset($error)){
								$valid = NIFValid($nif);

								if (!$valid) {
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Introduce un NIF válido
										</div>";
								}
							}

							?>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="direccion">Adreça (obligatori):</label>
							<input type="text" class="form-control" name="direccion" id="direccion" />
							<?php
								

								if (isset($error)) {
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Introduce una dirección
										</div>";
								}

							?>
						</div>
						<div class="form-group">
							<label for="codigo_postal">Codi postal (obligatori):</label>
							<input type="text" class="form-control" name="codigo_postal" id="codigo_postal" />
							<?php

								if (isset($error)) {
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Introduce un código postal
										</div>";
								}

							?>
						</div>
						<div class="form-group">
							<label for="poblacion">Població (obligatori):</label>
							<select class="form-control" name="poblacion" id="poblacion">
								<option value="">Selecciona una opció</option>

								<?php
									$sql = "SELECT id_poblacio, nom FROM poblacions ORDER BY nom";
									//echo $sql;

									$result = $conn->query($sql);

									if ($result) {

										if ($result->num_rows > 0) {
											

											$row = $result->fetch_assoc();
											while($row) {

												$id = $row["id_poblacio"];
												$poblacio = $row["nom"];
												

												echo "<option value=\"$id\">$poblacio</option>";

												$row = $result->fetch_assoc();
											}

											


										} else {
											echo "<p>No hay ningúna población</p>";
										}
									}

									

								?>
								
							</select>
							<?php

								if (isset($error)) {
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Introduce una población
										</div>";
								}

							?>
						</div>
						<div class="form-group">
							<label for="telefono">Telèfon:</label>
							<input type="text" class="form-control" name="telefono" id="telefono" />
						</div>
						<div class="form-group">
							<label for="codigo_postal">Email:</label>
							<input type="text" class="form-control" name="mail" id="mail" />
							<?php
							if (isset($error)){
								$valid = esEmail($mail);

								if (!$valid) {
									echo "<div class=\"alert alert-danger\" role=\"alert\">
										  Introduce un email válido
										</div>";
								}
							}
							?>
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-default">Enviar</button>
						</div>
					</div>
				</div>
			</form>
		</div>

		<?php

			
			
		$conn->close();
		?>
	</body>
</html>
