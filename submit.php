<?php
require("common.php");

$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$description = filter_var(
                          preg_replace("|http://skyrates.net/forum/viewtopic.php\?p=(\d+)(#\1)?|","[[Post:$1]]",
                                       preg_replace("|http://skyrates.net/forum/viewtopic.php\?t=(\d+)|","[[Topic:$1]]", $_POST["description"])),FILTER_SANITIZE_STRING);
$date = date("Y/m/d H:i:s");
$module = $_POST["module"];
$kind = $_POST["kind"];

if($loggedin) {
  $likes = 1;
  $votes = 1;
  $rate = 1.0;
 } else {
  $likes = 0;
  $votes = 0;
  $rate = 0.0;
 }

run($skybug, "INSERT INTO bugs (Name, Description, DateAdded, Module, Kind, Likes, Votes, Rate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
    array($name, $description, $date, $module, $kind, $likes, $votes, $rate));

if (!$loggedin) {
  $_SESSION['msg'] = "You must be logged in to autovote on issues.";
 } else {
  // This is an awful hack for db portability (not relying on last_insert_id). Will be fixed by transitioning to PEAR::DB sequences or PEAR::MDB natively.
  $result = run($skybug, "SELECT ID FROM bugs WHERE Name = ? AND Description = ? AND DateAdded = ? AND Module = ? AND Kind = ?", array($name, $description, $date, $module, $kind));
  if($result) {
	$insert_id = $result->fetchRow()->ID;
	run($skybug, "INSERT INTO log (User, Vote, Bug) VALUES (?, ?, ?)", array($username, "up", $insert_id));
  }
 }
$skybug -> disconnect();
header("Location:index.php");
?>
