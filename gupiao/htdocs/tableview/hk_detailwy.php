<?php
//session_start();
//if(!isset($_SESSION['adminuser'])&&!isset($_SESSION['youke'])){
//	header("location:/login.php");
//}
//$long = time()-$_SESSION['login_time'];
//if($long/60>60*12){
//	header("location:/out.php");
//}
header("content-type:text/html;charset=utf-8");
set_time_limit(18000000);
ini_set("display_errors", "On");
/**
 * 执行股票列表计算
 */
$basedir = dirname(__FILE__) . '/../../lib';
include  $basedir.'/config.php';
include  $basedir.'/functions.php';
include $basedir.'/mysqli.php';



$db_conf['host'] = 'localhost';
$db_conf['username'] = 'root';
$db_conf['password'] = '20160401';
$db_conf['database'] = 'stock';
$db_conf['prot'] = '3306';
/*配置数据库*/
/*实例DB*/
$db =  new DB($db_conf);

$code = $_GET['code'];
//获取股票详情
$sql = "select * from xl_hk_detail where code='$code'";
$codedetail = $db->selectOne($sql);
if(!$codedetail){
        header("location:/nofound.html");
}
$sql = "select * from xl_hk_value where code='$code'";
$codedetail = $db->selectOne($sql);
$noewyear = date('Y');
//获取年份
$sql = "select distinct `year` from xl_hk_detail where code='$code' and `year`!=$noewyear and roe !='0' order by `year`  desc";
$yearlist = $db->select($sql);

