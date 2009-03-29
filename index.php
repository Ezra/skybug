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
		<script type="text/javascript" src="tablesort.js"></script>
	</head>

	<body>
		<h1 id="heading" style="margin-left: auto; margin-right: auto; text-align: center;">
			Skybug Tracker
		</h1>

	    <div id="results" style="width: 90%; margin-left:auto; margin-right: auto; margin-bottom: 2em;">
			<form action="vote.php" method="post">
				<table id="bugTable" border="1px">
					<thead>
						<tr id="row-head">
							<th style="width:8%">
								Priority
							</th>
							<th style="width:20%">
								Name
							</th>
							<th style="width:5%">
								Module
							</th>
							<th style="width:5%">
								Kind
							</th>
							<th style="width:50%">
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
											<td style="text-align:center; padding:0px;">
												<button class="positive" id="up<?= $id ?>" onclick="priorityUp(<?= $id ?>);" >
													<img src="+.png" alt="+"/>
												</button>
												<button class="negative" id="down<?= $id ?>" onclick="priorityDown(<?= $id ?>);">
													<img src="-.png" alt="-"/>
												</button>
												<?= $likes."/".$votes ?>
												<input type="hidden" name="<?= $id ?>" id="<?= "vote".$id ?>" value="0" />
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
		<div id="submission-form" style="width:20em; margin-left: auto; margin-right: auto">
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
			<p>
				Click the table headers to sort by that column, and click the shiny buttons to approve or disapprove of an issue.
				Please restrain yourselves from voting multiple times - we're still working on authentication.
				Sorting of the Priority column is done with a Wilson Score, with a 95% confidence interval.
			</p>
			<p>
				Use the form above to add an issue to Skybug.
			</p>
			<p>
				Images from the <a href="http://famfamfam.com/lab/icons/silk/">Silk Icon set, by Mark James</a>. Used by CC-BY license.
			</p>
			<p style="width:88px; margin-left: auto; margin-right: auto">
				<a href="http://validator.w3.org/check?uri=referer">
					<img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" style="width:88; border-width:0px;" />
				</a>
			</p>
		</div>
	</body>
</html>
