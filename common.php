<?php
require_once("Auth/OpenID.php");
require_once("Auth/OpenID/MemcachedStore.php");
require_once("Auth/OpenID/Consumer.php");
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

$memcache = new Memcache();
$memcache->connect('localhost', 11211) or die("Could not connect to memcached");
$store = new Auth_OpenID_MemcachedStore($memcache);
$consumer = new Auth_OpenID_Consumer($store);

session_start();
?>
