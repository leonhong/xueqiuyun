# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html
import logging

import MySQLdb
from scrapy import log


class CodelistPipeline(object):
    def process_item(self, item, spider):
        return item


class HKCode(object):
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
        sql="select * from hk_stock_list where stock_code='"+item['code']+"'"
        try:
            # 执行sql语句
            cur.execute(sql)
            rows = cur.fetchall()
            # 提交到数据库执行
            self.conn.commit()
            if len(rows)==0:
                sql="select * from code_black_list where code='"+item['code']+"'"
                cur.execute(sql)
                black=cur.fetchall()
                self.conn.commit()
                if len(black)==0:
                    try:
                        sql='insert into hk_stock_list (stock_code, stock_name) values("'+item['code']+'","'+item['name']+'")'
                        cur.execute(sql)
                        self.conn.commit()
                        print "code:"+item["code"]+"  name:"+item["name"]
                    except Exception,e:
                        log.msg(str(e),logging.ERROR)
                        print "code:" + item["code"] + "  name:" + item["name"]
            # else:
            #     if rows[0][1]!=item['name']:
            #         sql="update hk_stock_list set stock_name='"+item["name"]+"' where stock_code='"+item["code"]+"'"
            #         print "code:"+item["code"]+"  name:"+item["name"]+"    "+rows[0][1]
                    # log.msg(sql)
                    # cur.execute(sql)
                    # self.conn.commit()
        except Exception,e:
            log.msg(e,_level=logging.ERROR)
            log.msg(item["code"] + item["name"], _level=logging.ERROR)
    def __del__(self):
        self.conn.close()


class HSCode(object):
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
        if item['market']=='SZ':
            sql="select * from sz_stock_list where stock_code='"+item['code']+"'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows)==0:
                    sql = "select * from code_black_list where code='" + item['code'] + "'"
                    cur.execute(sql)
                    black = cur.fetchall()
                    self.conn.commit()
                    if len(black) == 0:
                        if item["code"][:2]!="39":
                            print item["market"] + ":" + item["code"] + ";" + item["name"]
                            sql="insert into sz_stock_list (stock_code, stock_name) values('"+item['code']+"','"+item['name']+"')"
                            cur.execute(sql)
                            self.conn.commit()
                # else:
                #     if rows[0][1]!=item['name']:
                #         sql="update sz_stock_list set stock_name='"+item["name"]+"' where stock_code='"+item["code"]+"'"
                #         cur.execute(sql)
                #         self.conn.commit()
            except Exception,e:
                log.msg(e,_level=logging.ERROR)
                print item["code"]+item["name"]
        else:
            sql = "select * from sh_stock_list where stock_code='" + item['code'] + "'"
            try:
                # 执行sql语句
                cur.execute(sql)
                rows = cur.fetchall()
                # 提交到数据库执行
                self.conn.commit()
                if len(rows) == 0:
                    sql = "select * from code_black_list where code='" + item['code'] + "'"
                    cur.execute(sql)
                    black = cur.fetchall()
                    self.conn.commit()
                    if len(black) == 0:
                        if item["code"][:1]!='1' and item["code"][:1]!='0':
                            print item["market"] + ":" + item["code"] + ";" + item["name"]

                            sql = "insert into sh_stock_list (stock_code, stock_name) values('" + item['code'] + "','" + item[
                            'name'] + "')"
                            cur.execute(sql)
                            self.conn.commit()
                # else:
                #     if rows[0][1] != item['name']:
                #         sql = "update sh_stock_list set stock_name='" + item["name"] + "' where stock_code='" + item[
                #             "code"] + "'"
                #         cur.execute(sql)
                #         self.conn.commit()
            except Exception, e:
                log.msg(e, _level=logging.ERROR)
                log.msg(item["code"] + item["name"],_level=logging.ERROR)
    def __del__(self):
        self.conn.close()


