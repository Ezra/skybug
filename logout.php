<?php

session_start();

unset($_SESSION['username']);
unset($_SESSION['openid']);
$_SESSION['msg'] = "You have successfully logged out.";

header("Location: index.php");

?>