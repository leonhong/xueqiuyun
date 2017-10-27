# !/bin/bash


curpath=/home/app/gupiao/htdocs/tableview
num=`ps axu|grep -wE 'hk_detail_wy_run.php|hs_detail_run.php'|grep -v grep|wc -l`
if [ $num -le 0 ]
then
	t=`date`
	echo "$t hk_detail_wy_run.php start"
	php ${curpath}/hk_detail_wy_run.php
	t=`date`
	echo "$t hk_detail_wy_run.php finish"

	t=`date`
	echo "$t hs_detail_run.php start"
	php ${curpath}/hs_detail_run.php
	t=`date`
	echo "$t hs_detail_run.php finish"
else
	t=`date`
	echo "$t current has stock_history.sh, exit."
	exit
fi
