<?php
if (isset($_POST["submit"])) {
	$age 		= $_POST["age"];		//age 
	$sex 		= $_POST["sex"];		//sex
	$chest_pain = $_POST["chest_pain"];	//chest pain type  (4 values)
	$rbp 		= $_POST["rbp"];		//resting blood pressure
	$sc 		= $_POST["sc"];			//serum cholestoral in mg/dl 
	$fbs		= $_POST["fbs"];		//fasting blood sugar > 120 mg/dl
	$rer		= $_POST["rer"];		//resting electrocardiographic results  (values 0,1,2) 
	$max_hr		= $_POST["max_hr"];		//maximum heart rate achieved
	$eia		= $_POST["eia"]; 		//exercise induced angina
	$oldpeak 	= $_POST["oldpeak"];	//oldpeak = ST depression induced by exercise relative to rest 
	$slope_peak	= $_POST["slope_peak"]; //the slope of the peak exercise ST segment
	$major_vessel = $_POST["major_vessel"]; //number of major vessels (0-3) colored by flourosopy  
	$thal		= $_POST["thal"];		//thal: 3 = normal; 6 = fixed defect; 7 = reversable defect 
	$id 	= $_POST["id"];
	echo "<h2> From Your Input data ";
	$data = array('age,sex,chest,resting_blood_pressure,serum_cholestoral,fasting_blood_sugar,resting_electrocardiographic_results,maximum_heart_rate_achieved,exercise_induced_angina,oldpeak,slope,number_of_major_vessels,thal,class',
		'67,0,3,115,564,0,2,160,0,1.6,2,0,7,absent',
		'70,1,4,130,322,0,2,109,0,2.4,2,3,3,present',
		'71,0,3,110,265,1,2,130,0,0,1,1,3,?'
		/*'$age,$sex,$chest_pain,$rbp,$sc,$fbs,$rer,$max_hr,$eia,$oldpeak,$slope_peak,$major_vessel,$thal,?'*/);

//create CSV
	$fp = fopen('heart-statlog_csv.csv', 'w');
	foreach($data as $line) {
		$val = explode(",", $line);
		fputcsv($fp, $val);
	}
	fclose($fp);

	$cmd = 'java -classpath "weka.jar" weka.core.converters.CSVLoader -N "last" heart-statlog_csv.csv > heart-statlog_unseen_test.arff';
	exec($cmd,$output);

	$cmd1 = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -T "heart-statlog_unseen_test.arff" -l "heart-statlog.model" -p 10';
	exec($cmd1,$output1);

	echo "<BR> Output Prediction is : ";
	for ($i=0;$i<sizeof($output1);$i++) {
		{ trim($output1[$i]);
			if($i==sizeof($output1)-2)
				echo substr($output1[$i],27);
		}
	} 
} else {
	?>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="heart-statlog">
		<label for="">Age : </label><input type="number" name="age"><br>
		Sex : <input type="radio" name="sex" value="0"> Male <input type="radio" name="sex" value="1">Female <br>
		chest pain : <select name="chest_pain" id="chest_pain">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
	</select>
	<input type="hidden" name="id" value="?"><br>
	<input type="submit" name="submit" value="Predict"><br>
</form>
<?php
}
?>