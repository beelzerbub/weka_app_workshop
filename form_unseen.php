<?php
if (isset($_POST["submit"])) 
{
	$value1 = $_POST["V1"];
	$value2 = $_POST["V2"];
	$value3 = $_POST["V3"];
	$value4 = $_POST["V4"];
	$id = $_POST["id"];
	echo "<h2> Your Input data are ".$value1.",".$value2.",".$value3.",".$value4;
	$data = array('left-weight,left-distance,right-weight,right-distance,class',
		'5,1,3,2,L',
		'4,2,3,1,B',
		'3,5,2,1,R',
		"$value1,$value2,$value3,$value4,?");

	$fp = fopen('balance_csv.csv', 'w');
	foreach($data as $line){
		$val = explode(",",$line);
		fputcsv($fp, $val);
	}
	fclose($fp);
	$cmd = 'java -classpath "weka.jar" weka.core.converters.CSVLoader -N "last" balance_csv.csv > balance_unseen_test.arff ';
	exec($cmd,$output);
// run unseen data -p 5 is class attribute
	$cmd1 = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -T "balance_unseen_test.arff" -l "balance_web.model" -p 5';
	exec($cmd1,$output1);

	echo "<BR> Output Prediction is : ";
	for ($i=0;$i<sizeof($output1);$i++) {
		{ trim($output1[$i]);
			if($i==sizeof($output1)-2)
				echo substr($output1[$i],27);
		}
	} 
}else {
	?>
	<form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
		value 1 : <input type="text" name="V1" value=""> <br>
		value 2 : <input type="text" name="V2" value=""><br>
		value 3 : <input type="text" name="V3" value=""> <br>
		value 4 : <input type="text" name="V4" value=""> <br>
		<input type="hidden" name="id" value = "?"><br>
		<input type="submit" name="submit" value="Predict"></td></tr>
	</form>
	<?php
}
?>