<?php
	require "header.php";
	require "config.php";
?>
		<div class="container m-5 mx-auto">
			<div class="row">
				<div class="col-2 offset-1">
					<div class="list-group">
						<a href="comprar.php?cat=1" class="list-group-item list-group-item-action">Arròs</a>
						<a href="comprar.php?cat=2" class="list-group-item list-group-item-action">Begudes</a>
						<a href="comprar.php?cat=3" class="list-group-item list-group-item-action">Drogueria</a>
						<a href="comprar.php?cat=4" class="list-group-item list-group-item-action">Conserves</a>
						<a href="comprar.php?cat=5" class="list-group-item list-group-item-action">Esmorzars</a>
						<a href="comprar.php?cat=6" class="list-group-item list-group-item-action">Mascotes</a>
						<a href="comprar.php?cat=7" class="list-group-item list-group-item-action">Lactis i ous</a>
						<a href="comprar.php?cat=8" class="list-group-item list-group-item-action">Llegums</a>
						<a href="comprar.php?cat=9" class="list-group-item list-group-item-action">Oli, vinagre i sal</a>
						<a href="comprar.php?cat=10" class="list-group-item list-group-item-action">Pasta</a>
						<a href="comprar.php?cat=11" class="list-group-item list-group-item-action">Salses i espècies</a>
						<a href="comprar.php?cat=12" class="list-group-item list-group-item-action">Snacks i aperitius</a>
						<a href="comprar.php?cat=13" class="list-group-item list-group-item-action">Sopa i puré</a>
					</div>
				</div>
				<div class="col-8">
					
					<?php

						if(isset($_GET["cat"])){
					       	$id_cat = $_GET["cat"];
		                	$sql = "SELECT * FROM detall_productes WHERE codi_categoria = $id_cat";
					        
					    } else {
					    	$id_cat = 0;
					    	$sql = "SELECT * FROM detall_productes";
					    }

					    switch ($id_cat) {
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
					    
					    echo "<h3 class=\"text-white\">$categoria</h3>";

					    echo "<table class=\"table\">        
						<tr> 
							<th>Producte</th> 
							<th>Categoria</th>
							<th class=\"text-right\">Preu</th>
							<th></th>
						</tr>";

						
						//echo $sql;

						$result = $conn->query($sql);

						if ($result) {

							if ($result->num_rows > 0) {
								

								$row = $result->fetch_assoc();
								while($row) {

									$codi = $row["codi"];
									$producte = $row["nom"];
									$preu = $row["preu"];
									$unitats_stock= $row["unitats_stock"];
									$imatge = $row["imatge"];
									

									echo "<tr> 
											<td class=\"align-middle\">
												<img src=\"$imatge\" class=\"img-thumbnail mr-2\" style=\"height: 50px;\" />
												$producte
											</td>
											<td class=\"align-middle\">$categoria</td>
											<td class=\"align-middle text-right\">$preu €</td>
											<td class=\"align-middle\">
												<form class=\"form-inline\" action=\"carrito.php\" method=\"post\">
													<div class=\"form-group\">
														<input type=\"hidden\" name=\"codi\" value=\"$codi\" />
														<input type=\"number\" class=\"form-control form-control-sm mr-2\" name=\"quantitat\" min=\"1\" value=\"1\" style=\"width: 50px;\" />
													</div>
													<button type=\"submit\" class=\"btn btn-primary\"><i class=\"fas fa-cart-plus\"></i></button>
												</form>
											</td> 
										</tr>";

									$row = $result->fetch_assoc();
								}

								


							} else {
								echo "<p>No hay ningún producto</p>";
							}
						}

						echo "</table>";			
						$conn->close();
					?>
					
				</div>
			</div>
		</div>
	</body>
</html>
