<?php
	require_once("common.php");

	if(!$loggedin) { die("You're not logged in."); }

	$id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_FLOAT);
	$value = filter_var($_POST["dir"], FILTER_SANITIZE_STRING);

	$result = run($skybug, "SELECT Vote FROM log WHERE User = ? AND Bug = ? LIMIT 1", array($username, $id));
	if ($result) {
	  $current_vote = $result->fetchRow()->Vote;
	  if(!($current_vote == $value)) {
		if($current_vote == "up") { run($skybug, "UPDATE bugs SET Likes = Likes - 1 WHERE ID = ? LIMIT 1", array($id)); }
		else { run($skybug, "UPDATE bugs SET Likes = Likes + 1 WHERE ID = ? LIMIT 1", array($id)); }
		run($skybug, "UPDATE log SET Vote = ? WHERE User = ? AND Bug = ? LIMIT 1", array($value, $username, $id));
	  }
	  $result -> free();
	} elseif($value) {
	  run($skybug, "UPDATE bugs SET Votes = Votes + 1 WHERE ID = ? LIMIT 1", array($id));
	  if($value == "up") { run($skybug, "UPDATE bugs SET Likes = Likes + 1 WHERE ID = ? LIMIT 1", array($id)); }
	  run($skybug, "INSERT INTO log (Vote, User, Bug) VALUES (?, ?, ?)", array($value, $username, $id));
	}

	if($value == "up" || $value == "down") {
	  run($skybug, "UPDATE bugs SET Rate = Likes / Votes WHERE ID = ? LIMIT 1", array($id));
	}

	$result = run($skybug, "SELECT Likes, Votes FROM bugs WHERE ID = ? LIMIT 1", array($id));
	if($result) {
	  $row =& $result->fetchRow();
	  echo $row->Likes . "/" . $row->Votes;
	  $result -> free();
	}

	$skybug -> disconnect();
?>
