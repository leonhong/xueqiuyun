#! /bin/bash
path=`dirname $0`
echo $path
#cd $path

export PYTHONPATH=$PYTHONPATH:/usr/local/lib/python2.7/site-packages

ret=`ps aux |grep get_sz_stock_csv.py | grep -v grep|wc -l`
echo $ret
if [ $? -eq $ret ];
then
        echo 没有运行
        echo "cd ${path} && /usr/local/bin/python python get_sz_stock_csv.py > log 2>&1 &"
        cd $path && python get_sz_stock_csv.py
else
        echo 正在运行
fi

