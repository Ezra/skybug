<?php
require_once("Auth/OpenID.php");
require_once("Auth/OpenID/MemcachedStore.php");
require_once("Auth/OpenID/Consumer.php");
require_once("server.php");

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}

function getScheme() {
    $scheme = 'http';
    if (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] == 'on') {
        $scheme .= 's';
    }
    return $scheme;
}

function getTrustRoot() {
    return sprintf("%s://%s:%s%s/",
                   getScheme(), $_SERVER['SERVER_NAME'],
                   $_SERVER['SERVER_PORT'],
                   dirname($_SERVER['PHP_SELF']));
}

function getReturnTo() {
    return sprintf("%s://%s:%s%s/finish.php",
                   getScheme(), $_SERVER['SERVER_NAME'],
                   $_SERVER['SERVER_PORT'],
                   dirname($_SERVER['PHP_SELF']));
}

$skyrates_prefix = "http://skyrates.net/OpenID/index.php/idpage?user=";

function deURI($uri) {
  global $skyrates_prefix;
  return substr($uri, strlen($skyrates_prefix));
}

$memcache = new Memcache();
$memcache->connect('localhost', 11211) or die("Could not connect to memcached");
$store = new Auth_OpenID_MemcachedStore($memcache);
$consumer = new Auth_OpenID_Consumer($store);

session_start();

if (isset($_SESSION['username'])) {
  $loggedin = true;
  $username = $_SESSION['username'];
 } elseif (isset($_SESSION['openid'])) {
  $loggedin = true;
  $username = deURI($_SESSION['openid']);
  $_SESSION['username'] = $username;
 } else {
  $loggedin = false;
 }
?>
