# -*- coding:utf-8 -*-

import MySQLdb
import scrapy
from scrapy import Request
from scrapy import Selector
from scrapy.contrib.spiders import CrawlSpider
import time

import sys
reload(sys)
sys.setdefaultencoding('utf-8')
sys.stdout=open('content_output.txt','w') #将打印信息输出在相应的位置下

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

class SHRealTimeSpider(scrapy.Spider):
    name = "sh_real_info"
    headers = {
        "Accept":"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding":"gzip, deflate, sdch",
        "Accept-Language":"zh-CN,zh;q=0.8",
        "Connection":"keep-alive",
        "User-Agent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36"
    }


    def start_requests(self):
        (conn_new, cur_new) = getConnAndCursor()
        stock_code_list = cur_new.execute("select stock_code, stock_name from sh_stock_list")
        stock_code_infos = cur_new.fetchmany(stock_code_list)
        closeConnAndCursor(cur_new, conn_new)
        #g = getInfo()
        for stock_info in stock_code_infos:
                stock_code = str(stock_info[0])
                stock_name = str(stock_info[1])#.encode('gb2312')
                #print 'stock_code:' + stock_code
                #print 'stock_name:' + stock_name
                #sql = 'insert into xl_sh_real_time_share_price(stock_code) VALUES (' + str(stock_code) + ')'
                #cur_new.execute(sql)
                #conn_new.commit()
                try:
                    url = 'http://finance.sina.com.cn/realstock/company/sh' + str(stock_code) + '/nc.shtml'
                    yield Request(url=url, headers=self.headers, callback=self.getdata, meta={"stock_code": stock_code, "stock_name": stock_name})
                    #g.get(stock_code, stock_name)
                except Exception,e:
                    print 'get() method failed'
                    print 'stock_code:' + stock_code
                    print 'stock_name:' + stock_name
        #g = getInfo()
        #comId = '2335657694'
        #g.get(comId, "", "")i
    def getdata(self, response):
        stock_code=response.meta["stock_code"]
        stock_name=response.meta["stock_name"]
        
        print 'stock_code:' + stock_code
        print 'stock_name:' + stock_name
        print 'url:' + response.url

        stock_price = ''
        ups_and_downs = ''
        rise_and_fall = ''
        high_limit = ''
        low_limit = ''
        stock_time = ''
        opening_price = ''
        highest_price = ''
        minimum_price = ''
        Yesterday_closing_price = ''
        volume = ''
        turnover_volume = ''
        total_market_value = ''
        circulation_market_value = ''
        amplitude = ''
        turnover_rate = ''
        book_value = ''
        P_E_ratio = ''
        hasInfo = True
        
        #try:
        
        #实时股价
        stock_price = response.xpath('//*[@id="price"]/text()').extract()[0].encode("utf-8")
        if len(stock_price) > 0:
            result = "实时股价:" + str(stock_price) + "\r\n"
        #涨跌
        ups_and_downs = response.xpath('//*[@id="change"]/text()').extract()[0]
        if len(ups_and_downs) > 0:
            result = result + "涨跌:" + str(ups_and_downs) + "\r\n"
        #涨跌幅
        rise_and_fall = response.xpath('//*[@id="changeP"]/text()').extract()[0]
        if len(rise_and_fall) > 0:
            result = result + "涨跌幅:" + str(rise_and_fall) + "\r\n"
        #涨停价
        high_limit = response.xpath('//*[@id="ud_limie"]/div[1]/text()').extract()[0]
        if len(high_limit) > 0:
            result = result + "涨停价:" + str(high_limit) + "\r\n"
        #跌停价
        low_limit = response.xpath('//*[@id="ud_limie"]/div[2]/text()').extract()[0]
        if len(low_limit) > 0:
            result = result + "跌停价:" + str(low_limit) + "\r\n"
        #股价时间
        stock_time = response.xpath('//*[@id="hqTime"]/text()').extract()[0]
        if len(stock_time) > 0:
            result = result + "股价时间:" + str(stock_time) + "\r\n"
        #开盘价
        opening_price = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[1]/td[1]/text()').extract()[0]
        if len(opening_price) > 0:
            result = result + "开盘价:" + str(opening_price) + "\r\n"
        #最高价
        highest_price = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[2]/td[1]/text()').extract()[0]
        if len(highest_price) > 0:
            result = result + "最高价:" + str(highest_price) + "\r\n"
        #最低价
        minimum_price = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[3]/td[1]/text()').extract()[0]
        if len(minimum_price) > 0:
            result = result + "最低价:" + str(minimum_price) + "\r\n"
        #昨日收盘价
        Yesterday_closing_price = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[4]/td[1]/text()').extract()[0]
        if len(Yesterday_closing_price) > 0:
            result = result + "昨日收盘价:" + str(Yesterday_closing_price) + "\r\n"
        #成交量
        volume = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[1]/td[2]/text()').extract()[0]
        if len(volume) > 0:
            result = result + "成交量:" + str(volume) + "\r\n"
        #成交额
        turnover_volume = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[2]/td[2]/text()').extract()[0]
        if len(turnover_volume) > 0:
            result = result + "成交额:" + str(turnover_volume) + "\r\n"
        #总市值
        total_market_value = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[3]/td[2]/text()')#.extract()[0]
        print 'total_market_value:' + str(total_market_value.extract())
        total_market_value_double = 0
        if len(total_market_value) > 0:
            print 'result:' + result
            print 'total_market_value:' + total_market_value
            total_market_value_str = str(total_market_value).replace('亿', '').strip()
            print 'total_market_value_str:' + total_market_value_str
            total_market_value_double = float(total_market_value_str) * 100000000
            result = result + "总市值:" + str(total_market_value_double) + "\r\n"
        #流通市值
        circulation_market_value = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[4]/td[2]/text()').extract()[0]
        circulation_market_value_double = 0
        if len(circulation_market_value) > 0:
            circulation_market_value_str = str(circulation_market_value).replace('亿', '').strip()
            circulation_market_value_double = float(circulation_market_value_str) * 100000000
            result = result + "流通市值:" + str(circulation_market_value_double) + "\r\n"
        #振幅
        amplitude = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[1]/td[3]/text()').extract()[0]
        if len(amplitude) > 0:
            result = result + "振幅:" + str(amplitude) + "\r\n"
        #换手率
        turnover_rate = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[2]/td[3]/text()').extract()[0]
        if len(turnover_rate) > 0:
            result = result + "换手率:" + str(turnover_rate) + "\r\n"
        #市净率
        book_value = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[3]/td[3]/text()').extract()[0]
        if len(book_value) > 0:
            result = result + "市净率:" + str(book_value) + "\r\n"
        #市盈率
        P_E_ratio = response.xpath('//*[@id="hqDetails"]/table/tbody/tr[4]/td[3]/text()').extract()[0]
        if len(P_E_ratio) > 0:
            result = result + "市盈率:" + str(P_E_ratio) + "\r\n"
            #print 'result:' + result
        #except Exception,e:
        #    hasInfo = False
        #    print "get infos from xpath failed, stock code is " + str(stock_code)
        
        print 'hasInfo:' + str(hasInfo)
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

            print 'sql:' + sql
            (conn, cur) = getConnAndCursor()
            cur.execute(sql)
            conn.commit()
            closeConnAndCursor(cur, conn)
