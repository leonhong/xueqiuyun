# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html
import logging

import MySQLdb
from scrapy import log

import sys
default_encoding = 'utf-8'
if sys.getdefaultencoding() != default_encoding:
    reload(sys)
    sys.setdefaultencoding(default_encoding)

class XlstockPipeline(object):
    def process_item(self, item, spider):
        return item

class hs_fuzhai(object):
    def __init__(self):
        conn = MySQLdb.connect(
            host='127.0.0.1',
            port=3306,
            user='root',
            passwd='20160401',
            db='stock',
            charset='utf8'
        )
        self.conn = conn

    def process_item(self, item, spider):
        cur = self.conn.cursor()
        if not item["bank"]:
            sql = "select * from xl_hs_fuzhai where ky='" + item['code'] + "-" + item['time'] +  "'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql = "insert into xl_hs_fuzhai (ky, code, time, danwei, huobizijin, " \
                          "jiesuanbeifujin, chaichuziji, jiaoyixingjinrongziji, " \
                          "yanshengjinrongziji, yingshoupiaoju, yingshouzhangkuan," \
                          " yufukuanxiang, yingshoubaofei, yingshoufenbaozhangkuan, " \
                          "yingshoufenbaohetongzhunbeijin, yinshoulixi, yingshouguli," \
                          " qitayingshoukuan, yingshouchukoutuishui, yinshoubutie," \
                          " yingshoubaozhengjin, neibujingshoukuan, mairufanshoujirongzichan," \
                          " cunhuo, daitanfeiyong, daichuliliudongzichansunyin, yinianneidaoqidefeiliudongzichan, " \
                          "qitaliudongzichan, liudongzichanheji, fafangdaikuanjidiankuan, kegongchushoujinrongzichan, " \
                          "chiyouzhidaoqitouzi, changqiyingshoukuan, changqiguquantouzi, qitachangqitouzi," \
                          " touzixingfangdichan, gudingzichanyuanzhi, zhejiu, gudingzichanjingzhi," \
                          " gudingzichanjianzhizhunbei, gudingzichanjinge, zaijiangongcheng, " \
                          "gongchengwuzi, gudingzichanqingli, shengchanxingshengwuzichan, " \
                          "gongyixingshengwuzichan, qiyouzichan, wuxingzichan, kaifazhichu," \
                          " shangyu, changqidaitanfeiyong, guquanfenzhiliutongquan, " \
                          "diyanshuodeshuizichan, qitafeilidongzichan, feiliudongzichanheji, " \
                          "zichanzhongji, duanqijiekuan, xiangzhongyangyinhangjiekuan, " \
                          "xishoucunkuanjitongyecunfang, chairuziji, jiaoyixingjinrongfuzai," \
                          " yanshengjinrongfuzai, yingfupiaoju, yingfuzhangkuan, yushoukuanxiang, " \
                          "maichuhuigoujinrongzicanshu, yingfushouxufeijiyongjin, yingfuzhigongxinchou," \
                          " yingjiaoshuifei, yingfulixi, yingfuguli, qitayingjiaokuan, yingfubaozhengjin," \
                          " neibuyingfujin, qitayingfukuan, yutifeiyong, yujiliudongfuzai," \
                          " yingfufenbaozhangkuan, baoxianhetongzhunbeijin, dailimaimaiquankuan, " \
                          "dailichengxiaoquankuan, guojipiaozhengjiesuan, guoneipiaozhengjiesuan, " \
                          "diyanshouyi, yingfuduanqizaiquan, yinianneidaoqidefeiliudongfuzai, " \
                          "qitaliudongfuzai, liudongfuzaiheji, changqijiekuan, yingfuzaiquan, " \
                          "changqiyingfukuan, zhuanxiangyingfukuan, yujifeiliudongfuzai, " \
                          "diyanshuodeshuifuzai, qitafeiliudongfuzai, feiliudongfuzaiheji," \
                          " fuzaiheji, shishouziben, zibengongji, kucungu, zhuanxiangchubei," \
                          " yingyugongji, yibanfengxianzhunbei, weiquedingdetouzishunshi," \
                          " weifenpeilirun, nifenpeixianjinguli, waibibaobiaozhesuanche," \
                          " guishuyumugongsigudongquanyiheji, shaoshugudongquanyi, " \
                          "suoyouzhequanyiheji, fuzaihesuoyouzhequanyizhongji) values" \
                          + "('" + item["code"] + "-" + item["time"]+"'," \
                          + "'" + item["code"] + "'," \
                          + "'" + item["time"] + "'," \
                          + "'" + item["danwei"] + "'," \
                          + "'" + item["huobizijin"] + "'," \
                          + "'" + item["jiesuanbeifujin"] + "'," \
                          + "'" + item["chaichuziji"] + "'," \
                          + "'" + item["jiaoyixingjinrongziji"] + "'," \
                          + "'" + item["yanshengjinrongziji"] + "'," \
                          + "'" + item["yingshoupiaoju"] + "'," \
                          + "'" + item["yingshouzhangkuan"] + "'," \
                          + "'" + item["yufukuanxiang"] + "'," \
                          + "'" + item["yingshoubaofei"] + "'," \
                          + "'" + item["yingshoufenbaozhangkuan"] + "'," \
                          + "'" + item["yingshoufenbaohetongzhunbeijin"] + "'," \
                          + "'" + item["yinshoulixi"] + "'," \
                          + "'" + item["yingshouguli"] + "'," \
                          + "'" + item["qitayingshoukuan"] + "'," \
                          + "'" + item["yingshouchukoutuishui"] + "'," \
                          + "'" + item["yingshoubutie"] + "'," \
                          + "'" + item["yingshoubaozhengjin"] + "'," \
                          + "'" + item["neibujingshoukuan"] + "'," \
                          + "'" + item["mairufanshoujirongzichan"] + "'," \
                          + "'" + item["cunhuo"] + "'," \
                          + "'" + item["daitanfeiyong"] + "'," \
                          + "'" + item["daichuliliudongzichansunyin"] + "'," \
                          + "'" + item["yinianneidaoqidefeiliudongzichan"] + "'," \
                          + "'" + item["qitaliudongzichan"] + "'," \
                          + "'" + item["liudongzichanheji"] + "'," \
                          + "'" + item["fafangdaikuanjidiankuan"] + "'," \
                          + "'" + item["kegongchushoujinrongzichan"] + "'," \
                          + "'" + item["chiyouzhidaoqitouzi"] + "'," \
                          + "'" + item["changqiyingshoukuan"] + "'," \
                          + "'" + item["changqiguquantouzi"] + "'," \
                          + "'" + item["qitachangqitouzi"] + "'," \
                          + "'" + item["touzixingfangdichan"] + "'," \
                          + "'" + item["gudingzichanyuanzhi"] + "'," \
                          + "'" + item["zhejiu"] + "'," \
                          + "'" + item["gudingzichanjingzhi"] + "'," \
                          + "'" + item["gudingzichanjianzhizhunbei"] + "'," \
                          + "'" + item["gudingzichanjinge"] + "'," \
                          + "'" + item["zaijiangongcheng"] + "'," \
                          + "'" + item["gongchengwuzi"] + "'," \
                          + "'" + item["gudingzichanqingli"] + "'," \
                          + "'" + item["shengchanxingshengwuzichan"] + "'," \
                          + "'" + item["gongyixingshengwuzichan"] + "'," \
                          + "'" + item["qiyouzichan"] + "'," \
                          + "'" + item["wuxingzichan"] + "'," \
                          + "'" + item["kaifazhichu"] + "'," \
                          + "'" + item["shangyu"] + "'," \
                          + "'" + item["changqidaitanfeiyong"] + "'," \
                          + "'" + item["guquanfenzhiliutongquan"] + "'," \
                          + "'" + item["diyanshuodeshuizichan"] + "'," \
                          + "'" + item["qitafeilidongzichan"] + "'," \
                          + "'" + item["feiliudongzichanheji"] + "'," \
                          + "'" + item["zichanzhongji"] + "'," \
                          + "'" + item["duanqijiekuan"] + "'," \
                          + "'" + item["xiangzhongyangyinhangjiekuan"] + "'," \
                          + "'" + item["xishoucunkuanjitongyecunfang"] + "'," \
                          + "'" + item["chairuziji"] + "'," \
                          + "'" + item["jiaoyixingjinrongfuzai"] + "'," \
                          + "'" + item["yanshengjinrongfuzai"] + "'," \
                          + "'" + item["yingfupiaoju"] + "'," \
                          + "'" + item["yingfuzhangkuan"] + "'," \
                          + "'" + item["yushoukuanxiang"] + "'," \
                          + "'" + item["maichuhuigoujinrongzicanshu"] + "'," \
                          + "'" + item["yingfushouxufeijiyongjin"] + "'," \
                          + "'" + item["yingfuzhigongxinchou"] + "'," \
                          + "'" + item["yingjiaoshuifei"] + "'," \
                          + "'" + item["yingfulixi"] + "'," \
                          + "'" + item["yingfuguli"] + "'," \
                          + "'" + item["qitayingjiaokuan"] + "'," \
                          + "'" + item["yingfubaozhengjin"] + "'," \
                          + "'" + item["neibuyingfujin"] + "'," \
                          + "'" + item["qitayingfukuan"] + "'," \
                          + "'" + item["yutifeiyong"] + "'," \
                          + "'" + item["yujiliudongfuzai"] + "'," \
                          + "'" + item["yingfufenbaozhangkuan"] + "'," \
                          + "'" + item["baoxianhetongzhunbeijin"] + "'," \
                          + "'" + item["dailimaimaiquankuan"] + "'," \
                          + "'" + item["dailichengxiaoquankuan"] + "'," \
                          + "'" + item["guojipiaozhengjiesuan"] + "'," \
                          + "'" + item["guoneipiaozhengjiesuan"] + "'," \
                          + "'" + item["diyanshouyi"] + "'," \
                          + "'" + item["yingfuduanqizaiquan"] + "'," \
                          + "'" + item["yinianneidaoqidefeiliudongfuzai"] + "'," \
                          + "'" + item["qitaliudongfuzai"] + "'," \
                          + "'" + item["liudongfuzaiheji"] + "'," \
                          + "'" + item["changqijiekuan"] + "'," \
                          + "'" + item["yingfuzaiquan"] + "'," \
                          + "'" + item["changqiyingfukuan"] + "'," \
                          + "'" + item["zhuanxiangyingfukuan"] + "'," \
                          + "'" + item["yujifeiliudongfuzai"] + "'," \
                          + "'" + item["diyanshuodeshuifuzai"] + "'," \
                          + "'" + item["qitafeiliudongfuzai"] + "'," \
                          + "'" + item["feiliudongfuzaiheji"] + "'," \
                          + "'" + item["fuzaiheji"] + "'," \
                          + "'" + item["shishouziben"] + "'," \
                          + "'" + item["zibengongji"] + "'," \
                          + "'" + item["kucungu"] + "'," \
                          + "'" + item["zhuanxiangchubei"] + "'," \
                          + "'" + item["yingyugongji"] + "'," \
                          + "'" + item["yibanfengxianzhunbei"] + "'," \
                          + "'" + item["weiquedingdetouzishunshi"] + "'," \
                          + "'" + item["weifenpeilirun"] + "'," \
                          + "'" + item["nifenpeixianjinguli"] + "'," \
                          + "'" + item["waibibaobiaozhesuanche"] + "'," \
                          + "'" + item["guishuyumugongsigudongquanyiheji"] + "'," \
                          + "'" + item["shaoshugudongquanyi"] + "'," \
                          + "'" + item["suoyouzhequanyiheji"] + "'," \
                          + "'" + item["fuzaihesuoyouzhequanyizhongji"] + "')"
                    cur.execute(sql)
                    self.conn.commit()

                # else:
                #     log.msg("has crawled this data")

            except Exception, e:
                log.msg(e, _level=logging.ERROR)
        else:

            sql = "select * from hs_bank_list where code='" + item["code"] + "'"
            cur.execute(sql)
            rows = cur.fetchall()
            if len(rows) == 0:
                sql = "insert into hs_bank_list (code) values ('" + item["code"] + "')"
                cur.execute(sql)
                self.conn.commit()
            sql = "select * from xl_hs_bank_fuzhai where ky='" + item['code'] + "-" + item['time'] + "'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql = "insert into xl_hs_bank_fuzhai (ky, code, time, " \
                          "danwei, huobizijin, cunfangzhongyangyinhang," \
                          " jiesuanzhunbeijin, guijinshu, cunfangtongyekuanxiang," \
                          " chaichuzijin, chaifangtongye, chaifangjinrongxinggongsi, cunfanglianhangkuanxing," \
                          " cunchufachaojijin, yanshengjinronggongjuzichan, jiaoyixingjinrongzichan, " \
                          "mairufanshoujinrongzichan, tiexian, jinchukouyahui, yingshouzhangkuang, yufuzhangkuang, " \
                          "yingshoulixi, fafangdaikuanjidiankuan, daikuansunshizhunbei, dailiyewuzichan," \
                          " kegongchushoujinrongzichan, chiyouzhidaoqitouzi, qitayingshoukuan, " \
                          "changqiyingshoukuan, changqiguquantouzi, touzizigongsi, touzifangdichan, " \
                          "yingshoutouzikuanxiang, tanbofeiyong, gudingzichanjinge, zaijiangongcheng, " \
                          "gudingzichanqingli, wuxingzichan, shangyu, changqitanbofeiyong, daichulidizaizichan," \
                          " dizhaizichuanjianzhizhunbei, daichulidizhaizichanjine, diyanshuikuanjiexiang," \
                          " qitazichan, buliangzichanchuzhishunshizhuanxiangzhunbei, zichanzhongji," \
                          " xiangzhongyangyinhangjiekuan, faxinghuobizaiwu, tongyechunrujichaichu," \
                          " tongyecunfangkuanxiang, chairuzijin, lianhangchunfangkuanxiang, waiguozhengfujiekuan, " \
                          "yanshengjinronggongjufuzhai, jiaoyixingjirongfuzhai, maichuhuigouzichankuan," \
                          " kehuochunkuan, piaojurongzi, yingjiehuikuanjilinshichunkuan, yutifeiyong," \
                          " faxingchuankuanzheng, huichuhuikuan, yingfufulifei, yingjiaoshuifei," \
                          " yingfulixi, yingfuzhangkuang, zhuanxiangyingfukuan, yingfuguli, qitayingfukuan," \
                          " dailiyewufuzhai, yujifuzhai, diyanshouyi, changqiyingfukuan, yingfuzhaiquan," \
                          " yingfucijizhaiquan, diyansuodeshuifuzhai, qitafuzhai, fuzhaiheji, guben, " \
                          "zibengongji, kechushouleitouziweishixianshunyin, chiyouzhidaoqitouziweijiezhuansunyi," \
                          " kuancanggu, yingyugongji, yibanfengxianzhunbei, xintuopeichangzhunbeijin, weifenpeilirun," \
                          " nifenpeixianjinguli, waibibaobiaozesuanchae, qitachubei, guishumugongsigudongquanyi, " \
                          "shaoshugudongquanyi, gudongquanyiheji, fuzhaijigudongquanyiheji) values" \
                          + "('" + item["code"] + "-" + item["time"] + "'," \
                          + "'" + item["code"] + "'," \
                          + "'" + item["time"] + "'," \
                          + "'" + item["danwei"] + "'," \
                          + "'" + item["huobizijin"] + "'," \
                          + "'" + item["cunfangzhongyangyinhang"] + "'," \
                          + "'" + item["jiesuanzhunbeijin"] + "'," \
                          + "'" + item["guijinshu"] + "'," \
                          + "'" + item["cunfangtongyekuanxiang"] + "'," \
                          + "'" + item["chaichuzijin"] + "'," \
                          + "'" + item["chaifangtongye"] + "'," \
                          + "'" + item["chaifangjinrongxinggongsi"] + "'," \
                          + "'" + item["cunfanglianhangkuanxing"] + "'," \
                          + "'" + item["cunchufachaojijin"] + "'," \
                          + "'" + item["yanshengjinronggongjuzichan"] + "'," \
                          + "'" + item["jiaoyixingjinrongzichan"] + "'," \
                          + "'" + item["mairufanshoujinrongzichan"] + "'," \
                          + "'" + item["tiexian"] + "'," \
                          + "'" + item["jinchukouyahui"] + "'," \
                          + "'" + item["yingshouzhangkuang"] + "'," \
                          + "'" + item["yufuzhangkuang"] + "'," \
                          + "'" + item["yingshoulixi"] + "'," \
                          + "'" + item["fafangdaikuanjidiankuan"] + "'," \
                          + "'" + item["daikuansunshizhunbei"] + "'," \
                          + "'" + item["dailiyewuzichan"] + "'," \
                          + "'" + item["kegongchushoujinrongzichan"] + "'," \
                          + "'" + item["chiyouzhidaoqitouzi"] + "'," \
                          + "'" + item["qitayingshoukuan"] + "'," \
                          + "'" + item["changqiyingshoukuan"] + "'," \
                          + "'" + item["changqiguquantouzi"] + "'," \
                          + "'" + item["touzizigongsi"] + "'," \
                          + "'" + item["touzifangdichan"] + "'," \
                          + "'" + item["yingshoutouzikuanxiang"] + "'," \
                          + "'" + item["tanbofeiyong"] + "'," \
                          + "'" + item["gudingzichanjinge"] + "'," \
                          + "'" + item["zaijiangongcheng"] + "'," \
                          + "'" + item["gudingzichanqingli"] + "'," \
                          + "'" + item["wuxingzichan"] + "'," \
                          + "'" + item["shangyu"] + "'," \
                          + "'" + item["changqitanbofeiyong"] + "'," \
                          + "'" + item["daichulidizaizichan"] + "'," \
                          + "'" + item["dizhaizichuanjianzhizhunbei"] + "'," \
                          + "'" + item["daichulidizhaizichanjine"] + "'," \
                          + "'" + item["diyanshuikuanjiexiang"] + "'," \
                          + "'" + item["qitazichan"] + "'," \
                          + "'" + item["buliangzichanchuzhishunshizhuanxiangzhunbei"] + "'," \
                          + "'" + item["zichanzhongji"] + "'," \
                          + "'" + item["xiangzhongyangyinhangjiekuan"] + "'," \
                          + "'" + item["faxinghuobizaiwu"] + "'," \
                          + "'" + item["tongyechunrujichaichu"] + "'," \
                          + "'" + item["tongyecunfangkuanxiang"] + "'," \
                          + "'" + item["chairuzijin"] + "'," \
                          + "'" + item["lianhangchunfangkuanxiang"] + "'," \
                          + "'" + item["waiguozhengfujiekuan"] + "'," \
                          + "'" + item["yanshengjinronggongjufuzhai"] + "'," \
                          + "'" + item["jiaoyixingjirongfuzhai"] + "'," \
                          + "'" + item["maichuhuigouzichankuan"] + "'," \
                          + "'" + item["kehuochunkuan"] + "'," \
                          + "'" + item["piaojurongzi"] + "'," \
                          + "'" + item["yingjiehuikuanjilinshichunkuan"] + "'," \
                          + "'" + item["yutifeiyong"] + "'," \
                          + "'" + item["faxingchuankuanzheng"] + "'," \
                          + "'" + item["huichuhuikuan"] + "'," \
                          + "'" + item["yingfufulifei"] + "'," \
                          + "'" + item["yingjiaoshuifei"] + "'," \
                          + "'" + item["yingfulixi"] + "'," \
                          + "'" + item["yingfuzhangkuang"] + "'," \
                          + "'" + item["zhuanxiangyingfukuan"] + "'," \
                          + "'" + item["yingfuguli"] + "'," \
                          + "'" + item["qitayingfukuan"] + "'," \
                          + "'" + item["dailiyewufuzhai"] + "'," \
                          + "'" + item["yujifuzhai"] + "'," \
                          + "'" + item["diyanshouyi"] + "'," \
                          + "'" + item["changqiyingfukuan"] + "'," \
                          + "'" + item["yingfuzhaiquan"] + "'," \
                          + "'" + item["yingfucijizhaiquan"] + "'," \
                          + "'" + item["diyansuodeshuifuzhai"] + "'," \
                          + "'" + item["qitafuzhai"] + "'," \
                          + "'" + item["fuzhaiheji"] + "'," \
                          + "'" + item["guben"] + "'," \
                          + "'" + item["zibengongji"] + "'," \
                          + "'" + item["kechushouleitouziweishixianshunyin"] + "'," \
                          + "'" + item["chiyouzhidaoqitouziweijiezhuansunyi"] + "'," \
                          + "'" + item["kuancanggu"] + "'," \
                          + "'" + item["yingyugongji"] + "'," \
                          + "'" + item["yibanfengxianzhunbei"] + "'," \
                          + "'" + item["xintuopeichangzhunbeijin"] + "'," \
                          + "'" + item["weifenpeilirun"] + "'," \
                          + "'" + item["nifenpeixianjinguli"] + "'," \
                          + "'" + item["waibibaobiaozesuanchae"] + "'," \
                          + "'" + item["qitachubei"] + "'," \
                          + "'" + item["guishumugongsigudongquanyi"] + "'," \
                          + "'" + item["shaoshugudongquanyi"] + "'," \
                          + "'" + item["gudongquanyiheji"] + "'," \
                          + "'" + item["fuzhaijigudongquanyiheji"] + "')"
                    cur.execute(sql)
                    self.conn.commit()

                # else:
                #     log.msg("has crawled this data")

            except Exception, e:
                log.msg(e, _level=logging.ERROR)


    def __del__(self):
        self.conn.close()


