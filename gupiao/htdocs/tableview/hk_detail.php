<?php
if(!isset($_SESSION['adminuser'])&&!isset($_SESSION['youke'])){
    header("location:/login.php");
}
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
$sql = "select * from xl_hk_value where code='$code'";
$codedetail = $db->selectOne($sql);
if(!$codedetail){
        header("location:/nofound.html");
}
//获取年份
$sql = "select distinct `year` from xl_hk_detail where code='$code' order by `year`  desc";
$yearlist = $db->select($sql);

//获取详情列表
$keyarr = array(
    "yingyee",
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
    "chubei",
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
</head>
<body>
<section class="vbox">
    <section class="panel panel-default">
        <header class="panel-heading" style="background-color: #3ab0e2;color: #fff0ff;margin: 0px 20px; font-size: 20px; text-align: center;">
            <?php echo $codedetail['name']; ?>(<?php echo $code;?>)
        </header>
        <div class="row text-sm wrapper">
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
        </div>
        <div class="table-responsive" id="list" style="margin:0px  0px 0px 20px; float: left; width: 200px;">
            <table class="table table-striped b-t b-light text-sm">
                <thead>
                <tr>
                    <th>时间</th>
                </tr>
                </thead>
                <tbody>
                <tr>
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
                </tr>
                <tr>
                    <td class="firsttd">ROE</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div id="list2" class="table-responsive" style="margin:0px  20px 0px 0px; overflow-x: scroll; float: left; width: 1200px;">
            <table class="table table-striped b-t b-light text-sm">
                <thead>
                <tr>
                    <?php foreach($yearlist as $y){ ?>
                    <th><?php echo $y['year'] ?></th>
                    <?php } ?>

                </tr>
                </thead>
                <tbody>
                <?php foreach($keyarr as $k){ ?>
                <tr>
                    <?php foreach($yearlist as $y){
                        $year = $y['year'];
                        $sql = "select * from xl_hk_detail where code='$code' and year='$year'";

                        $row = $db->selectOne($sql);
                        ?>
                    <td><?php if($k!='yingyee' && $k!='zongzichan'){ echo sprintf('%.3f',$row[$k]*100)."%";}else{ echo sprintf('%.3f',$row[$k]); } ?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    <section style="margin-left: 20px; margin-right: 20px; background-color: #ffffff;">
        <div id="mainLine1" style="float:left;height:300px; width:32%;margin:5px;"></div>
        <div id="mainLine2" style="float:left;height:300px; width:32%;margin:5px;"></div>
        <div id="mainLine3" style="float:left;height:300px; width:32%;margin:5px;"></div>
        <div id="mainLine4" style="float:left;height:300px; width:32%;margin:5px;"></div>
        <div id="mainLine5" style="float:left;height:300px; width:32%;margin:5px;"></div>
        <div id="mainLine6" style="float:left;height:300px; width:32%;margin:5px;"></div>
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
            cloudCharts1.setOption(getoption('总资产'));

            var cloudCharts2 = ec.init(document.getElementById('mainLine2'), theme);
            cloudCharts2.setOption(getoption('流动资产'));

            var cloudCharts3 = ec.init(document.getElementById('mainLine3'), theme);
            cloudCharts3.setOption(getoption('营业额'));

            var cloudCharts4 = ec.init(document.getElementById('mainLine4'), theme);
            cloudCharts4.setOption(getoption('销售成本'));

            var cloudCharts5 = ec.init(document.getElementById('mainLine5'), theme);
            cloudCharts5.setOption(getoption('毛利'));

            var cloudCharts6 = ec.init(document.getElementById('mainLine6'), theme);
            cloudCharts6.setOption(getoption('股息'));
        }
    );
    function getoption(title,key)
    {
        option = {
            title : {
                text: title,
                subtext: '',
                x: 'center',
                y:'25'
            },
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
                x:35,
                x2:15,
            },
            dataZoom : {
                show : true,
                realtime : true,
                start : 0,
                end : 100
            },
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    axisLine: {onZero: false},
                    data : [
                        '2009','2010','2011','2012','2013','2014','2015','2016'
                    ]
                }
            ],
            yAxis : [
                {
                    name : '',
                    type : 'value',
                    max : 50
                }
            ],
            series : [
                {
                    name:'流量',
                    type:'line',
                    itemStyle: {normal: {areaStyle: {type: 'default'}}},
                    data:[
                        1,10,20,5,10,1,12,5
                    ]
                }
            ]
        };

        return option;
    }
    $(document).ready(function(){
        $('#list2').find('tr').mouseover(function(){
            //console.log($(this).context.rowIndex);
            $(this).attr('style',"background-color:#F3F9FE");
            $('#list').find('tr').eq($(this).context.rowIndex).attr('style',"background-color:#F3F9FE");
        })
        $('#list2').find('tr').mouseout(function(index){
            $(this).removeAttr('style');
            $('#list').find('tr').eq($(this).context.rowIndex).removeAttr('style');
        })
        $('#list2').css('width',document.body.clientWidth-245+'px');
    })
</script>
</html>
