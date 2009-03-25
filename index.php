<?php
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Skybug Tracker</title>
		<link rel="stylesheet" type="text/css" href="skybug.css" />
		<script src="utility.js" type="text/javascript"></script>
		<script src="buttons.js" type="text/javascript"></script>
	</head>
	
	<body>
		<h1 style="width: 7em; margin-left: auto; margin-right: auto">
			Skybug Tracker
		</h1>
		
		<div style="width:20em; margin-left: auto; margin-right: auto">
			<form action="submit.php" method="post">
				<fieldset>
					<div>
						<label>
							Name:<br />
							<input type="text" name="name"/>
						</label>
					</div>
					<div>
						<label>
							Description:<br />
							<textarea name="description" rows="4" cols="20"></textarea>
						</label>
					</div>
					<div style="float:left">
						<label>
							<input type="radio" name="module" value="Skyrates" checked="checked"/>
							Skyrates
						</label>
						<br />
						<label>
							<input type="radio" name="module" value="Skybug"/>
							Skybug
						</label>
					</div>
					<div style="float:right; text-align: right">
						<label style="text-align:right">
							Bug Report
							<input type="radio" name="kind" value="B" checked="checked"/>
						</label>
						<br />
						<label style="text-align:right">
							Feature Request
							<input type="radio" name="kind" value="F"/>
						</label>
					</div>
					<div>
						<input type="submit" value="Add to Skybug"/>
					</div>
				</fieldset>
			</form>
		</div>
		
		<table style="margin-left: auto; margin-right: auto" border="1px">
			<form action="vote.php" method="post">
				<tbody>
					<tr>
						<th>
							Priority
						</th>
						<th>
							Name
						</th>
						<th>
							Module
						</th>
						<th>
							Kind
						</th>
						<th>
							Description
						</th>
					</tr>
					<?php
					require("server.php");
				
					if(mysqli_connect_errno()) {
						echo "Connection Failed: " . mysqli_connect_errno();
						exit();
					}
					
					if($stmt = $skybug -> prepare("SELECT ID, Name, Description, Module, Kind, Likes, Votes FROM bugs ORDER BY Rate DESC LIMIT 50")) {
						$stmt -> execute();
						$stmt -> bind_result($id, $name, $description, $module, $kind, $likes, $votes);
						while($stmt -> fetch()) {
							?>
							<tr>
								<td style="text-align:center; padding-left:4; padding-right:4">
									<button onclick="<?="priorityUp(".$id.");" ?>" >+</button>
									<?= $likes."/".$votes ?>
									<input type="hidden" name="<?= $id ?>" id="<?= "vote".$id ?>" value="0" />
									<button onclick="<?="priorityDown(".$id.");" ?>" >-</button>
								</td>
								<td style="text-align:center">
									<?= stripslashes($name) ?>
								</td>
								<td style=
									<?="\"text-align:center; background-color:".
										(($module=="Skyrates")?"#99CCFF":
										(($module=="Skybug")?"#FFCC99":
										$module))."\""?>>
									<?= $module ?>
								</td>
								<td style=
									<?="\"text-align:center; background-color:".
										(($kind=="B")?"#FF99CC":
										(($kind=="F")?"#CCFF99":
										$kind))."\""?>>
									<?=
										(($kind=="B")?"Bug":
										(($kind=="F")?"Feature":
										$kind))
									?>
								</td>
								<td style="text-align:center">
									<?= stripslashes($description) ?>
								</td>
							</tr>
							<?php
						}
						$stmt -> close();
					} else {
						
						?>
						<div style="text-align: center">
							There was an error fetching the bug table. Please try again, or contact Eskay for help.<br />
							<a href="index.php">return</a>
						</div>
						<?php
						
					}
					
					$skybug -> close();
					?>
				</tbody>
			</form>
		</table>
		<p style="width:88px; margin-left: auto; margin-right: auto">
			<a href="http://validator.w3.org/check?uri=referer">
				<img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" style="border-width:0px;" />
			</a>
		</p>
	</body>
</html>