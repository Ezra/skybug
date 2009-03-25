<?php
require("server.php");

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
} else {
	header("Location:index.php");
}

if($stmt = $skybug -> prepare("UPDATE bugs SET Score = Score + ? WHERE ID = ? LIMIT 1")) {
	$stmt -> bind_param('ii', $inc, $id);
	foreach($_POST as $id => $value) {
		if($value == "+") {
			$inc = 1;
			$stmt -> execute();
		} else if($value == "-") {
			$inc = -1;
			$stmt -> execute();
		}
	}
	$stmt -> close();
	
}

$skybug -> close();
?>
