<?php
	header('Content-Type: text/html; charset=utf-8');
	include('cookie.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<title>Skybug Tracker</title>
		<link rel="stylesheet" type="text/css" href="skybug.css" />
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<script type="text/javascript">
			var sorter = [[0,1],[2,0],[3,0]];

			google.load("jquery", "1.3");
			google.load("jqueryui", "1.7");
			google.setOnLoadCallback(function() {
				// Place init code here instead of $(document).ready()
				$("#bugTable").tablesorter({
					headers: { 0: { sorter: 'prio_scanner' }},
					sortList: sorter
				});
				<?php
				if($stmt = $skybug -> prepare("SELECT Vote,Bug FROM log WHERE User = ?")) {
					$stmt -> bind_param('s', $uuid);
					$stmt -> execute();
					$stmt -> bind_result($current_vote,$bug_id);
					while($stmt -> fetch()) {
				?>
				$("#<?=$current_vote . $bug_id?>").addClass("pressed");
				<?php
					}
					$stmt -> close();
				} ?>
			});
			function do_vote(vote_id, pres) {
				$.post("vote.php", {id: vote_id, dir: pres}, function(newscore) {
					$("#" + "up" + vote_id).removeClass("pressed");
					$("#" + "down" + vote_id).removeClass("pressed");
					$("#" + pres + vote_id).addClass("pressed");
					var scoreid = "#" + "score" + vote_id;
					$(scoreid).html(newscore);
					$(scoreid).effect("highlight", {}, 2000);
					$("#bugTable").trigger("update");
					$("#bugTable").trigger("sorton",[sorter]);
			})}
		</script>
		<script type="text/javascript" src="jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="tablesort.js"></script>
	</head>

	<body>
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

						 if($stmt = $skybug -> prepare("SELECT ID, Name, Description, Module, Kind, Likes, Votes FROM bugs")) {
							$stmt -> execute();
							$stmt -> bind_result($id, $name, $description, $module, $kind, $likes, $votes);
							while($stmt -> fetch()) {
								?>
					<tr id="row<?= $id ?>">
						<td class="centered" style="padding:0px;">
							<button class="positive<?=($cvote=='up')?' pressed':''?>" id="up<?= $id ?>" onclick="do_vote(<?=$id?>,'up');" >
								<img src="+.png" alt="+"/>
                                                        </button>
                                                        <div id="score<?= $id ?>"><?= $likes."/".$votes ?></div>
                                                        <button class="negative<?=($cvote=='down')?' pressed':''?>" id="down<?= $id ?>" onclick="do_vote(<?=$id?>,'down');">
								<img src="-.png" alt="-"/>
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
				$stmt -> close();
			} else {

					?>
					<div class="centered">
						There was an error fetching the bug table. Please try again, or contact Eskay for help.<br />
						<a href="index.php">return</a>
					</div>
					<?php

						 }

						 $skybug -> close();
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
					<div style="float:right; text-align: right">
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
			<p> Use the form above to add an issue to Skybug.</p>
			<p> Images from the <a href="http://famfamfam.com/lab/icons/silk/">Silk Icon set, by Mark James</a>. Used by CC-BY license. </p>
		</div>
			<p class="automargined" style="width:88px;">
				<a href="http://validator.w3.org/check?uri=referer">
					<img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" style="width:88px; border-width:0px;" />
				</a>
			</p>
	</body>
</html>
