# -*- coding:utf-8 -*-
import json
import logging

import MySQLdb
import scrapy
from scrapy import Request
import sys

from scrapy import log

from HKstock.items import hk_sunyi
from scrapy import Selector
import time

class xl_hk_sunyi(scrapy.Spider):
    name = "xlhksunyi"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }

    custom_settings = {
        'ITEM_PIPELINES': {'HKstock.pipelines.hk_sunyi': 300},
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
            url = "http://stock.finance.sina.com.cn/hkstock/api/jsonp.php/abc/FinanceStatusService.getFinanceStatusForjs?symbol="+str(code)+"&financeStanderd=all"
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
                if len(hk)==22:
                    item=hk_sunyi()
                    item["bank"]=False
                    item["code"]=code
                    item["baogaoriqi"]=hk[0]
                    item["type"] = hk[1]
                    item["yingyee"] =hk[2]
                    item["chusuiqianyingli"] =hk[3]
                    item["suixiang"] =hk[4]
                    item["chusuihouyingli"] =hk[5]
                    item["shaoshugudongquanyi"]=hk[6]
                    item["gudongyingzhanyingli"] =hk[7]
                    item["guxi"]=hk[8]
                    item["chusuiguxihouyingli"] =hk[9]
                    item["meiguyingli"] =hk[10]
                    item["tanboyingli"] =hk[11]
                    item["meiguguxi"]=hk[12]
                    item["xiaoshouchengben"] =hk[13]
                    item["zhejiu"] =hk[14]
                    item["xiaoshoujifeixiaofeiyong"] =hk[15]
                    item["yibanjixingzhengfeiyong"] =hk[16]
                    item["lixifeiyong"] =hk[17]
                    item["maoli"]=hk[18]
                    item["jingyingyingli"] =hk[19]
                    item["yingzhanliangyinggongsiyingli"] =hk[20]
                    item["bizhong"]=hk[21]
                    yield item
                else:
                    item = hk_sunyi()
                    item["bank"] = True
                    item["code"] = code
                    item["baogaoriqi"] = hk[0]
                    item["type"] = hk[1]
                    item["lixishouru"] = hk[2]
                    item["lixizhichu"] = hk[3]
                    item["jinglixishouru"] = hk[4]
                    item["qitajingyingshouru"] = hk[5]
                    item["jingyingshouru"] = hk[6]
                    item["jingyingzhichu"] = hk[7]
                    item["zongzhunbei"] = hk[8]
                    item["qitayingli"] = hk[9]
                    item["shuiqianyingli"] = hk[10]
                    item["shuixiang"] = hk[11]
                    item["chushuihouyingli"] = hk[12]
                    item["shaoshugudongquanyi"] = hk[13]
                    item["gudongyingzhanyingli"] = hk[14]
                    item["guxi"]=hk[15]
                    item["chushuiguxihouyingli"] = hk[16]
                    item["jibenmeiguyingli"] = hk[17]
                    item["tanbomeiguyingli"] = hk[18]
                    item["bizhong"] = hk[19]
                    yield item
            # except Exception,e:
            #     log.msg("tuishi code:"+str(code))
