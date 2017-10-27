# -*- coding:utf-8 -*-

import urllib
import MySQLdb
import signal
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions

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
    
    
class getInfo(object):
    """docstring for TianYanCha"""
    def get(self, stock_code, stock_name):
        result = ''
        #driver = webdriver.PhantomJS(executable_path = './phantomjs2.1.1/bin/phantomjs.exe')
        driver = webdriver.PhantomJS(executable_path = '/usr/local/bin/phantomjs')
        url = 'http://finance.sina.com.cn/realstock/company/sh' + str(stock_code) + '/nc.shtml'
        driver.get(url)
        #driver.implicitly_wait(0.1)
        hasInfo = True
        try:
            #实时股价
            stock_price = driver.find_element_by_xpath('//*[@id="price"]').text
            if len(stock_price) > 0:
                result = "实时股价:" + str(stock_price) + "\r\n"
            #涨跌
            ups_and_downs = driver.find_element_by_xpath('//*[@id="change"]').text
            if len(ups_and_downs) > 0:
                result = result + "涨跌:" + str(ups_and_downs) + "\r\n"
            #涨跌幅
            rise_and_fall = driver.find_element_by_xpath('//*[@id="changeP"]').text
            if len(rise_and_fall) > 0:
                result = result + "涨跌幅:" + str(rise_and_fall) + "\r\n"
            #涨停价
            high_limit = driver.find_element_by_xpath('//*[@id="ud_limie"]/div[1]').text
            if len(high_limit) > 0:
                result = result + "涨停价:" + str(high_limit) + "\r\n"
            #跌停价
            low_limit = driver.find_element_by_xpath('//*[@id="ud_limie"]/div[2]').text
            if len(low_limit) > 0:
                result = result + "跌停价:" + str(low_limit) + "\r\n"
            #股价时间
            stock_time = driver.find_element_by_xpath('//*[@id="hqTime"]').text
            if len(stock_time) > 0:
                result = result + "股价时间:" + str(stock_time) + "\r\n"
            #开盘价
            opening_price = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[1]/td[1]').text
            if len(opening_price) > 0:
                result = result + "开盘价:" + str(opening_price) + "\r\n"
            #最高价
            highest_price = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[2]/td[1]').text
            if len(highest_price) > 0:
                result = result + "最高价:" + str(highest_price) + "\r\n"
            #最低价
            minimum_price = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[3]/td[1]').text
            if len(minimum_price) > 0:
                result = result + "最低价:" + str(minimum_price) + "\r\n"
            #昨日收盘价
            Yesterday_closing_price = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[4]/td[1]').text
            if len(Yesterday_closing_price) > 0:
                result = result + "昨日收盘价:" + str(Yesterday_closing_price) + "\r\n"
            #成交量
            volume = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[1]/td[2]').text
            if len(volume) > 0:
                result = result + "成交量:" + str(volume) + "\r\n"
            #成交额
            turnover_volume = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[2]/td[2]').text
            if len(turnover_volume) > 0:
                result = result + "成交额:" + str(turnover_volume) + "\r\n"
            #总市值
            total_market_value = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[3]/td[2]').text
            total_market_value_double = 0
            if len(total_market_value) > 0:
                total_market_value_str = str(total_market_value).replace('亿', '').strip()
                #print total_market_value_str
                total_market_value_double = float(total_market_value_str) * 100000000
                result = result + "总市值:" + str(total_market_value_double) + "\r\n"
            #流通市值
            circulation_market_value = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[4]/td[2]').text
            circulation_market_value_double = 0
            if len(circulation_market_value) > 0:
                circulation_market_value_str = str(circulation_market_value).replace('亿', '').strip()
                circulation_market_value_double = float(circulation_market_value_str) * 100000000
                result = result + "流通市值:" + str(circulation_market_value_double) + "\r\n"
            #振幅
            amplitude = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[1]/td[3]').text
            if len(amplitude) > 0:
                result = result + "振幅:" + str(amplitude) + "\r\n"
            #换手率
            turnover_rate = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[2]/td[3]').text
            if len(turnover_rate) > 0:
                result = result + "换手率:" + str(turnover_rate) + "\r\n"
            #市净率
            book_value = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[3]/td[3]').text
            if len(book_value) > 0:
                result = result + "市净率:" + str(book_value) + "\r\n"
            #市盈率
            P_E_ratio = driver.find_element_by_xpath('//*[@id="hqDetails"]/table/tbody/tr[4]/td[3]').text
            if len(P_E_ratio) > 0:
                result = result + "市盈率:" + str(P_E_ratio) + "\r\n"
            #print 'result:' + result
        except Exception,e:
            hasInfo = False
            print "get infos from xpath failed, stock code is " + str(stock_code)
            #driver.quit()
            driver.service.process.send_signal(signal.SIGTERM)
            driver.quit()
        driver.service.process.send_signal(signal.SIGTERM)
        driver.quit()
        #print str(hasInfo)

        if hasInfo:
            sql = "update xl_sh_real_time_share_price set stock_name='" + str(stock_name) + "',"\
"stock_price='" + str(stock_price) + "',"\
"ups_and_downs='" + str(ups_and_downs) + "',"\
"rise_and_fall='" + str(rise_and_fall) + "',"\
"high_limit='" + str(high_limit).replace('涨停：', '') + "',"\
"low_limit='" + str(low_limit).replace('跌停：', '') + "',"\
"stock_time='" + str(stock_time) + "',"\
"opening_price='" + str(opening_price) + "',"\
"highest_price='" + str(highest_price) + "',"\
"minimum_price='" + str(minimum_price) + "',"\
"Yesterday_closing_price='" + str(Yesterday_closing_price) + "',"\
"volume='" + str(volume) + "',"\
"turnover_volume='" + str(turnover_volume) + "',"\
"total_market_value='" + str(total_market_value_double) + "',"\
"circulation_market_value='" + str(circulation_market_value_double) + "',"\
"amplitude='" + str(amplitude) + "',"\
"turnover_rate='" + str(turnover_rate) + "',"\
"book_value='" + str(book_value) + "',"\
"P_E_ratio='" + str(P_E_ratio) + "' where stock_code='" + str(stock_code) + "'"


            (conn, cur) = getConnAndCursor()
            cur.execute(sql)
            conn.commit()
            closeConnAndCursor(cur, conn)
                
if __name__ == '__main__':
    (conn_new, cur_new) = getConnAndCursor()
    stock_code_list = cur_new.execute("select stock_code, stock_name from sh_stock_list")
    stock_code_infos = cur_new.fetchmany(stock_code_list)
    #closeConnAndCursor(cur_new, conn_new)
    g = getInfo()
    #while(True):
    for stock_info in stock_code_infos:
            stock_code = str(stock_info[0])
            stock_name = str(stock_info[1])#.encode('gb2312')
            print 'stock_code:' + stock_code
            #print 'stock_name:' + stock_name
            sql = 'insert into xl_sh_real_time_share_price(stock_code) VALUES (' + str(stock_code) + ')'
            try:
                cur_new.execute(sql)
                conn_new.commit()
            except Exception,e:
                pass
    closeConnAndCursor(cur_new, conn_new)
            #try:
            #    g.get(stock_code, stock_name)
            #except Exception,e:
            #    print 'get() method failed'
            #    print 'stock_code:' + stock_code
            #    print 'stock_name:' + stock_name
    #g = getInfo()
    #comId = '2335657694'
    #g.get(comId, "", "")
