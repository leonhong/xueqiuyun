#!/usr/bin/env python
#! -*- coding:utf-8 -*-

#from selenium import webdriver
#from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
import time
import sys
import urllib
import urllib2
proxyHost = "proxy.abuyun.com"
proxyPort = "9020"
proxyUser = "HOD68Z55TZC8319D"
proxyPass = "A63620DAF4A33078"

proxyMeta = "http://%(user)s:%(pass)s@%(host)s:%(port)s" % {
    "host" : proxyHost,
    "port" : proxyPort,
    "user" : proxyUser,
    "pass" : proxyPass,
}

proxy_handler = urllib2.ProxyHandler({
    "http"  : proxyMeta,
    "https" : proxyMeta,
})

opener = urllib2.build_opener(proxy_handler)
urllib2.install_opener(opener)

url='http://money.finance.sina.com.cn/corp/go.php/vDOWN_ProfitStatement/displaytype/4/stockid/600038/ctrl/all.phtml'
reqData = urllib2.urlopen(url, timeout = 3)
response= reqData.read()
print response
