# -*- coding:utf-8 -*-

import urllib
import MySQLdb
import time
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
        url = 'http://stock.finance.sina.com.cn/hkstock/quotes/' + str(stock_code) + '.html'
        driver.get(url)
        #driver.implicitly_wait(1)
        hasInfo = True
        try:
            #股价时间
            stock_time = driver.find_element_by_xpath('//*[@id="mts_stock_hk_time"]').text
            if len(stock_time) > 0:
                result = "实时股价:" + str(stock_time) + "\r\n"
            #实时股价
            stock_price = driver.find_element_by_xpath('//*[@id="mts_stock_hk_price"]').text
            if len(stock_price) > 0:
                result = "实时股价:" + str(stock_price) + "\r\n"
            #涨跌和涨跌幅
            ups_and_downs_with_rise_and_fall = driver.find_element_by_xpath('//*[@id="mts_stock_hk_zdf"]').text
            ups_and_downs = ''
            rise_and_fall = ''
            if len(ups_and_downs) > 0:
                ups_and_downs = ups_and_downs_with_rise_and_fall.split('（', '')[0]
                rise_and_fall = ups_and_downs_with_rise_and_fall.split('（', '')[1].replace('）', '')
                result = result + "涨跌:" + str(ups_and_downs) + "\r\n"
                result = result + "涨跌幅:" + str(rise_and_fall) + "\r\n"
            #昨日收盘价
            Yesterday_closing_price = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[1]/li[1]/span').text
            if len(Yesterday_closing_price) > 0:
                result = result + "昨日收盘价:" + str(Yesterday_closing_price) + "\r\n"
            #最高价
            highest_price = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[1]/li[2]/span').text
            if len(highest_price) > 0:
                result = result + "最高价:" + str(highest_price) + "\r\n"
            #振幅
            amplitude = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[1]/li[3]/span').text
            if len(amplitude) > 0:
                result = result + "振幅:" + str(amplitude) + "\r\n"
            #价格档
            price_file = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[1]/li[4]/span').text
            if len(price_file) > 0:
                result = result + "价格档:" + str(price_file) + "\r\n"
            #开盘价
            opening_price = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[2]/li[1]/span').text
            if len(opening_price) > 0:
                result = result + "开盘价:" + str(opening_price) + "\r\n"
            #最低价
            minimum_price = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[2]/li[2]/span').text
            if len(minimum_price) > 0:
                result = result + "最低价:" + str(minimum_price) + "\r\n"
            #市盈率
            P_E_ratio = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[2]/li[3]/span').text
            if len(P_E_ratio) > 0:
                result = result + "市盈率:" + str(P_E_ratio) + "\r\n"
            #每手股数
            lot_size = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[2]/li[4]/span').text
            if len(lot_size) > 0:
                result = result + "每手股数:" + str(lot_size) + "\r\n"
            #成交额
            turnover_volume = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[3]/li[1]/span').text
            if len(turnover_volume) > 0:
                result = result + "成交额:" + str(turnover_volume) + "\r\n"
            #52周最高
            i_52_weeks_maximum = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[3]/li[2]/span').text
            if len(i_52_weeks_maximum) > 0:
                result = result + "52周最高:" + str(i_52_weeks_maximum) + "\r\n"
            #总股本
            total_share_capital = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[3]/li[3]/span').text
            if len(total_share_capital) > 0:
                result = result + "总股本:" + str(total_share_capital) + "\r\n"
            #港股市值
            market_value_of_Hong_Kong_equities = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[3]/li[4]/span').text
            if len(market_value_of_Hong_Kong_equities) > 0:
                result = result + "港股市值:" + str(market_value_of_Hong_Kong_equities) + "\r\n"
            #成交量
            volume = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[4]/li[1]/span').text
            if len(volume) > 0:
                result = result + "成交量:" + str(volume) + "\r\n"
            #52周最低
            i_52_weeks_minimum = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[4]/li[2]/span').text
            if len(i_52_weeks_minimum) > 0:
                result = result + "52周最低:" + str(i_52_weeks_minimum) + "\r\n"
            #港股股本
            Hong_Kong_equity = driver.find_element_by_xpath('/html/body/div[4]/div[2]/div[2]/div[1]/div[1]/div[3]/ul[4]/li[3]/span').text
            if len(Hong_Kong_equity) > 0:
                result = result + "港股股本:" + str(Hong_Kong_equity) + "\r\n"
            #print 'result:' + result
        except Exception,e:
            hasInfo = False
            print "get infos from xpath failed, stock code is " + str(stock_code)
            driver.service.process.send_signal(signal.SIGTERM)
            driver.quit()
        driver.service.process.send_signal(signal.SIGTERM)
        driver.quit()
        #print str(hasInfo)
        if hasInfo:
            sql = "update xl_hk_real_time_share_price set stock_name='" + str(stock_name) + "',"\
"stock_time='" + str(stock_time) + "',"\
"stock_price='" + str(stock_price) + "',"\
"ups_and_downs='" + str(ups_and_downs) + "',"\
"rise_and_fall='" + str(rise_and_fall) + "',"\
"Yesterday_closing_price='" + str(Yesterday_closing_price) + "',"\
"highest_price='" + str(highest_price) + "',"\
"amplitude='" + str(amplitude) + "',"\
"price_file='" + str(price_file) + "',"\
"opening_price='" + str(opening_price) + "',"\
"minimum_price='" + str(minimum_price) + "',"\
"P_E_ratio='" + str(P_E_ratio) + "',"\
"lot_size='" + str(lot_size) + "',"\
"turnover_volume='" + str(turnover_volume) + "',"\
"52_weeks_maximum='" + str(i_52_weeks_maximum) + "',"\
"total_share_capital='" + str(total_share_capital)  + "',"\
"market_value_of_Hong_Kong_equities='" + str(market_value_of_Hong_Kong_equities)  + "',"\
"volume='" + str(volume)  + "',"\
"52_weeks_minimum='" + str(i_52_weeks_minimum)  + "',"\
"Hong_Kong_equity='" + str(Hong_Kong_equity)  + "' where stock_code='" + str(stock_code) + "'"
                
            #print 'sql:' + sql
            (conn, cur) = getConnAndCursor()
            cur.execute(sql)
            conn.commit()
            closeConnAndCursor(cur, conn)
                
if __name__ == '__main__':
    (conn_new, cur_new) = getConnAndCursor()
    stock_code_list = cur_new.execute("select stock_code, stock_name from hk_stock_list")
    stock_code_infos = cur_new.fetchmany(stock_code_list)
    closeConnAndCursor(cur_new, conn_new)
    g = getInfo()
    flag = True
    #while(flag):
    for stock_info in stock_code_infos:
            stock_code = str(stock_info[0])
            stock_name = str(stock_info[1])
            #print 'stock_code:' + stock_code
            #print 'stock_name:' + stock_name
            #try:
            #    #sql = "insert into xl_sz_real_time_share_price(stock_code, stock_name) VALUES ('" + str(stock_code) + "', '"+ stock_name + "')"
            #    sql = "insert into xl_hk_real_time_share_price(stock_code) VALUES ('" + str(stock_code) + "')"
            #    cur_new.execute(sql)
            #    conn_new.commit()
            #except Exception,e:
            #    print 'stock_code ' + stock_code + ' fialed'
            try:
                g.get(stock_code, stock_name)
            except Exception,e:
                print 'get() method failed'
                print 'stock_code:' + stock_code
                print 'stock_name:' + stock_name
        #flag = False
    #g = getInfo()
    #comId = '2335657694'
    #g.get(comId, "", "")
