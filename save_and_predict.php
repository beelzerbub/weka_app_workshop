<?php
$cmd = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -t "balance.arff" -x 5 -d "balance_web.model"';

exec($cmd, $output);

for($i=0;$i<sizeof($output);$i++) {
	echo $output[$i]."<br>";
}

/*$cmd2 = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -T "balance_unseen.arff" -l "balance_web.model" -p 5';

exec($cmd2, $output2);

for($i=0;$i<sizeof($output2);$i++) {
	echo $output2[$i]."<br>";
}*/
?>