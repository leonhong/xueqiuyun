#coding: utf-8
import smtplib
import time
import datetime
from email.mime.text import MIMEText
import sys
import codecs


reload(sys)
#sys.setdefaultencoding('utf-8')

mailto_list = ['85848546@qq.com','2305515180@qq.com', '348713891@qq.com','89254840@qq.com','348238447@qq.com','ohhotj@qq.com','16225528@qq.com','42429157@qq.com','cyberzei@qq.com']
#mailto_list = ['85848546@qq.com']
mail_host = 'smtp.163.com'
mail_user = 'zhangguidinghuo@163.com'
mail_pass = 'xueqiuyun@@'
mail_pass = '85848546a'
def send_mail(to_list, sub, content):
    me=""+"<"+mail_user+">"
    msg = MIMEText(content,_subtype='html' ,_charset="utf-8")
    msg['Subject'] = sub
    msg['From'] = me
    msg["Accept-Language"]="zh-CN"
    msg["Accept-Charset"]="ISO-8859-1,utf-8"
    msg['To'] = ";".join(to_list)
    try:
        server = smtplib.SMTP()
        server.connect(mail_host)
        server.login(mail_user,mail_pass)
        server.sendmail(me, to_list, msg.as_string())
        server.close()
        return True
    except Exception, e:
        print str(e)
        return False

def GetContent(file):
    fp = codecs.open(file, "r","utf-8")
    str = fp.read()
    fp.close()
    return str

if __name__ == '__main__':
    del sys.argv[0]
    content = " ".join(sys.argv)
    #content = " ".join(sys.argv[1])
    #content = sys.argv[1]
    #subject = sys.argv[0]
    content = GetContent("./c.txt").encode('utf-8')
    #subject = GetContent("./s.txt").encode('utf-8')
    subject = GetContent("./s.txt")
    #subject = "【雪球云-恒生】股票新闻报警"
    #subject = "dadadadwwwww"
    #print subject
    #print content
    #sys.exit()
    today=datetime.date.today();
    oneday=datetime.timedelta(days=1);
    yesterday=today-oneday
    if send_mail(mailto_list, subject, content):
        print 'done!' 
    else:
        print 'failed!'
