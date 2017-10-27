# -*- coding:utf-8 -*-
import json
import logging

import MySQLdb
import scrapy
import time
from scrapy import Request
import sys

from scrapy import log

from HKstock.items import history_hk_xianjin


class xl_hk_caiwu(scrapy.Spider):
    name = "historyxianjin"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }

    custom_settings = {
        'ITEM_PIPELINES': {'HKstock.pipelines.history_hk_xianjin': 300},
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
            url="http://quotes.money.163.com/hk/service/cwsj_service.php?symbol="+code+"&start=2006-06-30&end="+today+"&type=llb&unit=yuan"
            yield Request(url=url, headers=self.headers, callback=self.getdata, meta={"stock_code": code})

    def getdata(self,response):
        code=response.meta["stock_code"]
        Hdata=response.body
        data=json.loads(Hdata)
        for d in data:
            item=history_hk_xianjin()
            item["code"]=code
            item["date"] = d["YEAREND_DATE"]
            item["jingyinghuodongchanshengxianjinliu"] = d["CF_NCF_OPERACT"]
            item["yishoulixi"] = d["CF_INT_REC"]
            item["yifulixi"] = d["CF_INT_PAID"]
            item["yishouguxi"] = d["CF_DIV_REC"]
            item["yipaiguxi"] = d["CF_DIV_PAID"]
            item["touzihuodongchanshengxianjinliu"] = d["CF_INV"]
            item["rongzihuodongchanshengdexianjinliu"] = d["CF_FIN_ACT"]
            item["qichuxianjiliujidengjiawu"] = d["CF_BEG"]
            item["xianjinjixianjindengjiawujingzengjiae"] = d["CF_CHANGE_CSH"]
            item["qimoxianjinjixianjindengjiawu"] = d["CF_END"]
            item["huilvbiandongyingxiang"] = d["CF_EXCH"]
            yield item