class hs_lirun(object):
    def __init__(self):
        conn = MySQLdb.connect(
            host='127.0.0.1',
            port=3306,
            user='root',
            passwd='20160401',
            db='stock',
            charset='utf8'
        )
        self.conn = conn

    def process_item(self, item, spider):
        cur = self.conn.cursor()
        if not item["bank"]:
            sql = "select * from xl_hs_lirun where ky='" + item['code'] + "-" + item['time'] +  "'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql = "insert into xl_hs_lirun (ky, code, time, danwei," \
                          " yingyezhongshouru, yingyeshouru, lixishouru, " \
                          "yizhuanbaofei, shouxufeijiyongjinshouru, fangdichanxiaoshoushouru," \
                          " qitayewushouru, yingyezhongchengben, yingyechengben, " \
                          "lixizhichu, shouxufeijiyongjinzhichu, fangdichanxiaoshouchengben," \
                          " yanfafeiyong, tuibaojin, peifuzhichujinge, tiqubaoxianhetongzhunbeijinjinge, " \
                          "baodanhonglizhichu, fenbaofeiyong, titayewuchengben, yingyeshuijinjifujia," \
                          " xiaoshoufeiyong, guanlifeiyong, chaiwufeiyong, zichanjianzhisunshi," \
                          " gongyunjiazhibiandongshouyi, touzishouyi, duilianyingqiyeheheyingqiyetouzishouyi, " \
                          "huiduishouyi, qihuoshouyi, tuoguanshouyi, butieshouru, qitayewulirun, yingyelirun," \
                          " yingyewaishouru, yingyewaizhichu, feiliudongzichanchuzhisunshi, lirunzhonge, suodeshuifeiyong," \
                          " weiquerentouzisunshi, jinglirun, guishuyumugongsisuoyouzhejingliru, shaoshugudongsunyi," \
                          " jinbenmeigushouyi, xishimeigushouyi, yitazhongheshouyi, zhongheshouyizhonge," \
                          " guishuyumugongsisuoyouzhedezhongheshouyizhonge, guishuyushaoshugudongdezhongheshouyizhonge)  values"\
                          + "('" + item["code"] + "-" + item["time"] + "'," \
                          + "'" + item["code"] + "'," \
                          + "'" + item["time"] + "'," \
                          + "'" + item["danwei"] + "'," \
                          + "'" + item["yingyezhongshouru"] + "'," \
                          + "'" + item["yingyeshouru"] + "'," \
                          + "'" + item["lixishouru"] + "'," \
                          + "'" + item["yizhuanbaofei"] + "'," \
                          + "'" + item["shouxufeijiyongjinshouru"] + "'," \
                          + "'" + item["fangdichanxiaoshoushouru"] + "'," \
                          + "'" + item["qitayewushouru"] + "'," \
                          + "'" + item["yingyezhongchengben"] + "'," \
                          + "'" + item["yingyechengben"] + "'," \
                          + "'" + item["lixizhichu"] + "'," \
                          + "'" + item["shouxufeijiyongjinzhichu"] + "'," \
                          + "'" + item["fangdichanxiaoshouchengben"] + "'," \
                          + "'" + item["yanfafeiyong"] + "'," \
                          + "'" + item["tuibaojin"] + "'," \
                          + "'" + item["peifuzhichujinge"] + "'," \
                          + "'" + item["tiqubaoxianhetongzhunbeijinjinge"] + "'," \
                          + "'" + item["baodanhonglizhichu"] + "'," \
                          + "'" + item["fenbaofeiyong"] + "'," \
                          + "'" + item["titayewuchengben"] + "'," \
                          + "'" + item["yingyeshuijinjifujia"] + "'," \
                          + "'" + item["xiaoshoufeiyong"] + "'," \
                          + "'" + item["guanlifeiyong"] + "'," \
                          + "'" + item["chaiwufeiyong"] + "'," \
                          + "'" + item["zichanjianzhisunshi"] + "'," \
                          + "'" + item["gongyunjiazhibiandongshouyi"] + "'," \
                          + "'" + item["touzishouyi"] + "'," \
                          + "'" + item["duilianyingqiyeheheyingqiyetouzishouyi"] + "'," \
                          + "'" + item["huiduishouyi"] + "'," \
                          + "'" + item["qihuoshouyi"] + "'," \
                          + "'" + item["tuoguanshouyi"] + "'," \
                          + "'" + item["butieshouru"] + "'," \
                          + "'" + item["qitayewulirun"] + "'," \
                          + "'" + item["yingyelirun"] + "'," \
                          + "'" + item["yingyewaishouru"] + "'," \
                          + "'" + item["yingyewaizhichu"] + "'," \
                          + "'" + item["feiliudongzichanchuzhisunshi"] + "'," \
                          + "'" + item["lirunzhonge"] + "'," \
                          + "'" + item["suodeshuifeiyong"] + "'," \
                          + "'" + item["weiquerentouzisunshi"] + "'," \
                          + "'" + item["jinglirun"] + "'," \
                          + "'" + item["guishuyumugongsisuoyouzhejingliru"] + "'," \
                          + "'" + item["shaoshugudongsunyi"] + "'," \
                          + "'" + item["jinbenmeigushouyi"] + "'," \
                          + "'" + item["xishimeigushouyi"] + "'," \
                          + "'" + item["yitazhongheshouyi"] + "'," \
                          + "'" + item["zhongheshouyizhonge"] + "'," \
                          + "'" + item["guishuyumugongsisuoyouzhedezhongheshouyizhonge"] + "'," \
                          + "'" + item["guishuyushaoshugudongdezhongheshouyizhonge"] + "')"
                    cur.execute(sql)
                    self.conn.commit()

                # else:
                #     log.msg("has crawled this data")

            except Exception,e:
                log.msg(e, _level=logging.ERROR)

        else:
            sql = "select * from hs_bank_list where code='" + item["code"] + "'"
            cur.execute(sql)
            rows = cur.fetchall()
            if len(rows) == 0:
                sql = "insert into hs_bank_list (code) values ('" + item["code"] + "')"
                cur.execute(sql)
                self.conn.commit()

            sql = "select * from xl_hs_bank_lirun where ky='" + item['code'] + "-" + item['time'] + "'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql = "insert into xl_hs_bank_lirun (ky, code, time, danwei," \
                          " yingyeshouru, jinglixishouru, lixishouru, " \
                          "lixizhichu, shouxufeijirongjinjingshouru, shouxufeijirongjinshouru, " \
                          "shouxufeijirongjinzhichu, zhongjianyewujingshouru, zhongjianyewushouru," \
                          " zhongjianyewuzhichu, jingjiaoyishouru, yanshengjinronggongjujiaoyijingshouru," \
                          " huiduishouyi, touzijingshouyi, duilianyinggongsitouzishouyi, gongyunjiazhibiandongshouyi, " \
                          "qitayewushouru, yingyezhichu, yingyeshuijinjifujia, yewujiguanlifeiyong, zichanjianzhisunshi, " \
                          "zhejiufei, tiqudaizhangzhunbei, qitayewuzhichu, yingyelirun, yingyewaishouru," \
                          " yingyewaizhichu, lirunzhonge, suodeshui, shaoshugudongquanyi, guishumugongsidejinglirun, " \
                          "nianchumweifenpeilirun, kegongfenpeilirun, tiqufadingyingyugongji, tiqufadinggongyijin," \
                          " tiquyibanfengxianzhunbe, tiquxintuopeichangzhunbeijin, kegonggudongfenpeilirun, " \
                          "yingfuyouxianguguli, tiqurenyiyingyugongji, yingfuputongguguli, zhuanzuogubendeputongguguli," \
                          " weifenpeilirun, jibenmeigushouyi, xishimeigushouyi)  values" \
                          + "('" + item["code"] + "-" + item["time"] + "'," \
                          + "'" + item["code"] + "'," \
                          + "'" + item["time"] + "'," \
                          + "'" + item["danwei"] + "'," \
                          + "'" + item["yingyeshouru"] + "'," \
                          + "'" + item["jinglixishouru"] + "'," \
                          + "'" + item["lixishouru"] + "'," \
                          + "'" + item["lixizhichu"] + "'," \
                          + "'" + item["shouxufeijirongjinjingshouru"] + "'," \
                          + "'" + item["shouxufeijirongjinshouru"] + "'," \
                          + "'" + item["shouxufeijirongjinzhichu"] + "'," \
                          + "'" + item["zhongjianyewujingshouru"] + "'," \
                          + "'" + item["zhongjianyewushouru"] + "'," \
                          + "'" + item["zhongjianyewuzhichu"] + "'," \
                          + "'" + item["jingjiaoyishouru"] + "'," \
                          + "'" + item["yanshengjinronggongjujiaoyijingshouru"] + "'," \
                          + "'" + item["huiduishouyi"] + "'," \
                          + "'" + item["touzijingshouyi"] + "'," \
                          + "'" + item["duilianyinggongsitouzishouyi"] + "'," \
                          + "'" + item["gongyunjiazhibiandongshouyi"] + "'," \
                          + "'" + item["qitayewushouru"] + "'," \
                          + "'" + item["yingyezhichu"] + "'," \
                          + "'" + item["yingyeshuijinjifujia"] + "'," \
                          + "'" + item["yewujiguanlifeiyong"] + "'," \
                          + "'" + item["zichanjianzhisunshi"] + "'," \
                          + "'" + item["zhejiufei"] + "'," \
                          + "'" + item["tiqudaizhangzhunbei"] + "'," \
                          + "'" + item["qitayewuzhichu"] + "'," \
                          + "'" + item["yingyelirun"] + "'," \
                          + "'" + item["yingyewaishouru"] + "'," \
                          + "'" + item["yingyewaizhichu"] + "'," \
                          + "'" + item["lirunzhonge"] + "'," \
                          + "'" + item["suodeshui"] + "'," \
                          + "'" + item["shaoshugudongquanyi"] + "'," \
                          + "'" + item["guishumugongsidejinglirun"] + "'," \
                          + "'" + item["nianchumweifenpeilirun"] + "'," \
                          + "'" + item["kegongfenpeilirun"] + "'," \
                          + "'" + item["tiqufadingyingyugongji"] + "'," \
                          + "'" + item["tiqufadinggongyijin"] + "'," \
                          + "'" + item["tiquyibanfengxianzhunbe"] + "'," \
                          + "'" + item["tiquxintuopeichangzhunbeijin"] + "'," \
                          + "'" + item["kegonggudongfenpeilirun"] + "'," \
                          + "'" + item["yingfuyouxianguguli"] + "'," \
                          + "'" + item["tiqurenyiyingyugongji"] + "'," \
                          + "'" + item["yingfuputongguguli"] + "'," \
                          + "'" + item["zhuanzuogubendeputongguguli"] + "'," \
                          + "'" + item["weifenpeilirun"] + "'," \
                          + "'" + item["jibenmeigushouyi"] + "'," \
                          + "'" + item["xishimeigushouyi"] + "')"
                    cur.execute(sql)
                    self.conn.commit()

                # else:
                #     log.msg("has crawled this data")

            except Exception, e:
                log.msg(e, _level=logging.ERROR)


    def __del__(self):
        self.conn.close()

