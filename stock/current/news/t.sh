# !/bin/bash

xx="http://www.cninfo.com.cn/finalpage/2017-03-17/1203171072.PDF"
echo $xx|awk -F"/" '{print $5}'
#echo "$xx" |cut -d "." -f
