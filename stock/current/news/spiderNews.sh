# !/bin/bash

keyword="回购|增发新股|特别股息|要约|合并|分拆"
blackList="质押式回购|增发新股|逆回购|合并财务报表"
#keyword="董事|增持"
curDay=`date +%Y-%m-%d`
lastDay=$(date +%Y-%m-%d --date '1 days ago')
X='http://www.cninfo.com.cn/'
gsms="hadoop_hdfs_alarm"
gemail="hadoop_hdfs_alarm_emailonly"

function  doAlarm()
{
	subject=$1
	content=$2
	echo "doAlarm subject=$subject content=$content"
	ret=`python ./sendmail.py ./s.txt ./c.txt`
}

### hk
totalCnt=0
alarmCnt=0
doAlarmFuck=0
pageSize=30
i=0
echo "" > ./c.txt
echo "" > ./s.txt
echo "【雪球云-恒生】新闻预警【${keyword}】!!!" > ./s.txt
msg=""
while(true)
do
	t=`date`
	echo "${t} HK pageNum=${i} pageSize=${pageSize} start..."
	webSite=`curl 'http://www.cninfo.com.cn/cninfo-new/announcement/query' -H 'Host: www.cninfo.com.cn' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12; rv:52.0) Gecko/20100101 Firefox/52.0' -H 'Accept: application/json, text/javascript, */*; q=0.01' -H 'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3' --compressed -H 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8' -H 'X-Requested-With: XMLHttpRequest' -H 'Referer: http://www.cninfo.com.cn/cninfo-new/announcement/show' -H 'Cookie: JSESSIONID=9FDE20DFFFFCEDF4330EA94AD4A6A9D3' -H 'Connection: keep-alive' -H 'Cache-Control: max-age=0' --data 'stock=&searchkey=&plate=&category=&trade=&column=hke&columnTitle=%E5%8E%86%E5%8F%B2%E5%85%AC%E5%91%8A%E6%9F%A5%E8%AF%A2&pageNum='${i}'&pageSize='${pageSize}'&tabName=fulltext&sortName=&sortType=&limit=&showTitle=&seDate='${lastDay}'+~+'${curDay} 2>/dev/null`

	webSiteJson="[${webSite}]"
	result=`echo ${webSiteJson} |jq .[0].announcements`
	if [ "${result}" = "[]" ]
	then
		t=`date`
		echo "${t} HK result NULL"
		break
	else
		t=`date`
		#echo "${t} HK result=${result}"
	fi
	
	for((j=0;j<${pageSize};j++))
	do
		adjunctUrl=${X}`echo ${webSiteJson} |jq .[0].announcements[${j}].adjunctUrl|sed 's/"//g'`
		secName=`echo ${webSiteJson} |jq .[0].announcements[${j}].secName|sed 's/"//g'`
		announcementTitle=`echo ${webSiteJson} |jq .[0].announcements[${j}].announcementTitle|sed 's/"//g'`
		secCode=`echo ${webSiteJson} |jq .[0].announcements[${j}].secCode|sed 's/"//g'`
		adjunctType=`echo ${webSiteJson} |jq .[0].announcements[${j}].adjunctType|sed 's/"//g'`
		echo "download ${adjunctUrl} ..."
		downloadPdf=`curl ${adjunctUrl} -o ./tmpfile.pdf 2>/dev/null`
		pdfParse=`pdftotext ./tmpfile.pdf ./tmpfile.text 2>/dev/null`
		pdfAlarm=`grep -E "${keyword}" ./tmpfile.text|wc -l`
		titleAlarm=`echo ${announcementTitle} |grep -E "${keyword}"|wc -l`
		curTime=`echo $adjunctUrl|awk -F"/" '{print $5}'`
		#announcementTitle="${announcementTitle:0:16}..."
		pdfBlackListAlarm=`grep -E "${blackList}" ./tmpfile.text|wc -l`
		blackListAlarm=`echo ${announcementTitle} |grep -E "${blackList}"|wc -l`
		t=`date`
		echo "${t} HK pdfAlarm=$pdfAlarm titleAlarm=$titleAlarm adjunctUrl=$adjunctUrl secName=$secName announcementTitle=$announcementTitle secCode=$secCode adjunctType=$adjunctType curTime=$curTime"
		if [ "${secCode}" ]
		then
			((totalCnt++))
		fi
		
		if [ ${titleAlarm} -gt 0 ]
		then
			if [ ${pdfBlackListAlarm} -eq 0 -a ${blackListAlarm} -eq 0 ]
			then
				title="${secName}[${secCode}] [${keyword}] 预警!!!"
				echo "doAlarm $title"
				if [ "${secCode}" ]
				then
					((alarmCnt++))
					doAlarmFuck=1
					msg=${msg}"<tr><td align="center">${curTime}</td><td align="center">${secCode}</td> <td align="center">${secName}</td> <td align="center">${announcementTitle}</td> <td align="center">${adjunctUrl}</td></tr>"
				fi
	
			fi
		fi
		#sleep 3
	done

	t=`date`
	echo "${t} HK pageNum=${i} pageSize=${pageSize} finish..."
	((i++))
done

header="<html><head><title>${title}</title></head><body><p>共扫描${totalCnt}个新闻，符合【${keyword}】关键字有${alarmCnt}个, 黑名单【${blackList}】</p><table border="1"><tr><th  bgcolor="LightGoldenRodYellow">时间</th><th  bgcolor="LightGoldenRodYellow">code</th><th  bgcolor="LightGoldenRodYellow">名称</th><th  bgcolor="LightGoldenRodYellow">标题</th> <th  bgcolor="LightGoldenRodYellow">url</th></tr>"
if [ ${doAlarmFuck} -eq 1 ]
then
	echo "${header}${msg}</table></body></html>" > ./c.txt
	doAlarm "${title}" "${msg}" 1
