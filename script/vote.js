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
	$.post("../vote.php", {id: vote_id, dir: pres}, function(newscore) {
		$("#" + "up" + vote_id).removeClass("pressed");
		$("#" + "down" + vote_id).removeClass("pressed");
		$("#" + pres + vote_id).addClass("pressed");
		var scoreid = "#" + "score" + vote_id;
		$(scoreid).html(newscore);
		$(scoreid).effect("highlight", {}, 2000);
		$("#bugTable").trigger("update");
		$("#bugTable").trigger("sorton",[sorter]);
})}
