<?php
	require "header.php";

	if (isset($_GET["codi"])){

		$codi = $_GET["codi"];
	

		$sql = "SELECT * FROM productes WHERE codi = '$codi'";
	

		$result = $conn->query($sql);

		

		if ($result) {

			$row = $result->fetch_assoc();
			if($row){
				$nom_producte = $row["nom"];
				$preu = $row["preu"];
				$categoria_existent = $row["categoria"];
				$stock = $row["unitats_stock"];
				$imagen_producto= $row["imatge"];
				
			}
			
			
		} else {
			$error = 1;
			
		}

		
		

		

		//echo $sql;
		

		

		//echo "$error";
				

			

	} elseif (!empty($_POST)) {


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

		
?>
		<div class="container m-5 mx-auto text-white">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-4 offset-2">
						<div class="form-group">
							<label for="codi">Codi:</label>
							<input type="text" class="form-control" name="codi" id="codi" value="<?php echo("$codi") ?>"/>
						</div>
						<div class="form-group">
							<label for="nom">Nom:</label>
							<input type="text" class="form-control" name="nom" id="nom" value="<?php echo("$nom_producte") ?>"/>
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
												

											
												if(isset($_GET["codi"])){

													switch ($categoria_existent) {
												    	case 1:
												    		$categoria = "Arròs";
												    		break;
												    	case 2:
												    		$categoria = "Begudes";
												    		break;
												    	case 3:
												    		$categoria = "Drogueria";
												    		break;
												    	case 4:
												    		$categoria = "Conserves";
												    		break;
												    	case 5:
												    		$categoria = "Esmorzars";
												    		break;
												    	case 6:
												    		$categoria = "Mascotes";
												    		break;
												    	case 7:
												    		$categoria = "Lactis i ous";
												    		break;
												    	case 8:
												    		$categoria = "Llegums";
												    		break;
												    	case 9:
												    		$categoria = "Oli, vinagre i sal";
												    		break;
												    	case 10:
												    		$categoria = "Pasta";
												    		break;
												    	case 11:
												    		$categoria = "Salses i espècies";
												    		break;
												    	case 12:
												    		$categoria = "Snacks i aperitius";
												    		break;
												    	case 13:
												    		$categoria = "Sopa i puré";
												    		break;
												    	default:
												    		$categoria = "General";
												    		break;
												    }
														echo "<option selected = \"true\" value=\"$categoria_existent\">$categoria</option>";
												} else{
													
													echo "<option value=\"$id_categoria\">$nom_categoria</option>";
												}
												

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
							<input type="number" class="form-control" name="preu" id="preu" value="<?php echo("$preu") ?>"/>
						</div>
						<div class="form-group">
							<label for="stock">Unitats en stock:</label>
							<input type="number" class="form-control" name="unitats_stock" id="unitats_stock" value="<?php echo("$stock") ?>"/>
						</div>
						<div class="form-group text-right">
							<a href="productes.php" class="btn btn-outline-secondary mx-2">Tornar</a>
							<button type="submit" class="btn btn-default">Guardar</button>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="imatge">Imatge:</label>
							<input type="file" class="form-control" name="imatge" id="imatge" value="<?php echo("$imagen_producto") ?>"/>
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
