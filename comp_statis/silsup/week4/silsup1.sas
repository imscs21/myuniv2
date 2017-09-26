libname mylib "/folders/myshortcuts/silsup/week4";
proc print data=sashelp.fish;
run;
proc univariate data=sashelp.fish noprint;
	histogram height
	/ midpoints = 0 to 20;
run;
proc SGPLOT DATA=sashelp.fish; VBAR Species;
TITLE "The number of each species of fish";
RUN;
 PROC TEMPLATE;
DEFINE STATGRAPH pie;
BEGINGRAPH; LAYOUT REGION;
PIECHART CATEGORY = Species / DATALABELLOCATION = OUTSIDE CATEGORYDIRECTION = CLOCKWISE START = 180 NAME = 'pie';
DISCRETELEGEND 'pie' / TITLE = "Percentage of each species of fish";
ENDLAYOUT; ENDGRAPH;
END; 
RUN;
proc sgrender data=sashelp.fish
template = pie;
run;
proc print data=sashelp.holiday;
run;
data tmp;
set sashelp.holiday;
month = month+"월";
run;
 PROC TEMPLATE;
DEFINE STATGRAPH pie2;
BEGINGRAPH; LAYOUT REGION;
PIECHART CATEGORY = month / DATALABELLOCATION = OUTSIDE CATEGORYDIRECTION = CLOCKWISE START = 180 NAME = 'pie';
DISCRETELEGEND 'pie' / TITLE = "Percentage of each species of fish";
ENDLAYOUT; ENDGRAPH;
END; 
RUN;
proc sgrender data=sashelp.holiday
template = pie2;
run;