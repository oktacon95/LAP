<html>
	<head>
		<meta charset="UTF-8">
		<title>Trankstellenverwaltung</title>
	</head>
	<body>
		<form action="suchergebnis.php" method="post">
			<h1> Suche nach Kundennummer </h1><br>
			Kundennummer: <input type='text' name='customernumber'>
			<input type="submit" value="Suchen">
			<input type="reset" value="Leeren">
		</form>
	</body>
</html>



<!-- <?php
	$mysqli = new mysqli("localhost", "root", "root", "tankstelle");

	if ($mysqli->connect_errno) {
		die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
	}

	$id = 60000;
	$sql = "SELECT * FROM Verbrauch WHERE Buchungs_ID < ?";

	$statement = $mysqli->prepare($sql);
	$statement->bind_param('i', $id);
	$statement->execute();

	$result = $statement->get_result();

	while($row = $result->fetch_object()) {
		echo $row->Menge;
	}
?> -->