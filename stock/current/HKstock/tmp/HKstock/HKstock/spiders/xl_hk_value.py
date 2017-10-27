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
        return [Request(url="https://xueqiu.com/",headers=self.headers,callback=self.start_get_value,meta={"cookiejar":"xq"})]

    def start_get_value(self,response):
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
        conn.commit()
        for row in rows:
            code = row[0]
            sql = "select * from code_black_list where code='" +code+"'"
            cur.execute(sql)
            code_rows=cur.fetchall()
            conn.commit()
            if len(code_rows)==0:
                url = "http://hq.sinajs.cn/list=rt_hk"+code+",hk"+code+"_i"
                yield Request(url=url, headers=self.headers, callback=self.getdata, meta={"stock_code": code})
        conn.close()
    def getdata(self,response):
        code=response.meta["stock_code"]
        # log.msg("crawled "+str(code))
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
                    # log.msg(str(code)+"no shizhi goto ths")
                    # return Request(url="http://web.sqt.gtimg.cn/q=r_hk"+str(code),meta={'Item':item},headers=self.headers,callback=self.getshizhi)
                    # return Request(url="http://stockpage.10jqka.com.cn/HK"+code[1:]+"/quote/quotation/",meta={'Item':item,'stock_code':code},headers=self.headers,callback=self.getths)
                    headers = {
                        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
                        "Accept-Encoding": "gzip,deflate,br,sdch",
                        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
                        "Connection": "keep-alive",
                        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0",
                        "Host":"xueqiu.com",
                        "Referer":"https://xueqiu.com/S/"+str(code)
                    }
                    return Request(url="https://xueqiu.com/v4/stock/quote.json?code="+str(code)+"&_="+str(int(time.time()*1000)),meta={'Item':item,'stock_code':code,"cookiejar":"xq"},headers=self.headers,callback=self.getxueqiu)

            else:
                log.msg("tuishi " + code)

    def getshizhi(self,response):
        try:
            sel = Selector(response)
            hkjs = sel.xpath("body/p/text()").extract()[0].encode("utf-8")
            D = dict()
            for hk in hkjs.split(";"):
                if hk != "":
                    h = hk.split("=")
                    D[h[0]] = h[1].replace('"', "").replace(";", '')
            if "v_pv_none_match" not in D:
                item = response.meta["Item"]
                data = D["v_r_hk" + str(item["code"])].split("~0~0~0~0~0~0~0~0~0~")
                data2 = data[2].split("~")
                time = data2[1]
                if "0000/00/00" in time:
                    log.msg(str(item["code"]+" no shizhi "))
                    return
                else:
                    item["shizhi"] = str(int(string.atof(data2[16])*100000000.0))
                    log.msg("tx shizhi:"+str(item["shizhi"])+"  code "+item["code"])
                    return item
        except:
            pass



    def getxueqiu(self,response):
        code = response.meta["stock_code"]
        item=response.meta["Item"]
        try:
            sel = Selector(response)
            HKdata = sel.xpath("body/p/text()")
            if HKdata == '':
                return Request(url="http://web.sqt.gtimg.cn/q=r_hk" + str(code), meta={'Item': item},headers=self.headers, callback=self.getshizhi)
            else:
                Jdata = json.loads(HKdata.extract()[0])
                if "error_description" in Jdata:
                    log.msg("did not get data in xueqiu "+str(code))
                    return Request(url="http://web.sqt.gtimg.cn/q=r_hk" + str(code), meta={'Item': item},headers=self.headers, callback=self.getshizhi)
                else:
                    data = Jdata[str(code)]
                    if data["totalShares"]!="0":
                        if item["guben"]=="0":
                            item["guben"]=data["totalShares"]
                        if item["hkguben"]=="0":
                            item["hkguben"]=data["float_shares"]
                        item["shizhi"] = str(int(string.atof(item["guben"]) * string.atof(item["gujia"])))
                        item["hkshizhi"] = str(int(string.atof(item["hkguben"]) * string.atof(item["gujia"])))
                        log.msg("xueqiu:"+str(code))
                        return item
                    else:
                        return Request(url="http://web.sqt.gtimg.cn/q=r_hk"+str(code),meta={'Item':item},headers=self.headers,callback=self.getshizhi)
        except Exception,e:
            log.msg(str(e),_level=logging.ERROR)
            return Request(url="http://web.sqt.gtimg.cn/q=r_hk" + str(code), meta={'Item': item}, headers=self.headers,callback=self.getshizhi)





        # def getths(self,response):
    #     code = response.meta["stock_code"]
    #     item=response.meta["Item"]
    #     try:
    #         sel = Selector(response)
    #         HKdata = sel.xpath("body/p/text()")
    #         if HKdata == '':
    #             log.msg("no data " + code)
    #         else:
    #             Jdata = json.loads(HKdata.extract()[0])
    #             message = Jdata["errorcode"]
    #             if message == 0:
    #                 data = Jdata["data"]
    #                 key="HK" + code[1:]
    #                 if key in data:
    #                     stock_data =data[key]
    #                     item["shizhi"]=str(int(stock_data['3541450'] * 100000000))
    #                     return item
    #                 else:
    #                     item["shizhi"]=item["hkshizhi"]
    #                     if item["hkshizhi"]=='0':
    #                         return Request(url="http://web.sqt.gtimg.cn/q=r_hk"+str(code),meta={'Item':item},headers=self.headers,callback=self.getshizhi)
    #                     else:
    #                         return item
    #             else:
    #                 log.msg("there is an error in ths "+str(code))
    #     except:
    #         return Request(url="http://web.sqt.gtimg.cn/q=r_hk" + str(code), meta={'Item': item}, headers=self.headers,
    #                        callback=self.getshizhi)
