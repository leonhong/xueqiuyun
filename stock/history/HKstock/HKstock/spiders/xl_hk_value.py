# -*- coding:utf-8 -*-
import json
import logging
import string

import MySQLdb
import scrapy
from scrapy import Request
import sys

from scrapy import log

from HKstock.items import hk_value
from scrapy import Selector
import time

class xl_hk_value(scrapy.Spider):
    name = "xlhkvalue"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }
    custom_settings = {
        'ITEM_PIPELINES': {'HKstock.pipelines.hk_value': 300},
        'LOG_LEVEL': "INFO"
    }
    def start_requests(self):
        self.update_time = str(time.strftime("%Y-%m-%d %H:%M:%S", time.localtime(time.time())))
        conn = MySQLdb.connect(
            host='127.0.0.1',
            port=3306,
            user='root',
            passwd='20160401',
            db='stock',
            charset='utf8'
        )
        cur = conn.cursor()
        sql = "select stock_code from hk_stock_list"
        cur.execute(sql)
        rows = cur.fetchall()
        for row in rows:
            code = row[0]
            url = "http://hq.sinajs.cn/list=rt_hk"+code+",hk"+code+"_i"
            yield Request(url=url, headers=self.headers, callback=self.getdata, meta={"stock_code": code})

    def getdata(self,response):
        code=response.meta["stock_code"]
        sel=Selector(response)
        HKdata = sel.xpath("body/p/text()")
        if HKdata=='null':
            log.msg("no data "+code)
        else:
            item=hk_value()
            data=HKdata.extract()[0].replace('"','').split(";")
            data1=data[0].split("=")[1].split(",")
            data2=data[1].split("=")[1].split(",")
            if len(data1)>1 and len(data2)>1:
                item["code"]=code
                item["name"]=data1[1]
                item["update"]=self.update_time
                item["jinkaipan"]=data1[2]
                item["zuoshoupan"]=data1[3]
                item["zuigaojia"]=data1[4]
                item["zuidijia"]=data1[5]
                item["gujia"]=data1[6]
                item["chengjiaoe"]=data1[11]
                item["chengjiaoliang"]=data1[12]
                item["shiyinglv"]=data1[13]
                item["zuigao52"]=data1[15]
                item["zuidi52"]=data1[16]
                item["riqi"]=data1[17]
                item["shijian"]=data1[18]
                item["hkguben"]=data2[7]
                item["guben"]=data2[9]
                item["zhouxilv"]=data2[10]
                item["shizhi"]=str(int(string.atof(item["guben"])*string.atof(item["gujia"])))
                item["hkshizhi"]=str(int(string.atof(item["hkguben"])*string.atof(item["gujia"])))
                if item["shizhi"]!='0':
               	    return item
                else:
                    return
            # else:
            #     log.msg("tuishi " + code)
