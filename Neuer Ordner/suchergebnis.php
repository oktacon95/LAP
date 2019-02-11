<html>
	<head>
		<meta charset="UTF-8">
		<title>Trankstellenverwaltung</title>
	</head>
<?php

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Objekt vorbereiten zur Verbindung zur Datenbank
$mysqli = new mysqli("localhost", "root", "root", "tankstelle");
$mysqli->set_charset("utf8");

# Fehler abfangen falls die Verbindung fehl schlägt
if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}

$sql = "SELECT Verbrauch.Kunde_ID as Kundenname, Kunde.Vorname, Kunde.Nachname, Kunde.Strasse, Kunde.PLZ, Kunde.Ort, Kunde.Geburtsdatum, SUM(Verbrauch.Menge) as Treibstoffverbrauch, SUM(Verbrauch.Preis) as Gesamtpreis FROM Verbrauch
LEFT JOIN Kunde ON Verbrauch.Kunde_ID = Kunde.Kunde_ID
WHERE Verbrauch.Kunde_ID = ?;";

// $statement = $mysqli->stmt_init();
echo intval($_POST["customernumber"]);

// SQL Statement vorbereiten und den Wert von dem Userinput übernehmen
$statement = $mysqli->prepare($sql);
$statement->bind_param('i', intval($_POST["customernumber"]));

//SQL-Statement abschicken und Daten abholen
$statement->execute();
$result = $statement->get_result();

// Falls das SQL-Statement keine Einträge zu der ID hat und der User was falsches eingegeben hat, soll eine Fehlermeldung kommen.
if (($result->num_rows !== 0) && ($result)) {
	$row = $result->fetch_object();
	echo "<body>";
	echo "	<h1>Suchergebnis</h1>";
	echo "	<table>";
	foreach($row as $key => $value) {
		echo "<tr>";
		echo "	<th>$key:</th>";
		echo "  <td>$value</td>";
		echo "</tr>"; 
	}
	echo "	</table>";
	echo "</body>";
} else {
	echo "<p>Der Kunde wurde nicht gefunden oder ungültige Eingabe!</p>";
}
?>
</html>