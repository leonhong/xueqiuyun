# -*- coding:utf-8 -*-
import json
import logging

import MySQLdb
import scrapy
from HSstock.items import hs_lirun
from scrapy import Request
import time
logger=logging.getLogger()
#proxyHost = "proxy.abuyun.com"
#proxyPort = "9020"
#proxyUser = "HJ265K5QABVY4Q4D"
#proxyPass = "C29187311FFB921E"
#
#proxyMeta = "http://%(user)s:%(pass)s@%(host)s:%(port)s" % {
#    "host" : proxyHost,
#    "port" : proxyPort,
#    "user" : proxyUser,
#    "pass" : proxyPass,
#}
#
#proxy_handler = urllib2.ProxyHandler({
#    "http"  : proxyMeta,
#    "https" : proxyMeta,
#})
#
#opener = urllib2.build_opener(proxy_handler)
#urllib2.install_opener(opener)

class lirun(scrapy.Spider):
    name = "hslirun"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }

    custom_settings = {
        'ITEM_PIPELINES': {'HSstock.pipelines.hs_lirun': 300},
        'LOG_LEVEL': "INFO"
    }

    def start_requests(self):
        print "---------------"
        self.logger.info("0000000000000000000000000000")
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
        for row in rows:
            code = row[0]
            url="http://money.finance.sina.com.cn/corp/go.php/vDOWN_ProfitStatement/displaytype/4/stockid/"+code+"/ctrl/all.phtml"
            #yield Request(url=url,headers=self.headers, callback=self.getdata, meta={"stock_code": code})
            yield Request(url=url, callback=self.getdata, meta={"stock_code": code})

        cur = conn.cursor()
        sql = "select stock_code from sz_stock_list"
        cur.execute(sql)
        rows = cur.fetchall()
        for row in rows:
            code = row[0]
            url = "http://money.finance.sina.com.cn/corp/go.php/vDOWN_ProfitStatement/displaytype/4/stockid/" + code + "/ctrl/all.phtml"
            #yield Request(url=url,headers=self.headers, callback=self.getdata, meta={"stock_code": code})
            yield Request(url=url, callback=self.getdata, meta={"stock_code": code})
        conn.close()

    def getdata(self,response):
        time.sleep(5)
        #print response
        #self.logger.info("response="+str(response))
        code=response.meta["stock_code"]
        data=response.body.decode("gb2312").encode("utf-8").split("\n")[0:-1]
        self.logger.info("datalen="+str(len(data)))
        self.logger.info("1111111")
        for i in range (0,len(data)):
            data[i]=data[i].split("\t")
        #if data[3][0]=='净利息收入':
        if data[3][0]=='利息净收入':
            self.logger.info("data[3][0]=" + str(data[3][0]))

            for i in range(1,len(data[0])-2):
                item=hs_lirun()
                item["bank"]=True
                item["code"] = code
                item["time"] = data[0][i]
                self.logger.info("1 time=" + item["time"])
                item["danwei"] = data[1][i]
                item["yingyeshouru"] = data[2][i]
                item["jinglixishouru"] = data[3][i]
                item["lixishouru"] = data[4][i]
                item["lixizhichu"] = data[5][i]
                item["shouxufeijirongjinjingshouru"] = data[6][i]
                item["shouxufeijirongjinshouru"] = data[7][i]
                item["shouxufeijirongjinzhichu"] = data[8][i]
                item["huiduishouyi"] = data[9][i]
                item["touzijingshouyi"] = data[10][i]
                item["duilianyinggongsitouzishouyi"] = data[11][i]
                item["gongyunjiazhibiandongshouyi"] = data[12][i]
                item["qitayewushouru"] = data[13][i]
                item["yingyezhichu"] = data[14][i]
                item["yingyeshuijinjifujia"] = data[15][i]
                item["yewujiguanlifeiyong"] = data[16][i]
                item["zichanjianzhisunshi"] = data[17][i]
                item["qitayewuzhichu"] = data[18][i]
                item["yingyelirun"] = data[19][i]
                item["yingyewaishouru"] = data[20][i]
                item["yingyewaizhichu"] = data[21][i]
                item["lirunzhonge"] = data[22][i]
                item["suodeshui"] = data[23][i]
                
			
		item["jinglirun"] = data[24][i]

                item["guishumugongsidejinglirun"] = data[25][i]
                item["shaoshugudongquanyi"] = data[26][i]

                item["jibenmeigushouyi"] = data[28][i]
                item["xishimeigushouyi"] = data[29][i]
                
                #item["qitazongheshouyi"] = data[30][i]
                #item["zongheshouyizonge"] = data[31][i]
                item["guishuyumugongsisuoyouzhedezhongheshouyizhonge"] = data[32][i]
                item["guishuyushaoshugudongdezhongheshouyizhonge"] = data[33][i]
                
                item["zhongjianyewujingshouru"] = "0"
                item["zhongjianyewushouru"] = "0"
                item["zhongjianyewuzhichu"] = "0"
                item["jingjiaoyishouru"] = "0"
                item["yanshengjinronggongjujiaoyijingshouru"] = "0"
                item["zhejiufei"] = "0"
                item["tiqudaizhangzhunbei"] = "0"
                item["nianchumweifenpeilirun"] = "0"
                item["kegongfenpeilirun"] = "0"
                item["tiqufadingyingyugongji"] = "0"
                item["tiqufadinggongyijin"] = "0"
                item["tiquyibanfengxianzhunbe"] = "0"
                item["tiquxintuopeichangzhunbeijin"] = "0"
                item["kegonggudongfenpeilirun"] = "0"
                item["yingfuyouxianguguli"] = "0"
                item["tiqurenyiyingyugongji"] = "0"
                item["yingfuputongguguli"] = "0"
                item["zhuanzuogubendeputongguguli"] = "0"
                item["weifenpeilirun"] = "0"

                yield item
        else:
            for i in range(1,len(data[0])-2):
                item=hs_lirun()
                item["bank"]=False
                item["code"] = code
                item["time"] = data[0][i]
                self.logger.info("2 time=" + item["time"]+ " datalen=" + str(len(data)) + " len(data[0])-2)=" + str(len(data[0])-2) + " data[24]=" + str(data[24]))
                item["danwei"] = data[1][i]
                item["yingyezhongshouru"] = data[2][i]
                item["yingyeshouru"] = data[3][i]
                item["yingyezhongchengben"] = data[4][i]
                item["yingyechengben"] = data[5][i]
                item["yingyeshuijinjifujia"] = data[6][i]
                item["xiaoshoufeiyong"] = data[7][i]
                item["guanlifeiyong"] = data[8][i]
                item["chaiwufeiyong"] = data[9][i]
                item["zichanjianzhisunshi"] = data[10][i]
                item["gongyunjiazhibiandongshouyi"] = data[11][i]
                item["touzishouyi"] = data[12][i]
                item["duilianyingqiyeheheyingqiyetouzishouyi"] = data[13][i]
                item["huiduishouyi"] = data[14][i]
                item["yingyelirun"] = data[15][i]
                item["yingyewaishouru"] = data[16][i]
                item["yingyewaizhichu"] = data[17][i]
                item["feiliudongzichanchuzhisunshi"] = data[18][i]
                item["lirunzhonge"] = data[19][i]
                item["suodeshuifeiyong"] = data[20][i]
                item["jinglirun"] = data[21][i]
                item["guishuyumugongsisuoyouzhejingliru"] = data[22][i]
                item["shaoshugudongsunyi"] = data[23][i]
                item["jinbenmeigushouyi"] = data[25][i]
                item["xishimeigushouyi"] = data[26][i]
                item["yitazhongheshouyi"] = data[27][i]
                item["zhongheshouyizhonge"] = data[28][i]
                item["guishuyumugongsisuoyouzhedezhongheshouyizhonge"] = data[29][i]
                item["guishuyushaoshugudongdezhongheshouyizhonge"] = data[30][i]

                item["lixishouru"] = "0"
                item["yizhuanbaofei"] = "0"
                item["shouxufeijiyongjinshouru"] = "0"
                item["fangdichanxiaoshoushouru"] = "0"
                item["qitayewushouru"] = "0"
                item["lixizhichu"] = "0"
                item["shouxufeijiyongjinzhichu"] = "0"
                item["fangdichanxiaoshouchengben"] = "0"
                item["yanfafeiyong"] = "0"
                item["tuibaojin"] = "0"
                item["peifuzhichujinge"] = "0"
                item["tiqubaoxianhetongzhunbeijinjinge"] = "0"
                item["baodanhonglizhichu"] = "0"
                item["fenbaofeiyong"] = "0"
                item["titayewuchengben"] = "0"
                item["qihuoshouyi"] = "0"
                item["tuoguanshouyi"] = "0"
                item["butieshouru"] = "0"
                item["qitayewulirun"] = "0"
                item["weiquerentouzisunshi"] = "0"

                yield item
