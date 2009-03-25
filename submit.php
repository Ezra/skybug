<?php
echo "0";
require("server.php");
echo "1";

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
} else {
	echo "2";
#	header("Location:index.php");
}

if($stmt = $skybug -> prepare("INSERT INTO bugs (Name, Description, DateAdded, Kind, Status, Likes, Votes, Rate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
	echo "win";
	$stmt -> bind_param('sssssiiid', $name, $description, $date, $kind, $status, $likes, $votes, $rate);

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
} else echo "lose";

$skybug -> close();
?>
