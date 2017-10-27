# !/bin/bash

while(true)
do
	t=`date`
	echo "${t} StorkControl start " >> /home/app/StorkControl/StorkControl.log
	echo "${t} real spider start " >> /home/app/StorkControl/StorkControl.log
	cd /home/app/stock/current && /bin/bash start_all_current_spider.sh 1>/home/app/stock/current/current.out 2>&1
	t=`date`
	echo "${t} real spider finish" >> /home/app/StorkControl/StorkControl.log
	sleep 5
	
	t=`date`
	echo "${t} real etl start " >> /home/app/StorkControl/StorkControl.log
cd /home/app/gupiao/htdocs/tableview && /bin/bash stock_real.sh 1>/home/app/gupiao/htdocs/tableview/stock_real.log 2>&1
	t=`date`
	echo "${t} real etl finish" >> /home/app/StorkControl/StorkControl.log
	echo "${t} StorkControl finish" >> /home/app/StorkControl/StorkControl.log
	sleep 5
done
