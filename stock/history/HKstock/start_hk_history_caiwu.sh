#! /bin/bash
path=`dirname $0`
echo $path
#cd $path

export PYTHONPATH=$PYTHONPATH:/usr/local/lib/python2.7/site-packages

ret=`ps aux |grep historycaiwu | grep -v grep|wc -l`
echo $ret
if [ $? -eq $ret ];
then
        echo 没有运行
        cd $path && /usr/local/bin/scrapy crawl historycaiwu
else
        echo 正在运行
fi