//获取详情列表
$keyarr = array(
    /*"yingyee",
    "xiaoshouchengben",
    "maoli",
    "xiaoshoujifeixiaofeiyong",
    "yibanjixingzhengfeiyong",
    "lixifeiyong",
    "jingyingyingli",
    "feijingchangxingshouyi",
    "gudongyingzhanyingli",
    "guxi",
    "zongzichan",
    "liudongzichan",
    "xianjinjiyinhangjiecun",
    "yingshouzhangkuan",
    "cunhuo",
    "feiliudongzichan",
    "fushugongsiquanyi",
    "wuyechangfangshebei",
    "lianyinggongsiquanyi",
    "wuxingzichan",
    "qitatouzi",
    "zongfuzai",
    "liudongfuzai",
    "yinhangdaikuan",
    "yingfuzhangkuan",
    "feiliudongfuzai",
    "feiliudongyinhangdaikuan",
    "jingzichan",
    "gudongquanyi",
    "shaoshugudongquanyi",
    "chubei",*/
    'roe'
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/font.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/app.css" type="text/css" />
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="js/echarts/echarts.js"></script>
    <link rel="stylesheet" type="text/css" href="css/detail.css"/>
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body>
<section class="vbox">
    <section class="panel panel-default">
        <!--<header class="panel-heading" style="background-color: #3ab0e2;color: #fff0ff;margin: 0px; font-size: 20px; text-align: center;">-->
        <header class="panel-heading" style="background-color: #3ab0e2;color: #fff0ff;margin: 0px; font-size: 20px; text-align: center;position: relative;">
            <a class="title_btn" href="javascript:history.go(-1)">返回</a>
        	<h4 style="color: #fff0ff;">股票详情</h4>
			<div class="hweixin-margin">
				<img src="img/weixin_logo.png" class="hweixin-img"><span class="hweixin-span">imhobgliang<span></div>
	        </div>
        </header>
        <!--<div class="row text-sm wrapper">
            <div class="col-sm-4 m-b-xs">
                <div class="btn-group" id="tab" data-toggle="buttons">
                    <label class="btn btn-sm btn-danger active">
                        <input type="radio" name="options" id="option1" item="yingye"> 按年度
                    </label>
                    <label class="btn btn-sm btn-default">
                        <input type="radio" name="options" id="option2" item="zichan"> 按报告期
                    </label>
                </div>
            </div>
        </div>-->
        <div class="wrapper hktitle">
	        <h3><?php echo $codedetail['name']; ?>(<?php echo $code;?>)</h3>
	        <h1><?php echo $codedetail['gujia'];?></h1>
	        <small><?php echo $codedetail['update_time']?></small>
        </div>
        <?php
        $sql = "select * from xl_hk_huizong where code='$code'";
        $huizong = $db->selectOne($sql);

        ?>
        <div class="wrapper hk_detailwy">
        	<div class="col-md-6">
        		<table class="table">
	        		<tr>
	        			<td><span>财报时间</span> </td>
	        			<td><?php echo $huizong['ctime']; ?></td>
	        		</tr>
	        		<tr>
	        			<td><span>市值(亿)</span></td>
	        			<td><?php echo sprintf('%.3f',($huizong['shizhi']/100000000)); ?></td>
	        		</tr>
	        		<tr>
	        			<td><span>TTM</span> </td>
	        			<td><?php echo sprintf('%.3f',$huizong['ttm']); ?></td>
	        		</tr>
	        		<tr>
	        			<td><span>PB</span></td>
	        			<td><?php echo sprintf('%.3f',$huizong['pb']); ?></td>
	        		</tr>
	        		<tr>
	        			<td><span>ROE</span></td>
	        			<td><?php echo sprintf('%.3f',$huizong['roe']*100)."%"; ?></td>
	        		</tr>    
	        		<tr>
	        			<td><span>股息率</span></td>
	        			<td><?php echo sprintf('%.3f',$huizong['dyr']*100).'%'; ?></td>
	        		</tr>    		
	        	</table>
	        	<table class="table table2" >	        		
	        		<tr>
	        			<td><span>资产负债率</span></td>
	        			<td><?php echo sprintf('%.3f',$huizong['debtratio']*100).'%'; ?></td>
	        		</tr>
	        		<tr>
	        			<td><span>净净流动资产（亿）</span></td>
	        			<td><?php echo sprintf('%.3f',($huizong['jinjin']/100000000)); ?></td>
	        		</tr>
	        		<tr>
	        			<td><span>净净/市值</span></td>
	        			<td><?php echo sprintf('%.3f',(($huizong['jinjin']/100000000)/($huizong['shizhi']/100000000))*100)."%"; ?></td>
	        		</tr>
	        		<tr>
	        			<td><span>Rank(TTM)</span></td>
	        			<td><?php echo $huizong['rank_ttm']; ?></td>
	        		</tr>
	        		<tr>
	        			<td><span>Rank(ROE)</span></td>
	        			<td><?php echo $huizong['rank_roe']; ?></td>
	        		</tr>
	        		<tr>
	        			<td><span>Rank</span></td>
	        			<td><?php echo $huizong['rank_all']; ?></td>
	        		</tr>
	        	</table>
        	</div>
        	<div class="col-md-6" style="padding-right: 0;">
        		<div id="mainLine1" style="float:left;height:289px; width:100%;margin:0;"></div>
        		<div id="list2" class="table-responsive">
		            <table class="table table-striped b-t b-light text-sm">
		                <thead>
		                <tr>
		                    <?php foreach(array_reverse($yearlist) AS $key=>$y){ ?>
		                        <th><div><?php echo $y['year'] ?></div></th>
		                    <?php } ?>
		
		                </tr>
		                </thead>
		                <tbody>
		                <?php foreach(array_reverse($keyarr) AS $key=>$k){ ?>
		                    <tr>
		                        <?php foreach(array_reverse($yearlist) AS $key=>$y){
		                            $year = $y['year'];
		                            $sql = "select * from xl_hk_detail where code='$code' and year='$year'";
		
		                            $row = $db->selectOne($sql);
		                            ?>
		                            <td><div><?php if($k!='yingyee' && $k!='zongzichan'){ echo sprintf('%.3f',$row[$k]*100)."%";}else{ echo sprintf('%.3f',$row[$k]); } ?></div></td>
		                        <?php } ?>
		                    </tr>
		                <?php } ?>
		                </tbody>
		            </table>
		        </div>
        	</div>
        	<div style="clear: both;"></div>
        </div>
        <!--<div class="table-responsive" id="list" style="margin:0px  0px 0px 20px; float: left; width: 200px;">
            <table class="table table-striped b-t b-light text-sm">
                <thead>
                <tr>
                    <th>时间</th>
                </tr>
                </thead>
                <tbody>
                <!--<tr>
                    <td class="firsttd">营业额</td>
                </tr>
                <tr>
                    <td class="firsttd">销售成本</td>
                </tr>
                <tr>
                    <td class="firsttd">毛利</td>
                </tr>
                <tr>
                    <td class="firsttd">销售及分销费用</td>
                </tr>
                <tr>
                    <td class="firsttd">一般及行政费用</td>
                </tr>
                <tr>
                    <td class="firsttd">利息费用/融资成本</td>
                </tr>
                <tr>
                    <td class="firsttd">经营盈利</td>
                </tr>
                <tr>
                    <td class="firsttd">非经常性收益(亏损)</td>
                </tr>
                <tr>
                    <td class="firsttd">股东应占盈利/(亏损)</td>
                </tr>
                <tr>
                    <td class="firsttd">股息</td>
                </tr>
                <tr>
                    <td class="firsttd">总资产</td>
                </tr>
                <tr>
                    <td class="firsttd">流动资产</td>
                </tr>
                <tr>
                    <td class="firsttd">现金及银行结存(流动资产)</td>
                </tr>
                <tr>
                    <td class="firsttd">应收账款(流动资产)</td>
                </tr>
                <tr>
                    <td class="firsttd">存货(流动资产)</td>
                </tr>
                <tr>
                    <td class="firsttd">非流动资产</td>
                </tr>
                <tr>
                    <td class="firsttd">附属公司权益(非流动资产)</td>
                </tr>
                <tr>
                    <td class="firsttd">物业、厂房及设备(非流动资产)</td>
                </tr>
                <tr>
                    <td class="firsttd">联营公司权益 (非流动资产)</td>
                </tr>
                <tr>
                    <td class="firsttd">无形资产(非流动资产)</td>
                </tr>
                <tr>
                    <td class="firsttd">其他投资(非流动资产)</td>
                </tr>
                <tr>
                    <td class="firsttd">总负债</td>
                </tr>
                <tr>
                    <td class="firsttd">流动负债</td>
                </tr>
                <tr>
                    <td class="firsttd">银行贷款(流动负债)</td>
                </tr>
                <tr>
                    <td class="firsttd">应付帐款(流动负债)</td>
                </tr>
                <tr>
                    <td class="firsttd">非流动负债</td>
                </tr>
                <tr>
                    <td class="firsttd">非流动银行贷款</td>
                </tr>
                <tr>
                    <td class="firsttd">净资产/(负债)</td>
                </tr>
                <tr>
                    <td class="firsttd">股东权益/(亏损)</td>
                </tr>
                <tr>
                    <td class="firsttd">少数股东权益 - (借)/贷</td>
                </tr>
                <tr>
                    <td class="firsttd">储备</td>
                </tr>-->
                <!--<tr>
                    <td class="firsttd">ROE</td>
                </tr>

                </tbody>
            </table>
        </div>-->
        
    </section>
    
    <section style="margin-left: 20px; margin-right: 20px; background-color: #ffffff;">
        <!--<div id="mainLine1" style="float:left;height:300px; width:90%;margin:5px 5%;"></div>-->
        <!--<div id="mainLine2" style="float:left;height:300px; width:32%;margin:5px;"></div>
        <div id="mainLine3" style="float:left;height:300px; width:32%;margin:5px;"></div>
        <div id="mainLine4" style="float:left;height:300px; width:32%;margin:5px;"></div>
        <div id="mainLine5" style="float:left;height:300px; width:32%;margin:5px;"></div>
        <div id="mainLine6" style="float:left;height:300px; width:32%;margin:5px;"></div>-->
    </section>
</section>
</body>
<script type="text/javascript">
    /*$(document).ready(function(){
     $('input[name=options]').click(function(){
     $('#tab').find('label').attr('class','btn btn-sm btn-default');
     $(this).parent().attr('class','btn btn-sm btn-danger active');
     var tableid = $(this).attr('item');
     $('.table-responsive').find('table').hide();
     $('#'+tableid).show();
     })
     });*/
    // Step:3 conifg ECharts's path, link to echarts.js from current page.
    // Step:3 为模块加载器配置echarts的路径，从当前页面链接到echarts.js，定义所需图表路径
    require.config({
        paths: {
            echarts: './js/echarts'
        }
    });

    // Step:4 require echarts and use it in the callback.
    // Step:4 动态加载echarts然后在回调函数中开始使用，注意保持按需加载结构定义图表路径
    var dark;
    require(
        [
            'echarts',
            'echarts/theme/macarons',
            'echarts/chart/line',
            'echarts/chart/bar'
        ],
        function (ec,theme) {
            var cloudCharts1 = ec.init(document.getElementById('mainLine1'), theme);
            cloudCharts1.setOption(getoption('ROE'));
			$(window).resize(function(){
				var cloudCharts1 = ec.init(document.getElementById('mainLine1'), theme);
				cloudCharts1.setOption(getoption('ROE'));
			})
            /*var cloudCharts2 = ec.init(document.getElementById('mainLine2'), theme);
            cloudCharts2.setOption(getoption('流动资产'));

            var cloudCharts3 = ec.init(document.getElementById('mainLine3'), theme);
            cloudCharts3.setOption(getoption('营业额'));

            var cloudCharts4 = ec.init(document.getElementById('mainLine4'), theme);
            cloudCharts4.setOption(getoption('销售成本'));

            var cloudCharts5 = ec.init(document.getElementById('mainLine5'), theme);
            cloudCharts5.setOption(getoption('毛利'));

            var cloudCharts6 = ec.init(document.getElementById('mainLine6'), theme);
            cloudCharts6.setOption(getoption('股息'));*/
        }
    );
    function getoption(title,key)
    {   	
        <?php $shiijan = array();  foreach(array_reverse($yearlist) AS $key=>$y){ $shijian[] = $y['year']; } ?>
        var shijian = eval(<?php echo json_encode($shijian); ?>);
        var shuju = [<?php $i=0; foreach(array_reverse($yearlist) AS $key=>$y){$year = $y['year'];$sql = "select * from xl_hk_detail where code='$code' and year='$year'";$row = $db->selectOne($sql);  echo $i=='0'?sprintf('%.3f',($row[$k]*100)):','.sprintf('%.3f',$row[$k]*100); $i++; } ?>];
        option = {
            tooltip : {
                trigger: 'axis'
            },
            title : {
                text: "历史"+title,
                subtext: '',
                x: 'center',
                y:'25',
                textStyle: {
                	 color: '#0081f2'
                }
            },
            color:['#1dbb72'],
            /*toolbox: {
             show : true,
             feature : {
             mark : {show: false},
             dataView : {show: false, readOnly: false},
             magicType : {show: true, type: ['line', 'bar']},
             restore : {show: true},
             saveAsImage : {show: true}
             },
             x:'330'
             },*/
            grid: {
                borderWidth: 0,
                x:45,
                x2:15
            },
//          dataZoom : {
//              show : true,
//              realtime : true,
//              start : 0,
//              end : 100
//          },
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    axisLine: {onZero: false},
                    data : shijian
                }
            ],
            yAxis : [
                {
                    name : '',
                    type : 'value',
                //    max : 10000,
//              	axisLabel: {
//              		rotate: 45
//              	}
                }
            ],
            series : [
                {
                    name:'ROE',
                    type:'line',
                    itemStyle: {normal: {areaStyle: {type: 'default'}}},
                    data:shuju
                }
            ]
        };

        return option;
    }
    $(document).ready(function(){
//      $('#list2').find('tr').mouseover(function(){
//          //console.log($(this).context.rowIndex);
//          $(this).attr('style',"background-color:#F3F9FE");
//          $('#list').find('tr').eq($(this).context.rowIndex).attr('style',"background-color:#F3F9FE");
//      })
//      $('#list2').find('tr').mouseout(function(index){
//          $(this).removeAttr('style');
//          $('#list').find('tr').eq($(this).context.rowIndex).removeAttr('style');
//      })
//      $('#list2').css('width',document.body.clientWidth-245+'px');
		var length=$(".hk_detailwy .table-responsive thead th").length;
		var w=85*length;
		if($(".hk_detailwy .table-responsive").width()>w){
		    $(".hk_detailwy .table-responsive table").width($(".hk_detailwy .table-responsive").width())
	    }else{
	    	$(".hk_detailwy .table-responsive table").width(w)
	    }
		$(window).resize(function(){
			if($(".hk_detailwy .table-responsive").width()>w){
			    $(".hk_detailwy .table-responsive table").width($(".hk_detailwy .table-responsive").width())
		    }else{
		    	$(".hk_detailwy .table-responsive table").width(w)
		    }
		})
    })
</script>
</html>
