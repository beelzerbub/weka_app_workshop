<?php
//create unseen array denpend on class we have example have 3 class
$data = array('left-weight,left-distance,right-weight,right-distance,class',
	'5,1,3,2,L',
	'4,2,3,1,B',
	'3,5,2,1,R',
	'4,5,1,3,?');

//create data csv file
$fp = fopen('balance_csv.csv', 'w');
foreach($data as $line) {
	$val = explode(",",$line);
	fputcsv($fp, $val);
}
fclose($fp);

//save file csv to arff-file and -N last set last attribute is class label
$cmd = 'java -classpath "weka.jar" weka.core.converters.CSVLoader -N "last" balance_csv.csv > balance_unseen_test.arff';
exec($cmd, $output);

//run unseen data -p 5 is class attribute
$cmd1 = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -T "balance_unseen_test.arff" -l "balance_web.model" -p 5';
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