#!/bin/bash
export PYTHONPATH=$PYTHONPATH:/usr/local/lib/python2.7/site-packages

path=`dirname $0`
while(true)
do
        cd $path && /usr/local/bin/scrapy crawl HScode 1>>tmp_HScode_log 2>&1 

	sleep 30
done
