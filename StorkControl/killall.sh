# !/bin/bash

ret=`ps axu|grep python|grep -v grep|awk '{print $2}'|xargs kill -9`