class hs_xianjin(object):
    def __init__(self):
        conn = MySQLdb.connect(
            host='127.0.0.1',
            port=3306,
            user='root',
            passwd='20160401',
            db='stock',
            charset='utf8'
        )
        self.conn = conn

    def process_item(self, item, spider):
        cur = self.conn.cursor()
        if not item["bank"]:
            sql = "select * from xl_hs_xianjin where ky='" + item['code'] + "-" + item['time'] +  "'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql = "insert into xl_hs_xianjin (" \
                          "ky, code, time, " \
                          "danwei, xiaoshoulaowusuodexianjin, kehujitongyecunkuanzengjiae," \
                          " xiangyinhangjiekuanjingzengjiae, xiangqitajinrongjigouchairuzijinjingzengjiae," \
                          " shoudaoyuanbaoxianhetongbaofeiqudedexianjin, shoudaozaibaoxianyewuxianjinjinge, " \
                          "baohuchujinjitouzikuanjingzengjiae, chuzhijiaoyixingjirongzichanjingzengjiae, " \
                          "shouqulixishouxufeijiyongjindexianjin, chairuzijijingzengjiae, huigouyewuzijijingzengjiae," \
                          " shoudaodeshuifeifanhui, shoudaoqitayingyeyouguanxianjin, yingyehuodongliuruxianjinxiaoji," \
                          " goumaishangpinjieshoulaowuzhhifuxianjin, kehudaiquanjidiankuanjingzengjiae, " \
                          "cunfangzhongyangyinhanghetongyekuanxiangjingzengjiae, zhifuyuanbaoxianhetongpeifukuanxiangxianjin, " \
                          "zhifulixishouxufeiyongjindexianjin, zhifubaodanhonglidexianjin, " \
                          "zhifugeizhigongyijiweizhigongzhifudexianjin, zhifugexiangshuifei, " \
                          "zhifudeqitayingyeyouguanxianjin, yingyehuodongxianjinliuchuxiaoji, " \
                          "yingyehuodongxianjinliuliangjinge, shouhuitouzisuoshoudaoxianjin, qudetouzishouyi, " \
                          "chuzhigudingzichan, chuzhizigongsi, shoudaoqitatouzi, jianshaozhiya, touzihuodongshouruxiaoji," \
                          " goujiangudingzichan, touzisuofuxianjin, zhiyadaikuanjingzengjiae, " \
                          "qudezigongsijiqitayingyedanweizhifudexianjinjinge, zhifudeqitayutouziyouguandexianjin, " \
                          "zengjhiazhiyahedingqicunkuansuozhishoudexianjin, touzihuodongliuchuxianjinxiaoji," \
                          "touzihuodongchanshengdexianjinliuliangjinge, xishoutouzishoudaodexianjin, " \
                          "zigongsixishoushaoshugudongtouzishoudaodexianjin, qudejiekuanshoudaodexianjin, " \
                          "faxingzaiquanshoudaodexianjin, shoudaoqitayuchaozihuodongyouguandexianjin," \
                          " chouzihuodongxianjinliuruxiaoji, changhuanzhaiwuzhifudexianjin, fenpeigulilirunsuozhifudexianjin," \
                          " zhifuqitachouzihuodongyouguanxianjin, chouzihuodongxianjinliuchuxiaoji, " \
                          "chouzihuodongchanshengdexianjinliuliangjinge, huilvbiandongyingxiang, " \
                          "xianjinjixianjindengjiawujingzengjiae, qichuxianjinyue, qimoxianjinyue, jinglirun, " \
                          "shaoshugudongquanyi, weiquerentouzishunshi, zichanjianzhizhunbei, zhejiu, wuxingzichantanxiao," \
                          " changqitanxiaofeiyongtanxiao, tanxiaofeiyongdejianshao, yutifeiyongdezengjia, " \
                          "chuzhigudingzichandetanxiao, gudizichanbaofeisunshi, gongyunjiazhibiandongsunshi, " \
                          "diyanshouyizengjia, yujifuzai, caiwufeiyong, touzisunshi, diyansuodeshuizichanjianshao," \
                          " diyansuodeshuifuzaizengjia, cunhuodejianshao, jingyingxingyingshouxiangmudejianshao, " \
                          "jingyingxingyingshouxiangmudezengjia, yiwangongshangweijiesunkuandejianshao," \
                          " yijiesuanshaoweiwangongkuandezengjia, qita, jingyinghuodongchanshengxianjinliuliangjinge," \
                          " zhaiwuzhuanweiziben, yinianneidaoqidekezhuanhuangongsizhaiquan, rongzizhurugudingzichan, " \
                          "xianjindeqimoyue, xianjindeqichuyue, xianjindengjiawudeqimpyue, xianjindengjiawudeqichuyue," \
                          " xianjinjixianjindengjiawudejingzengjia)  values"\
                          + "('" + item["code"] + "-" + item["time"] + "'," \
                          + "'" + item["code"] + "'," \
                          + "'" + item["time"] + "'," \
                          + "'" + item["danwei"] + "'," \
                          + "'" + item["xiaoshoulaowusuodexianjin"] + "'," \
                          + "'" + item["kehujitongyecunkuanzengjiae"] + "'," \
                          + "'" + item["xiangyinhangjiekuanjingzengjiae"] + "'," \
                          + "'" + item["xiangqitajinrongjigouchairuzijinjingzengjiae"] + "'," \
                          + "'" + item["shoudaoyuanbaoxianhetongbaofeiqudedexianjin"] + "'," \
                          + "'" + item["shoudaozaibaoxianyewuxianjinjinge"] + "'," \
                          + "'" + item["baohuchujinjitouzikuanjingzengjiae"] + "'," \
                          + "'" + item["chuzhijiaoyixingjirongzichanjingzengjiae"] + "'," \
                          + "'" + item["shouqulixishouxufeijiyongjindexianjin"] + "'," \
                          + "'" + item["chairuzijijingzengjiae"] + "'," \
                          + "'" + item["huigouyewuzijijingzengjiae"] + "'," \
                          + "'" + item["shoudaodeshuifeifanhui"] + "'," \
                          + "'" + item["shoudaoqitayingyeyouguanxianjin"] + "'," \
                          + "'" + item["yingyehuodongliuruxianjinxiaoji"] + "'," \
                          + "'" + item["goumaishangpinjieshoulaowuzhhifuxianjin"] + "'," \
                          + "'" + item["kehudaiquanjidiankuanjingzengjiae"] + "'," \
                          + "'" + item["cunfangzhongyangyinhanghetongyekuanxiangjingzengjiae"] + "'," \
                          + "'" + item["zhifuyuanbaoxianhetongpeifukuanxiangxianjin"] + "'," \
                          + "'" + item["zhifulixishouxufeiyongjindexianjin"] + "'," \
                          + "'" + item["zhifubaodanhonglidexianjin"] + "'," \
                          + "'" + item["zhifugeizhigongyijiweizhigongzhifudexianjin"] + "'," \
                          + "'" + item["zhifugexiangshuifei"] + "'," \
                          + "'" + item["zhifudeqitayingyeyouguanxianjin"] + "'," \
                          + "'" + item["yingyehuodongxianjinliuchuxiaoji"] + "'," \
                          + "'" + item["yingyehuodongxianjinliuliangjinge"] + "'," \
                          + "'" + item["shouhuitouzisuoshoudaoxianjin"] + "'," \
                          + "'" + item["qudetouzishouyi"] + "'," \
                          + "'" + item["chuzhigudingzichan"] + "'," \
                          + "'" + item["chuzhizigongsi"] + "'," \
                          + "'" + item["shoudaoqitatouzi"] + "'," \
                          + "'" + item["jianshaozhiya"] + "'," \
                          + "'" + item["touzihuodongshouruxiaoji"] + "'," \
                          + "'" + item["goujiangudingzichan"] + "'," \
                          + "'" + item["touzisuofuxianjin"] + "'," \
                          + "'" + item["zhiyadaikuanjingzengjiae"] + "'," \
                          + "'" + item["qudezigongsijiqitayingyedanweizhifudexianjinjinge"] + "'," \
                          + "'" + item["zhifudeqitayutouziyouguandexianjin"] + "'," \
                          + "'" + item["zengjhiazhiyahedingqicunkuansuozhishoudexianjin"] + "'," \
                          + "'" + item["touzihuodongliuchuxianjinxiaoji"] + "'," \
                          + "'" + item["touzihuodongchanshengdexianjinliuliangjinge"] + "'," \
                          + "'" + item["xishoutouzishoudaodexianjin"] + "'," \
                          + "'" + item["zigongsixishoushaoshugudongtouzishoudaodexianjin"] + "'," \
                          + "'" + item["qudejiekuanshoudaodexianjin"] + "'," \
                          + "'" + item["faxingzaiquanshoudaodexianjin"] + "'," \
                          + "'" + item["shoudaoqitayuchaozihuodongyouguandexianjin"] + "'," \
                          + "'" + item["chouzihuodongxianjinliuruxiaoji"] + "'," \
                          + "'" + item["changhuanzhaiwuzhifudexianjin"] + "'," \
                          + "'" + item["fenpeigulilirunsuozhifudexianjin"] + "'," \
                          + "'" + item["zhifuqitachouzihuodongyouguanxianjin"] + "'," \
                          + "'" + item["chouzihuodongxianjinliuchuxiaoji"] + "'," \
                          + "'" + item["chouzihuodongchanshengdexianjinliuliangjinge"] + "'," \
                          + "'" + item["huilvbiandongyingxiang"] + "'," \
                          + "'" + item["xianjinjixianjindengjiawujingzengjiae"] + "'," \
                          + "'" + item["qichuxianjinyue"] + "'," \
                          + "'" + item["qimoxianjinyue"] + "'," \
                          + "'" + item["jinglirun"] + "'," \
                          + "'" + item["shaoshugudongquanyi"] + "'," \
                          + "'" + item["weiquerentouzishunshi"] + "'," \
                          + "'" + item["zichanjianzhizhunbei"] + "'," \
                          + "'" + item["zhejiu"] + "'," \
                          + "'" + item["wuxingzichantanxiao"] + "'," \
                          + "'" + item["changqitanxiaofeiyongtanxiao"] + "'," \
                          + "'" + item["tanxiaofeiyongdejianshao"] + "'," \
                          + "'" + item["yutifeiyongdezengjia"] + "'," \
                          + "'" + item["chuzhigudingzichandetanxiao"] + "'," \
                          + "'" + item["gudizichanbaofeisunshi"] + "'," \
                          + "'" + item["gongyunjiazhibiandongsunshi"] + "'," \
                          + "'" + item["diyanshouyizengjia"] + "'," \
                          + "'" + item["yujifuzai"] + "'," \
                          + "'" + item["caiwufeiyong"] + "'," \
                          + "'" + item["touzisunshi"] + "'," \
                          + "'" + item["diyansuodeshuizichanjianshao"] + "'," \
                          + "'" + item["diyansuodeshuifuzaizengjia"] + "'," \
                          + "'" + item["cunhuodejianshao"] + "'," \
                          + "'" + item["jingyingxingyingshouxiangmudejianshao"] + "'," \
                          + "'" + item["jingyingxingyingshouxiangmudezengjia"] + "'," \
                          + "'" + item["yiwangongshangweijiesunkuandejianshao"] + "'," \
                          + "'" + item["yijiesuanshaoweiwangongkuandezengjia"] + "'," \
                          + "'" + item["qita"] + "'," \
                          + "'" + item["jingyinghuodongchanshengxianjinliuliangjinge"] + "'," \
                          + "'" + item["zhaiwuzhuanweiziben"] + "'," \
                          + "'" + item["yinianneidaoqidekezhuanhuangongsizhaiquan"] + "'," \
                          + "'" + item["rongzizhurugudingzichan"] + "'," \
                          + "'" + item["xianjindeqimoyue"] + "'," \
                          + "'" + item["xianjindeqichuyue"] + "'," \
                          + "'" + item["xianjindengjiawudeqimpyue"] + "'," \
                          + "'" + item["xianjindengjiawudeqichuyue"] + "'," \
                          + "'" + item["xianjinjixianjindengjiawudejingzengjia"] + "')"
                    cur.execute(sql)
                    self.conn.commit()

                else:
                    log.msg("has crawled this data")

            except Exception,e:
                log.msg(e, _level=logging.ERROR)
        else:
            sql="select * from hs_bank_list where code='"+item["code"]+"'"
            cur.execute(sql)
            rows = cur.fetchall()
            if len(rows)==0:
                sql="insert into hs_bank_list (code) values ('"+item["code"]+"')"
                cur.execute(sql)
                self.conn.commit()
            sql = "select * from xl_hs_bank_xianjin where ky='" + item['code'] + "-" + item['time'] + "'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql = "insert into xl_hs_bank_xianjin (" \
                          "ky, code, time, danwei, kehudaikuanjidiankuanjingjianshaoe," \
                          " xiangyanghangjiekuanjingjianshaoe, kehuchunkuanxiangjingzengjiae," \
                          " kehucunkuan, tongyejiqitajirongjigoujinge, shouhuicunfangtongyejinge, " \
                          "chaichuzijinxianjinliuru, shouhuidechaichuzijinjinge, xishoudemaichuhuigouxiangjinge," \
                          " shouhuidemairufanshouxiangjinge, chuzhijiaoyixingjinrongzichanjingzengjiae, " \
                          "shouqulixishouxufeijiyongjindexianjin, shoudaolixi, shoudaodeshouxufei, " \
                          "jirongqiyewanglaishourushoudaodexianjin, zhongjianyewushourushoudaodexianjin, " \
                          "huiduijingshouyishoudaodexianjin, qitayingyejiyingyewaijingshourushoudaodexianjin, " \
                          "cunrubaozengjinshoudaodexianjin, shoudaodeweituozijin, guijinshuxianjinliuru, " \
                          "tiexianshoudaodezijin, xiaoshoushangpintigonglaowushoudaodexianjin, shoudaodesuifeifanhuan," \
                          " qitafuzhaizengjialiurudexianjin, huishoudeyiyuyiqiannianduhexiaodedaikuanjiyingshoukuanxiang," \
                          " qitayingfuzanshoukuanjianshaoliuchudexianjin, chuzhidizhaizichanshoudaodexianjin, " \
                          "shoudaoqitajingyinghuodongxianjin, jingyinghuodongxianjinliuruxiaoji," \
                          " kehudaikuanjindianfukuanzengjiae, cunfangzhongyangyinhanghetongyekuanxiangjingzengjiae," \
                          " cunfangzhongyangyinhang, cunfangtongyejiqitajigoucunkuan, chaichuzijijingxianjinliuru, " \
                          "changhuanzhongyangyinghangjinkuan, zhifudechunkuan, jianshaotongyejiqitajinrongjigoucunfangjinge," \
                          " changhuantongyejiqitajinrongjigouchairujinge, changhuanmaichuhuigoukuanxiangjinge," \
                          " zhengquantouzizhichudexianjin, zhifumairufanhushoukuanxiangjinge, " \
                          "chuzhikegongchushoujinrongzichanjingjianshaoe, zhifulixishouxufeijiyongjindexianjin, " \
                          "zhifudelixi, shouxufeizhichuzhifudexianjin, zhifugeizhigongjizhigongzhifudexianjin, " \
                          "zhifudegexianshuifei, yixianjinzhifudeyingyefeiyong, yuejinrongjigoufanglaizhichudexianjinjinge, " \
                          "tiexianzhifudexianjin, yihexiaodaizhangdaikuanjilixidehuishou, weituojidailiyewujianshaoe, " \
                          "guijinshuxianjinliuchu, goumaishangpinjieshoulaowuzhifudexianjin, jieruqitazijinjingjianshaoe, " \
                          "qitazijinjianshaozhichudexianjin, qitayingshouzhanfukuanjianshaohuishoudexianjin, " \
                          "zhifuqitayujingyinghuodongyouguandexianjin, jingyinghuodongxianjinliuchuxiaoji, " \
                          "jingyinghuodongchanshengdexianjinliuliangjinge, huishoutouzishoudaodexianjin, " \
                          "qudetouzishouyishoudaodexianjin, fendegulihuolirunsuoshoudaodexianjin, " \
                          "qudezhaiquanlixishourushoudaodexianjin, chuzhigudingzichanwuxingzichanshoudaodexianjin, " \
                          "chuzhiguquantouzisuoshoudaodexianjin, qudezigongsijiqitayingyedanweisuoshoudaodexianjinjinge, " \
                          "shoudaoqitayutouzihuodongyouguandexianjin, touzihuodongxianjinliuruxiaoji, touzizhifudexianjin, " \
                          "quanyixingtouzizengjiazhifudexianjin, zhaiquantouzisuozhifudexianjin, " \
                          "goumaizigongsilianyingqiyesuozhifudexianjin, zengjiazaijiangongchengsuozhifudexianjin, " \
                          "goujiangudingzichanwuxingzichanzhifudexianjin, qudezigongsijiqitayingyedanweizhifudexianjinjinge," \
                          " zhifudeqitayutouzihuodongyouguandexianjin, touzihuodongxianjinliuchuxiaoji, " \
                          "touzihuodongchanshengdexianjinliuliangjinge, xishoutouzisuoshoudaodexianjin, " \
                          "faxingzhengquanhuazichansuoxishoudezijin, faxingzhengquanshoudaodexianji, " \
                          "faxingcijizhaiquanshoudaodexianjin, zengjiagubensuoshoudaodexianjin, " \
                          "shoudaoqitayuchouzihuodongyouguanzijin, chouzihuodongxianjinliuruxiaoji, " \
                          "changhuanzaiwusuozhifudexianjin, fenpeigulilirunhuochangfulixizhifudexianjin, " \
                          "changfulixisuozhifudexianjin, zhifuxigufaxingfeiyong, zhifuqitayuchouzihuodongyouguandexianjin, " \
                          "chouzihuodongxianjinliuchuxiaoji, chouzihuodongchanshengdexianjinliuliangjinge, " \
                          "huilvbiandongduixianjinjixianjindengjiawudeyingxiang, xianjinjixianjindengjiawujingzengjiae, " \
                          "qichuxianjinjixianjindengjiawuyue, qimoxianjinjixianjindengjiawuyue, jinglirun, " \
                          "shaoshugudongshouyi, jitizichanjianzhizunbei, jitidehuaizhangzhunbei, jitidedaikuanshunshizhunbei, " \
                          "conghuicunfangtongyejianzhizhunbei, gudingzichanzhejiu, touzixingfangdichanzhejiu, " \
                          "wuxingzichandiyanzichanqitazichantanxiao, wuxingzichantanxiao, changqitanxiaofeiyongdetanxiao, " \
                          "changqizichantanxiao, chuzhigudingzichandesunshi, chuzhitouzixingfangdichandesunshi, " \
                          "gudingzichanbaofeisunshi, chaiwufeiyong, touzishunshi, gongyunjiazhibiandong, huiduishunyi, " \
                          "yangshengjironggongjujiaoyijingsunyi, zhexianhuiba, cunhuodejianshao, daikuandejianshao, " \
                          "cunkuandezengjia, chaijiekuanxiangdejingzeng, jinrongxingzichandejianshao, yujifuzaidezengjia, " \
                          "shoudaoyihexiaokuanxiang, diyansuodeshuizichandejainshao, diyansuodeshuifuzaidezengjia, " \
                          "jingyingxingyingshouxiangmudezengjia, jingyingxingyingfuxiangmudezengjia, " \
                          "jingyingxingqitazichandejianshao, jingyingxingqitafuzaidezengjia, qita, " \
                          "jingyinghuodongxianjinliuliangjinge, yigudingzichanchanghuanfuzai, yitouzichanghuanfuzhai, " \
                          "yigudingzichanjingxingtouzi, zhaiwuzhuanweiziben, yinianneidaoqidekezhuanhuangongsidezhaiquan, " \
                          "rongzizhurugudingzichan, qitabushejixianjinzhishoudetouzihechouzihuodongjine, xianjindeqimoyue, " \
                          "xianjinchuqiyue, xianjindengjiawuqimoyue, xianjindengjiawuqichuyue, " \
                          "xianjinjixianjindengjiawuzengjiae)  values" \
                          + "('" + item["code"] + "-" + item["time"] + "'," \
                          + "'" + item["code"] + "'," \
                          + "'" + item["time"] + "'," \
                          + "'" + item["danwei"] + "'," \
                          + "'" + item["kehudaikuanjidiankuanjingjianshaoe"] + "'," \
                          + "'" + item["xiangyanghangjiekuanjingjianshaoe"] + "'," \
                          + "'" + item["kehuchunkuanxiangjingzengjiae"] + "'," \
                          + "'" + item["kehucunkuan"] + "'," \
                          + "'" + item["tongyejiqitajirongjigoujinge"] + "'," \
                          + "'" + item["shouhuicunfangtongyejinge"] + "'," \
                          + "'" + item["chaichuzijinxianjinliuru"] + "'," \
                          + "'" + item["shouhuidechaichuzijinjinge"] + "'," \
                          + "'" + item["xishoudemaichuhuigouxiangjinge"] + "'," \
                          + "'" + item["shouhuidemairufanshouxiangjinge"] + "'," \
                          + "'" + item["chuzhijiaoyixingjinrongzichanjingzengjiae"] + "'," \
                          + "'" + item["shouqulixishouxufeijiyongjindexianjin"] + "'," \
                          + "'" + item["shoudaolixi"] + "'," \
                          + "'" + item["shoudaodeshouxufei"] + "'," \
                          + "'" + item["jirongqiyewanglaishourushoudaodexianjin"] + "'," \
                          + "'" + item["zhongjianyewushourushoudaodexianjin"] + "'," \
                          + "'" + item["huiduijingshouyishoudaodexianjin"] + "'," \
                          + "'" + item["qitayingyejiyingyewaijingshourushoudaodexianjin"] + "'," \
                          + "'" + item["cunrubaozengjinshoudaodexianjin"] + "'," \
                          + "'" + item["shoudaodeweituozijin"] + "'," \
                          + "'" + item["guijinshuxianjinliuru"] + "'," \
                          + "'" + item["tiexianshoudaodezijin"] + "'," \
                          + "'" + item["xiaoshoushangpintigonglaowushoudaodexianjin"] + "'," \
                          + "'" + item["shoudaodesuifeifanhuan"] + "'," \
                          + "'" + item["qitafuzhaizengjialiurudexianjin"] + "'," \
                          + "'" + item["huishoudeyiyuyiqiannianduhexiaodedaikuanjiyingshoukuanxiang"] + "'," \
                          + "'" + item["qitayingfuzanshoukuanjianshaoliuchudexianjin"] + "'," \
                          + "'" + item["chuzhidizhaizichanshoudaodexianjin"] + "'," \
                          + "'" + item["shoudaoqitajingyinghuodongxianjin"] + "'," \
                          + "'" + item["jingyinghuodongxianjinliuruxiaoji"] + "'," \
                          + "'" + item["kehudaikuanjindianfukuanzengjiae"] + "'," \
                          + "'" + item["cunfangzhongyangyinhanghetongyekuanxiangjingzengjiae"] + "'," \
                          + "'" + item["cunfangzhongyangyinhang"] + "'," \
                          + "'" + item["cunfangtongyejiqitajigoucunkuan"] + "'," \
                          + "'" + item["chaichuzijijingxianjinliuru"] + "'," \
                          + "'" + item["changhuanzhongyangyinghangjinkuan"] + "'," \
                          + "'" + item["zhifudechunkuan"] + "'," \
                          + "'" + item["jianshaotongyejiqitajinrongjigoucunfangjinge"] + "'," \
                          + "'" + item["changhuantongyejiqitajinrongjigouchairujinge"] + "'," \
                          + "'" + item["changhuanmaichuhuigoukuanxiangjinge"] + "'," \
                          + "'" + item["zhengquantouzizhichudexianjin"] + "'," \
                          + "'" + item["zhifumairufanhushoukuanxiangjinge"] + "'," \
                          + "'" + item["chuzhikegongchushoujinrongzichanjingjianshaoe"] + "'," \
                          + "'" + item["zhifulixishouxufeijiyongjindexianjin"] + "'," \
                          + "'" + item["zhifudelixi"] + "'," \
                          + "'" + item["shouxufeizhichuzhifudexianjin"] + "'," \
                          + "'" + item["zhifugeizhigongjizhigongzhifudexianjin"] + "'," \
                          + "'" + item["zhifudegexianshuifei"] + "'," \
                          + "'" + item["yixianjinzhifudeyingyefeiyong"] + "'," \
                          + "'" + item["yuejinrongjigoufanglaizhichudexianjinjinge"] + "'," \
                          + "'" + item["tiexianzhifudexianjin"] + "'," \
                          + "'" + item["yihexiaodaizhangdaikuanjilixidehuishou"] + "'," \
                          + "'" + item["weituojidailiyewujianshaoe"] + "'," \
                          + "'" + item["guijinshuxianjinliuchu"] + "'," \
                          + "'" + item["goumaishangpinjieshoulaowuzhifudexianjin"] + "'," \
                          + "'" + item["jieruqitazijinjingjianshaoe"] + "'," \
                          + "'" + item["qitazijinjianshaozhichudexianjin"] + "'," \
                          + "'" + item["qitayingshouzhanfukuanjianshaohuishoudexianjin"] + "'," \
                          + "'" + item["zhifuqitayujingyinghuodongyouguandexianjin"] + "'," \
                          + "'" + item["jingyinghuodongxianjinliuchuxiaoji"] + "'," \
                          + "'" + item["jingyinghuodongchanshengdexianjinliuliangjinge"] + "'," \
                          + "'" + item["huishoutouzishoudaodexianjin"] + "'," \
                          + "'" + item["qudetouzishouyishoudaodexianjin"] + "'," \
                          + "'" + item["fendegulihuolirunsuoshoudaodexianjin"] + "'," \
                          + "'" + item["qudezhaiquanlixishourushoudaodexianjin"] + "'," \
                          + "'" + item["chuzhigudingzichanwuxingzichanshoudaodexianjin"] + "'," \
                          + "'" + item["chuzhiguquantouzisuoshoudaodexianjin"] + "'," \
                          + "'" + item["qudezigongsijiqitayingyedanweisuoshoudaodexianjinjinge"] + "'," \
                          + "'" + item["shoudaoqitayutouzihuodongyouguandexianjin"] + "'," \
                          + "'" + item["touzihuodongxianjinliuruxiaoji"] + "'," \
                          + "'" + item["touzizhifudexianjin"] + "'," \
                          + "'" + item["quanyixingtouzizengjiazhifudexianjin"] + "'," \
                          + "'" + item["zhaiquantouzisuozhifudexianjin"] + "'," \
                          + "'" + item["goumaizigongsilianyingqiyesuozhifudexianjin"] + "'," \
                          + "'" + item["zengjiazaijiangongchengsuozhifudexianjin"] + "'," \
                          + "'" + item["goujiangudingzichanwuxingzichanzhifudexianjin"] + "'," \
                          + "'" + item["qudezigongsijiqitayingyedanweizhifudexianjinjinge"] + "'," \
                          + "'" + item["zhifudeqitayutouzihuodongyouguandexianjin"] + "'," \
                          + "'" + item["touzihuodongxianjinliuchuxiaoji"] + "'," \
                          + "'" + item["touzihuodongchanshengdexianjinliuliangjinge"] + "'," \
                          + "'" + item["xishoutouzisuoshoudaodexianjin"] + "'," \
                          + "'" + item["faxingzhengquanhuazichansuoxishoudezijin"] + "'," \
                          + "'" + item["faxingzhengquanshoudaodexianji"] + "'," \
                          + "'" + item["faxingcijizhaiquanshoudaodexianjin"] + "'," \
                          + "'" + item["zengjiagubensuoshoudaodexianjin"] + "'," \
                          + "'" + item["shoudaoqitayuchouzihuodongyouguanzijin"] + "'," \
                          + "'" + item["chouzihuodongxianjinliuruxiaoji"] + "'," \
                          + "'" + item["changhuanzaiwusuozhifudexianjin"] + "'," \
                          + "'" + item["fenpeigulilirunhuochangfulixizhifudexianjin"] + "'," \
                          + "'" + item["changfulixisuozhifudexianjin"] + "'," \
                          + "'" + item["zhifuxigufaxingfeiyong"] + "'," \
                          + "'" + item["zhifuqitayuchouzihuodongyouguandexianjin"] + "'," \
                          + "'" + item["chouzihuodongxianjinliuchuxiaoji"] + "'," \
                          + "'" + item["chouzihuodongchanshengdexianjinliuliangjinge"] + "'," \
                          + "'" + item["huilvbiandongduixianjinjixianjindengjiawudeyingxiang"] + "'," \
                          + "'" + item["xianjinjixianjindengjiawujingzengjiae"] + "'," \
                          + "'" + item["qichuxianjinjixianjindengjiawuyue"] + "'," \
                          + "'" + item["qimoxianjinjixianjindengjiawuyue"] + "'," \
                          + "'" + item["jinglirun"] + "'," \
                          + "'" + item["shaoshugudongshouyi"] + "'," \
                          + "'" + item["jitizichanjianzhizunbei"] + "'," \
                          + "'" + item["jitidehuaizhangzhunbei"] + "'," \
                          + "'" + item["jitidedaikuanshunshizhunbei"] + "'," \
                          + "'" + item["conghuicunfangtongyejianzhizhunbei"] + "'," \
                          + "'" + item["gudingzichanzhejiu"] + "'," \
                          + "'" + item["touzixingfangdichanzhejiu"] + "'," \
                          + "'" + item["wuxingzichandiyanzichanqitazichantanxiao"] + "'," \
                          + "'" + item["wuxingzichantanxiao"] + "'," \
                          + "'" + item["changqitanxiaofeiyongdetanxiao"] + "'," \
                          + "'" + item["changqizichantanxiao"] + "'," \
                          + "'" + item["chuzhigudingzichandesunshi"] + "'," \
                          + "'" + item["chuzhitouzixingfangdichandesunshi"] + "'," \
                          + "'" + item["gudingzichanbaofeisunshi"] + "'," \
                          + "'" + item["chaiwufeiyong"] + "'," \
                          + "'" + item["touzishunshi"] + "'," \
                          + "'" + item["gongyunjiazhibiandong"] + "'," \
                          + "'" + item["huiduishunyi"] + "'," \
                          + "'" + item["yangshengjironggongjujiaoyijingsunyi"] + "'," \
                          + "'" + item["zhexianhuiba"] + "'," \
                          + "'" + item["cunhuodejianshao"] + "'," \
                          + "'" + item["daikuandejianshao"] + "'," \
                          + "'" + item["cunkuandezengjia"] + "'," \
                          + "'" + item["chaijiekuanxiangdejingzeng"] + "'," \
                          + "'" + item["jinrongxingzichandejianshao"] + "'," \
                          + "'" + item["yujifuzaidezengjia"] + "'," \
                          + "'" + item["shoudaoyihexiaokuanxiang"] + "'," \
                          + "'" + item["diyansuodeshuizichandejainshao"] + "'," \
                          + "'" + item["diyansuodeshuifuzaidezengjia"] + "'," \
                          + "'" + item["jingyingxingyingshouxiangmudezengjia"] + "'," \
                          + "'" + item["jingyingxingyingfuxiangmudezengjia"] + "'," \
                          + "'" + item["jingyingxingqitazichandejianshao"] + "'," \
                          + "'" + item["jingyingxingqitafuzaidezengjia"] + "'," \
                          + "'" + item["qita"] + "'," \
                          + "'" + item["jingyinghuodongxianjinliuliangjinge"] + "'," \
                          + "'" + item["yigudingzichanchanghuanfuzai"] + "'," \
                          + "'" + item["yitouzichanghuanfuzhai"] + "'," \
                          + "'" + item["yigudingzichanjingxingtouzi"] + "'," \
                          + "'" + item["zhaiwuzhuanweiziben"] + "'," \
                          + "'" + item["yinianneidaoqidekezhuanhuangongsidezhaiquan"] + "'," \
                          + "'" + item["rongzizhurugudingzichan"] + "'," \
                          + "'" + item["qitabushejixianjinzhishoudetouzihechouzihuodongjine"] + "'," \
                          + "'" + item["xianjindeqimoyue"] + "'," \
                          + "'" + item["xianjinchuqiyue"] + "'," \
                          + "'" + item["xianjindengjiawuqimoyue"] + "'," \
                          + "'" + item["xianjindengjiawuqichuyue"] + "'," \
                          + "'" + item["xianjinjixianjindengjiawuzengjiae"] + "')"
                    cur.execute(sql)
                    self.conn.commit()

                else:
                    log.msg("has crawled this data")

            except Exception, e:
                log.msg(e, _level=logging.ERROR)

    def __del__(self):
        self.conn.close()


