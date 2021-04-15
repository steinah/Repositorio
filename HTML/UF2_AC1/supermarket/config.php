
<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "supermercat";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("ERROR al connectar con la base de datos");
	}

?>
