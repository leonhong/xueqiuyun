# -*- coding:utf-8 -*-

import requests
import MySQLdb
import time

import sys
reload(sys)
sys.setdefaultencoding('utf-8')

def getConnAndCursor():
    conn = MySQLdb.connect(
        host='127.0.0.1',
        port=3306,
        user='root',
        passwd='20160401',
        db='stock',
        charset='utf8'
    )
    cur = conn.cursor()
    return (conn, cur)


def closeConnAndCursor(cur, conn):
    cur.close()
    conn.commit()
    conn.close()

class getStockhistoryInfo(object):
    def get(self, stockCode, stockTypeCode):
        url = 'http://quotes.money.163.com/service/chddata.html?code=' + str(stockTypeCode) + stockCode
        r = requests.get(url) 
        con = r.content
        lines = con.split('\n')
        (conn, cur) = getConnAndCursor()
        logFile = open("log", "a")
        for i in range(0, len(lines)):
            if i == 0:
                context = "begin to get stock " + stockCode + " infos"
                logFile.write(context + '\r\n')
            if i > 0:
                contexts = lines[i].split(',')
                if len(contexts) > 1:
                    (conn_new, cur_new) = getConnAndCursor()
                    sql = "select MAX(date) from sz_storck_historical_transaction where stock_code = '" + stockCode + "'"
                    date_list = cur_new.execute(sql)
                    database_date = cur_new.fetchmany(date_list)
                    closeConnAndCursor(cur_new, conn_new)
                    #print 'database_date:' + str(database_date[0][0])
                    try:
                        a_struct_time = time.strptime(str(database_date[0][0]), '%Y-%m-%d %H:%M:%S')
                        b_struct_time = time.strptime(str(contexts[0]), '%Y-%m-%d')
                    except Exception, e:
                        print 'get time failed, code is ' + stockCode + ', name is ' + str(contexts[2]) + ', data is ' + str(contexts[0]) + ', url is ' + str(url)
                        #if str(database_date[0][0]) == 'None':
                        print 'database_date[0][0]:' + str(database_date[0][0])
                        break
                    if time.mktime(a_struct_time) < time.mktime(b_struct_time):
                        sql = ''
                        if stockTypeCode == 0:
                            sql = "INSERT INTO sh_storck_historical_transaction(stock_code,\
date,\
stock_name,\
closing_price,\
highest_price,\
minimum_price,\
opening_price,\
closing_price_the_day_before,\
price_rise,\
rise_and_fall,\
turnover_rate,\
volume,\
transaction_amount,\
total_market_value,\
circulation_market_value,\
number_of_transactions) VALUES ('"+stockCode+"',\
'"+contexts[0]+"',\
'"+contexts[2]+"',\
'"+contexts[3]+"',\
'"+contexts[4]+"',\
'"+contexts[5]+"',\
'"+contexts[6]+"',\
'"+contexts[7]+"',\
'"+contexts[8]+"',\
'"+contexts[9]+"',\
'"+contexts[10]+"',\
'"+contexts[11]+"',\
'"+contexts[12]+"',\
'"+contexts[13]+"',\
'"+contexts[14]+"',\
'"+contexts[15]+"')"
                        elif stockTypeCode == 1:
                            sql = "INSERT INTO sz_storck_historical_transaction(stock_code,\
date,\
stock_name,\
closing_price,\
highest_price,\
minimum_price,\
opening_price,\
closing_price_the_day_before,\
price_rise,\
rise_and_fall,\
turnover_rate,\
volume,\
transaction_amount,\
total_market_value,\
circulation_market_value,\
number_of_transactions) VALUES ('"+stockCode+"',\
'"+contexts[0]+"',\
'"+contexts[2]+"',\
'"+contexts[3]+"',\
'"+contexts[4]+"',\
'"+contexts[5]+"',\
'"+contexts[6]+"',\
'"+contexts[7]+"',\
'"+contexts[8]+"',\
'"+contexts[9]+"',\
'"+contexts[10]+"',\
'"+contexts[11]+"',\
'"+contexts[12]+"',\
'"+contexts[13]+"',\
'"+contexts[14]+"',\
'"+contexts[15]+"')"
                        try:
                            print 'sql:' + sql.replace('\n', '').replace('\r', '').decode('gbk','ignore').encode('utf-8')
                            cur.execute(sql.replace('\n', '').replace('\r', '').decode('gbk','ignore').encode('utf-8'))
                            conn.commit()
                        except Exception, e:
                            errorInfo = 'stock ' + stockCode + ' in ' + contexts[0] + ' insert is failed'
                            print errorInfo
                            logFile.write(errorInfo + '\n')
                            logFile.write(sql.replace('\n', '').replace('\r', '').decode('gbk','ignore').encode('utf-8') + '\r\n')
                    else:
                        #print 'into else'
                        break    
        context = "stock " + stockCode + " infos is getted!"
        logFile.write(context + '\r\n')
        closeConnAndCursor(cur, conn)
        
if __name__ == '__main__':
    (conn_new, cur_new) = getConnAndCursor()
    stock_code_list = cur_new.execute("select stock_code from sz_stock_list")
    stock_code_infos = cur_new.fetchmany(stock_code_list)
    g = getStockhistoryInfo()
    for stock_code in stock_code_infos:
        print stock_code[0]
        stockCode = str(stock_code[0])
    	#stockCode = '000722'
    	stocktype = 1 #沪市0，深市1
    	g.get(stockCode, stocktype)
