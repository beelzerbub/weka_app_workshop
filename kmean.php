<?php
$cmd = 'java -classpath "weka.jar" weka.clusterers.SimpleKMeans -N 2 -t "glass.arff"';
exec($cmd, $output);

for($i=0;$i<sizeof($output);$i++) {
	echo $output[$i]."<br>";
}
?>