else
	msg="<html><head><title>${title}</title></head><body><p>共扫描${totalCnt}个新闻，符合【${keyword}】关键字有${alarmCnt}个</p></body></html>"
	echo $msg >  ./c.txt
	doAlarm "${title}" "${msg}" 1
fi


#exit
# HS
totalCnt=0
alarmCnt=0
doAlarmFuck=0
pageSize=30
i=0
title=""
echo "" > ./c.txt
echo "" > ./s.txt
echo "【雪球云-沪深】新闻预警【${keyword}】!!!" > ./s.txt
msg=""
while(true)
do
	t=`date`
	echo "${t} HS pageNum=${i} pageSize=${pageSize} start..."
	webSite=`curl 'http://www.cninfo.com.cn/cninfo-new/announcement/query' -H 'Host: www.cninfo.com.cn' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12; rv:52.0) Gecko/20100101 Firefox/52.0' -H 'Accept: application/json, text/javascript, */*; q=0.01' -H 'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3' --compressed -H 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8' -H 'X-Requested-With: XMLHttpRequest' -H 'Referer: http://www.cninfo.com.cn/cninfo-new/announcement/show' -H 'Connection: keep-alive' -H 'Cache-Control: max-age=0' --data 'stock=&searchkey=&plate=&category=&trade=&column=szse&columnTitle=%E5%8E%86%E5%8F%B2%E5%85%AC%E5%91%8A%E6%9F%A5%E8%AF%A2&pageNum='${i}'&pageSize='${pageSize}'&tabName=fulltext&sortName=&sortType=&limit=&showTitle=&seDate='${lastDay}'+~+'${curDay} 2>/dev/null`
	webSiteJson="[${webSite}]"
	result=`echo ${webSiteJson} |jq .[0].announcements`
	if [ "${result}" = "[]" ]
	then
		t=`date`
		echo "${t} result NULL"
		break
	else
		t=`date`
	fi
	
	for((j=0;j<${pageSize};j++))
	do
		adjunctUrl=${X}`echo ${webSiteJson} |jq .[0].announcements[${j}].adjunctUrl|sed 's/"//g'`
		secName=`echo ${webSiteJson} |jq .[0].announcements[${j}].secName|sed 's/"//g'`
		announcementTitle=`echo ${webSiteJson} |jq .[0].announcements[${j}].announcementTitle|sed 's/"//g'`
		secCode=`echo ${webSiteJson} |jq .[0].announcements[${j}].secCode|sed 's/"//g'`
		adjunctType=`echo ${webSiteJson} |jq .[0].announcements[${j}].adjunctType|sed 's/"//g'`
		downloadPdf=`curl ${adjunctUrl} -o ./tmpfile.pdf 2>/dev/null`
		pdfParse=`pdftotext ./tmpfile.pdf ./tmpfile.text 2>/dev/null`
		pdfAlarm=`grep -E "${keyword}" ./tmpfile.text|wc -l`
		titleAlarm=`echo ${announcementTitle} |grep -E "${keyword}"|wc -l`
		curTime=`echo $adjunctUrl|awk -F"/" '{print $5}'`
		#announcementTitle="${announcementTitle:0:16}..."
		pdfBlackListAlarm=`grep -E "${blackList}" ./tmpfile.text|wc -l`
		blackListAlarm=`echo ${announcementTitle} |grep -E "${blackList}"|wc -l`
		t=`date`
		echo "${t} HS pdfAlarm=$pdfAlarm titleAlarm=$titleAlarm adjunctUrl=$adjunctUrl secName=$secName announcementTitle=$announcementTitle secCode=$secCode adjunctType=$adjunctType curTime=$curTime"
		if [ "${secCode}" ]
		then
			((totalCnt++))
		fi
		if [ ${titleAlarm} -gt 0 ]
		then
			if [ ${pdfBlackListAlarm} -eq 0 -a ${blackListAlarm} -eq 0 ]
			then
				title="${secName}[${secCode}] [${keyword}] 预警!!!"
				echo "doAlarm $title"
				if [ "${secCode}" ]
				then
					((alarmCnt++))
					doAlarmFuck=1
					msg=${msg}"<tr><td align="center">${curTime}</td><td align="center">${secCode}</td> <td align="center">${secName}</td> <td align="center">${announcementTitle}</td> <td align="center">${adjunctUrl}</td></tr>"
				fi
	
			fi
		fi
		#sleep 3
	done

	t=`date`
	echo "${t} HS pageNum=${i} pageSize=${pageSize} finish..."
	((i++))
done
header="<html><head><title>${title}</title></head><body><p>共扫描${totalCnt}个新闻，符合【${keyword}】关键字有${alarmCnt}个, 黑名单【${blackList}】</p><table border="1"><tr><th  bgcolor="LightGoldenRodYellow">时间</th><th  bgcolor="LightGoldenRodYellow">code</th><th  bgcolor="LightGoldenRodYellow">名称</th><th  bgcolor="LightGoldenRodYellow">标题</th> <th  bgcolor="LightGoldenRodYellow">url</th></tr>"
if [ ${doAlarmFuck} -eq 1 ]
then
	echo "${header}${msg}</table></body></html>" > ./c.txt
	doAlarm "${title}" "${msg}" 1
else
	msg="<html><head><title>${title}</title></head><body><p>共扫描${totalCnt}个新闻，符合【${keyword}】关键字有${alarmCnt}个</p></body></html>"
	echo $msg >  ./c.txt
	doAlarm "${title}" "${msg}" 1
fi
