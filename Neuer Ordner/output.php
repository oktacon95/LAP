<?php

if (!empty($_POST)) {
	echo $_POST["zug"];
	if ($_POST["zug"] == "" || $_POST["abfahrtsort"] == "" || $_POST["ankunftsort"] == "" || $_POST["abfahrtszeit"] == "" || $_POST["ankunftszeit"]) {
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

?>