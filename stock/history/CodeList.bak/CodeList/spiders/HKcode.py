import json
import logging
import string

import MySQLdb
import scrapy
from scrapy import Request
import sys

from scrapy import log
from CodeList.items import HK_Code
from scrapy import Selector
import time

class hk_code(scrapy.Spider):
    name = "HKcode"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0",
        "Host": "xueqiu.com",
        "Cache-Control": "no-cache",
        "X-Requested-With": "XMLHttpRequest"
    }
    custom_settings = {
        'ITEM_PIPELINES': {'CodeList.pipelines.HKCode': 300},
        'LOG_LEVEL': "INFO"
    }
    def start_requests(self):
        return [Request(url="https://xueqiu.com/hq#exchange=HK&firstName=2&secondName=2_0&page=1",headers=self.headers,callback=self.getfirstpage,meta={'cookiejar':"code"})]

    def getfirstpage(self,response):
        url="https://xueqiu.com/stock/cata/stocklist.json?page=1&size=90&order=desc&orderby=percent&type=30&_="+str(int(time.time()*1000))
        headers=self.headers
        headers["Referer"]="https://xueqiu.com/hq#exchange=HK&firstName=2&secondName=2_0&page=1"
        return Request(url=url,headers=headers,meta={"cookiejar":"code"},callback=self.firstjson)

    def firstjson(self,response):
        sel = Selector(response)
        HKdata = sel.xpath("body/p/text()")
        if HKdata == '':
            log.msg("no data " )
        else:
            Jdata = json.loads(HKdata.extract()[0])
            if Jdata["success"]=="true":
                count=Jdata["count"]["count"]
                page_num=count/90
                if count%90!=0:
                    page_num+=1
                for page in range(2,page_num+1):
                    url = "https://xueqiu.com/stock/cata/stocklist.json?page="+str(page)+"&size=90&order=desc&orderby=percent&type=30&_=" + str(
                        int(time.time() * 1000))
                    headers = self.headers
                    headers["Referer"] = "https://xueqiu.com/hq#exchange=HK&firstName=2&secondName=2_0&page="+str(page)
                    yield Request(url=url, headers=headers, meta={"cookiejar": "code"}, callback=self.getdata)

                stocks=Jdata["stocks"]
                for stock in stocks:
                    item=HK_Code()
                    item["code"]=stock["code"]
                    item["name"]=stock["name"]
                    if item["code"]==''or item["name"]=="":
                        continue
                    else:
                        yield item
                    yield item
            else:
                log.msg("get json error "+response.url)

    def getdata(self,response):
        sel = Selector(response)
        HKdata = sel.xpath("body/p/text()")
        if HKdata == '':
            log.msg("no data ")
        else:
            Jdata = json.loads(HKdata.extract()[0])
            if Jdata["success"] == "true":
                stocks = Jdata["stocks"]
                for stock in stocks:
                    item = HK_Code()
                    item["code"] = stock["symbol"].replace("HK","")
                    item["name"] = stock["name"].strip()
                    if item["code"]==''or item["name"]=="":
                        continue
                    else:
                        yield item
            else:
                log.msg("get json error " + response.url)
