<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "tankstelle";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// set encoding to utf-8
mysqli_set_charset($conn, "utf8");

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Kunde.KUNDE_ID as Kundennummer, Kunde.Vorname, Kunde.Nachname, Kunde.Strasse, Kunde.PLZ, Kunde.Ort, Kunde.Geburtsdatum, SUM(Verbrauch.Menge) as Treibstoffverbrauch, SUM(Verbrauch.Preis) as Gesamtpreis FROM Kunde LEFT JOIN Verbrauch ON Kunde.Kunde_ID = Verbrauch.Kunde_ID WHERE Kunde.Kunde_ID = ". $_POST["customernumber"] .";";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	$row = mysqli_fetch_assoc($result)
	
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Tankstellenverwaltung</title>
	</head>
	<body>
		<h1>Suchergebnis</h1>
		<table>
<?php
	foreach($row as $key => $value) {
		echo "	<tr>";
		echo "		<th>". $key ."</th>";
		echo "		<td>". $value ."</td>";
		echo "	</tr>";
	}
?>
		</table>
	</body>
</html>
<?php
} else {
    echo "0 results";
}


$conn->close();
?>