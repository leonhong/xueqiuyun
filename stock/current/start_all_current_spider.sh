#! /bin/bash
path=`dirname $0`
echo $path
cd $path

#echo `pwd`

#/bin/bash ./get_hk_real_time_share_price/start.sh
#/bin/bash ./get_sh_real_time_share_price/start.sh
#/bin/bash ./get_sz_real_time_share_price/start.sh

num=`ps axu|grep -wE 'get_sh_sz_real_time_stock_price.py|crawl xlhkvalue|crawl xlhkfuzhai|crawl xlhkcaiwu|crawl xlhkxianjin|crawl xlhksunyi|crawl huilv|crawl hsfuzhai|crawl hslirun|crawl hsxianjin'|grep -v grep|wc -l`

echo $num

if [ $num -le 0 ]
then
	t=`date`
	echo "$t HS_Real_Time/start.sh start." > /home/app/stock/current/current.log
	/bin/bash ./HS_Real_Time/start.sh >> /home/app/stock/current/current.log
	t=`date`
	echo "$t HS_Real_Time/start.sh finish." >> /home/app/stock/current/current.log
	
	t=`date`
	echo "$t ./HKstock/start_hk_value.sh start." >> /home/app/stock/current/current.log
	/bin/bash ./HKstock/start_hk_value.sh
	t=`date`
	echo "$t ./HKstock/start_hk_value.sh finish." >> /home/app/stock/current/current.log
	
	t=`date`
	echo "$t ./HKstock/start_hk_fuzhai.sh start." >> /home/app/stock/current/current.log
	/bin/bash ./HKstock/start_hk_fuzhai.sh
	t=`date`
	echo "$t ./HKstock/start_hk_fuzhai.sh finish." >> /home/app/stock/current/current.log
	
	t=`date`
	echo "$t ./HKstock/start_hk_caiwu.sh start." >> /home/app/stock/current/current.log
	/bin/bash ./HKstock/start_hk_caiwu.sh
	t=`date`
	echo "$t ./HKstock/start_hk_caiwu.sh finish." >> /home/app/stock/current/current.log
	
	t=`date`
	echo "$t ./HKstock/start_hk_xianjin.sh start." >> /home/app/stock/current/current.log
	/bin/bash ./HKstock/start_hk_xianjin.sh
	t=`date`
	echo "$t ./HKstock/start_hk_xianjin.sh finish." >> /home/app/stock/current/current.log
	
	t=`date`
	echo "$t ./HKstock/start_hk_sunyi.sh start." >> /home/app/stock/current/current.log
	/bin/bash ./HKstock/start_hk_sunyi.sh
	t=`date`
	echo "$t ./HKstock/start_hk_sunyi.sh finish." >> /home/app/stock/current/current.log
	
	t=`date`
	echo "$t ./HKstock/start_hk_huilv.sh start." >> /home/app/stock/current/current.log
	/bin/bash ./HKstock/start_hk_huilv.sh
	t=`date`
	echo "$t ./HKstock/start_hk_huilv.sh finish." >> /home/app/stock/current/current.log
	
	t=`date`
	echo "$t ./HSstock/start_hs_fuzhai.sh start." >> /home/app/stock/current/current.log
	/bin/bash ./HSstock/start_hs_fuzhai.sh
	t=`date`
	echo "$t ./HSstock/start_hs_fuzhai.sh finish." >> /home/app/stock/current/current.log
	
	t=`date`
	echo "$t ./HSstock/start_hs_lirun.sh start." >> /home/app/stock/current/current.log
	/bin/bash ./HSstock/start_hs_lirun.sh
	t=`date`
	echo "$t ./HSstock/start_hs_lirun.sh finish." >> /home/app/stock/current/current.log
	
	t=`date`
	echo "$t ./HSstock/start_hs_xianjin.sh start." >> /home/app/stock/current/current.log
	#/bin/bash ./HSstock/start_hs_xianjin.sh
	t=`date`
	echo "$t ./HSstock/start_hs_xianjin.sh finish." >> /home/app/stock/current/current.log
	
	t=`date`
	echo "$t ./HSstock/start_hs_value.sh start." >> /home/app/stock/current/current.log
	/bin/bash ./HSstock/start_hs_value.sh
	t=`date`
	echo "$t ./HSstock/start_hs_value.sh finish." >> /home/app/stock/current/current.log
fi
