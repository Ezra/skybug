<?php

session_start();

unset($_SESSION['openid']);
unset($_SESSION['username']);
unset($_SESSION['faction']);

$_SESSION['msg'] = "You have successfully logged out.";

header("Location: index.php");

?>