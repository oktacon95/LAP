<html>
	<head>
		<meta charset="utf-8"/>
		<title>ÖBB Erweiterungen</title>
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

$stationsSQL = "SELECT name FROM bahnhof";
$trainsSQL = "SELECT name FROM zug";
$stations = getSQLResultObject($stationsSQL, $conn);
$trains = getSQLResultObject($trainsSQL, $conn);

?>

	<body>
		<h1>Erweiterungen</h1>
		<form action="/output.php" method="post">
			Zug: 
			<select name="zug">
				<option value="">Bitte Wählen</option>
<?php
	for($x = 0; $x <= sizeof($trains) - 1; $x++) {
		echo "<option value=\"" . $trains[$x]["idZug"] . "\">" . $trains[$x]["name"] . "</option>";
	}
?>
			</select>
			Von: 
			<select name="abfahrtsort">
				<option value="">Bitte Wählen</option>
<?php
	for($x = 0; $x <= sizeof($stations) - 1; $x++) {
		echo "<option value=\"" . $stations[$x]["idBahnhof"] . "\">" . $stations[$x]["name"] . "</option>";
	}
?>
			</select>
			 Bis: 
			<select name="ankunftsort">
				<option value="">Bitte Wählen</option>
<?php
	for($x = 0; $x <= sizeof($stations) - 1; $x++) {
		echo "<option value=\"" . $stations[$x]["idBahnhof"] . "\">" . $stations[$x]["name"] . "</option>";
	}
?>
			</select>
			Ankunftszeit: <input type="time" name="ankunftszeit"> Abfahrtszeit: <input type="time" name="abfahrtszeit"> <input type="submit" value="Erstellen"> <input type="reset" value="Reset">
		</form>
	</body>
</html>

<!-- <?php

if (!empty($_POST)) {
	echo $_POST["zug"];
	// if (!empty($_POST["zug"]) && !empty($_POST["abfahrtsort"]) && !empty($_POST["ankunftsort"]) && !empty($_POST["abfahrtszeit"]) && !empty($_POST["ankunftszeit"])) {
	if ($_POST["zug"] !== "" || $_POST["abfahrtsort"] !== "" || $_POST["ankunftsort"] !== "" || $_POST["abfahrtszeit"] !== "" || $_POST["ankunftszeit"]) {
		$newTripSQL = "INSERT INTO `oebb`.`fahrplan`(`Zug`, `Abfahrtsort`, `Abfahrtszeit`, `Ankunftsort`, `Ankunftszeit`) VALUES (" . $_POST["zug"] . ", " . $_POST["abfahrtsort"] . ", STR_TO_DATE('" . $_POST["abfahrtszeit"] . "', '%H:%i'), " . $_POST["ankunftsort"] . ", STR_TO_DATE('" . $_POST["ankunftszeit"] . "', '%H:%i'));";

		if (mysqli_query($conn, $newTripSQL) === TRUE) {
    		echo "New record created successfully";
		} else {
    		echo "Error: " . $newTripSQL . "<br>" . $conn->error;
		}

	} else {
		echo "Please insert something into each field before submitting!";
	}	
	
}

?> -->