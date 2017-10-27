#! /bin/bash
path=`dirname $0`
echo $path
#cd $path

export PYTHONPATH=$PYTHONPATH:/usr/local/lib/python2.7/site-packages

ret=`ps aux |grep get_sh_sz_real_time_stock_price.py | grep -v grep|wc -l`
echo $ret
if [ $? -eq $ret ];
then
        echo 没有运行
        echo "cd ${path} && /usr/local/bin/python get_sh_sz_real_time_stock_price.py > log 2>&1 "
        cd $path && python get_sh_sz_real_time_stock_price.py 
else
        echo 正在运行
fi
