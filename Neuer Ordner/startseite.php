<html>
	<head>
		<meta charset="utf-8"/>
		<title>ÖBB Lookup</title>
	</head>
<?php

function getSQLResultObject($sql, $conn) {
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) <= 0) {
		echo "Error: wasn't able to read mainstations or there are no mainstations";
		exit();
	}
	while($row = mysqli_fetch_assoc($result)) {
		$data[] = $row;
	}	
	return $data;
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "oebb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// set encoding to utf-8
mysqli_set_charset($conn, "utf8");

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM bahnhof";
$data = getSQLResultObject($sql, $conn);

?>

	<body>
		<h1>Verbindung Suchen</h1>
		<form action="/fahrplan.php" method="post">
			Von: 
			<select name="abfahrtsort">
				<option value="">Bitte Wählen</option>
<?php
	for($x = 0; $x <= sizeof($data) - 1; $x++) {
		echo "<option value=\"" . $data[$x]["name"] . "\">" . $data[$x]["name"] . "</option>";
	}
?>
			</select>
			 Bis: 
			<select name="ankunftsort">
				<option value="">Bitte Wählen</option>
<?php
	for($x = 0; $x <= sizeof($data) - 1; $x++) {
		echo "<option value=\"" . $data[$x]["name"] . "\">" . $data[$x]["name"] . "</option>";
	}
?>
			</select>
			Abfahrtszeit: <input type="time" name="abfahrtszeit"> <input type="submit" value="Suchen"> <input type="reset" value="Reset">
		</form>
		<a href="/newstuff.php">Neue Fahrten hinzufügen</a>
	</body>
</html>