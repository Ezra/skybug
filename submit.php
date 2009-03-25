<?php
require("server.php");

$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
$date = date("Y/m/d H:i:s");
$score = 1;
$status = 'Posted';

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}

if($stmt = $skybug -> prepare("INSERT INTO bugs (Name, Description, DateAdded, Score, Status) VALUES (?, ?, ?, ?, ?)")) {
	$stmt -> bind_param('sssis', $name, $description, $date, $score, $status);
	$stmt -> execute();
	$stmt -> close();
	
	?>
	<table align="center" border="1px">
		<caption>Your bug</caption>
		<tr>
			<th>Name</th>
			<th>Description</th>
		</tr>
		<tr>
			<td><?= $name ?></td>
			<td><?= $description ?></td>
		</tr>
	</table>
	<div align="center">
		has been added.<br />
		<a href="index.php">return</a>
	</div>
	<?php
	
} else {
	
	?>
	<div style="text-align: center">
		There was an error entering your bug. Please try again, or contact a moderator.<br />
		<a href="index.php">return</a>
	</div>
	<?php
	
}

$skybug -> close();
?>
