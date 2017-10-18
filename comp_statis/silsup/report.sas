data bb_data;
	set SASHELP.BASEBALL;
	keep nAtBat nHits;
run;

proc corr data=bb_data;
	var nAtBat nHits;
run;
proc corr data=bb_data plots=matrix;
	var nAtBat nHits;
run;
proc plot data=bb_data;
	plot nAtBat*nHits;
run;
proc print data=bb_data;
run;