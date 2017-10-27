# -*- coding:utf-8 -*-
import json
import logging
import string

import MySQLdb
import scrapy
from scrapy import Request
import sys

from scrapy import log

from HSstock.items import hs_value
from scrapy import Selector
import time

class xl_hk_value(scrapy.Spider):
    name = "hsvalue"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }
    custom_settings = {
        'ITEM_PIPELINES': {'HSstock.pipelines.hs_value': 300}
    }
    def start_requests(self):
        return [Request(url="https://xueqiu.com/",headers=self.headers,callback=self.start_get_value,meta={"cookiejar":"xq"})]

    def start_get_value(self,response):
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
        sql = "select stock_code from sh_stock_list"
        cur.execute(sql)
        rows = cur.fetchall()
        conn.commit()
        for row in rows:
            code = row[0]
            sql = "select * from code_black_list where code='" +code+"'"
            cur.execute(sql)
            code_rows=cur.fetchall()
            conn.commit()
            if len(code_rows)==0:
                url = "https://xueqiu.com/v4/stock/quote.json?code=SH"+str(code)+"&_="+str(int(time.time()*1000))
                yield Request(url=url, headers=self.headers, callback=self.getdata, meta={"market":"SH","stock_code": code,"cookiejar":"xq"})

        sql = "select stock_code from sz_stock_list"
        cur.execute(sql)
        rows = cur.fetchall()
        conn.commit()
        for row in rows:
            code = row[0]
            sql = "select * from code_black_list where code='" + code + "'"
            cur.execute(sql)
            code_rows = cur.fetchall()
            conn.commit()
            if len(code_rows) == 0:
                url = "https://xueqiu.com/v4/stock/quote.json?code=SZ" + str(code) + "&_=" + str(
                    int(time.time() * 1000))
                yield Request(url=url, headers=self.headers, callback=self.getdata, meta={"market":"SZ","stock_code": code,"cookiejar":"xq"})

        conn.close()


    def getdata(self,response):
        code = response.meta["stock_code"]
        market=response.meta["market"]
        item= hs_value()
        # try:
        sel = Selector(response)
        HKdata = sel.xpath("body/p/text()")
        if HKdata == '':
            return
        else:
            Jdata = json.loads(HKdata.extract()[0])
            if "error_description" in Jdata:
                log.msg("did not get data in xueqiu "+str(code))
                return Request(url="http://web.sqt.gtimg.cn/q=r_hk" + str(code), meta={'Item': item},headers=self.headers, callback=self.getshizhi)
            else:
                data = Jdata[str(market)+str(code)]
                item["name"]=data["name"]
                item["code"]=data["code"]
                item["update"] = self.update_time
                item["jinkaipan"] = data["open"]
                item["zuoshoupan"] = data["last_close"]
                item["zuigaojia"] = data["high"]
                item["zuidijia"] = data["low"]
                item["gujia"] = data["current"]
                item["chengjiaoe"] = data["amount"]
                item["chengjiaoliang"] = data["volume"]
                item["zuigao52"] = data["high52week"]
                item["zuidi52"] = data["low52week"]
                t1=data["time"]
                if t1=="":
                    item["riqi"] = "-"
                    item["shijian"] = "-"
                else:
                    date_t=time.strptime(t1,"%a %b %d %H:%M:%S +0800 %Y")
                    time_data=str(time.strftime("%Y-%m-%d %H:%M:%S",date_t))
                    item["riqi"] = time_data.split(" ")[0]
                    item["shijian"] = time_data.split(" ")[1]
                item["guben"] = data["totalShares"]
                item["shizhi"] =data["marketCapital"]
                return item
        # except Exception,e:
        #     log.msg(str(e),_level=logging.ERROR)
        #     return
