<?php
	require "header.php";

	if (isset($_POST["codi"])){

		$codi = $_POST["codi"];
		echo "$codi";

		$sql = "DELETE FROM productes WHERE codi = '$codi'";
	

		$conn->query($sql);

							
	}

?>
		<div class="container m-5 mx-auto">
			<div class="col-8 offset-2">

				<?php

						
					    $sql = "SELECT * FROM productes";
					

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

									$codi_prod = $row["codi"];
									$producte = $row["nom"];
									$preu = $row["preu"];
									$imatge = $row["imatge"];
									$id_cat = $row["categoria"];

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

									echo "<tr> 
											<td class=\"align-middle\">
												<img src=\"$imatge\" class=\"img-thumbnail mr-2\" style=\"height: 50px;\" />
												$producte
											</td>
											<td class=\"align-middle\">$categoria</td>
											<td class=\"align-middle\">$preu €</td>
											<td class=\"align-middle\">
												<form class=\"form-inline\" action=\"$_SERVER[PHP_SELF]\" method=\"post\">
													<a href=\"form_producte.php?codi=$codi_prod\" class=\"btn btn-primary\"><i class=\"fas fa-pencil-alt\"></i></a>
													<div class=\"form-group\">
														<input type=\"hidden\" name=\"codi\" value=\"$codi_prod\" />
													</div>
													<button type=\"submit\" class=\"btn btn-primary\"><i class=\"fas fa-trash-alt\"></i></button>
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
	</body>
</html>
