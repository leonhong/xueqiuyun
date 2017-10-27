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

class hk_caiwu(object):
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
        sql="select * from xl_hk_caiwu where pk='"+item['code']+"-"+item['end_time']+item["type"]+"'"
        try:
            # 执行sql语句
            cur.execute(sql)
            rows = cur.fetchall()
            # 提交到数据库执行
            self.conn.commit()
            if len(rows)==0:
                sql="insert into xl_hk_caiwu (pk, code, start_time, end_time,"\
                    +" pudate_time, type, yingyee, sunyie, yinglihuokuisun, zhenfu,"\
                    +" feijingchangxingshouyi, jibenmeiguyingli, tanbomeiguyinglin,"\
                    +" tebieguxi, guxijiezhikaishi, guxijiezhijieshu,guxiyingfuriqi, bizhong) values"\
                    +"('"+item["code"]+"-"+item["end_time"]+item["type"]+"',"\
                    +"'"+item["code"]+"'," \
                    + "'" + item["start_time"] + "'," \
                    + "'" + item["end_time"] + "'," \
                    + "'" + item["pudate_time"] + "'," \
                    + "'" + item["type"] + "'," \
                    + "'" + item["yingyee"] + "'," \
                    + "'" + item["sunyie"] + "'," \
                    + "'" + item["yinglihuokuisun"] + "'," \
                    + "'" + item["zhenfu"] + "'," \
                    + "'" + item["feijingchangxingshouyi"] + "'," \
                    + "'" + item["jibenmeiguyingli"] + "'," \
                    + "'" + item["tanbomeiguyinglin"] + "'," \
                    + "'" + item["tebieguxi"] + "'," \
                    + "'" + item["guxijiezhikaishi"] + "'," \
                    + "'" + item["guxijiezhijieshu"] + "'," \
                    + "'" + item["guxiyingfuriqi"] + "'," \
                    + "'" + item["bizhong"] + "')"
                cur.execute(sql)
                self.conn.commit()
            # else:
            #     log.msg("has crawled this data")
        except Exception,e:
            log.msg(e,_level=logging.ERROR)
    def __del__(self):
        self.conn.close()

