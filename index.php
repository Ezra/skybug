<?php
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<title>Skybug Tracker</title>
		<link rel="stylesheet" type="text/css" href="skybug.css" />
		<script src="utility.js" type="text/javascript"></script>
		<script src="buttons.js" type="text/javascript"></script>
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<script type="text/javascript">
			// You may specify partial version numbers, such as "1" or "1.3",
			// with the same result. Doing so will automatically load the
			// latest version matching that partial revision pattern
			// (i.e. both 1 and 1.3 would load 1.3.1 today).
			
			google.load("jquery", "1.3");
			
			google.setOnLoadCallback(function() {
				// Place init code here instead of $(document).ready()
				$("#bugTable").tablesorter({
					headers: { 0: { sorter: 'prio_scanner' }},
					sortList: [[0,1],[2,0],[3,0]]
				});
			});
		</script>
		<script type="text/javascript" src="jquery.tablesorter.min.js"></script>
		<script type="text/javascript">
			$.tablesorter.addParser({
				id: 'prio_scanner',
				is: function(s) { return false; },
				format: function(s) {
					var posnlist = s.replace(/<\/?(button|input|img)([^<>]*)>/g,"").match(/\d+/g);
					var pos = parseInt(posnlist[0]);
					var n = parseInt(posnlist[1]);
					if (n == 0) { return 0; }
					var z = 1.96; // The z-score of the 0.05 confidence interval
					var phat = pos/n;
					var value = (phat + (z*z)/(2*n) - z*Math.sqrt((phat*(1-phat)+z*z/(4*n))/n))/(1+z*z/n);
					return value;
				},
				type: 'numeric'
			});
			</script>
	</head>

	<body>
		<h1 id="heading" style="margin-left: auto; margin-right: auto; text-align: center;">
			Skybug Tracker
		</h1>

	    <div id="results" style="margin-left:auto; margin-right: auto;">
			<form action="vote.php" method="post">
				<table id="bugTable" border="1px">
					<thead>
						<tr id="row-head">
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
					</thead>
					<tbody>
						<?php
						require("server.php");

						if(mysqli_connect_errno()) {
							echo "Connection Failed: " . mysqli_connect_errno();
							exit();
						}

						if($stmt = $skybug -> prepare("SELECT ID, Name, Description, Module, Kind, Likes, Votes FROM bugs")) {
							$stmt -> execute();
							$stmt -> bind_result($id, $name, $description, $module, $kind, $likes, $votes);
							while($stmt -> fetch()) {
								?>
								<tr id="row-<?= $id ?>">
									<td style="text-align:center; padding-left:4; padding-right:4">
										<button class="positive" id="up<?= $id ?>" onclick="priorityUp(<?= $id ?>);" style="padding:0px; margin: 0px;" >
											<img src="+.png" alt="+" style="padding:0px; margin: 0px;" />
										</button>
										<?= $likes."/".$votes ?>
										<input type="hidden" name="<?= $id ?>" id="<?= "vote".$id ?>" value="0" />
										<button class="negative" id="down<?= $id ?>" onclick="priorityDown(<?= $id ?>);" style="padding:0px; margin: 0px;" >
											<img src="-.png" alt="-" style="padding:0px; margin: 0px;" />
										</button>
									</td>
									<td style="text-align:center">
										<?= stripslashes($name) ?>
									</td>
									<td style="text-align:center; background-color:<?=
											(($module=="Skyrates")?"#99CCFF":
											(($module=="Skybug")?"#FFCC99":
											$module)) ?>">
										<?= $module ?>
									</td>
									<td style="text-align:center; background-color:<?=
											(($kind=="Bug")?"#FF99CC":
											(($kind=="Feature")?"#CCFF99":
											$kind)) ?>">
										<?=	$kind ?>
									</td>
									<td style="text-align:center">
										<?= preg_replace("|\[\[[Pp]ost:(\d+)\]\]|", "<a href=\"http://skyrates.net/forum/viewtopic.php?p=$1#$1\">Post #$1</a>",
											preg_replace("|\[\[[Tt]opic:(\d+)\]\]|", "<a href=\"http://skyrates.net/forum/viewtopic.php?t=$1\">Topic #$1</a>",
											stripslashes($description))) ?>
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
				</table>
			</form>
		</div>
<br />
		<div id="submission-form" style="width:20em; margin-right: auto">
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
							<input type="radio" name="kind" value="Bug" checked="checked"/>
						</label>
						<br />
						<label style="text-align:right">
							Feature Request
							<input type="radio" name="kind" value="Feature"/>
						</label>
					</div>
					<div>
						<input type="submit" value="Add to Skybug"/>
					</div>
				</fieldset>
			</form>
		</div>

	        <div id="footer">
		  <p>Click the table headers to sort by that column, and click the shiny buttons to approve or disapprove of an issue.
		    Please restrain yourselves from voting multiple times - we're still working on authentication.
		    Sorting of the Priority column is done with a Wilson Score, with a 95% confidence interval.</p>
		  <p>Use the form above to add an issue to Skybug.</p>
		  <p>Images from the <a href="http://famfamfam.com/lab/icons/silk/">Silk Icon set, by Mark James</a>. Used by CC-BY license.</p>
		  <p style="width:88px; margin-left: auto; margin-right: auto">
		    <a href="http://validator.w3.org/check?uri=referer">
		      <img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" style="border-width:0px;" />
		    </a>
		  </p>
	       </div>
	</body>
</html>
