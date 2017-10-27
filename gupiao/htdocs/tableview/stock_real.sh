# !/bin/bash

curpath=/home/app/gupiao/htdocs/tableview
num=`ps axu|grep -wE 'run.php|run1.php|hs_run.php|hs_run1.php'|grep -v grep|wc -l`
echo $num
if [ $num -le 0 ]
then
	t=`date`
	echo "$t run.php start"
	php ${curpath}/run.php
	t=`date`
	echo "$t run.php finish"

	t=`date`
	echo "$t run1.php start"
	php ${curpath}/run1.php
	t=`date`
	echo "$t run1.php finish"

	t=`date`
	echo "$t hs_run.php start"
	php ${curpath}/hs_run.php
	t=`date`
	echo "$t hs_run.php finish"

	t=`date`
	echo "$t hs_run1.php start"
	php ${curpath}/hs_run1.php
	t=`date`
	echo "$t hs_run1.php finish"
else
	t=`date`
	echo "$t current has stock_real.sh, exit."
	exit
fi
