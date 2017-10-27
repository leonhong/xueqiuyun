import base64
#class ProxyMiddleware(object):
## overwrite process request
#    def process_request(self, request, spider):
#        # Set the location of the proxy
#        request.meta['proxy'] = "http://proxy.abuyun.com:9020"
#        
#        # Use the following lines if your proxy requires authentication
#        proxy_user_pass = "HOD68Z55TZC8319D:A63620DAF4A33078"
#        # setup basic authentication for the proxy
#        encoded_user_pass = base64.b64encode(proxy_user_pass)
#        request.headers['Proxy-Authorization'] = 'Basic ' + encoded_user_pass
proxyServer = "http://proxy.abuyun.com:9020"

proxyUser = "HJA1354AT829M77D"
proxyPass = "F222C0D807890356"

# for Python2
proxyAuth = "Basic " + base64.b64encode(proxyUser + ":" + proxyPass)

# for Python3
#proxyAuth = "Basic " + base64.urlsafe_b64encode(bytes((proxyUser + ":" + proxyPass), "ascii")).decode("utf8")

class ProxyMiddleware(object):
    def process_request(self, request, spider):
        request.meta["proxy"] = proxyServer

        request.headers["Proxy-Authorization"] = proxyAuth   