class hk_fuzhai(object):
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
            sql="select * from xl_hk_fuzhai where pk='"+ item["code"] + "-" + item["baogaoriqi"] + item["type"] +"'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql = "insert into xl_hk_fuzhai (pk, code, time, " \
                          "type, feiliudongzichan, liudongzichan," \
                          " liudongfuzai, jingliudongzichan, feiliudongfuzai," \
                          " shaoshugudongquanyi, jingzichan, yifaxingguben," \
                          " chubei, gudongquanyi, wuxingzichan," \
                          " wuyechangfangshebei, fushugongsiquanyi, lianyinggongsiquanyi, " \
                          "qitatouzi, yingshouzhangkuan, cunhuo," \
                          " xianjinjiyinhangjiecun, yingfuzhangkuan,yinhangdaikuan," \
                          " feiliudongyinhangdaikuan, zongzichan, zongfuzai," \
                          " gufenshumu, bizhong) values" \
                          + "('" + item["code"] + "-" + item["baogaoriqi"] + item["type"] + "'," \
                          + "'" + item["code"] + "'," \
                          + "'" + item["baogaoriqi"] + "'," \
                          + "'" + item["type"] + "'," \
                          + "'" + item["feiliudongzichan"] + "'," \
                          + "'" + item["liudongzichan"] + "'," \
                          + "'" + item["liudongfuzai"] + "'," \
                          + "'" + item["jingliudongzichan"] + "'," \
                          + "'" + item["feiliudongfuzai"] + "'," \
                          + "'" + item["shaoshugudongquanyi"] + "'," \
                          + "'" + item["jingzichan"] + "'," \
                          + "'" + item["yifaxingguben"] + "'," \
                          + "'" + item["chubei"] + "'," \
                          + "'" + item["gudongquanyi"] + "'," \
                          + "'" + item["wuxingzichan"] + "'," \
                          + "'" + item["wuyechangfangshebei"] + "'," \
                          + "'" + item["fushugongsiquanyi"] + "'," \
                          + "'" + item["lianyinggongsiquanyi"] + "'," \
                          + "'" + item["qitatouzi"] + "'," \
                          + "'" + item["yingshouzhangkuan"] + "'," \
                          + "'" + item["cunhuo"] + "'," \
                          + "'" + item["xianjinjiyinhangjiecun"] + "'," \
                          + "'" + item["yingfuzhangkuan"] + "'," \
                          + "'" + item["yinhangdaikuan"] + "'," \
                          + "'" + item["feiliudongyinhangdaikuan"] + "'," \
                          + "'" + item["zongzichan"] + "'," \
                          + "'" + item["zongfuzai"] + "'," \
                          + "'" + item["gufenshumu"] + "'," \
                          + "'" + item["bizhong"] + "')"
                    cur.execute(sql)
                    self.conn.commit()
                # else:
                #     log.msg("has crawled this data")
            except Exception, e:
                log.msg(e, _level=logging.ERROR)
        else:

            sql = "select * from hk_bank_list where code='" + item["code"] + "'"
            cur.execute(sql)
            rows = cur.fetchall()
            if len(rows) == 0:
                sql = "insert into hk_bank_list (code) values ('" + item["code"] + "')"
                cur.execute(sql)
                self.conn.commit()
            sql = "select * from xl_hk_bank_fuzhai where pk='" + item["code"] + "-" + item["baogaoriqi"] + item["type"] + "'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql="insert into xl_hk_bank_fuzhai (" \
                        "pk, code, baogaoriqi, type," \
                        " xianjinjinduanqizijin, yinghangtongyejiqitajinrongjingoucunkaun," \
                        " maoyipiaoju, xianggangyequzhengfufuzhaizhengmingshu, " \
                        "jehudaikuanjiqitazhangkuang, chizhidaoqizhengquanzhaiwuzhengquangupiao," \
                        " lianyinggongsiquanyi, hezigongsiquanyijiqitaquanyi, wuxingzichan, " \
                        "gudingzichangjitouziwuye, titazichan, zongzichan, " \
                        "xianggangzhibiliutonge, yinghangjiqitajirongjigoucunkuanjijieyu," \
                        " kehucunkuan, yifaxingzhaiwuzhengquan, qitafuzhai, " \
                        "zongfuzhai, jiruziben, guben," \
                        " chubei, gudongquanyi, shaoshugudongquanyi, " \
                        "zibenlaiyuanheji, fuzhaijizibenlaiyuanheji, gufenshumu, " \
                        "chiyoudecunkuanzheng, chizuomaimaiyongtuzhengquan," \
                        " yifaxingcunkuanzheng, bizhong) values " \
                        + "('" + item["code"] + "-" + item["baogaoriqi"] + item["type"] + "'," \
                        + "'" + item["code"] + "'," \
                        + "'" + item["baogaoriqi"] + "'," \
                        + "'" + item["type"] + "'," \
                        + "'" + item["xianjinjinduanqizijin"] + "'," \
                        + "'" + item["yinghangtongyejiqitajinrongjingoucunkaun"] + "'," \
                        + "'" + item["maoyipiaoju"] + "'," \
                        + "'" + item["xianggangyequzhengfufuzhaizhengmingshu"] + "'," \
                        + "'" + item["jehudaikuanjiqitazhangkuang"] + "'," \
                        + "'" + item["chizhidaoqizhengquanzhaiwuzhengquangupiao"] + "'," \
                        + "'" + item["lianyinggongsiquanyi"] + "'," \
                        + "'" + item["hezigongsiquanyijiqitaquanyi"] + "'," \
                        + "'" + item["wuxingzichan"] + "'," \
                        + "'" + item["gudingzichangjitouziwuye"] + "'," \
                        + "'" + item["titazichan"] + "'," \
                        + "'" + item["zongzichan"] + "'," \
                        + "'" + item["xianggangzhibiliutonge"] + "'," \
                        + "'" + item["yinghangjiqitajirongjigoucunkuanjijieyu"] + "'," \
                        + "'" + item["kehucunkuan"] + "'," \
                        + "'" + item["yifaxingzhaiwuzhengquan"] + "'," \
                        + "'" + item["qitafuzhai"] + "'," \
                        + "'" + item["zongfuzhai"] + "'," \
                        + "'" + item["jiruziben"] + "'," \
                        + "'" + item["guben"] + "'," \
                        + "'" + item["chubei"] + "'," \
                        + "'" + item["gudongquanyi"] + "'," \
                        + "'" + item["shaoshugudongquanyi"] + "'," \
                        + "'" + item["zibenlaiyuanheji"] + "'," \
                        + "'" + item["fuzhaijizibenlaiyuanheji"] + "'," \
                        + "'" + item["gufenshumu"] + "'," \
                        + "'" + item["chiyoudecunkuanzheng"] + "'," \
                        + "'" + item["chizuomaimaiyongtuzhengquan"] + "'," \
                        + "'" + item["yifaxingcunkuanzheng"] + "'," \
                        + "'" + item["bizhong"] + "')"
                    cur.execute(sql)
                    self.conn.commit()
                # else:
                #     log.msg("has crawled this data")
            except Exception, e:
                log.msg(e, _level=logging.ERROR)

    def __del__(self):
        self.conn.close()


