<?php
$cmd = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -t "heart-statlog.arff" -x 10 -d "heart-statlog.model"';
exec($cmd, $output);

for($i=0;$i<sizeof($output);$i++) {
	echo $output[$i]."<br>";
}
?>