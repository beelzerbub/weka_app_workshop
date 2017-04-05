<?php
$cmd = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -T "balance_unseen.arff" -l "balance.model" -p 5';

exec($cmd, $output);

for($i=0;$i<sizeof($output);$i++) {
	echo $output[$i]."<br>";
}
?>