<?php
$skybug = new mysqli('localhost', 'webuser', 'pilot', 'skybug');

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}

if($stmt = $skybug -> prepare("UPDATE bugs SET Score = Score + ? WHERE ID = ? LIMIT 1")) {
	$stmt -> bind_param('ii', $inc, $id);
	foreach($_POST as $id => $value) {
		if($value == "+") {
			$inc = 1;
			$stmt -> execute();
		} else if($value == "-") {
			$inc = -1;
			$stmt -> execute();
		}
	}
	$stmt -> close();
	
	?>
	<div style="text-align: center">
		Your votes have been recorded.<br />
		<a href="index.php">return</a>
	</div>
	<?php
	
} else {
	
	?>
	<div style="text-align: center">
		There was an error recording your votes. Please try again, or contact a moderator.<br />
		<a href="index.php">return</a>
	</div>
	<?php
	
}

$skybug -> close();
?>

