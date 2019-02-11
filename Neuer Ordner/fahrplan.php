<html>
	<head>
		<meta charset="utf-8"/>
		<title>Fahrplan</title>
	</head>
<?php
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

if ($_POST["ankunftsort"] === "" || $_POST["abfahrtsort"] == "" || $_POST["abfahrtszeit"] === "") {
	echo "Bitte überprüfen Sie ihre Eingaben!";
	exit();
}

$sql = "SELECT zug.name as Zug, abfahrt.name as Abfahrtsort, fahrplan.Abfahrtszeit, ankunft.name as Ankunftsort, fahrplan.Ankunftszeit FROM fahrplan LEFT JOIN bahnhof abfahrt ON fahrplan.Abfahrtsort = abfahrt.idBahnhof LEFT JOIN bahnhof ankunft ON fahrplan.Ankunftsort = ankunft.idBahnhof LEFT JOIN zug ON fahrplan.Zug = zug.idZug WHERE abfahrt.name = \"" . $_POST["abfahrtsort"] . "\" AND ankunft.name = \"" . $_POST["ankunftsort"] . "\" AND fahrplan.Abfahrtszeit >= STR_TO_DATE('" . $_POST["abfahrtszeit"] . "', '%H:%i') ORDER BY fahrplan.Abfahrtszeit;";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
?>
	<body>
		<h1>Suchergebnis</h1>
		<table>
<?php
	while($row = mysqli_fetch_assoc($result)) {
		echo "	<tr>";
		echo "		<td>". $row["Zug"] ."</td>";
		echo "		<td>". $row["Abfahrtsort"] ."</td>";
		echo "		<td>". $row["Abfahrtszeit"] ."</td>";
		echo "		<td>". $row["Ankunftsort"] ."</td>";
		echo "		<td>". $row["Ankunftszeit"] ."</td>";
		echo "	</tr>";
	}
?>
		</table>
	</body>
</html>


<?php

} else {
	echo "Keine Zugverbindungen gefunden!";
}
?>
