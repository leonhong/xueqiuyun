# -*- coding:utf-8 -*-
import json
import logging

import MySQLdb
import scrapy
from scrapy import Request
import sys

from scrapy import log

from HKstock.items import hk_caiwu
from scrapy import Selector
import time

class xl_hk_caiwu(scrapy.Spider):
    name = "xlhkcaiwu"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }

    custom_settings = {
        'ITEM_PIPELINES': {'HKstock.pipelines.hk_caiwu': 300},
        'LOG_LEVEL': "INFO"
    }

    def start_requests(self):
        self.update_time = str(time.strftime("%Y-%m-%d %H:%M:%S", time.localtime(time.time())))
        conn = MySQLdb.connect(
            host='10.2.1.3',
            port=3306,
            user='sqoop',
            passwd='sqoop',
            db='stock',
            charset='utf8'
        )
        cur = conn.cursor()
        sql = "select stock_code from hk_stock_list"
        cur.execute(sql)
        rows = cur.fetchall()
        for row in rows:
            code = row[0]
            url = "http://stock.finance.sina.com.cn/hkstock/api/jsonp.php/abc/FinanceStatusService.getFinanceStandardForjs?symbol="+str(code)+"&financeStanderd=all"
            yield Request(url=url, headers=self.headers, callback=self.getdata, meta={"stock_code": code})

    def getdata(self,response):
        code=response.meta["stock_code"]
        sel=Selector(response)
        HKdata = sel.xpath("body/p/text()").extract()[0].encode("utf-8").replace("abc(", "", 1).\
            replace(");", "")
        if HKdata=='null':
            log.msg("no data "+code)
        else:
            HK= HKdata.replace("[[","").replace("]]","").replace("],[","||")
            data=HK.split("||")
            # try:
            for d in data:
                hk=d.replace('"','').split(",")
                if len(hk)==16:
                    item=hk_caiwu()
                    item["code"]=code
                    item["start_time"]=hk[0]
                    item["end_time"] = hk[1]
                    item["pudate_time"] = hk[2]
                    item["type"] = hk[3]
                    item["yingyee"] = hk[4]
                    item["sunyie"] = hk[5]
                    item["yinglihuokuisun"] = hk[6]
                    item["zhenfu"] = hk[7]
                    item["feijingchangxingshouyi"] = hk[8]
                    item["jibenmeiguyingli"] = hk[9]
                    item["tanbomeiguyinglin"] = hk[10]
                    item["tebieguxi"] = hk[11]
                    item["guxijiezhikaishi"] = hk[12]
                    item["guxijiezhijieshu"] = hk[13]
                    item["guxiyingfuriqi"] = hk[14]
                    item["bizhong"] = hk[15]
                    yield item
                else:
                    print "different data  "+code
            # except Exception,e:
            #     log.msg("tuishi code:"+str(code))
