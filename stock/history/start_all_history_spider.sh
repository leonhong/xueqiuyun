#! /bin/bash
path=`dirname $0`
echo $path
cd $path

#echo `pwd`
num=`ps axu|grep -wE 'get_sh_stock_csv.py|get_sz_stock_csv.py|crawl hk_stock_history_info|crawl historyfuzhai|crawl historycaiwu|crawl historyxianjin|crawl historylirun'|grep -v grep|wc -l`

echo $num
if [ $num -le 0 ]
then
	t=`date`
	echo "$t sh/start.sh start." > /home/app/stock/history/history.log
	/bin/bash ./sh/start.sh
	t=`date`
	echo "$t sh/start.sh finish." >> /home/app/stock/history/history.log
	
	t=`date`
	echo "$t sz/start.sh start." >> /home/app/stock/history/history.log
	/bin/bash ./sz/start.sh
	t=`date`
	echo "$t sz/start.sh finish." >> /home/app/stock/history/history.log
	
	t=`date`
	echo "$t ./hk/get_hk_history_infos/start.sh start." >> /home/app/stock/history/history.log
	/bin/bash ./hk/get_hk_history_infos/start.sh
	t=`date`
	echo "$t ./hk/get_hk_history_infos/start.sh finish." >> /home/app/stock/history/history.log

	t=`date`
	echo "$t ./start_HK_history.sh start." >> /home/app/stock/history/history.log
	/bin/bash ./start_HK_history.sh
	t=`date`
	echo "$t ./start_HK_history.sh finish." >> /home/app/stock/history/history.log
	
	t=`date`
	echo "$t ./CodeList/start_HKcode.sh start." >> /home/app/stock/history/history.log
	/bin/bash ./CodeList/start_HKcode.sh
	t=`date`
	echo "$t ./CodeList/start_HKcode.sh finish." >> /home/app/stock/history/history.log
	
	t=`date`
	echo "$t ./CodeList/start_HScode.sh start." >> /home/app/stock/history/history.log
	/bin/bash ./CodeList/start_HScode.sh
	t=`date`
	echo "$t ./CodeList/start_HScode.sh finish." >> /home/app/stock/history/history.log

fi
