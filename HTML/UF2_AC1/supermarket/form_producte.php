<?php
	require "header.php";

	if (isset($_GET["codi"])){

		$codi = $_GET["codi"];
		echo "$codi";

		$sql = "SELECT * FROM productes WHERE codi = '$codi'";
		print_r($sql);

		$nom_producte = $_GET["nom"];
		$preu = $_GET["preu"];
		$categoria = $_GET["categoria"];
		$stock = $_GET["unitats_stock"];
		$targetDir = "images/productes/";
		if (!empty($_FILES)) {
			$nombre_imagen = $_FILES["imatge"]["name"];
			$rutaDestino = "images/productes/".$nombre_imagen;

		} else {
			$rutaDestino = "images/productes/no-image.png";
		}
		

		

		//echo $sql;
		

		$result = $conn->query($sql);

		if ($result) {
			header("Location: form_producte.php");
			echo "<div class=\"p-3 mb-2 bg-success text-white\">
									  Producte inserit correctament
									</div>";
			
		} else {
			$error = 1;
			"<div class=\"alert alert-danger\" role=\"alert\">
									  El Producte no s'ha pugut inserir
									</div>";
		}

		//echo "$error";
				

			

	} else {

		if (!empty($_POST)) {


				$codi = $_POST["codi"];
				$nom_producte = $_POST["nom"];
				$preu = $_POST["preu"];
				$categoria = $_POST["categoria"];
				$stock = $_POST["unitats_stock"];
				$targetDir = "images/productes/";
				if (!empty($_FILES)) {
					$nombre_imagen = $_FILES["imatge"]["name"];
					$rutaDestino = "images/productes/".$nombre_imagen;

				} else {
					$rutaDestino = "images/productes/no-image.png";
				}
				

				$sql = "INSERT INTO productes (codi, categoria, nom, preu, unitats_stock, imatge) 
						VALUES ('$codi', '$categoria', '$nom_producte', '$preu', $stock, '$rutaDestino')";

				//echo $sql;
				

				$result = $conn->query($sql);

				if ($result) {
					header("Location: form_producte.php");
					echo "<div class=\"p-3 mb-2 bg-success text-white\">
											  Producte inserit correctament
											</div>";
					
				} else {
					$error = 1;
					"<div class=\"alert alert-danger\" role=\"alert\">
											  El Producte no s'ha pugut inserir
											</div>";
				}

				//echo "$error";
				

			} else {
				$codi = "";
				$nom_producte = "";
				$preu = "";
				$unitats_stock = "";
				$rutaDestino = "";
			} 
	}
		
?>
		<div class="container m-5 mx-auto text-white">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-4 offset-2">
						<div class="form-group">
							<label for="codi">Codi:</label>
							<input type="text" class="form-control" name="codi" id="codi" />
						</div>
						<div class="form-group">
							<label for="nom">Nom:</label>
							<input type="text" class="form-control" name="nom" id="nom" />
						</div>
						<div class="form-group">
							<label for="categoria">Categoria:</label>
							<select class="form-control" name="categoria" id="categoria">
								<option value="">Selecciona una opció</option>
								<?php
									$sql = "SELECT id_categoria, nom FROM categories ORDER BY nom";
									//echo $sql;

									$result = $conn->query($sql);

									if ($result) {

										if ($result->num_rows > 0) {
											

											$row = $result->fetch_assoc();
											while($row) {

												$id_categoria = $row["id_categoria"];
												$nom_categoria = $row["nom"];
												

												echo "<option value=\"$id_categoria\">$nom_categoria</option>";

												$row = $result->fetch_assoc();
											}

											


										} else {
											echo "<p>No hay ningúna categoria</p>";
										}
									}

								?>
								
							</select>
						</div>
						<div class="form-group">
							<label for="preu">Preu:</label>
							<input type="number" class="form-control" name="preu" id="preu" />
						</div>
						<div class="form-group">
							<label for="stock">Unitats en stock:</label>
							<input type="number" class="form-control" name="unitats_stock" id="unitats_stock" />
						</div>
						<div class="form-group text-right">
							<a href="productes.php" class="btn btn-outline-secondary mx-2">Tornar</a>
							<button type="submit" class="btn btn-default">Guardar</button>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="imatge">Imatge:</label>
							<input type="file" class="form-control" name="imatge" id="imatge" />
						</div>
						<div class="text-center">
							<img src="images/productes/no-image.png" class="img-thumbnail" style="height: 250px;" />
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
