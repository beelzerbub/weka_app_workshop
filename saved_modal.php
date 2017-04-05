<?php
$cmd = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -t "glass.arff“ -x 10 -d "glass_web.model” ';
exec($cmd,$output);
for ($i=0;$i<sizeof($output);$i++)
	{ echo $output[$i]."<br>";
}
?>