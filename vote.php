<?php
	require("server.php");

	if(mysqli_connect_errno()) {
		echo "Connection Failed: " . mysqli_connect_errno();
		exit();
	}

	$id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_FLOAT);
	$value = filter_var($_POST["dir"], FILTER_SANITIZE_STRING);

	if($stmt = $skybug -> prepare("UPDATE bugs SET Votes = Votes + 1 WHERE ID = ? LIMIT 1")) {
		$stmt -> bind_param('i', $id);
		if($value == "up" || $value == "down") {
			$stmt -> execute();
		}
		$stmt -> close();

	}
	if($stmt = $skybug -> prepare("UPDATE bugs SET Likes = Likes + 1 WHERE ID = ? LIMIT 1")) {
		$stmt -> bind_param('i', $id);
		if($value == "up") {
			$stmt -> execute();
		}
		$stmt -> close();

	}
	if($stmt = $skybug -> prepare("UPDATE bugs SET Rate = Likes / Votes WHERE ID = ? LIMIT 1")) {
		$stmt -> bind_param('i', $id);
		if($value == "up" || $value == "down") {
			$stmt -> execute();
		}
		$stmt -> close();
	}
	if($stmt = $skybug -> prepare("SELECT Likes, Votes FROM bugs WHERE ID = ? LIMIT 1")) {
		$stmt -> bind_param('i', $id);
		$stmt -> execute();
		$stmt -> bind_result($likes, $votes);
		$stmt -> fetch();
		$stmt -> close();
		echo $likes . "/" . $votes;
	}

	$skybug -> close();
?>
