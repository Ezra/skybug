$.tablesorter.addParser({
	id: 'prio_scanner',
	is: function(s) { return false; },
	format: function(s) {
		var posnlist = s.replace(/<\/?(button|input|img|div)([^<>]*)>/g,"").match(/\d+/g);
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
