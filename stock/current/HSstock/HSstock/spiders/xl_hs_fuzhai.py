# -*- coding:utf-8 -*-
import json
import logging

import MySQLdb
import scrapy
from HSstock.items import hs_fuzhai
from scrapy import Request
import time

class fuzhai(scrapy.Spider):
    name = "hsfuzhai"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }

    custom_settings = {
        'ITEM_PIPELINES': {'HSstock.pipelines.hs_fuzhai': 300},
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
        sql = "select stock_code from sh_stock_list"
        cur.execute(sql)
        rows = cur.fetchall()
        for row in rows:
            code = row[0]
            url="http://money.finance.sina.com.cn/corp/go.php/vDOWN_BalanceSheet/displaytype/4/stockid/"+code+"/ctrl/all.phtml"
            yield Request(url=url,
                      headers=self.headers, callback=self.getdata, meta={"stock_code": code})

        cur = conn.cursor()
        sql = "select stock_code from sz_stock_list"
        cur.execute(sql)
        rows = cur.fetchall()
        for row in rows:
            code = row[0]
            url = "http://money.finance.sina.com.cn/corp/go.php/vDOWN_BalanceSheet/displaytype/4/stockid/" + code + "/ctrl/all.phtml"
            yield Request(url=url,
                          headers=self.headers, callback=self.getdata, meta={"stock_code": code})
        conn.close()

    def getdata(self,response):
        code=response.meta["stock_code"]
        #data=response.body.decode("gb2312").encode("utf-8").split("\n")[0:-1]
        data=response.body.decode("gb2312","ignore").encode("utf-8").split("\n")[0:-1]
        for i in range (0,len(data)):
            data[i]=data[i].split("\t")
        if data[2][0]=='资产':
            for i in range(1, len(data[0]) - 2):
                item = hs_fuzhai()



                item["cunchufachaojijin"] = "0"
                item["tiexian"] = "0"
                item["huobizijin"] = "0"
                item["jiesuanzhunbeijin"] = "0"
                item["chaifangtongye"] = "0"
                item["chaifangjinrongxinggongsi"] = "0"
                item["cunfanglianhangkuanxing"] = "0"
                item["jinchukouyahui"] = "0"
                item["yingshouzhangkuang"] = "0"
                item["yufuzhangkuang"] = "0"
                item["daikuansunshizhunbei"] = "0"
                item["qitayingshoukuan"] = "0"
                item["changqiyingshoukuan"] = "0"
                item["touzizigongsi"] = "0"
                item["touzifangdichan"] = "0"
                item["tanbofeiyong"] = "0"
                item["gudingzichanjinge"] = "0"
                item["zaijiangongcheng"] = "0"
                item["gudingzichanqingli"] = "0"
                item["changqitanbofeiyong"] = "0"
                item["daichulidizaizichan"] = "0"
                item["dizhaizichuanjianzhizhunbei"] = "0"
                item["daichulidizhaizichanjine"] = "0"
                item["buliangzichanchuzhishunshizhuanxiangzhunbei"] = "0"
                item["faxinghuobizaiwu"] = "0"
                item["lianhangchunfangkuanxiang"] = "0"
                item["waiguozhengfujiekuan"] = "0"
                item["piaojurongzi"] = "0"
                item["yingjiehuikuanjilinshichunkuan"] = "0"
                item["yutifeiyong"] = "0"
                item["faxingchuankuanzheng"] = "0"
                item["huichuhuikuan"] = "0"
                item["yingfufulifei"] = "0"
                item["yingjiaoshuifei"] = "0"
                item["yingfulixi"] = "0"
                item["yingfuzhangkuang"] = "0"
                item["zhuanxiangyingfukuan"] = "0"
                item["yingfuguli"] = "0"
                item["qitayingfukuan"] = "0"
                item["diyanshouyi"] = "0"
                item["changqiyingfukuan"] = "0"
                item["yingfucijizhaiquan"] = "0"
                item["kechushouleitouziweishixianshunyin"] = "0"
                item["chiyouzhidaoqitouziweijiezhuansunyi"] = "0"
                item["xintuopeichangzhunbeijin"] = "0"
                item["nifenpeixianjinguli"] = "0"



                item["bank"] = True
                item["code"]=code
                item["time"] = data[0][i]
                item["danwei"] = data[1][i]
                item["cunfangzhongyangyinhang"] = data[3][i]
                item["cunfangtongyekuanxiang"] = data[4][i]
                item["chaichuzijin"] = data[5][i]
                item["guijinshu"] = data[6][i]
                item["jiaoyixingjinrongzichan"] = data[7][i]
                item["yanshengjinronggongjuzichan"] = data[8][i]
                item["mairufanshoujirongzichan"]=data[9][i]
                item["yingshoulixi"] = data[10][i]
                item["fafangdaikuanjidiankuan"] = data[11][i]
                item["dailiyewuzichan"] = data[12][i]
                item["kegongchushoujinrongzichan"] = data[13][i]
                item["chiyouzhidaoqitouzi"] = data[14][i]
                item["changqiguquantouzi"] = data[15][i]
                item["yingshoutouzikuanxiang"] = data[16][i]
                item["gudingzichanheji"] = data[17][i]
                item["wuxingzichan"] = data[18][i]
                item["shangyu"] = data[19][i]
                item["diyanshuikuanjiexiang"] = data[20][i]
                item["touzixingfangdichan"]=data[21][i]
                item["qitazichan"] = data[22][i]
                item["zichanzhongji"] = data[23][i]
                item["xiangzhongyangyinhangjiekuan"] = data[25][i]
                item["tongyechunrujichaichu"] = data[26][i]
                item["tongyecunfangkuanxiang"] = data[27][i]
                item["chairuzijin"] = data[28][i]
                item["yanshengjinronggongjufuzhai"] = data[29][i]
                item["jiaoyixingjirongfuzhai"] = data[30][i]
                item["maichuhuigouzichankuan"] = data[31][i]
                item["kehuochunkuan"] = data[32][i]
                item["yingfuzhigongxinchou"]=data[33][i]
                item["yingjiaoshuifei"]=data[34][i]
                item["yingfulixi"]=data[35][i]
                item["yingfuzhangkuan"]=data[36][i]
                item["dailiyewufuzhai"] = data[37][i]
                item["yingfuzhaiquan"] = data[38][i]
                item["diyansuodeshuifuzhai"] = data[39][i]
                item["yujifuzhai"] = data[40][i]
                item["qitafuzhai"] = data[41][i]
                item["fuzhaiheji"] = data[42][i]
                item["guben"] = data[44][i]
                item["qitaquanyigongju"] = data[45][i]
                item["youxiangu"] = data[46][i]
                item["zibengongji"] = data[47][i]
                item["kuancanggu"] = data[48][i]
                item["qitazongheshouyi"] = data[49][i]
                item["yingyugongji"] = data[50][i]
                item["weifenpeilirun"] = data[51][i]
                item["yibanfengxianzhunbei"] = data[52][i]
                item["waibibaobiaozesuanchae"] = data[53][i]
                item["qitachubei"] = data[54][i]
                item["guishumugongsigudongquanyi"] = data[55][i]
                item["shaoshugudongquanyi"] = data[56][i]
                item["gudongquanyiheji"] = data[57][i]
                item["fuzhaijigudongquanyiheji"] = data[58][i]
                item["mairufanshoujinrongzichan"] = "0"
               


                yield item
        else:
            for i in range(1,len(data[0])-2):
                item=hs_fuzhai()







                item["jiesuanbeifujin"]="0"
                item["chaichuziji"]="0"
                item["yingshoubaofei"]="0"
                item["yingshoufenbaozhangkuan"]="0"
                item["yingshoufenbaohetongzhunbeijin"]="0"
                item["yinshoulixi"]="0"
                item["yingshouchukoutuishui"]="0"
                item["yingshoubutie"]="0"
                item["yingshoubaozhengjin"]="0"
                item["neibujingshoukuan"]="0"
                item["qitachangqitouzi"]="0"
                item["gudingzichanyuanzhi"]="0"
                item["zhejiu"]="0"
                item["gudingzichanjingzhi"]="0"
                item["gudingzichanjianzhizhunbei"]="0"
                item["guquanfenzhiliutongquan"]="0"
                item["xiangzhongyangyinhangjiekuan"]="0"
                item["xishoucunkuanjitongyecunfang"]="0"
                item["chairuziji"]="0"
                item["yanshengjinrongfuzai"]="0"
                item["maichuhuigoujinrongzicanshu"]="0"
                item["yingfubaozhengjin"]="0"
                item["neibuyingfujin"]="0"
                item["qitayingfukuan"]="0"
                item["yujiliudongfuzai"]="0"
                item["yingfufenbaozhangkuan"]="0"
                item["baoxianhetongzhunbeijin"]="0"
                item["dailimaimaiquankuan"]="0"
                item["dailichengxiaoquankuan"]="0"
                item["guojipiaozhengjiesuan"]="0"
                item["guoneipiaozhengjiesuan"]="0"
                item["diyanshouyi"]="0"
                item["weiquedingdetouzishunshi"]="0"
                item["nifenpeixianjinguli"]="0"
                item["waibibaobiaozhesuanche"]="0"




                item["bank"]=False
                item["code"]=code
                item["time"]=data[0][i]
                item["danwei"]=data[1][i]
                item["huobizijin"]=data[3][i]
                item["jiaoyixingjinrongziji"]=data[4][i]
                item["yanshengjinrongziji"]=data[5][i]
                item["yingshoupiaoju"]=data[6][i]
                item["yingshouzhangkuan"]=data[7][i]
                item["yufukuanxiang"]=data[8][i]
                item["yingshoulixi"] = data[9][i]
                item["yingshouguli"]=data[10][i]
                item["qitayingshoukuan"]=data[11][i]
                item["mairufanshoujirongzichan"]=data[12][i]
                item["cunhuo"]=data[13][i]
                item["huafenweichiyoudaishoudezichan"]=data[14][i]
                item["yinianneidaoqidefeiliudongzichan"]=data[15][i]
                item["daitanfeiyong"]=data[16][i]
                item["daichuliliudongzichansunyin"]=data[17][i]
                item["qitaliudongzichan"]=data[18][i]
                item["liudongzichanheji"]=data[19][i]
                item["fafangdaikuanjidiankuan"]=data[21][i]
                item["kegongchushoujinrongzichan"]=data[22][i]
                item["chiyouzhidaoqitouzi"]=data[23][i]
                item["changqiyingshoukuan"]=data[24][i]
                item["changqiguquantouzi"]=data[25][i]
                item["touzixingfangdichan"]=data[26][i]
                item["gudingzichanjinge"]=data[27][i]
                item["zaijiangongcheng"]=data[28][i]
                item["gongchengwuzi"]=data[29][i]
                item["gudingzichanqingli"]=data[30][i]
                item["shengchanxingshengwuzichan"]=data[31][i]
                item["gongyixingshengwuzichan"]=data[32][i]
                item["qiyouzichan"]=data[33][i]
                item["wuxingzichan"]=data[34][i]
                item["kaifazhichu"]=data[35][i]
                item["shangyu"]=data[36][i]
                item["changqidaitanfeiyong"]=data[37][i]
                item["diyanshuodeshuizichan"]=data[38][i]
                item["qitafeilidongzichan"]=data[39][i]
                item["feiliudongzichanheji"]=data[40][i]
                item["zichanzhongji"]=data[41][i]
                item["duanqijiekuan"]=data[43][i]
                item["jiaoyixingjinrongfuzai"]=data[44][i]
                item["yingfupiaoju"]=data[45][i]
                item["yingfuzhangkuan"]=data[46][i]
                item["yushoukuanxiang"]=data[47][i]
                item["yingfushouxufeijiyongjin"]=data[48][i]
                item["yingfuzhigongxinchou"]=data[49][i]
                item["yingjiaoshuifei"]=data[50][i]
                item["yingfulixi"]=data[51][i]
                item["yingfuguli"]=data[52][i]
                item["qitayingjiaokuan"]=data[53][i]
                item["yutifeiyong"]=data[54][i]
                item["yinianneidediyanshouyi"]=data[55][i]
                item["yingfuduanqizaiquan"]=data[56][i]
                item["yinianneidaoqidefeiliudongfuzai"]=data[57][i]
                item["qitaliudongfuzai"]=data[58][i]
                item["liudongfuzaiheji"]=data[59][i]
                item["changqijiekuan"]=data[61][i]
                item["yingfuzaiquan"]=data[62][i]
                item["changqiyingfukuan"]=data[63][i]
                item["changqiyingfuzhigongxinchou"]=data[64][i]
                item["zhuanxiangyingfukuan"]=data[65][i]
                item["yujifeiliudongfuzai"]=data[66][i]
                item["diyanshuodeshuifuzai"]=data[67][i]
                item["changqidiyanshouyi"]=data[68][i]
                item["qitafeiliudongfuzai"]=data[69][i]
                item["feiliudongfuzaiheji"]=data[70][i]
                item["fuzaiheji"]=data[71][i]
                item["shishouziben"]=data[73][i]
                item["zibengongji"]=data[74][i]
                item["kucungu"]=data[75][i]
                item["qitazongheshouyi"] = data[76][i]
                item["zhuanxiangchubei"]=data[77][i]
                item["yingyugongji"]=data[78][i]
                item["yibanfengxianzhunbei"]=data[79][i]
                item["weifenpeilirun"]=data[80][i]
                item["guishuyumugongsigudongquanyiheji"]=data[81][i]
                item["shaoshugudongquanyi"]=data[82][i]
                item["suoyouzhequanyiheji"]=data[83][i]
                item["fuzaihesuoyouzhequanyizhongji"]=data[84][i]


                yield item
