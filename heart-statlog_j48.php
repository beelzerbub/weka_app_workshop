<?php
//create unseen array denpend on class we have example have 3 class
$data = array('age,sex,chest_pain,rbp,sc,fbs,rer,max_hr,eia,oldpeak,slope_peak,major_vessel,thal,class',
	'70,1,4,130,322,0,2,109,0,2.4,2,3,3,present',
	'67,0,3,115,564,0,2,160,0,1.6,2,0,7,absent',
	'71,0,3,110,265,1,2,130,0,0,1,1,3,?');

//create data csv file
$fp = fopen('heart-statlog_csv.csv', 'w');
foreach($data as $line) {
	$val = explode(",",$line);
	fputcsv($fp, $val);
}
fclose($fp);

//save file csv to arff-file and -N last set last attribute is class label
$cmd = 'java -classpath "weka.jar" weka.core.converters.CSVLoader -N "last" heart-statlog_csv.csv > heart-statlog_unseen_test.arff';
exec($cmd, $output);

//run unseen data -p 5 is class attribute
$cmd1 = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -T "heart-statlog_unseen_test.arff" -l "heart-statlog.model" -p 10';
exec($cmd1, $output1);

for($i=0; $i<sizeof($output1); $i++) {
	echo $output1[$i]."<br>";
}
echo "<hr>";

for($i=0; $i<sizeof($output1); $i++) {
	if($i==sizeof($output1)-2)
	{ 
		echo substr($output1[$i],27);
	}
}
?>