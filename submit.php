<?php
require("server.php");

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
} else {
	header("Location:index.php");
}

if($stmt = $skybug -> prepare("INSERT INTO bugs (Name, Description, DateAdded, Kind, Status, Likes, Votes, Rate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
	$stmt -> bind_param('sssssiid', $name, $description, $date, $kind, $status, $likes, $votes, $rate);

	$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
	$date = date("Y/m/d H:i:s");
	$kind = $_POST["kind"];
	$status = 'Posted';
	$likes = 1;
	$votes = 1;
	$rate = 1.0;

	$stmt -> execute();
	$stmt -> close();
}

$skybug -> close();
?>