class hs_value(object):
    def __init__(self):
        conn = MySQLdb.connect(
            host='127.0.0.1',
            port=3306,
            user='root',
            passwd='20160401',
            db='stock',
            charset='utf8'
        )
        self.conn = conn

    def process_item(self, item, spider):
        cur = self.conn.cursor()
        sql = "select * from xl_hs_value where code='" + item['code'] + "'"
        try:
            # 执行sql语句
            cur.execute(sql)
            rows = cur.fetchall()
            # 提交到数据库执行
            self.conn.commit()
            if len(rows) == 0:
                sql = "insert into xl_hs_value (" \
                      "code, name, update_time, jinkaipan," \
                      "zuoshoupan, zuigaojia, zuidijia," \
                      "gujia, chengjiaoe, chengjiaoliang, " \
                      "zuigao52, zuidi52, riqi, " \
                      "shijian, guben,  " \
                      "shizhi)  values(" \
                      + "'" + item["code"] + "'," \
                      + "'" + item["name"] + "'," \
                      + "'" + item["update"] + "'," \
                      + "'" + item["jinkaipan"] + "'," \
                      + "'" + item["zuoshoupan"] + "'," \
                      + "'" + item["zuigaojia"] + "'," \
                      + "'" + item["zuidijia"] + "'," \
                      + "'" + item["gujia"] + "'," \
                      + "'" + item["chengjiaoe"] + "'," \
                      + "'" + item["chengjiaoliang"] + "'," \
                      + "'" + item["zuigao52"] + "'," \
                      + "'" + item["zuidi52"] + "'," \
                      + "'" + item["riqi"] + "'," \
                      + "'" + item["shijian"] + "'," \
                      + "'" + item["guben"] + "'," \
                      + "'" + item["shizhi"] + "')"
                cur.execute(sql)
                self.conn.commit()
            else:
                sql="update xl_hs_value set  " \
                    + "update_time='" + item["update"] + "'," \
                    + "jinkaipan='" + item["jinkaipan"] + "'," \
                    + "zuoshoupan='" + item["zuoshoupan"] + "'," \
                    + "zuigaojia='" + item["zuigaojia"] + "'," \
                    + "zuidijia='" + item["zuidijia"] + "'," \
                    + "gujia='" + item["gujia"] + "'," \
                    + "chengjiaoe='" + item["chengjiaoe"] + "'," \
                    + "chengjiaoliang='" + item["chengjiaoliang"] + "'," \
                    + "zuigao52='" + item["zuigao52"] + "'," \
                    + "zuidi52='" + item["zuidi52"] + "'," \
                    + "riqi='" + item["riqi"] + "'," \
                    + "shijian='" + item["shijian"] + "'," \
                    + "guben='" + item["guben"] + "'," \
                    + "shizhi='" + item["shizhi"] + "' " \
                    +"where code='"+item["code"]+"'"
                cur.execute(sql)
                self.conn.commit()
        except Exception,e:
            log.msg(e, _level=logging.ERROR)

    def __del__(self):
        self.conn.close()

