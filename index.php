<h1 style="width: 7em; margin-left: auto; margin-right: auto">Skybug Tracker</h1>
<div style="width:20em; margin-left: auto; margin-right: auto">
	<form action="submit.php" method="post">
		<fieldset>
			<label>
				Name:<br />
				<input type="text" name="name"/>
			</label>
			<br />
			<label style="margin-left: auto; margin-right: auto">
				Description:<br />
				<textarea name="description" rows="4" cols="20"></textarea>
			</label>
			<br />
			<input type="submit" value="Add Bug"/>
		</fieldset>
	</form>
</div>

<form action="vote.php" method="post">
<table align="center" border="1px">
	<tr>
		<th rowspan=2>Name</th>
		<th rowspan=2>Description</th>
		<th colspan=3>Priority</th>
	</tr>
	<tr>
		<th>High</th>
		<th />
		<th>Low</th>
	</tr>
	<?php
	$skybug = new mysqli('localhost', 'webuser', 'pilot', 'skybug');
	
	if(mysqli_connect_errno()) {
		echo "Connection Failed: " . mysqli_connect_errno();
		exit();
	}
	
	if($stmt = $skybug -> prepare("SELECT ID, Score, Name, Description FROM bugs ORDER BY Score DESC LIMIT 50")) {
		$stmt -> execute();
		$stmt -> bind_result($id, $score, $name, $description);
		while($stmt -> fetch()) {
			?>
			<tr>
				<td style="text-align:center"><?= $name ?></td>
				<td style="text-align:center"><?= $description ?></td>
				<td style="text-align:center"><input type="radio" name=<?= $id ?> value="+"/>
				<td style="text-align:center; padding-left:4; padding-right:4"><strong><?= $score ?></strong></td>
				<td style="text-align:center"><input type="radio" name=<?= $id ?> value="-"/>
			</tr>
			<?php
		}
		$stmt -> close();
	} else {
		
		?>
		<div style="text-align: center">
			There was an error fetching the bug table. Please try again, or contact a moderator.<br />
			<a href="index.php">return</a>
		</div>
		<?php
		
	}
	
	$skybug -> close();
	?>
	<tr>
		<td colspan=2 />
		<td colspan=3 style="text-align:center">
			<input type="submit" value="Vote"/>
			<input type="reset" value="Clear"/>
		</td>
	</tr>
</table>