class hk_xianjin(object):
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
        sql="select * from xl_hk_xianjin where pk='"+item['code']+"-"+item['baogaoriqi']+ item["type"] +"'"
        try:
            # 执行sql语句
            cur.execute(sql)
            rows = cur.fetchall()
            # 提交到数据库执行
            self.conn.commit()
            if len(rows) == 0:
                sql = "insert into xl_hk_xianjin (pk, code, time," \
                      " type, jingyingliuru, touziliuru," \
                      " rongziliuru, xianjinjidengjiawuzengjia, nianchuxianji," \
                      " nianzhongxianjin, waihuiyingxiang, gouzhigudingzichan," \
                      " bizhong) values" \
                      + "('" + item["code"] + "-" + item["baogaoriqi"] + item["type"] + "'," \
                      + "'" + item["code"] + "'," \
                      + "'" + item["baogaoriqi"] + "'," \
                      + "'" + item["type"] + "'," \
                      + "'" + item["jingyingliuru"] + "'," \
                      + "'" + item["touziliuru"] + "'," \
                      + "'" + item["rongziliuru"] + "'," \
                      + "'" + item["xianjinjidengjiawuzengjia"] + "'," \
                      + "'" + item["nianchuxianji"] + "'," \
                      + "'" + item["nianzhongxianjin"] + "'," \
                      + "'" + item["waihuiyingxiang"] + "'," \
                      + "'" + item["gouzhigudingzichan"] + "'," \
                      + "'" + item["bizhong"] + "')"
                cur.execute(sql)
                self.conn.commit()
            # else:
            #     log.msg("has crawled this data")
        except Exception, e:
            log.msg(e, _level=logging.ERROR)

    def __del__(self):
        self.conn.close()


