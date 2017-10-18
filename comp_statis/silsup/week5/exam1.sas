Data cars_data;
	SET SASHELP.CARS;
RUN;

proc corr data=cars_data;
	var horsepower weight;
run;
proc plot data=cars_data;
	plot horsepower*weight;
run;
proc corr data=cars_data PLOTS=matrix;
	var horsepower weight;
run;