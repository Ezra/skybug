<?php
	require("server.php");

	if(mysqli_connect_errno()) {
		echo "Connection Failed: " . mysqli_connect_errno();
		exit();
	} else {
		header("Location:index.php");
	}

	if($stmt = $skybug -> prepare("INSERT INTO bugs (Name, Description, DateAdded, Module, Kind, Likes, Votes, Rate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
		$stmt -> bind_param('sssssiid', $name, $description, $date, $module, $kind, $likes, $votes, $rate);

		$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
		$description = filter_var(
			preg_replace("|http://skyrates.net/forum/viewtopic.php\?p=(\d+)(#\1)?|","[[Post:$1]]",
			preg_replace("|http://skyrates.net/forum/viewtopic.php\?t=(\d+)|","[[Topic:$1]]",
			$_POST["description"])),FILTER_SANITIZE_STRING);
		$date = date("Y/m/d H:i:s");
		$module = $_POST["module"];
		$kind = $_POST["kind"];
		$likes = 1;
		$votes = 1;
		$rate = 1.0;

		$stmt -> execute();
		$stmt -> close();
	}

	$skybug -> close();
?>