class hk_sunyi(object):
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
            sql="select * from xl_hk_sunyi where pk='"+item['code']+"-"+item['baogaoriqi']+ item["type"] +"'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql = "insert into xl_hk_sunyi (pk, code, time," \
                          " type, yingyee, chusuiqianyingli," \
                          " suixiang, chusuihouyingli, shaoshugudongquanyi,gudongyingzhanyingli,guxi," \
                          "chusuiguxihouyingli, meiguyingli, tanboyingli,meiguguxi," \
                          " xiaoshouchengben, zhejiu, xiaoshoujifeixiaofeiyong, " \
                          "yibanjixingzhengfeiyong, lixifeiyong,maoli,jingyingyingli, yingzhanliangyinggongsiyingli," \
                          " bizhong) values" \
                          + "('" + item["code"] + "-" + item["baogaoriqi"] + item["type"] + "'," \
                          + "'" + item["code"] + "'," \
                          + "'" + item["baogaoriqi"] + "'," \
                          + "'" + item["type"] + "'," \
                          + "'" + item["yingyee"] + "'," \
                          + "'" + item["chusuiqianyingli"] + "'," \
                          + "'" + item["suixiang"] + "'," \
                          + "'" + item["chusuihouyingli"] + "'," \
                          + "'" + item["shaoshugudongquanyi"] + "'," \
                          + "'" + item["gudongyingzhanyingli"] + "'," \
                          + "'" + item["guxi"] + "'," \
                          + "'" + item["chusuiguxihouyingli"] + "'," \
                          + "'" + item["meiguyingli"] + "'," \
                          + "'" + item["tanboyingli"] + "'," \
                          + "'" + item["meiguguxi"] + "'," \
                          + "'" + item["xiaoshouchengben"] + "'," \
                          + "'" + item["zhejiu"] + "'," \
                          + "'" + item["xiaoshoujifeixiaofeiyong"] + "'," \
                          + "'" + item["yibanjixingzhengfeiyong"] + "'," \
                          + "'" + item["lixifeiyong"] + "'," \
                          + "'" + item["maoli"] + "'," \
                          + "'" + item["jingyingyingli"] + "'," \
                          + "'" + item["yingzhanliangyinggongsiyingli"] + "'," \
                          + "'" + item["bizhong"] + "')"
                    cur.execute(sql)
                    self.conn.commit()
                # else:
                #     log.msg("has crawled this data")
            except Exception, e:
                log.msg(e, _level=logging.ERROR)


        else:
            sql = "select * from hk_bank_list where code='" + item["code"] + "'"
            cur.execute(sql)
            rows = cur.fetchall()
            if len(rows) == 0:
                sql = "insert into hk_bank_list (code) values ('" + item["code"] + "')"
                cur.execute(sql)
                self.conn.commit()
            sql = "select * from xl_hk_bank_sunyi where pk='" + item['code'] + "-" + item['baogaoriqi'] + item["type"] + "'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql = "insert into xl_hk_bank_sunyi (" \
                          "pk, code, baogaoriqi, " \
                          "type, lixishouru, lixizhichu," \
                          " jinglixishouru, qitajingyingshouru," \
                          " jingyingshouru, jingyingzhichu, zongzhunbei," \
                          " qitayingli, shuiqianyingli, shuixiang, " \
                          "chushuihouyingli, shaoshugudongquanyi, " \
                          "gudongyingzhanyingli,guxi, chushuiguxihouyingli, jibenmeiguyingli," \
                          " tanbomeiguyingli, bizhong) values" \
                          + "('" + item["code"] + "-" + item["baogaoriqi"] + item["type"] + "'," \
                          + "'" + item["code"] + "'," \
                          + "'" + item["baogaoriqi"] + "'," \
                          + "'" + item["type"] + "'," \
                          + "'" + item["lixishouru"] + "'," \
                          + "'" + item["lixizhichu"] + "'," \
                          + "'" + item["jinglixishouru"] + "'," \
                          + "'" + item["qitajingyingshouru"] + "'," \
                          + "'" + item["jingyingshouru"] + "'," \
                          + "'" + item["jingyingzhichu"] + "'," \
                          + "'" + item["zongzhunbei"] + "'," \
                          + "'" + item["qitayingli"] + "'," \
                          + "'" + item["shuiqianyingli"] + "'," \
                          + "'" + item["shuixiang"] + "'," \
                          + "'" + item["chushuihouyingli"] + "'," \
                          + "'" + item["shaoshugudongquanyi"] + "'," \
                          + "'" + item["gudongyingzhanyingli"] + "'," \
                          + "'" + item["guxi"] + "'," \
                          + "'" + item["chushuiguxihouyingli"] + "'," \
                          + "'" + item["jibenmeiguyingli"] + "'," \
                          + "'" + item["tanbomeiguyingli"] + "'," \
                          + "'" + item["bizhong"] + "')"
                    cur.execute(sql)
                    self.conn.commit()
                    # else:
                    #     log.msg("has crawled this data")
            except Exception, e:
                log.msg(e, _level=logging.ERROR)

    def __del__(self):
        self.conn.close()


