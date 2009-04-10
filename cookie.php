<?php
require("server.php");

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}

if (isset($_COOKIE['uuid'])) {
	$uuid = $_COOKIE['uuid'];
} else {
	$stmt = $skybug -> prepare("SELECT UUID();");
	$stmt -> execute();
	$stmt -> bind_result($uuid);
	$stmt -> fetch();
	$stmt -> close();
	setcookie('uuid', $uuid, pow(2,31)-1);
}
?>