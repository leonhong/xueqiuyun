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
        data=response.body.decode("gb2312").encode("utf-8").split("\n")[0:-1]
        for i in range (0,len(data)):
            data[i]=data[i].split("\t")
        if data[2][0]=='资产':
            for i in range(1, len(data[0]) - 2):
                item = hs_fuzhai()
                item["bank"] = True
                item["code"]=code
                item["time"] = data[0][i]
                item["danwei"] = data[1][i]
                item["huobizijin"] = data[3][i]
                item["cunfangzhongyangyinhang"] = data[5][i]
                item["jiesuanzhunbeijin"] = data[6][i]
                item["guijinshu"] = data[7][i]
                item["cunfangtongyekuanxiang"] = data[8][i]
                item["chaichuzijin"] = data[9][i]
                item["chaifangtongye"] = data[10][i]
                item["chaifangjinrongxinggongsi"] = data[11][i]
                item["cunfanglianhangkuanxing"] = data[12][i]
                item["cunchufachaojijin"] = data[13][i]
                item["yanshengjinronggongjuzichan"] = data[14][i]
                item["jiaoyixingjinrongzichan"] = data[15][i]
                item["mairufanshoujinrongzichan"] = data[16][i]
                item["tiexian"] = data[17][i]
                item["jinchukouyahui"] = data[18][i]
                item["yingshouzhangkuang"] = data[19][i]
                item["yufuzhangkuang"] = data[20][i]
                item["yingshoulixi"] = data[21][i]
                item["fafangdaikuanjidiankuan"] = data[22][i]
                item["daikuansunshizhunbei"] = data[23][i]
                item["dailiyewuzichan"] = data[24][i]
                item["kegongchushoujinrongzichan"] = data[25][i]
                item["chiyouzhidaoqitouzi"] = data[26][i]
                item["qitayingshoukuan"] = data[27][i]
                item["changqiyingshoukuan"] = data[28][i]
                item["changqiguquantouzi"] = data[29][i]
                item["touzizigongsi"] = data[30][i]
                item["touzifangdichan"] = data[31][i]
                item["yingshoutouzikuanxiang"] = data[32][i]
                item["tanbofeiyong"] = data[33][i]
                item["gudingzichanjinge"] = data[34][i]
                item["zaijiangongcheng"] = data[35][i]
                item["gudingzichanqingli"] = data[36][i]
                item["wuxingzichan"] = data[37][i]
                item["shangyu"] = data[38][i]
                item["changqitanbofeiyong"] = data[39][i]
                item["daichulidizaizichan"] = data[40][i]
                item["dizhaizichuanjianzhizhunbei"] = data[41][i]
                item["daichulidizhaizichanjine"] = data[42][i]
                item["diyanshuikuanjiexiang"] = data[43][i]
                item["qitazichan"] = data[44][i]
                item["buliangzichanchuzhishunshizhuanxiangzhunbei"] = data[45][i]
                item["zichanzhongji"] = data[46][i]
                item["xiangzhongyangyinhangjiekuan"] = data[48][i]
                item["faxinghuobizaiwu"] = data[49][i]
                item["tongyechunrujichaichu"] = data[50][i]
                item["tongyecunfangkuanxiang"] = data[51][i]
                item["chairuzijin"] = data[52][i]
                item["lianhangchunfangkuanxiang"] = data[53][i]
                item["waiguozhengfujiekuan"] = data[54][i]
                item["yanshengjinronggongjufuzhai"] = data[55][i]
                item["jiaoyixingjirongfuzhai"] = data[56][i]
                item["maichuhuigouzichankuan"] = data[57][i]
                item["kehuochunkuan"] = data[58][i]
                item["piaojurongzi"] = data[59][i]
                item["yingjiehuikuanjilinshichunkuan"] = data[60][i]
                item["yutifeiyong"] = data[61][i]
                item["faxingchuankuanzheng"] = data[62][i]
                item["huichuhuikuan"] = data[63][i]
                item["yingfufulifei"] = data[65][i]
                item["yingjiaoshuifei"] = data[66][i]
                item["yingfulixi"] = data[67][i]
                item["yingfuzhangkuang"] = data[68][i]
                item["zhuanxiangyingfukuan"] = data[69][i]
                item["yingfuguli"] = data[70][i]
                item["qitayingfukuan"] = data[71][i]
                item["dailiyewufuzhai"] = data[72][i]
                item["yujifuzhai"] = data[73][i]
                item["diyanshouyi"] = data[74][i]
                item["changqiyingfukuan"] = data[75][i]
                item["yingfuzhaiquan"] = data[76][i]
                item["yingfucijizhaiquan"] = data[77][i]
                item["diyansuodeshuifuzhai"] = data[78][i]
                item["qitafuzhai"] = data[79][i]
                item["fuzhaiheji"] = data[80][i]
                item["guben"] = data[82][i]
                item["zibengongji"] = data[83][i]
                item["kechushouleitouziweishixianshunyin"] = data[84][i]
                item["chiyouzhidaoqitouziweijiezhuansunyi"] = data[85][i]
                item["kuancanggu"] = data[86][i]
                item["yingyugongji"] = data[87][i]
                item["yibanfengxianzhunbei"] = data[88][i]
                item["xintuopeichangzhunbeijin"] = data[89][i]
                item["weifenpeilirun"] = data[90][i]
                item["nifenpeixianjinguli"] = data[91][i]
                item["waibibaobiaozesuanchae"] = data[92][i]
                item["qitachubei"] = data[93][i]
                item["guishumugongsigudongquanyi"] = data[94][i]
                item["shaoshugudongquanyi"] = data[95][i]
                item["gudongquanyiheji"] = data[96][i]
                item["fuzhaijigudongquanyiheji"] = data[97][i]

                yield item
        else:
            for i in range(1,len(data[0])-2):
                item=hs_fuzhai()
                item["bank"]=False
                item["code"]=code
                item["time"]=data[0][i]
                item["danwei"]=data[1][i]
                item["huobizijin"]=data[3][i]
                item["jiesuanbeifujin"]=data[4][i]
                item["chaichuziji"]=data[5][i]
                item["jiaoyixingjinrongziji"]=data[6][i]
                item["yanshengjinrongziji"]=data[7][i]
                item["yingshoupiaoju"]=data[8][i]
                item["yingshouzhangkuan"]=data[9][i]
                item["yufukuanxiang"]=data[10][i]
                item["yingshoubaofei"]=data[11][i]
                item["yingshoufenbaozhangkuan"]=data[12][i]
                item["yingshoufenbaohetongzhunbeijin"]=data[13][i]
                item["yinshoulixi"]=data[14][i]
                item["yingshouguli"]=data[15][i]
                item["qitayingshoukuan"]=data[16][i]
                item["yingshouchukoutuishui"]=data[17][i]
                item["yingshoubutie"]=data[18][i]
                item["yingshoubaozhengjin"]=data[19][i]
                item["neibujingshoukuan"]=data[20][i]
                item["mairufanshoujirongzichan"]=data[21][i]
                item["cunhuo"]=data[22][i]
                item["daitanfeiyong"]=data[23][i]
                item["daichuliliudongzichansunyin"]=data[24][i]
                item["yinianneidaoqidefeiliudongzichan"]=data[25][i]
                item["qitaliudongzichan"]=data[26][i]
                item["liudongzichanheji"]=data[27][i]
                item["fafangdaikuanjidiankuan"]=data[29][i]
                item["kegongchushoujinrongzichan"]=data[30][i]
                item["chiyouzhidaoqitouzi"]=data[31][i]
                item["changqiyingshoukuan"]=data[32][i]
                item["changqiguquantouzi"]=data[33][i]
                item["qitachangqitouzi"]=data[34][i]
                item["touzixingfangdichan"]=data[35][i]
                item["gudingzichanyuanzhi"]=data[36][i]
                item["zhejiu"]=data[37][i]
                item["gudingzichanjingzhi"]=data[38][i]
                item["gudingzichanjianzhizhunbei"]=data[39][i]
                item["gudingzichanjinge"]=data[40][i]
                item["zaijiangongcheng"]=data[41][i]
                item["gongchengwuzi"]=data[42][i]
                item["gudingzichanqingli"]=data[43][i]
                item["shengchanxingshengwuzichan"]=data[44][i]
                item["gongyixingshengwuzichan"]=data[45][i]
                item["qiyouzichan"]=data[46][i]
                item["wuxingzichan"]=data[47][i]
                item["kaifazhichu"]=data[48][i]
                item["shangyu"]=data[49][i]
                item["changqidaitanfeiyong"]=data[50][i]
                item["guquanfenzhiliutongquan"]=data[51][i]
                item["diyanshuodeshuizichan"]=data[52][i]
                item["qitafeilidongzichan"]=data[53][i]
                item["feiliudongzichanheji"]=data[54][i]
                item["zichanzhongji"]=data[55][i]
                item["duanqijiekuan"]=data[57][i]
                item["xiangzhongyangyinhangjiekuan"]=data[58][i]
                item["xishoucunkuanjitongyecunfang"]=data[59][i]
                item["chairuziji"]=data[60][i]
                item["jiaoyixingjinrongfuzai"]=data[61][i]
                item["yanshengjinrongfuzai"]=data[62][i]
                item["yingfupiaoju"]=data[63][i]
                item["yingfuzhangkuan"]=data[64][i]
                item["yushoukuanxiang"]=data[65][i]
                item["maichuhuigoujinrongzicanshu"]=data[66][i]
                item["yingfushouxufeijiyongjin"]=data[67][i]
                item["yingfuzhigongxinchou"]=data[68][i]
                item["yingjiaoshuifei"]=data[69][i]
                item["yingfulixi"]=data[70][i]
                item["yingfuguli"]=data[71][i]
                item["qitayingjiaokuan"]=data[72][i]
                item["yingfubaozhengjin"]=data[73][i]
                item["neibuyingfujin"]=data[74][i]
                item["qitayingfukuan"]=data[75][i]
                item["yutifeiyong"]=data[76][i]
                item["yujiliudongfuzai"]=data[77][i]
                item["yingfufenbaozhangkuan"]=data[78][i]
                item["baoxianhetongzhunbeijin"]=data[79][i]
                item["dailimaimaiquankuan"]=data[80][i]
                item["dailichengxiaoquankuan"]=data[81][i]
                item["guojipiaozhengjiesuan"]=data[82][i]
                item["guoneipiaozhengjiesuan"]=data[83][i]
                item["diyanshouyi"]=data[84][i]
                item["yingfuduanqizaiquan"]=data[85][i]
                item["yinianneidaoqidefeiliudongfuzai"]=data[86][i]
                item["qitaliudongfuzai"]=data[87][i]
                item["liudongfuzaiheji"]=data[88][i]
                item["changqijiekuan"]=data[90][i]
                item["yingfuzaiquan"]=data[91][i]
                item["changqiyingfukuan"]=data[92][i]
                item["zhuanxiangyingfukuan"]=data[93][i]
                item["yujifeiliudongfuzai"]=data[94][i]
                item["diyanshuodeshuifuzai"]=data[95][i]
                item["qitafeiliudongfuzai"]=data[96][i]
                item["feiliudongfuzaiheji"]=data[97][i]
                item["fuzaiheji"]=data[98][i]
                item["shishouziben"]=data[100][i]
                item["zibengongji"]=data[101][i]
                item["kucungu"]=data[102][i]
                item["zhuanxiangchubei"]=data[103][i]
                item["yingyugongji"]=data[104][i]
                item["yibanfengxianzhunbei"]=data[105][i]
                item["weiquedingdetouzishunshi"]=data[106][i]
                item["weifenpeilirun"]=data[107][i]
                item["nifenpeixianjinguli"]=data[108][i]
                item["waibibaobiaozhesuanche"]=data[109][i]
                item["guishuyumugongsigudongquanyiheji"]=data[110][i]
                item["shaoshugudongquanyi"]=data[111][i]
                item["suoyouzhequanyiheji"]=data[112][i]
                item["fuzaihesuoyouzhequanyizhongji"]=data[113][i]

                yield item





