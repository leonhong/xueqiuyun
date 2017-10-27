# -*- coding:utf-8 -*-
import json
import logging

import MySQLdb
import scrapy
import time
from scrapy import Request
import sys

from scrapy import log

from HKstock.items import history_hk_fuzhai


class xl_hk_caiwu(scrapy.Spider):
    name = "historyfuzhai"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }

    custom_settings = {
        'ITEM_PIPELINES': {'HKstock.pipelines.history_hk_fuzhai': 300},
        'LOG_LEVEL': "INFO"
    }

    def start_requests(self):
        today=str(time.strftime("%Y-%m-%d", time.localtime(time.time())))
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
            url="http://quotes.money.163.com/hk/service/cwsj_service.php?symbol="+code+"&start=2006-06-30&end="+today+"&type=fzb&unit=yuan"
            yield Request(url=url, headers=self.headers, callback=self.getdata, meta={"stock_code": code})

    def getdata(self,response):
        code=response.meta["stock_code"]
        Hdata=response.body
        data=json.loads(Hdata)
        for d in data:
            item=history_hk_fuzhai()
            item["code"]=code
            item["date"] = d["YEAREND_DATE"]
            item["gudingzichan"] = d["FIX_ASS"]
            item["liudongzichan"]=d["CURR_ASS"]
            item["liudongfuzhai"] = d["CURR_LIAB"]
            item["cunkuan"] = d["INVENTORY"]
            item["xianjinjiyinhangcunjie"] = d["CASH"]
            item["qitazichan"] = d["OTHER_ASS"]
            item["kucunxianjinjiduanqiziji"] = d["CASH_SHORTTERMFUND"]
            item["kehucunkuan"] = d["DEPOSITS_FROM_CUSTOMER"]
            item["yinhangtongyecunkuanjidaikuan"] = d["LOAN_TO_BANK"]
            item["kegongchushouzhizhengquan"] = d["FINANCIALASSET_SALE"]
            item["jinrongzichan"] = d["DERIVATIVES_ASSET"]
            item["jinrongfuzhai"] = d["DERIVATIVES_LIABILITIES"]
            item["zongzichan"] = d["TOTAL_ASS"]
            item["zongfuzai"] = d["TOTAL_LIAB"]
            item["gudongquanyi"] = d["EQUITY"]
            yield item