class hk_value(object):
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
        sql = "select * from xl_hk_value where code='" + item['code'] + "'"
        try:
            # 执行sql语句
            cur.execute(sql)
            rows = cur.fetchall()
            # 提交到数据库执行
            self.conn.commit()
            if len(rows) == 0:
                sql = "insert into xl_hk_value (" \
                      "code, name, update_time, jinkaipan," \
                      " zuoshoupan, zuigaojia, zuidijia," \
                      " gujia, chengjiaoe, chengjiaoliang, " \
                      "shiyinglv, zuigao52, zuidi52, riqi, " \
                      "shijian, hkguben, guben, zhouxilv, " \
                      "shizhi, hkshizhi)  values(" \
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
                      + "'" + item["shiyinglv"] + "'," \
                      + "'" + item["zuigao52"] + "'," \
                      + "'" + item["zuidi52"] + "'," \
                      + "'" + item["riqi"] + "'," \
                      + "'" + item["shijian"] + "'," \
                      + "'" + item["hkguben"] + "'," \
                      + "'" + item["guben"] + "'," \
                      + "'" + item["zhouxilv"] + "'," \
                      + "'" + item["shizhi"] + "'," \
                      + "'" + item["hkshizhi"] + "')"
                cur.execute(sql)
                self.conn.commit()
            else:
                sql="update xl_hk_value set  " \
                    + "update_time='" + item["update"] + "'," \
                    + "jinkaipan='" + item["jinkaipan"] + "'," \
                    + "zuoshoupan='" + item["zuoshoupan"] + "'," \
                    + "zuigaojia='" + item["zuigaojia"] + "'," \
                    + "zuidijia='" + item["zuidijia"] + "'," \
                    + "gujia='" + item["gujia"] + "'," \
                    + "chengjiaoe='" + item["chengjiaoe"] + "'," \
                    + "chengjiaoliang='" + item["chengjiaoliang"] + "'," \
                    + "shiyinglv='" + item["shiyinglv"] + "'," \
                    + "zuigao52='" + item["zuigao52"] + "'," \
                    + "zuidi52='" + item["zuidi52"] + "'," \
                    + "riqi='" + item["riqi"] + "'," \
                    + "shijian='" + item["shijian"] + "'," \
                    + "hkguben='" + item["hkguben"] + "'," \
                    + "guben='" + item["guben"] + "'," \
                    + "zhouxilv='" + item["zhouxilv"] + "'," \
                    + "shizhi='" + item["shizhi"] + "'," \
                    + "hkshizhi='" + item["hkshizhi"] + "' " \
                    +"where code='"+item["code"]+"'"
                cur.execute(sql)
                self.conn.commit()
        except Exception, e:
            log.msg(e, _level=logging.ERROR)

    def __del__(self):
        self.conn.close()




