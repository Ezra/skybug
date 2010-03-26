<?php
	require("common.php");

	if(mysqli_connect_errno()) {
		echo "Connection Failed: " . mysqli_connect_errno();
		exit();
	}

	$id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_FLOAT);
	$value = filter_var($_POST["dir"], FILTER_SANITIZE_STRING);

	$current_vote = null;

	if($stmt = $skybug -> prepare("SELECT Vote FROM log WHERE User = ? AND Bug = ? LIMIT 1")) {
	  $stmt -> bind_param('si', $uuid, $id);
		$stmt -> execute();
		$stmt -> bind_result($current_vote);
		$stmt -> fetch();
		$stmt -> close();
	}

	function str_str_int($stmt, $str1, $str2, $int) {
		if($stmt) {
			$stmt -> bind_param('ssi', $str1, $str2, $int);
	      		$stmt -> execute();
	      		$stmt -> close();
		}
	}

	function one_int($stmt, $int) {
		if($stmt) {
			$stmt -> bind_param('i', $int);
			$stmt -> execute();
			$stmt -> close();
		}
	}

	if($current_vote) {
		if(!($current_vote == $value)) {
			if($current_vote == "up") { one_int($skybug -> prepare("UPDATE bugs SET Likes = Likes - 1 WHERE ID = ? LIMIT 1"), $id); }
			                     else { one_int($skybug -> prepare("UPDATE bugs SET Likes = Likes + 1 WHERE ID = ? LIMIT 1"), $id); }
			str_str_int($skybug -> prepare("UPDATE log SET Vote = ? WHERE User = ? AND Bug = ? LIMIT 1"), $value, $uuid, $id);
		}
	} elseif($value) {
		one_int($skybug -> prepare("UPDATE bugs SET Votes = Votes + 1 WHERE ID = ? LIMIT 1"), $id);
		if($value == "up") { one_int($skybug -> prepare("UPDATE bugs SET Likes = Likes + 1 WHERE ID = ? LIMIT 1"), $id); }
		str_str_int($skybug -> prepare("INSERT INTO log (Vote, User, Bug) VALUES (?, ?, ?)"), $value, $uuid, $id);
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
