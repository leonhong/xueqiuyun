# -*- coding:utf-8 -*-
import json
import logging

import MySQLdb
import scrapy
from HSstock.items import hs_xianjin
from scrapy import Request
import time

class xianjin(scrapy.Spider):
    name = "hsxianjin"
    headers = {
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Encoding": "gzip,deflate,br,sdch",
        "Accept-Language": "ezh-CN,zh;q=0.8,en;q=0.6",
        "Connection": "keep-alive",
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0"
    }

    custom_settings = {
        'ITEM_PIPELINES': {'HSstock.pipelines.hs_xianjin': 300},
        'LOG_LEVEL': "INFO"
    }

    def start_requests(self):
        self.update_time = str(time.strftime("%Y-%m-%d %H:%M:%S", time.localtime(time.time())))
        conn = MySQLdb.connect(
            host='127.0.0.1',
            port=3306,
            user='root',
            passwd='20160401',
            db='stock',
            charset='utf8'
        )
        cur = conn.cursor()
        sql = "select stock_code from sh_stock_list"
        cur.execute(sql)
        rows = cur.fetchall()
        for row in rows:
            code = row[0]
            url="http://money.finance.sina.com.cn/corp/go.php/vDOWN_CashFlow/displaytype/4/stockid/"+code+"/ctrl/all.phtml"
            yield Request(url=url,
                      headers=self.headers, callback=self.getdata, meta={"stock_code": code})

        cur = conn.cursor()
        sql = "select stock_code from sz_stock_list"
        cur.execute(sql)
        rows = cur.fetchall()
        for row in rows:
            code = row[0]
            url = "http://money.finance.sina.com.cn/corp/go.php/vDOWN_CashFlow/displaytype/4/stockid/" + code + "/ctrl/all.phtml"
            yield Request(url=url,
                          headers=self.headers, callback=self.getdata, meta={"stock_code": code})
        conn.close()

    def getdata(self,response):
        code=response.meta["stock_code"]
        data=response.body.decode("gb2312").encode("utf-8").split("\n")[0:-1]
        for i in range (0,len(data)):
            data[i]=data[i].split("\t")
        if data[3][0]=='客户贷款及垫款净减少额':
            for i in range(1,len(data[0])-2):
                item=hs_xianjin()
                item["bank"]=True
                item["code"]=code
                item["time"] = data[0][i]
                item["danwei"] = data[1][i]
                item["kehudaikuanjidiankuanjingjianshaoe"] = data[3][i]
                item["xiangyanghangjiekuanjingjianshaoe"] = data[4][i]
                item["kehuchunkuanxiangjingzengjiae"] = data[5][i]
                item["kehucunkuan"] = data[6][i]
                item["tongyejiqitajirongjigoujinge"] = data[7][i]
                item["shouhuicunfangtongyejinge"] = data[8][i]
                item["chaichuzijinxianjinliuru"] = data[9][i]
                item["shouhuidechaichuzijinjinge"] = data[10][i]
                item["xishoudemaichuhuigouxiangjinge"] = data[11][i]
                item["shouhuidemairufanshouxiangjinge"] = data[12][i]
                item["chuzhijiaoyixingjinrongzichanjingzengjiae"] = data[13][i]
                item["shouqulixishouxufeijiyongjindexianjin"] = data[14][i]
                item["shoudaolixi"] = data[15][i]
                item["shoudaodeshouxufei"] = data[16][i]
                item["jirongqiyewanglaishourushoudaodexianjin"] = data[17][i]
                item["zhongjianyewushourushoudaodexianjin"] = data[18][i]
                item["huiduijingshouyishoudaodexianjin"] = data[19][i]
                item["qitayingyejiyingyewaijingshourushoudaodexianjin"] = data[20][i]
                item["cunrubaozengjinshoudaodexianjin"] = data[21][i]
                item["shoudaodeweituozijin"] = data[22][i]
                item["guijinshuxianjinliuru"] = data[23][i]
                item["tiexianshoudaodezijin"] = data[24][i]
                item["xiaoshoushangpintigonglaowushoudaodexianjin"] = data[25][i]
                item["shoudaodesuifeifanhuan"] = data[26][i]
                item["qitafuzhaizengjialiurudexianjin"] = data[27][i]
                item["huishoudeyiyuyiqiannianduhexiaodedaikuanjiyingshoukuanxiang"] = data[28][i]
                item["qitayingfuzanshoukuanjianshaoliuchudexianjin"] = data[29][i]
                item["chuzhidizhaizichanshoudaodexianjin"] = data[30][i]
                item["shoudaoqitajingyinghuodongxianjin"] = data[31][i]
                item["jingyinghuodongxianjinliuruxiaoji"] = data[32][i]
                item["kehudaikuanjindianfukuanzengjiae"] = data[33][i]
                item["cunfangzhongyangyinhanghetongyekuanxiangjingzengjiae"] = data[34][i]
                item["cunfangzhongyangyinhang"] = data[35][i]
                item["cunfangtongyejiqitajigoucunkuan"] = data[36][i]
                item["chaichuzijijingxianjinliuru"] = data[37][i]
                item["changhuanzhongyangyinghangjinkuan"] = data[38][i]
                item["zhifudechunkuan"] = data[39][i]
                item["jianshaotongyejiqitajinrongjigoucunfangjinge"] = data[40][i]
                item["changhuantongyejiqitajinrongjigouchairujinge"] = data[41][i]
                item["changhuanmaichuhuigoukuanxiangjinge"] = data[42][i]
                item["zhengquantouzizhichudexianjin"] = data[43][i]
                item["zhifumairufanhushoukuanxiangjinge"] = data[44][i]
                item["chuzhikegongchushoujinrongzichanjingjianshaoe"] = data[45][i]
                item["zhifulixishouxufeijiyongjindexianjin"] = data[46][i]
                item["zhifudelixi"] = data[47][i]
                item["shouxufeizhichuzhifudexianjin"] = data[48][i]
                item["zhifugeizhigongjizhigongzhifudexianjin"] = data[49][i]
                item["zhifudegexianshuifei"] = data[50][i]
                item["yixianjinzhifudeyingyefeiyong"] = data[51][i]
                item["yuejinrongjigoufanglaizhichudexianjinjinge"] = data[52][i]
                item["tiexianzhifudexianjin"] = data[53][i]
                item["yihexiaodaizhangdaikuanjilixidehuishou"] = data[54][i]
                item["weituojidailiyewujianshaoe"] = data[55][i]
                item["guijinshuxianjinliuchu"] = data[56][i]
                item["goumaishangpinjieshoulaowuzhifudexianjin"] = data[57][i]
                item["jieruqitazijinjingjianshaoe"] = data[58][i]
                item["qitazijinjianshaozhichudexianjin"] = data[59][i]
                item["qitayingshouzhanfukuanjianshaohuishoudexianjin"] = data[60][i]
                item["zhifuqitayujingyinghuodongyouguandexianjin"] = data[61][i]
                item["jingyinghuodongxianjinliuchuxiaoji"] = data[62][i]
                item["jingyinghuodongchanshengdexianjinliuliangjinge"] = data[63][i]
                item["huishoutouzishoudaodexianjin"] = data[65][i]
                item["qudetouzishouyishoudaodexianjin"] = data[66][i]
                item["fendegulihuolirunsuoshoudaodexianjin"] = data[67][i]
                item["qudezhaiquanlixishourushoudaodexianjin"] = data[68][i]
                item["chuzhigudingzichanwuxingzichanshoudaodexianjin"] = data[69][i]
                item["chuzhiguquantouzisuoshoudaodexianjin"] = data[70][i]
                item["qudezigongsijiqitayingyedanweisuoshoudaodexianjinjinge"] = data[71][i]
                item["shoudaoqitayutouzihuodongyouguandexianjin"] = data[72][i]
                item["touzihuodongxianjinliuruxiaoji"] = data[73][i]
                item["touzizhifudexianjin"] = data[74][i]
                item["quanyixingtouzizengjiazhifudexianjin"] = data[75][i]
                item["zhaiquantouzisuozhifudexianjin"] = data[76][i]
                item["goumaizigongsilianyingqiyesuozhifudexianjin"] = data[77][i]
                item["zengjiazaijiangongchengsuozhifudexianjin"] = data[78][i]
                item["goujiangudingzichanwuxingzichanzhifudexianjin"] = data[79][i]
                item["qudezigongsijiqitayingyedanweizhifudexianjinjinge"] = data[80][i]
                item["zhifudeqitayutouzihuodongyouguandexianjin"] = data[81][i]
                item["touzihuodongxianjinliuchuxiaoji"] = data[82][i]
                item["touzihuodongchanshengdexianjinliuliangjinge"] = data[83][i]
                item["xishoutouzisuoshoudaodexianjin"] = data[85][i]
                item["faxingzhengquanhuazichansuoxishoudezijin"] = data[86][i]
                item["faxingzhengquanshoudaodexianji"] = data[87][i]
                item["faxingcijizhaiquanshoudaodexianjin"] = data[88][i]
                item["zengjiagubensuoshoudaodexianjin"] = data[89][i]
                item["shoudaoqitayuchouzihuodongyouguanzijin"] = data[90][i]
                item["chouzihuodongxianjinliuruxiaoji"] = data[91][i]
                item["changhuanzaiwusuozhifudexianjin"] = data[92][i]
                item["fenpeigulilirunhuochangfulixizhifudexianjin"] = data[93][i]
                item["changfulixisuozhifudexianjin"] = data[94][i]
                item["zhifuxigufaxingfeiyong"] = data[95][i]
                item["zhifuqitayuchouzihuodongyouguandexianjin"] = data[96][i]
                item["chouzihuodongxianjinliuchuxiaoji"] = data[97][i]
                item["chouzihuodongchanshengdexianjinliuliangjinge"] = data[98][i]
                item["huilvbiandongduixianjinjixianjindengjiawudeyingxiang"] = data[99][i]
                item["xianjinjixianjindengjiawujingzengjiae"] = data[100][i]
                item["qichuxianjinjixianjindengjiawuyue"] = data[101][i]
                item["qimoxianjinjixianjindengjiawuyue"] = data[102][i]
                item["jinglirun"] = data[104][i]
                item["shaoshugudongshouyi"] = data[105][i]
                item["jitizichanjianzhizunbei"] = data[106][i]
                item["jitidehuaizhangzhunbei"] = data[107][i]
                item["jitidedaikuanshunshizhunbei"] = data[108][i]
                item["conghuicunfangtongyejianzhizhunbei"] = data[109][i]
                item["gudingzichanzhejiu"] = data[110][i]
                item["touzixingfangdichanzhejiu"] = data[111][i]
                item["wuxingzichandiyanzichanqitazichantanxiao"] = data[112][i]
                item["wuxingzichantanxiao"] = data[113][i]
                item["changqitanxiaofeiyongdetanxiao"] = data[114][i]
                item["changqizichantanxiao"] = data[115][i]
                item["chuzhigudingzichandesunshi"] = data[116][i]
                item["chuzhitouzixingfangdichandesunshi"] = data[117][i]
                item["gudingzichanbaofeisunshi"] = data[118][i]
                item["chaiwufeiyong"] = data[119][i]
                item["touzishunshi"] = data[120][i]
                item["gongyunjiazhibiandong"] = data[121][i]
                item["huiduishunyi"] = data[122][i]
                item["yangshengjironggongjujiaoyijingsunyi"] = data[123][i]
                item["zhexianhuiba"] = data[124][i]
                item["cunhuodejianshao"] = data[125][i]
                item["daikuandejianshao"] = data[126][i]
                item["cunkuandezengjia"] = data[127][i]
                item["chaijiekuanxiangdejingzeng"] = data[128][i]
                item["jinrongxingzichandejianshao"] = data[129][i]
                item["yujifuzaidezengjia"] = data[130][i]
                item["shoudaoyihexiaokuanxiang"] = data[131][i]
                item["diyansuodeshuizichandejainshao"] = data[132][i]
                item["diyansuodeshuifuzaidezengjia"] = data[133][i]
                item["jingyingxingyingshouxiangmudezengjia"] = data[134][i]
                item["jingyingxingyingfuxiangmudezengjia"] = data[135][i]
                item["jingyingxingqitazichandejianshao"] = data[136][i]
                item["jingyingxingqitafuzaidezengjia"] = data[137][i]
                item["qita"] = data[138][i]
                item["jingyinghuodongxianjinliuliangjinge"] = data[139][i]
                item["yigudingzichanchanghuanfuzai"] = data[140][i]
                item["yitouzichanghuanfuzhai"] = data[141][i]
                item["yigudingzichanjingxingtouzi"] = data[142][i]
                item["zhaiwuzhuanweiziben"] = data[143][i]
                item["yinianneidaoqidekezhuanhuangongsidezhaiquan"] = data[144][i]
                item["rongzizhurugudingzichan"] = data[145][i]
                item["qitabushejixianjinzhishoudetouzihechouzihuodongjine"] = data[146][i]
                item["xianjindeqimoyue"] = data[147][i]
                item["xianjinchuqiyue"] = data[148][i]
                item["xianjindengjiawuqimoyue"] = data[149][i]
                item["xianjindengjiawuqichuyue"] = data[150][i]
                item["xianjinjixianjindengjiawuzengjiae"] = data[151][i]
                yield item
        else:
            for i in range(1,len(data[0])-2):
                item=hs_xianjin()
                item["bank"]=False
                item["code"] = code
                item["time"] = data[0][i]
                item["danwei"] = data[1][i]
                item["xiaoshoulaowusuodexianjin"] = data[3][i]
                item["kehujitongyecunkuanzengjiae"] = data[4][i]
                item["xiangyinhangjiekuanjingzengjiae"] = data[5][i]
                item["xiangqitajinrongjigouchairuzijinjingzengjiae"] = data[6][i]
                item["shoudaoyuanbaoxianhetongbaofeiqudedexianjin"] = data[7][i]
                item["shoudaozaibaoxianyewuxianjinjinge"] = data[8][i]
                item["baohuchujinjitouzikuanjingzengjiae"] = data[9][i]
                item["chuzhijiaoyixingjirongzichanjingzengjiae"] = data[10][i]
                item["shouqulixishouxufeijiyongjindexianjin"] = data[11][i]
                item["chairuzijijingzengjiae"] = data[12][i]
                item["huigouyewuzijijingzengjiae"] = data[13][i]
                item["shoudaodeshuifeifanhui"] = data[14][i]
                item["shoudaoqitayingyeyouguanxianjin"] = data[15][i]
                item["yingyehuodongliuruxianjinxiaoji"] = data[16][i]
                item["goumaishangpinjieshoulaowuzhhifuxianjin"] = data[17][i]
                item["kehudaiquanjidiankuanjingzengjiae"] = data[18][i]
                item["cunfangzhongyangyinhanghetongyekuanxiangjingzengjiae"] = data[19][i]
                item["zhifuyuanbaoxianhetongpeifukuanxiangxianjin"] = data[20][i]
                item["zhifulixishouxufeiyongjindexianjin"] = data[21][i]
                item["zhifubaodanhonglidexianjin"] = data[22][i]
                item["zhifugeizhigongyijiweizhigongzhifudexianjin"] = data[23][i]
                item["zhifugexiangshuifei"] = data[24][i]
                item["zhifudeqitayingyeyouguanxianjin"] = data[25][i]
                item["yingyehuodongxianjinliuchuxiaoji"] = data[26][i]
                item["yingyehuodongxianjinliuliangjinge"] = data[27][i]
                item["shouhuitouzisuoshoudaoxianjin"] = data[29][i]
                item["qudetouzishouyi"] = data[30][i]
                item["chuzhigudingzichan"] = data[31][i]
                item["chuzhizigongsi"] = data[32][i]
                item["shoudaoqitatouzi"] = data[33][i]
                item["jianshaozhiya"] = data[34][i]
                item["touzihuodongshouruxiaoji"] = data[35][i]
                item["goujiangudingzichan"] = data[36][i]
                item["touzisuofuxianjin"] = data[37][i]
                item["zhiyadaikuanjingzengjiae"] = data[38][i]
                item["qudezigongsijiqitayingyedanweizhifudexianjinjinge"] = data[39][i]
                item["zhifudeqitayutouziyouguandexianjin"] = data[40][i]
                item["zengjhiazhiyahedingqicunkuansuozhishoudexianjin"] = data[41][i]
                item["touzihuodongliuchuxianjinxiaoji"] = data[42][i]
                item["touzihuodongchanshengdexianjinliuliangjinge"] = data[43][i]
                item["xishoutouzishoudaodexianjin"] = data[45][i]
                item["zigongsixishoushaoshugudongtouzishoudaodexianjin"] = data[46][i]
                item["qudejiekuanshoudaodexianjin"] = data[47][i]
                item["faxingzaiquanshoudaodexianjin"] = data[48][i]
                item["shoudaoqitayuchaozihuodongyouguandexianjin"] = data[49][i]
                item["chouzihuodongxianjinliuruxiaoji"] = data[50][i]
                item["changhuanzhaiwuzhifudexianjin"] = data[51][i]
                item["fenpeigulilirunsuozhifudexianjin"] = data[52][i]
                item["zhifuqitachouzihuodongyouguanxianjin"] = data[54][i]
                item["chouzihuodongxianjinliuchuxiaoji"] = data[55][i]
                item["chouzihuodongchanshengdexianjinliuliangjinge"] = data[56][i]
                item["huilvbiandongyingxiang"] = data[58][i]
                item["xianjinjixianjindengjiawujingzengjiae"] = data[59][i]
                item["qichuxianjinyue"] = data[60][i]
                item["qimoxianjinyue"] = data[61][i]
                item["jinglirun"] = data[62][i]
                item["shaoshugudongquanyi"] = data[63][i]
                item["weiquerentouzishunshi"] = data[64][i]
                item["zichanjianzhizhunbei"] = data[65][i]
                item["zhejiu"] = data[66][i]
                item["wuxingzichantanxiao"] = data[67][i]
                item["changqitanxiaofeiyongtanxiao"] = data[68][i]
                item["tanxiaofeiyongdejianshao"] = data[69][i]
                item["yutifeiyongdezengjia"] = data[70][i]
                item["chuzhigudingzichandetanxiao"] = data[71][i]
                item["gudizichanbaofeisunshi"] = data[72][i]
                item["gongyunjiazhibiandongsunshi"] = data[73][i]
                item["diyanshouyizengjia"] = data[74][i]
                item["yujifuzai"] = data[75][i]
                item["caiwufeiyong"] = data[76][i]
                item["touzisunshi"] = data[77][i]
                item["diyansuodeshuizichanjianshao"] = data[78][i]
                item["diyansuodeshuifuzaizengjia"] = data[79][i]
                item["cunhuodejianshao"] = data[80][i]
                item["jingyingxingyingshouxiangmudejianshao"] = data[81][i]
                item["jingyingxingyingshouxiangmudezengjia"] = data[82][i]
                item["yiwangongshangweijiesunkuandejianshao"] = data[83][i]
                item["yijiesuanshaoweiwangongkuandezengjia"] = data[84][i]
                item["qita"] = data[85][i]
                item["jingyinghuodongchanshengxianjinliuliangjinge"] = data[86][i]
                item["zhaiwuzhuanweiziben"] = data[87][i]
                item["yinianneidaoqidekezhuanhuangongsizhaiquan"] = data[88][i]
                item["rongzizhurugudingzichan"] = data[89][i]
                item["xianjindeqimoyue"] = data[90][i]
                item["xianjindeqichuyue"] = data[91][i]
                item["xianjindengjiawudeqimpyue"] = data[92][i]
                item["xianjindengjiawudeqichuyue"] = data[93][i]
                item["xianjinjixianjindengjiawudejingzengjia"] = data[94][i]
                yield item
