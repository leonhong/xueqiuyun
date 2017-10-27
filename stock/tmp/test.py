# -*- coding:utf-8 -*-
import time

import MySQLdb
#dateStr1 = '2016-11-16 00:00:00'
#datestr2 = '2015/5/29'
#
#a_struct_time = time.strptime(dateStr1, '%Y-%m-%d %H:%M:%S')
#b_struct_time = time.strptime(datestr2, '%Y/%m/%d')
#if time.mktime(a_struct_time) > time.mktime(b_struct_time):
#    print True
#else:
#    print False


def getConnAndCursor():
    conn = MySQLdb.connect(
        host='10.2.1.3',
        port=3306,
        user='sqoop',
        passwd='sqoop',
        db='stock',
        charset='utf8'
    )
    cur = conn.cursor()
    return (conn, cur)
 
def closeConnAndCursor(cur, conn):
    cur.close()
    conn.commit()
    conn.close()

(conn_new, cur_new) = getConnAndCursor()

f = open("new1.txt","r")  
lines = f.readlines()#读取全部内容  
for line in lines:
    strarr = str(line).split(' ')
    stock_code = strarr[0].strip()
    stock_name = strarr[1].strip()
    #print stock_code
    #print stock_name
    stock_code_list_old = cur_new.execute("select stock_code from hk_stock_list where stock_code = " + stock_code)
    stock_code_old = cur_new.fetchmany(stock_code_list_old)
    print stock_code_old[0]
    if len(stock_code_old) == 2:
        #print stock_code_old
        print 'into if'
        sql = "insert into hk_stock_list(stock_code, stock_name) VALUES ('" + str(stock_code) + "', '" + str(stock_name) + "')"
        print sql
        #cur_new.execute(sql)
        #conn_new.commit()
closeConnAndCursor(cur_new, conn_new)
