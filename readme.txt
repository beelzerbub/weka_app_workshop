-t filename
Name of the file with tranining data.

-T filename
Name of the file with test data. if missing cross-validation is preformed.

-c index
Index of the class attribute(1,2,...; Default: last).

-d filename
save classifier built from the tranining data into the given file

-no-cv
no cross-validation

java weka.classifiers.trees.J48 -T C:\Appserv\www\weka_app\heart-statlog_unseen_test.arff -l C:\Appserv\www\weka_app\heart-statlog.model -p 5