<?php
require("server.php");

$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
$date = date("Y/m/d H:i:s");
$score = 1;
$kind = $_POST["kind"];
$status = 'Posted';

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
} else {
	header("Location:index.php");
}

if($stmt = $skybug -> prepare("INSERT INTO bugs (Name, Description, DateAdded, Score, Kind, Status) VALUES (?, ?, ?, ?, ?, ?)")) {
	$stmt -> bind_param('sssiss', $name, $description, $date, $score, $kind, $status);
	$stmt -> execute();
	$stmt -> close();
}
$skybug -> close();
?>
