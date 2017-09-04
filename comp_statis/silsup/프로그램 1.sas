libname mylib "/folders/myshortcuts/silsup/";
data mylib.sas_test2;
		infile "/folders/myshortcuts/silsup/class_score.txt" delimiter="|" firstobs=2;
		input class name $ kor eng mat sci;
run;