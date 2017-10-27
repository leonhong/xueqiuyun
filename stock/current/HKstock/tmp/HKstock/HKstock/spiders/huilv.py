# -*- coding:utf-8 -*-
import json
import logging

import MySQLdb
import scrapy
from scrapy import Request
import sys

from scrapy import log

from HKstock.items import huilv
from scrapy import Selector
import time

class huilv_spider(scrapy.Spider):
    name = "huilv"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }

    custom_settings = {
        'ITEM_PIPELINES': {'HKstock.pipelines.huilv': 300},
    }
    bz={
        "HKD":{
            "name":"港币"
        },
        "CNY":{
          "name":"人民币"
        },
        "CAD":{
            "name":"加元"
        },
        "USD":{
            "name":"美元"
        },
        "GBP":{
          "name":"英镑"
        },
        "MYR":{
            "name":"马来西亚，林吉特"
        },
        "EUR":{
            "name":"欧元"
        }
    }
    def start_requests(self):
        From=["CNY","CAD","USD","GBP","MYR","EUR","HKD"]
        To=["HKD","CNY"]
        for f in From:
            for t in To:
                if f==t:
                    continue
                code=f+t
                f_name=self.bz[f]["name"]
                t_name=self.bz[t]["name"]
                url="http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s="+code+"=x"
                yield Request(url=url,headers=self.headers, callback=self.gethuilv, meta={"code": code,"f_name":f_name,"t_name":t_name})

    def gethuilv(self,response):
        item=huilv()
        item["From"]=response.meta["f_name"]
        item["To"]=response.meta["t_name"]
        item["code"]=response.meta["code"]
        item["value"]=response.body.decode("gb2312").encode("utf-8").split(",")[1]
        return item
