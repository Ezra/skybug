<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once('common.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<title>Skybug Tracker</title>
		<link rel="stylesheet" type="text/css" href="css/skybug.css" />
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<script type="text/javascript"><?php require "script/vote.js" ?></script>
		<script type="text/javascript" src="script/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="script/jquery.cookie.js"></script>
		<script type="text/javascript" src="script/jquery.json.js"></script>
		<script type="text/javascript" src="script/jquery.cookiejar.pack.js"></script>
		<script type="text/javascript" src="script/tablesort.js"></script>
	</head>

	<body>
		<div id="user" class="righted">
			<?php if(isset($_SESSION['msg'])) { ?>
			<div class="message" id="status_message"><?= $_SESSION['msg'] ?></div>
			<?php 	unset($_SESSION['msg']);
						}
						$places = array("Azure League" => "%s's blueprints",
						                "Jade Hand" => "%s's requisitions",
						                "Crimson Armada" => "%s's orders",
						                "Earthen Order" => "%s's prayers",
						                "Court of Violets" => "%s's assurances",
						                "Flight School" => "%s's causes",
						                "Independents" => "%s's foci",
						                "Pirates" => "%s's todo list");
						$shortnames = array("Azure League" => "league",
						                    "Jade Hand" => "hand",
						                    "Crimson Armada" => "armada",
						                    "Earthen Order" => "order",
						                    "Court of Violets" => "court",
						                    "Flight School" => "school",
						                    "Independents" => "indies",
						                    "Pirates" => "devs");
						$welcome = sprintf($places[$faction], $username);
						if($welcome==NULL) {
							$welcome = sprintf("You, %s, have logged in fine. But something is wonky with your faction. Please report the text ('%s') and the code ('%s') to tSotW.", $username, $faction, rand(1000,9000)); }
						$shortname = $shortnames[$faction];
			      if($loggedin) {	?>
			<div><span class="faction <?= $shortname ?>"><?= $welcome ?></span> (<a href="logout.php">Log out</a>)</div>
			<?php } else { ?>
			<form method="get" action="verify.php">
				<!-- <label>Skyrates Username: <input type="text" name="openid_identifier_suffix" /></label> -->
				<button class="submit" type="submit" value="Login">Login</button>
			</form>
			<?php } ?>
		</div>
		<h1 id="heading" class="centered automargined">
			Skybug Tracker
		</h1>

	  <div id="results" class="automargined" style="width: 95%">
			<table id="bugTable" class="tablesorter">
				<thead>
					<tr id="row-head">
						<th style="width:10%">Priority</th>
						<th style="width:20%">Name</th>
						<th style="width:5%">Module</th>
						<th style="width:5%">Kind</th>
						<th style="width:50%">Description</th>
					</tr>
				</thead>
				<tbody>
					<?php
						 if ($loggedin) { $class = ""; } else { $class = " disabled"; }
						 $result = run($skybug, "SELECT ID, Name, Description, Module, Kind, Likes, Votes FROM bugs", null);
						 if($result) {
							while($row =& $result -> fetchRow()) {
						   $id = $row->ID; $name = $row->Name; $description = $row->Description; $module = $row->Module; $kind = $row->Kind; $likes = $row->Likes; $votes = $row->Votes;
								?>
					<tr id="row<?= $id ?>">
						<td class="centered" style="padding:0px;">
							<button class="positive<?= $class ?>" id="up<?= $id ?>"	onclick="do_vote(<?=$id?>,'up');" >
								<img src="images/+.png" alt="+"/>
							</button>
							<div id="score<?= $id ?>"><?= $likes."/".$votes ?></div>
							<button class="negative<?= $class ?>" id="down<?= $id ?>" onclick="do_vote(<?=$id?>,'down');">
								<img src="images/-.png" alt="-"/>
							</button>
						</td>
						<td>
							<?= stripslashes($name) ?>
						</td>
						<td class="<?=$module?>">
							<?= $module ?>
						</td>
						<td class="<?=$kind?>">
							<?=$kind ?>
						</td>
						<td>
							<?= preg_replace("|\[\[Post:(\d+)\]\]|i", "<a href=\"http://skyrates.net/forum/viewtopic.php?p=$1#$1\">Post #$1</a>",
							    preg_replace("|\[\[Topic:(\d+)\]\]|i", "<a href=\"http://skyrates.net/forum/viewtopic.php?t=$1\">Topic #$1</a>",
							    stripslashes($description))) ?>
						</td>
					</tr>
					<?php
				}
				$result -> free();
			} else {

					?>
					<div class="centered">
						There was an error fetching the bug table. Please try again, or contact Eskay for help.<br />
						<a href="index.php">return</a>
					</div>
					<?php

						 }

						 $skybug -> disconnect();
					?>
				</tbody>
			</table>
		</div>
		<div id="submission-form" class="automargined" style="width:24em;">
			<form action="submit.php" method="post">
				<fieldset>
					<div>
						<label>Name:<br />
							<input type="text" name="name"/>
						</label>
					</div>
					<div>
						<label>Description:<br />
							<textarea name="description" rows="4" cols="22"></textarea>
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
					<div class="righted">
						<label>
							Bug Report
							<input type="radio" name="kind" value="Bug" checked="checked"/>
						</label>
						<br />
						<label>
							Feature Request
							<input type="radio" name="kind" value="Feature"/>
						</label>
					</div>
					<div>
						<button class="submit" type="submit" value="submit">Add to Skybug</button>
					</div>
				</fieldset>
			</form>
		</div>

		<div id="footer" class="automargined topspaced">
			<p> Click the table headers to sort by that column, and click the shiny buttons to approve or disapprove of an issue.
			    Sorting of the Priority column is done with a Wilson Score, with a 95% confidence interval.
			    You can hold shift and then click multiple columns to sort by more than one column. </p>
			<p> When you vote (which unfortunately requires javascript), you'll get some feedback, the current likes/votes of the item you voted on will be fetched from the server, and it may be resorted, if applicable. </p>
			<p> You get one vote per issue per Skyrates user account. Please don't create sockpuppets, especially as they're pretty obvious. </p>
			<p> Use the form above to add an issue to Skybug.</p>
			<p> Images from the <a href="http://famfamfam.com/lab/icons/silk/">Silk Icon set, by Mark James</a>. Used by CC-BY license. </p>
		</div>
			<p class="automargined" style="width:88px;">
				<a href="http://validator.w3.org/check?uri=referer">
					<img src="http://www.w3.org/Icons/valid-xhtml11-blue" alt="Valid XHTML 1.1" height="31" style="width:88px; border-width:0px;" />
				</a>
			</p>
	</body>
</html>
<!-- Local Variables: -->
<!-- mode:html -->
<!-- tab-width:2 -->
<!-- End: -->
