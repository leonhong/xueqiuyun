#encoding: utf-8
import scrapy
import sys
import time
from scrapy.selector import Selector
from scrapy.selector import HtmlXPathSelector
from scrapy.contrib.linkextractors import LinkExtractor
from scrapy.http import Request
from scrapy.contrib.spiders import CrawlSpider,Rule
import MySQLdb
from scrapy import FormRequest


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

class ExampleSpider(CrawlSpider):
    name = "hk_stock_history_info"
    #start_urls =['http://stock.finance.sina.com.cn/hkstock/history/00700.html']#url_list
    #rules=(
    #    Rule(LinkExtractor(allow=r"stock.finance.sina.com.cn/hkstock/rights/00700.html"),
    #    callback="parse_news",follow=False),
    #)
    
    headers = {
        "Accept":"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding":"gzip, deflate, sdch",
        "Accept-Language":"zh-CN,zh;q=0.8",
        "Connection":"keep-alive",
        "User-Agent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36"
    }
    
    def start_requests(self):
        #print 'into start_requests method'
        #stockCode = '00700'
        (conn_new, cur_new) = getConnAndCursor()
        stock_code_list = cur_new.execute("select stock_code from hk_stock_list")
        stock_code_infos = cur_new.fetchmany(stock_code_list)
        for stock_code in stock_code_infos:
            #print stock_code[0]
            stockCode = str(stock_code[0])
            next_url = 'http://stock.finance.sina.com.cn/hkstock/history/' + stockCode + '.html'
            yield Request(next_url,callback=lambda response, stockCode=stockCode : self.getInfo(response, stockCode), dont_filter=True)
        
    def post_login(self, response, stockCode, year, season):
        #print 'into post_login method'
        #print 'url1:' + response.url
        return [FormRequest(url=response.url,
                    formdata={"year":str(year), "season":str(season)},
                    callback=lambda response, stockCode=stockCode : self.getInfo(response, stockCode))]
    
    def parse_news(self, response):
        #print 'into parse_news'
        (conn_new, cur_new) = getConnAndCursor()
        stock_code_list = cur_new.execute("select stock_code from hk_stock_list")
        stock_code_infos = cur_new.fetchmany(stock_code_list)
        #for stock_code in stock_code_infos:
        #    #print stock_code[0]
        #    stockCode = str(stock_code[0])
        #    next_url = 'http://stock.finance.sina.com.cn/hkstock/history/' + stockCode + '.html'
        #    yield Request(next_url,callback=lambda response, stockCode=stockCode : self.getInfo(response, stockCode), dont_filter=True)
        closeConnAndCursor(cur_new, conn_new)
        next_url = 'http://stock.finance.sina.com.cn/hkstock/rights/00700.html'
        yield Request(next_url,callback=lambda response, stockCode=stockCode : self.getInfo(response, stockCode), dont_filter=True)
        
            
    def getInfo(self, response, stockCode):
        #print 'into getInfo method'
        (conn, cur) = getConnAndCursor()
        url = response.url
        #print 'url:' + url
        count = 2
        flag = True
        date=''
        stock_name=''
        closing_price=''
        price_rise=''
        rise_and_fall=''
        volume=''
        transaction_amount=''
        opening_price=''
        highest_price=''
        minimum_price=''
        while(flag):
            for i in range(1,11):
                #print 'i:' + str(i)
                xpath = '//*[@id="sub01_c2"]/table/tbody/tr[' + str(count) + ']/td[' + str(i) + ']/text()'
                text = response.xpath(xpath).extract()
                if i == 1 and len(str(text)) == 2:
                    flag = False
                    #print 'flag:' + str(flag) + ' | count:' + str(count)
                    break
                #print 'len:' + str(len(str(text)))
                #print 'text:' + str(text)
                if(i == 1 and len(text) > 0):
                    date = str(text[0])
                if(i == 2 and len(text) > 0):
                    stock_name = str(text[0])#.decode('gbk','ignore').encode('utf-8'))
                if(i == 3 and len(text) > 0):
                    closing_price = str(text[0])
                if(i == 4 and len(text) > 0):
                    price_rise = str(text[0])
                if(i == 5) and len(text) > 0:
                    rise_and_fall = str(text[0])
                if(i == 6 and len(text) > 0):
                    volume = str(text[0])
                if(i == 7 and len(text) > 0):
                    transaction_amount = str(text[0])
                if(i == 8 and len(text) > 0):
                    opening_price = str(text[0])
                if(i == 9 and len(text) > 0):
                    highest_price = str(text[0])
                if(i == 10 and len(text) > 0):
                    minimum_price = str(text[0].replace('\'', '"'))
                #if(i == 11 and len(text) > 0):
                #    class_of_shares = str(text[0])
            #flag = False
            count = count + 1
            (conn_new, cur_new) = getConnAndCursor()
            sql = "select MAX(date) from hk_storck_historical_transaction where stock_code = '" + stockCode + "'"
            date_list = cur_new.execute(sql)
            database_date = cur_new.fetchmany(date_list)
            #print 'database_date[0][0]:' + str(database_date[0][0])
            #print 'date:' + str(date)
            closeConnAndCursor(cur_new, conn_new)
            try:
                a_struct_time = time.strptime(str(database_date[0][0]), '%Y-%m-%d %H:%M:%S')
                b_struct_time = time.strptime(str(date), '%Y%m%d')
            except Exception, e:
                #print 'get time failed, code is ' + stockCode + ', name is ' + stock_name + ', data is ' + str(date) + ', url is ' + str(url) + ', xpath is ' + str(xpath)
                #if str(database_date[0][0]) == 'None':
                #    print 'database_date[0][0]:' + str(database_date[0][0])
                flag = False
                break
            if time.mktime(a_struct_time) < time.mktime(b_struct_time):
                sql = "INSERT INTO hk_storck_historical_transaction(stock_code,\
date,\
stock_name,\
closing_price,\
price_rise,\
rise_and_fall,\
volume,\
transaction_amount,\
opening_price,\
highest_price,\
minimum_price) VALUES ('" + stockCode + "', \
'" + date + "', \
'" + stock_name + "', \
'" + closing_price + "', \
'" + price_rise + "', \
'" + rise_and_fall + "', \
'" + volume + "', \
'" + transaction_amount + "', \
'" + opening_price + "', \
'" + highest_price + "', \
'" + minimum_price + "')"
                try:
                    print 'sql:' + sql
                    cur.execute(sql)
                    conn.commit()
                except Exception, e:
                    print 'errorSql:' + sql
            else:
                flag = False
                break
            
                    
        closeConnAndCursor(cur, conn)     
