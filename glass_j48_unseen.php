<?php
$cmd = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -T "glass_unseen.arff" -l "glass_web.model" -p 10';

exec($cmd, $output);

for($i=0;$i<sizeof($output);$i++) {
	echo $output[$i]."<br>";
}
?>