class history_hk_caiwu(object):
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
        sql="select * from history_hk_caiwu where pk='"+item['code']+"-"+item['date']+"'"
        try:
            # 执行sql语句
            cur.execute(sql)
            rows = cur.fetchall()
            # 提交到数据库执行
            self.conn.commit()
            if len(rows)==0:
                sql="insert into history_hk_caiwu (" \
                    "pk, code, date, jibenmiegushouyi," \
                    " tanbomeigushouyi, molilv, daikuanhuibaolv, " \
                    "zongzichanshouyilv, jinzichanshouyilv, liudongbilv," \
                    " sudongbilv, zibencongzhulv, zichanzhouzhuanlv, cundaibi," \
                    " cunhuozhouzhuanlv, guanlifeiyongbilv, caiwufeiyongbilv, " \
                    "xiaoshouxianjinbilv) values"\
                    +"('"+item["code"]+"-"+item["date"]+"'," \
                    + "'" + item["code"] + "'," \
                    + "'" + item["date"] + "'," \
                    + "'" + item["jibenmiegushouyi"] + "'," \
                    + "'" + item["tanbomeigushouyi"] + "'," \
                    + "'" + item["molilv"] + "'," \
                    + "'" + item["daikuanhuibaolv"] + "'," \
                    + "'" + item["zongzichanshouyilv"] + "'," \
                    + "'" + item["jinzichanshouyilv"] + "'," \
                    + "'" + item["liudongbilv"] + "'," \
                    + "'" + item["sudongbilv"] + "'," \
                    + "'" + item["zibencongzhulv"] + "'," \
                    + "'" + item["zichanzhouzhuanlv"] + "'," \
                    + "'" + item["cundaibi"] + "'," \
                    + "'" + item["cunhuozhouzhuanlv"] + "'," \
                    + "'" + item["guanlifeiyongbilv"] + "'," \
                    + "'" + item["caiwufeiyongbilv"] + "'," \
                    + "'" + item["xiaoshouxianjinbilv"] + "')"
                cur.execute(sql)
                self.conn.commit()
            # else:
            #     log.msg("has crawled this data")
        except Exception,e:
            log.msg(e,_level=logging.ERROR)
    def __del__(self):
        self.conn.close()

class history_hk_lirun(object):
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
        sql="select * from history_hk_lirun where pk='"+item['code']+"-"+item['date']+"'"
        try:
            # 执行sql语句
            cur.execute(sql)
            rows = cur.fetchall()
            # 提交到数据库执行
            self.conn.commit()
            if len(rows)==0:
                sql="insert into history_hk_lirun (" \
                    "pk, code, date, zongyingshou, " \
                    "lixishouyi, feiyongshouyi, jiaoyishouyi," \
                    " jingyinglirun, chushuiqianlirun, jinglirun," \
                    " meigujibenyingli, meiguguxi) values"\
                    +"('"+item["code"]+"-"+item["date"]+"'," \
                    + "'" + item["code"] + "'," \
                    + "'" + item["date"] + "'," \
                    + "'" + item["zongyingshou"] + "'," \
                    + "'" + item["lixishouyi"] + "'," \
                    + "'" + item["feiyongshouyi"] + "'," \
                    + "'" + item["jiaoyishouyi"] + "'," \
                    + "'" + item["jingyinglirun"] + "'," \
                    + "'" + item["chushuiqianlirun"] + "'," \
                    + "'" + item["jinglirun"] + "'," \
                    + "'" + item["meigujibenyingli"] + "'," \
                    + "'" + item["meiguguxi"] + "')"
                cur.execute(sql)
                self.conn.commit()
            # else:
            #     log.msg("has crawled this data")
        except Exception,e:
            log.msg(e,_level=logging.ERROR)
    def __del__(self):
        self.conn.close()


