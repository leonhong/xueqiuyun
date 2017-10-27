# -*- coding:utf-8 -*-
import json
import logging

import MySQLdb
import scrapy
from scrapy import Request
import sys

from scrapy import log

from HKstock.items import hk_fuzhai
from scrapy import Selector
import time

class xl_hk_fuzai(scrapy.Spider):
    name = "xlhkfuzhai"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }

    custom_settings = {
        'ITEM_PIPELINES': {'HKstock.pipelines.hk_fuzhai': 300},
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
            url = "http://stock.finance.sina.com.cn/hkstock/api/jsonp.php/abc/FinanceStatusService.getBalanceSheetForjs?symbol="+str(code)+"&financeStanderd=all"
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
                if len(hk) ==27:
                    item=hk_fuzhai()
                    item["bank"]=False
                    item["code"]=code
                    item["baogaoriqi"]=hk[0]
                    item["type"] = hk[1]
                    item["feiliudongzichan"] = hk[2]
                    item["liudongzichan"] = hk[3]
                    item["liudongfuzai"] = hk[4]
                    item["jingliudongzichan"] = hk[5]
                    item["feiliudongfuzai"] = hk[6]
                    item["shaoshugudongquanyi"] = hk[7]
                    item["jingzichan"] = hk[8]
                    item["yifaxingguben"] = hk[9]
                    item["chubei"] = hk[10]
                    item["gudongquanyi"] = hk[11]
                    item["wuxingzichan"] = hk[12]
                    item["wuyechangfangshebei"] = hk[13]
                    item["fushugongsiquanyi"] = hk[14]
                    item["lianyinggongsiquanyi"] = hk[15]
                    item["qitatouzi"] = hk[16]
                    item["yingshouzhangkuan"] = hk[17]
                    item["cunhuo"] = hk[18]
                    item["xianjinjiyinhangjiecun"] = hk[19]
                    item["yingfuzhangkuan"] = hk[20]
                    item["yinhangdaikuan"] = hk[21]
                    item["feiliudongyinhangdaikuan"] = hk[22]
                    item["zongzichan"] = hk[23]
                    item["zongfuzai"] = hk[24]
                    item["gufenshumu"] = hk[25]
                    item["bizhong"] = hk[26]
                    yield item
                else:
                    item = hk_fuzhai()
                    item["bank"] = True
                    item["code"] = code
                    item["baogaoriqi"] = hk[0]
                    item["type"] = hk[1]
                    item["xianjinjinduanqizijin"] = hk[2]
                    item["yinghangtongyejiqitajinrongjingoucunkaun"] = hk[3]
                    item["maoyipiaoju"] = hk[4]
                    item["xianggangyequzhengfufuzhaizhengmingshu"] = hk[5]
                    item["jehudaikuanjiqitazhangkuang"] = hk[6]
                    item["chizhidaoqizhengquanzhaiwuzhengquangupiao"] = hk[7]
                    item["lianyinggongsiquanyi"] = hk[8]
                    item["hezigongsiquanyijiqitaquanyi"] = hk[9]
                    item["wuxingzichan"] = hk[10]
                    item["gudingzichangjitouziwuye"] = hk[11]
                    item["titazichan"] = hk[12]
                    item["zongzichan"] = hk[13]
                    item["xianggangzhibiliutonge"] = hk[14]
                    item["yinghangjiqitajirongjigoucunkuanjijieyu"] = hk[15]
                    item["kehucunkuan"] = hk[16]
                    item["yifaxingzhaiwuzhengquan"] = hk[17]
                    item["qitafuzhai"] = hk[18]
                    item["zongfuzhai"] = hk[19]
                    item["jiruziben"] = hk[20]
                    item["guben"] = hk[21]
                    item["chubei"] = hk[22]
                    item["gudongquanyi"] = hk[23]
                    item["shaoshugudongquanyi"] = hk[24]
                    item["zibenlaiyuanheji"] = hk[25]
                    item["fuzhaijizibenlaiyuanheji"] = hk[26]
                    item["gufenshumu"] = hk[27]
                    item["chiyoudecunkuanzheng"] = hk[28]
                    item["chizuomaimaiyongtuzhengquan"] = hk[29]
                    item["yifaxingcunkuanzheng"] = hk[30]
                    item["bizhong"] = hk[31]
                    yield item
            # except Exception,e:
            #     log.msg("tuishi code:"+str(code))