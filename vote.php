<?php
	require("server.php");

	if(mysqli_connect_errno()) {
		echo "Connection Failed: " . mysqli_connect_errno();
		exit();
	} else {
		header("Location:index.php");
	}

	if($stmt = $skybug -> prepare("UPDATE bugs SET Votes = Votes + 1 WHERE ID = ? LIMIT 1")) {
		$stmt -> bind_param('i', $id);
		foreach($_POST as $id => $value) {
			if($value == "+" || $value == "-") {
				$stmt -> execute();
			}
		}
		$stmt -> close();

	}
	if($stmt = $skybug -> prepare("UPDATE bugs SET Likes = Likes + 1 WHERE ID = ? LIMIT 1")) {
		$stmt -> bind_param('i', $id);
		foreach($_POST as $id => $value) {
			if($value == "+") {
				$stmt -> execute();
			}
		}
		$stmt -> close();

	}
	if($stmt = $skybug -> prepare("UPDATE bugs SET Rate = Likes / Votes WHERE ID = ? LIMIT 1")) {
		$stmt -> bind_param('i', $id);
		foreach($_POST as $id => $value) {
			if($value == "+" || $value == "-") {
				$stmt -> execute();
			}
		}
		$stmt -> close();

	}

	$skybug -> close();
?>