class history_hk_fuzhai(object):
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
        sql="select * from history_hk_fuzhai where pk='"+item['code']+"-"+item['date']+"'"
        try:
            # 执行sql语句
            cur.execute(sql)
            rows = cur.fetchall()
            # 提交到数据库执行
            self.conn.commit()
            if len(rows)==0:
                sql="insert into history_hk_fuzhai (pk, code, date, " \
                    "gudingzichan,liudongzichan, liudongfuzhai, cunkuan," \
                    " xianjinjiyinhangcunjie, qitazichan, kucunxianjinjiduanqiziji," \
                    " kehucunkuan, yinhangtongyecunkuanjidaikuan, kegongchushouzhizhengquan, " \
                    "jinrongzichan, jinrongfuzhai, zongzichan, " \
                    "zongfuzai, gudongquanyi) values"\
                    +"('"+item["code"]+"-"+item["date"]+"'," \
                    + "'" + item["code"] + "'," \
                    + "'" + item["date"] + "'," \
                    + "'" + item["gudingzichan"] + "'," \
                    +"'"+item["liudongzichan"]+"',"\
                    + "'" + item["liudongfuzhai"] + "'," \
                    + "'" + item["cunkuan"] + "'," \
                    + "'" + item["xianjinjiyinhangcunjie"] + "'," \
                    + "'" + item["qitazichan"] + "'," \
                    + "'" + item["kucunxianjinjiduanqiziji"] + "'," \
                    + "'" + item["kehucunkuan"] + "'," \
                    + "'" + item["yinhangtongyecunkuanjidaikuan"] + "'," \
                    + "'" + item["kegongchushouzhizhengquan"] + "'," \
                    + "'" + item["jinrongzichan"] + "'," \
                    + "'" + item["jinrongfuzhai"] + "'," \
                    + "'" + item["zongzichan"] + "'," \
                    + "'" + item["zongfuzai"] + "'," \
                    + "'" + item["gudongquanyi"] + "')"
                cur.execute(sql)
                self.conn.commit()
            # else:
            #     log.msg("has crawled this data")
        except Exception,e:
            log.msg(e,_level=logging.ERROR)
    def __del__(self):
        self.conn.close()



class history_hk_xianjin(object):
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
        sql="select * from history_hk_xianjin where pk='"+item['code']+"-"+item['date']+"'"
        try:
            # 执行sql语句
            cur.execute(sql)
            rows = cur.fetchall()
            # 提交到数据库执行
            self.conn.commit()
            if len(rows)==0:
                sql="insert into history_hk_xianjin (" \
                    "pk, code, date, " \
                    "jingyinghuodongchanshengxianjinliu, yishoulixi, " \
                    "yifulixi, yishouguxi, yipaiguxi, touzihuodongchanshengxianjinliu, " \
                    "rongzihuodongchanshengdexianjinliu, qichuxianjiliujidengjiawu," \
                    " xianjinjixianjindengjiawujingzengjiae, qimoxianjinjixianjindengjiawu, " \
                    "huilvbiandongyingxiang) values"\
                    +"('"+item["code"]+"-"+item["date"]+"'," \
                    + "'" + item["code"] + "'," \
                    + "'" + item["date"] + "'," \
                    + "'" + item["jingyinghuodongchanshengxianjinliu"] + "'," \
                    + "'" + item["yishoulixi"] + "'," \
                    + "'" + item["yifulixi"] + "'," \
                    + "'" + item["yishouguxi"] + "'," \
                    + "'" + item["yipaiguxi"] + "'," \
                    + "'" + item["touzihuodongchanshengxianjinliu"] + "'," \
                    + "'" + item["rongzihuodongchanshengdexianjinliu"] + "'," \
                    + "'" + item["qichuxianjiliujidengjiawu"] + "'," \
                    + "'" + item["xianjinjixianjindengjiawujingzengjiae"] + "'," \
                    + "'" + item["qimoxianjinjixianjindengjiawu"] + "'," \
                    + "'" + item["huilvbiandongyingxiang"] + "')"
                cur.execute(sql)
                self.conn.commit()
            # else:
            #     log.msg("has crawled this data")
        except Exception,e:
            log.msg(e,_level=logging.ERROR)
    def __del__(self):
        self.conn.close()



class huilv(object):
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
        sql = "select * from huilv where code='"+ item['code'] +"'"
        try:
            # 执行sql语句
            cur.execute(sql)
            rows = cur.fetchall()
            # 提交到数据库执行
            self.conn.commit()
            if len(rows) == 0:
                sql = "insert into huilv (code, Fbizhong, Tbizhong, value)  values('"+item["code"]+"','" +item["From"]+"','" +item["To"]+"','"+item["value"]+"')"
                cur.execute(sql)
                self.conn.commit()

            else:
                sql="update huilv set value='"+item["value"]+"' where code='"+item["code"]+"'"
                cur.execute(sql)
                self.conn.commit()

        except Exception,e:
            log.msg(e, _level=logging.ERROR)
