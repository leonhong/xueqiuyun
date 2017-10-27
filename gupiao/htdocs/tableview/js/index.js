$(function() {
    getcontent();
    $(".maxtipbtn").on({
        mouseover: function() {
            $(".maxtip").show();
        },
        mouseleave: function() {
            $(".maxtip").hide();
        }
    })
    $("#lft a").on({
        mouseover: function() {
            $(this).find("span").show();
        },
        mouseleave: function() {
            $("#lft a").find("span").hide()
        }
    })
    $(".widget-preview").on({
        mouseover: function() {
            $(this).find(".delwidget").show();
        },
        mouseleave: function() {
            $(this).find(".delwidget").hide();
        },
        click: function() {
            $(this).css("border", "1px solid #4f80ff");
            $(this).find(".delwidget").show();
        }
    })
    /*var headerCells = $('.widget-preview .header table tr:first th');

    $('.widget-preview .body table tr:first td').each(function(i, n) {
        $(this).css('width', headerCells.eq(i).css('width'));
    });

    //关联宽度
    $(window).resize(function() {
        $('.widget-preview .header').width($('.widget-preview > .body table').width());
    }).triggerHandler('resize');*/

    //选择图表
    $('.menu-item-list li').click(function(){
        var tu_type = $(this).attr('item');
        $('.menu-item-list li div i').removeAttr('id');
        $(this).find('i').attr('id','leftborder');

        switch(tu_type){
            case 'lChart':
                $('.right_block').show();
                $('#dlist').show();
                $('#fenlei').parent().show();
                $('#yname').parent().show();
                $('#xname').height('30');
                $('#xname').parent().show();
                $('#dlist').append($('#yname').html());
                $('#dlist').append($('#xname').html());
                $('#dlist').append($('#fenlei').html());
                $('#yname').find('div').remove();
                $('#xname').find('div').remove();
                $('#fenlei').find('div').remove();
                $('#container').show();
                $('.content_word').hide();
                zhexian_show(false,false);
                break;
            case 'bGraph':
                $('.right_block').show();
                $('#dlist').show();
                $('#fenlei').parent().show();
                $('#yname').parent().show();
                $('#xname').height('30');
                $('#xname').parent().show();
                $('#dlist').append($('#yname').html());
                $('#dlist').append($('#xname').html());
                $('#dlist').append($('#fenlei').html());
                $('#yname').find('div').remove();
                $('#xname').find('div').remove();
                $('#fenlei').find('div').remove();
                $('#container').show();
                $('.content_word').hide();
                zhu_show(false,false);
                break;
            case 'pie':
                $('.right_block').show();
                $('#dlist').show();
                $('#fenlei').parent().show();
                $('#xname').height('30');
                $('#xname').parent().show();
                $('#dlist').append($('#yname').html());
                $('#dlist').append($('#xname').html());
                $('#dlist').append($('#fenlei').html());
                $('#yname').find('div').remove();
                $('#xname').find('div').remove();
                $('#fenlei').find('div').remove();
                $('#yname').parent().hide();
                $('#container').show();
                $('.content_word').hide();
                bing_show();
                break;
            case 'biao':
                $('#container').show();
                $('.content_word').hide();
                biao_show();
                break;
            case 'sandian':
                $('.right_block').show();
                $('#dlist').show();
                $('#fenlei').parent().hide();
                $('#yname').parent().show();
                $('#xname').height('30');
                $('#xname').parent().show();
                $('#dlist').append($('#yname').html());
                $('#dlist').append($('#xname').html());
                $('#dlist').append($('#fenlei').html());
                $('#yname').find('div').remove();
                $('#xname').find('div').remove();
                $('#fenlei').find('div').remove();
                $('#container').show();
                $('.content_word').hide();
                sandian_show();
                break;
            case 'leida':
                $('.right_block').show();
                $('#dlist').show();
                $('#fenlei').parent().hide();
                $('#xname').height('300');
                $('#xname').parent().show();
                $('#dlist').append($('#yname').html());
                $('#dlist').append($('#xname').html());
                $('#dlist').append($('#fenlei').html());
                $('#yname').find('div').remove();
                $('#xname').find('div').remove();
                $('#fenlei').find('div').remove();
                $('#yname').parent().hide();
                $('#container').show();
                $('.content_word').hide();
                leida_show(false);
                break;
            case 'zuobiao':
                $('.right_block').show();
                $('#dlist').show();
                $('#fenlei').parent().show();
                $('#xname').height('300');
                $('#xname').parent().show();
                $('#dlist').append($('#yname').html());
                $('#dlist').append($('#xname').html());
                $('#dlist').append($('#fenlei').html());
                $('#yname').find('div').remove();
                $('#xname').find('div').remove();
                $('#fenlei').find('div').remove();
                $('#yname').parent().hide();
                $('#container').show();
                $('.content_word').hide();
                zuobiao_show(false,false);
                break;

            case 'ciyun':
                $('.right_block').show();
                $('#dlist').show();
                $('#dlist').append($('#yname').html());
                $('#dlist').append($('#xname').html());
                $('#dlist').append($('#fenlei').html());
                $('#yname').find('div').remove();
                $('#xname').find('div').remove();
                $('#fenlei').find('div').remove();
                $('#fenlei').parent().show();
                $('#yname').parent().hide();
                $('#xname').parent().hide();
                $('#container').show();
                $('.content_word').hide();
                var data=[ "沈阳","鞍山","本溪","朝阳", "大连", "丹东", "抚顺", "阜新", "葫芦岛", "锦州", "辽阳", "盘锦","铁岭", "营口","沈阳","鞍山","本溪","朝阳", "大连", "丹东", "抚顺", "阜新", "葫芦岛", "锦州", "辽阳", "盘锦","铁岭", "营口","沈阳","鞍山","本溪","朝阳", "大连", "丹东", "抚顺", "阜新", "葫芦岛", "锦州", "辽阳", "盘锦","铁岭", "营口","沈阳","鞍山","本溪","朝阳", "大连", "丹东", "抚顺", "阜新", "葫芦岛", "锦州", "辽阳", "盘锦","铁岭", "营口"];
                $('#container').hide();
                $('.content_word').show();
                $('.content_word svg').html('');
                keyword(data);
                break;
            default:
                alert('当前功能正在开发中！');
                break;
        }
        $('input[name=show_type]').val(tu_type);
        $('#tuload').hide();
        //$('#container').html('');
    })

    //生成图表
    $('#create').click(function(){
        var show_type = $('input[name=show_type]').val();

        switch(show_type){
            case 'lChart':
                zhexian_data();
                break;
            case 'bGraph':
                zhu_data();
                break;
            case 'pie':
                bing_data();
                break;
            case 'sandian':
                sandian_data();
                break;
            case 'leida':
                leida_data();
                break;
            case 'zuobiao':
                zuobiao_data();
                break;
            case 'ciyun':
                ciyun_data();
                break;
        }
    })
    $('#reset').click(function(){
        $('#dlist').append($('#yname').html());
        $('#dlist').append($('#xname').html());
        $('#dlist').append($('#fenlei').html());
        $('#yname').find('div').remove();
        $('#xname').find('div').remove();
        $('#fenlei').find('div').remove();
    })
})

//获取列表
function getcontent()
{
    var sql = window.localStorage.getItem('sql');
    /*var table_name = window.localStorage.getItem('table_name');
    var user_name = window.localStorage.getItem('user_name');
    var data_path = window.localStorage.getItem('data_path');*/
    var table_name ='order_table';
     var user_name = 'order';
     var data_path = '/home/order/sparksql/data/result.parquet';
    $.ajax({
        url:'/tableview/index.php',
        type:'post',
        dataType:'json',
        data:{sql:sql,user_name:user_name,table_name:table_name,data_path:data_path},
        success:function(data){
            if(data.status=='0'){
                if (data.error){
                    alert("参数错误："+data.error);

                    return false;
                }
                $('#listload').hide();

                var header_list = data.header;
                var header_arr = {target:'分析指标',count_number:'销售量',city_name:'地市',item_name:'规格',month:'月份'};
                var header_html = '';
                var flist_html = '';
                var d_html = '';
                var w_html = '';
                var kuan = 100/header_list.length;
                for(i=0;i<header_list.length;i++){
                    header_html += '<th width="'+kuan+'%" style="text-align: center">'+header_arr[header_list[i].name]+'</th>';
                    flist_html += '<div draggable="true" ondragstart="drag(event)" id="div'+i+'" style="width:80px;height:20px;border:1px solid #cacaca;margin:5px;padding:3px 6px;">'+header_list[i].name+'</div>';
                    //if(header_list[i].type=='String'){
                        d_html +=  '<div draggable="true" ondragstart="drag(event)" item="'+header_list[i].name+'" id="div'+i+'" style="width:80px;height:20px;border:1px solid #cacaca;margin:5px;padding:3px 6px;">'+header_arr[header_list[i].name]+'</div>';
                    //}
                    /*if(header_list[i].type=='Double'){
                        w_html +=  '<div draggable="true" ondragstart="drag(event)" id="div'+i+'" style="width:80px;height:20px;border:1px solid #cacaca;margin:5px;padding:3px 6px;">'+header_list[i].name+'</div>';
                    }*/
                }
                if(w_html == ''){
                    w_html = "<font color='red'>当前选项无可用数据</font>";
                }
                $('#dlist').append(d_html);
                $('#wlist').append(w_html);
                $('#header_listing').append(header_html);
                var datalist = {header:data.header,data:data.data};
                $('input[name=shuju]').val(JSON.stringify(datalist));
                var content_list = data.data;
                var content_html = '';
                for(i=0;i<content_list.length;i++){
                    content_html += '<tr>';
                    for(x=0;x<header_list.length;x++){
                        content_html += '<td  width="'+kuan+'%" style="text-align: center">'+content_list[i][header_list[x].kname]+'</td>';
                    }
                    content_html += '</tr>';
                }

                $('#content_listing').append(content_html);
                $('#tablehead').show();
                $('#tablelist').show();
            }else{
                window.location.href='/';
            }
        }
    })
}

//获取折线图数据
function zhexian_data(){
    if($('#fenlei').find('div').text()==''){
        alert('请添加分类！');
        return false;
    }
    if($('#xname').find('div').text()==''){
        alert('请添加X轴！');
        return false;
    }
    if($('#yname').find('div').text()==''){
        alert('请添加Y轴！');
        return false;
    }
    $('#tuload').show();
    $('#container').hide();
    $('.content_word').hide();
    $.ajax({
        url:'/tableview/dataview.php',
        type:'post',
        dataType:'json',
        data:{shuju:$('input[name=shuju]').val(),show_type:$('input[name=show_type]').val(),fenlei:$('#fenlei').find('div').attr('item'),xname:$('#xname').find('div').attr('item'),yname:$('#yname').find('div').attr('item')},
        success:function(data){
            if (data.error){
                alert("出错了："+data.error);
                return false;
            }
            var cate_data = data.cate;
            var ser_data = data.ser;
            $('#tuload').hide();
            $('#container').show();
            zhexian_show(cate_data,ser_data);
        }
    })
}
//获取柱状图数据
function zhu_data(){
    if($('#fenlei').find('div').text()==''){
        alert('请添加分类！');
        return false;
    }
    if($('#xname').find('div').text()==''){
        alert('请添加X轴！');
        return false;
    }
    if($('#yname').find('div').text()==''){
        alert('请添加Y轴！');
        return false;
    }

    $('#tuload').show();
    $('#container').hide();
    $('.content_word').hide();
    $.ajax({
        url:'/tableview/dataview.php',
        type:'post',
        dataType:'json',
        data:{shuju:$('input[name=shuju]').val(),show_type:$('input[name=show_type]').val(),fenlei:$('#fenlei').find('div').attr('item'),xname:$('#xname').find('div').attr('item'),yname:$('#yname').find('div').attr('item')},
        success:function(data){
            if (data.error){
                alert("出错了："+data.error);
                return false;
            }
            $('#tuload').hide();
            $('#container').show();
            var cate_data = data.cate;
            var ser_data = data.ser;
            zhu_show(cate_data,ser_data);
        }
    })
}
//获取饼图数据
function bing_data(){
    if($('#fenlei').find('div').text()==''){
        alert('请添加分类！');
        return false;
    }
    if($('#xname').find('div').text()==''){
        alert('请添加X轴！');
        return false;
    }
    $('#tuload').show();
    $('#container').hide();
    $('.content_word').hide();
    $.ajax({
        url:'/tableview/dataview.php',
        type:'post',
        dataType:'json',
        data:{shuju:$('input[name=shuju]').val(),show_type:$('input[name=show_type]').val(),fenlei:$('#fenlei').find('div').attr('item'),xname:$('#xname').find('div').attr('item'),yname:$('#yname').find('div').attr('item')},
        success:function(data){
            /* var data = [
             ['Firefox',   45.0],
             ['IE',       26.8],
             {
             name: 'Chrome',
             y: 12.8,
             sliced: true,
             selected: true
             },
             ['Safari',    8.5],
             ['Opera',     6.2],
             ['Others',   0.7]
             ]; */
            if (data.error){
                alert("出错了："+data.error);
                return false;
            }
            $('#tuload').hide();
            $('#container').show();
            bing_show($('#xname').find('div').text(),data.data);
        }
    })
}
function sandian_data(){
    if($('#xname').find('div').text()==''){
        alert('请添加X轴！');
        return false;
    }
    if($('#yname').find('div').text()==''){
        alert('请添加Y轴！');
        return false;
    }
    $('#tuload').show();
    $('#container').hide();
    $('.content_word').hide();
    $.ajax({
        url:'/tableview/dataview.php',
        type:'post',
        dataType:'json',
        data:{shuju:$('input[name=shuju]').val(),show_type:'scatter',fenlei:$('#xname').find('div').attr('item'),xname:$('#yname').find('div').attr('item'),yname:$('#yname').find('div').attr('item')},
        success:function(data){
            /* var data = [
             ['Firefox',   45.0],
             ['IE',       26.8],
             {
             name: 'Chrome',
             y: 12.8,
             sliced: true,
             selected: true
             },
             ['Safari',    8.5],
             ['Opera',     6.2],
             ['Others',   0.7]
             ]; */
            if (data.error){
                alert("出错了："+data.error);
                return false;
            }
            $('#tuload').hide();
            $('#container').show();
            sandian_show(data.data);
        }
    })
}
function leida_data(){
    if($('#xname').find('div').text()==''){
        alert('请添加X轴！');
        return false;
    }
    var canshu = '';
    $('#xname').find('div').each(function(i){
        if((i+1)%3==0){
            leixing = "area";
        }else if((i+1)%3!=0 && (i+1)%2==0){
            leixing = "line";
        }else{
            leixing = "column";
        }
        if(i==0){
            canshu += '{"'+$(this).attr('item')+'":"'+leixing+'"';
        }else{
            canshu += ',"'+$(this).attr('item')+'":"'+leixing+'"';
        }
    })
    canshu += "}";
    $('#tuload').show();
    $('#container').hide();
    $('.content_word').hide();
    $.ajax({
        url:'/tableview/dataview.php',
        type:'post',
        dataType:'json',
        data:{shuju:$('input[name=shuju]').val(),show_type:'polar',clum:canshu},
        success:function(data){
            if (data.error){
                alert("出错了："+data.error);
                return false;
            }
            console.log(data.series);
            $('#tuload').hide();
            $('#container').show();
            leida_show(data.series);
        }
    })
}

function zuobiao_data()
{
    if($('#fenlei').find('div').text()==''){
        alert('请添加分类！');
        return false;
    }
    if($('#xname').find('div').text()==''){
        alert('请添加X轴！');
        return false;
    }
    var canshu = '';
    var cate_data = [];
    $('#xname').find('div').each(function(i){
        if(i==0){
            canshu += $(this).attr('item');
        }else{
            canshu += ","+$(this).attr('item');
        }
        cate_data.push($(this).attr('item'));
    })
    $('#tuload').show();
    $('#container').hide();
    $('.content_word').hide();
    $.ajax({
        url:'/tableview/dataview.php',
        type:'post',
        dataType:'json',
        data:{shuju:$('input[name=shuju]').val(),show_type:'spending',fenlei:$('#fenlei').find('div').attr('item'),clum:canshu},
        success:function(data){
            if (data.error){
                alert("出错了："+data.error);
                return false;
            }
            //console.log(data.series);
            //leida_show(data.series);
            $('#tuload').hide();
            $('#container').show();
            zuobiao_show(cate_data,data.series);
        }
    })

}

function ciyun_data()
{

    if($('#fenlei').find('div').text()==''){
        alert('请添加分类！');
        return false;
    }
    $('#tuload').show();
    $('#container').hide();
    $('.content_word').hide();
    $.ajax({
        url:'/tableview/dataview.php',
        type:'post',
        dataType:'json',
        data:{shuju:$('input[name=shuju]').val(),show_type:'wordcloud',fenlei:$('#fenlei').find('div').attr('item')},
        success:function(data){
            if (data.error){
                alert("出错了："+data.error);
                return false;
            }
            //console.log(data.series);
            //leida_show(data.series);
            $('#container').hide();
            $('.content_word').show();
            $('.content_word svg').html('');
            $('#tuload').hide();
            $('.content_word').show();
            keyword(data.data);
            //zuobiao_show(cate_data,data.series);
        }
    })
}
//显示折线图
function zhexian_show(cate_data,ser_data){
    if(!cate_data && !ser_data){
        var cate_data = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var ser_data = [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'New York',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: 'Berlin',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }];
    }
    $('#container').highcharts({
        title: {
            text: '',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: cate_data
        },
        yAxis: {
            title: {
                text: ''
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: ser_data
    });
}
//显示柱状图
function zhu_show(cate_data,ser_data){
    if(!cate_data && !ser_data){
        var cate_data = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];
        var ser_data = [{
            name: 'Tokyo',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
        }, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
        }];

    }
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: cate_data,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: ser_data
    });
}
//饼图
function bing_show(name,data){
    if(!name && !data){
        var name = "示例图表";
        var data = [
            ['Firefox',   45.0],
            ['IE',       26.8],
            {
                name: 'Chrome',
                y: 12.8,
                sliced: true,
                selected: true
            },
            ['Safari',    8.5],
            ['Opera',     6.2],
            ['Others',   0.7]
        ];
    }
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}[{point.y}]</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: name,
            data: data
        }]
    });
}
//仪表图
function biao_show(){
    $('#container').highcharts({
            chart: {
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: 'Speedometer'
            },
            pane: {
                startAngle: -150,
                endAngle: 150,
                background: [{
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#FFF'],
                            [1, '#333']
                        ]
                    },
                    borderWidth: 0,
                    outerRadius: '109%'
                }, {
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#333'],
                            [1, '#FFF']
                        ]
                    },
                    borderWidth: 1,
                    outerRadius: '107%'
                }, {
                    // default background
                }, {
                    backgroundColor: '#DDD',
                    borderWidth: 0,
                    outerRadius: '105%',
                    innerRadius: '103%'
                }]
            },
            // the value axis
            yAxis: {
                min: 0,
                max: 200,
                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',
                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: 'km/h'
                },
                plotBands: [{
                    from: 0,
                    to: 120,
                    color: '#55BF3B' // green
                }, {
                    from: 120,
                    to: 160,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 160,
                    to: 200,
                    color: '#DF5353' // red
                }]
            },
            series: [{
                name: 'Speed',
                data: [80],
                tooltip: {
                    valueSuffix: ' km/h'
                }
            }]
        },
        // Add some life
        function (chart) {
            if (!chart.renderer.forExport) {
                setInterval(function () {
                    var point = chart.series[0].points[0],
                        newVal,
                        inc = Math.round((Math.random() - 0.5) * 20);
                    newVal = point.y + inc;
                    if (newVal < 0 || newVal > 200) {
                        newVal = point.y - inc;
                    }
                    point.update(newVal);
                }, 3000);
            }
        });
}

//散点图
function sandian_show(data){
    if(!data){
        var data = [[161.2, 51.6], [167.5, 59.0], [159.5, 49.2], [157.0, 63.0], [155.8, 53.6],
            [170.0, 59.0], [159.1, 47.6], [166.0, 69.8], [176.2, 66.8], [160.2, 75.2],
            [172.5, 55.2], [170.9, 54.2], [172.9, 62.5], [153.4, 42.0], [160.0, 50.0],
            [147.2, 49.8], [168.2, 49.2], [175.0, 73.2], [157.0, 47.8], [167.6, 68.8],
            [159.5, 50.6], [175.0, 82.5], [166.8, 57.2], [176.5, 87.8], [170.2, 72.8],
            [174.0, 54.5], [173.0, 59.8], [179.9, 67.3], [170.5, 67.8], [160.0, 47.0],
            [154.4, 46.2], [162.0, 55.0], [176.5, 83.0], [160.0, 54.4], [152.0, 45.8],
            [162.1, 53.6], [170.0, 73.2], [160.2, 52.1], [161.3, 67.9], [166.4, 56.6],
            [168.9, 62.3], [163.8, 58.5], [167.6, 54.5], [160.0, 50.2], [161.3, 60.3],
            [167.6, 58.3], [165.1, 56.2], [160.0, 50.2], [170.0, 72.9], [157.5, 59.8],
            [167.6, 61.0], [160.7, 69.1], [163.2, 55.9], [152.4, 46.5], [157.5, 54.3],
            [168.3, 54.8], [180.3, 60.7], [165.5, 60.0], [165.0, 62.0], [164.5, 60.3],
            [156.0, 52.7], [160.0, 74.3], [163.0, 62.0], [165.7, 73.1], [161.0, 80.0],
            [162.0, 54.7], [166.0, 53.2], [174.0, 75.7], [172.7, 61.1], [167.6, 55.7],
            [151.1, 48.7], [164.5, 52.3], [163.5, 50.0], [152.0, 59.3], [169.0, 62.5],
            [164.0, 55.7], [161.2, 54.8], [155.0, 45.9], [170.0, 70.6], [176.2, 67.2],
            [170.0, 69.4], [162.5, 58.2], [170.3, 64.8], [164.1, 71.6], [169.5, 52.8],
            [163.2, 59.8], [154.5, 49.0], [159.8, 50.0], [173.2, 69.2], [170.0, 55.9],
            [161.4, 63.4], [169.0, 58.2], [166.2, 58.6], [159.4, 45.7], [162.5, 52.2],
            [159.0, 48.6], [162.8, 57.8], [159.0, 55.6], [179.8, 66.8], [162.9, 59.4],
            [161.0, 53.6], [151.1, 73.2], [168.2, 53.4], [168.9, 69.0], [173.2, 58.4],
            [171.8, 56.2], [178.0, 70.6], [164.3, 59.8], [163.0, 72.0], [168.5, 65.2],
            [166.8, 56.6], [172.7, 105.2], [163.5, 51.8], [169.4, 63.4], [167.8, 59.0],
            [159.5, 47.6], [167.6, 63.0], [161.2, 55.2], [160.0, 45.0], [163.2, 54.0],
            [162.2, 50.2], [161.3, 60.2], [149.5, 44.8], [157.5, 58.8], [163.2, 56.4],
            [172.7, 62.0], [155.0, 49.2], [156.5, 67.2], [164.0, 53.8], [160.9, 54.4],
            [162.8, 58.0], [167.0, 59.8], [160.0, 54.8], [160.0, 43.2], [168.9, 60.5],
            [158.2, 46.4], [156.0, 64.4], [160.0, 48.8], [167.1, 62.2], [158.0, 55.5],
            [167.6, 57.8], [156.0, 54.6], [162.1, 59.2], [173.4, 52.7], [159.8, 53.2],
            [170.5, 64.5], [159.2, 51.8], [157.5, 56.0], [161.3, 63.6], [162.6, 63.2],
            [160.0, 59.5], [168.9, 56.8], [165.1, 64.1], [162.6, 50.0], [165.1, 72.3],
            [166.4, 55.0], [160.0, 55.9], [152.4, 60.4], [170.2, 69.1], [162.6, 84.5],
            [170.2, 55.9], [158.8, 55.5], [172.7, 69.5], [167.6, 76.4], [162.6, 61.4],
            [167.6, 65.9], [156.2, 58.6], [175.2, 66.8], [172.1, 56.6], [162.6, 58.6],
            [160.0, 55.9], [165.1, 59.1], [182.9, 81.8], [166.4, 70.7], [165.1, 56.8],
            [177.8, 60.0], [165.1, 58.2], [175.3, 72.7], [154.9, 54.1], [158.8, 49.1],
            [172.7, 75.9], [168.9, 55.0], [161.3, 57.3], [167.6, 55.0], [165.1, 65.5],
            [175.3, 65.5], [157.5, 48.6], [163.8, 58.6], [167.6, 63.6], [165.1, 55.2],
            [165.1, 62.7], [168.9, 56.6], [162.6, 53.9], [164.5, 63.2], [176.5, 73.6],
            [168.9, 62.0], [175.3, 63.6], [159.4, 53.2], [160.0, 53.4], [170.2, 55.0],
            [162.6, 70.5], [167.6, 54.5], [162.6, 54.5], [160.7, 55.9], [160.0, 59.0],
            [157.5, 63.6], [162.6, 54.5], [152.4, 47.3], [170.2, 67.7], [165.1, 80.9],
            [172.7, 70.5], [165.1, 60.9], [170.2, 63.6], [170.2, 54.5], [170.2, 59.1],
            [161.3, 70.5], [167.6, 52.7], [167.6, 62.7], [165.1, 86.3], [162.6, 66.4],
            [152.4, 67.3], [168.9, 63.0], [170.2, 73.6], [175.2, 62.3], [175.2, 57.7],
            [160.0, 55.4], [165.1, 104.1], [174.0, 55.5], [170.2, 77.3], [160.0, 80.5],
            [167.6, 64.5], [167.6, 72.3], [167.6, 61.4], [154.9, 58.2], [162.6, 81.8],
            [175.3, 63.6], [171.4, 53.4], [157.5, 54.5], [165.1, 53.6], [160.0, 60.0],
            [174.0, 73.6], [162.6, 61.4], [174.0, 55.5], [162.6, 63.6], [161.3, 60.9],
            [156.2, 60.0], [149.9, 46.8], [169.5, 57.3], [160.0, 64.1], [175.3, 63.6],
            [169.5, 67.3], [160.0, 75.5], [172.7, 68.2], [162.6, 61.4], [157.5, 76.8],
            [176.5, 71.8], [164.4, 55.5], [160.7, 48.6], [174.0, 66.4], [163.8, 67.3]];
    }
    $('#container').highcharts({
        chart: {
            type: 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: '散点图'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            // categories:categroies,
            title: {
                enabled: true,
                text: $('#xname').find('div').text()
            },
            startOnTick: true,
            endOnTick: true,
            showLastLabel: true
        },
        yAxis: {
            title: {
                text: $('#yname').find('div').text()
            }
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 100,
            y: 70,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
            borderWidth: 1
        },
        plotOptions: {
            scatter: {
                marker: {
                    radius: 5,
                    states: {
                        hover: {
                            enabled: true,
                            lineColor: 'rgb(100,100,100)'
                        }
                    }
                },
                states: {
                    hover: {
                        marker: {
                            enabled: false
                        }
                    }
                },
                tooltip: {
                    headerFormat: '',
                    pointFormat: '{point.x}, {point.y}'
                }
            }
        },
        series: [{
            name: '',
            color: 'rgba(223, 83, 83, .5)',
            data: data
        }]});
}

//坐标图
function zuobiao_show(cate_data,data)
{
    if(!cate_data && !data){
        var cate_data = ['Sales', 'Marketing', 'Development', 'Customer Support',
            'Information Technology', 'Administration'];
        var data = [{
            name: 'Allocated Budget',
            data: [43000, 19000, 60000, 35000, 17000, 10000],
            pointPlacement: 'on'
        }, {
            name: 'Actual Spending',
            data: [50000, 39000, 42000, 31000, 26000, 14000],
            pointPlacement: 'on'
        }];
    }

    $('#container').highcharts({
        chart: {
            polar: true,
            type: 'line'
        },
        title: {
            text: '坐标图',
            x: -80
        },
        pane: {
            size: '80%'
        },
        xAxis: {
            categories: cate_data,
            tickmarkPlacement: 'on',
            lineWidth: 0
        },
        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0
        },
        tooltip: {
            shared: true,
            pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
        },
        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 70,
            layout: 'vertical'
        },
        series: data
    });
}
//雷达图
function leida_show(data)
{
    if(!data){
        var data = [{
            type: 'column',
            name: 'Column',
            data: [8, 7, 6, 5, 4, 3, 2, 1]
        }, {
            type: 'line',
            name: 'Line',
            data: [1, 2, 3, 4, 5, 6, 7, 8]
        }, {
            type: 'area',
            name: 'Area',
            data: [1, 8, 2, 7, 3, 6, 4, 5]
        }];
    }
    $('#container').highcharts({
        chart: {
            polar: true
        },
        title: {
            text: '雷达图表'
        },
        pane: {
            startAngle: 0,
            endAngle: 360
        },
        xAxis: {
            tickInterval: 45,
            min: 0,
            max: 360,
            labels: {
                formatter: function () {
                    return this.value + '°';
                }
            }
        },
        yAxis: {
            min: 0
        },
        plotOptions: {
            series: {
                pointStart: 0,
                pointInterval: 45
            },
            column: {
                pointPadding: 0,
                groupPadding: 0
            }
        },
        series: data
    });
}
//文字汉化
Highcharts.setOptions({
    lang:{
        contextButtonTitle:"图表导出菜单",
        decimalPoint:".",
        downloadJPEG:"下载JPEG图片",
        downloadPDF:"下载PDF文件",
        downloadPNG:"下载PNG文件",
        downloadSVG:"下载SVG文件",
        drillUpText:"返回 {series.name}",
        loading:"加载中",
        months:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
        noData:"没有数据",
        numericSymbols: [ "千" , "兆" , "G" , "T" , "P" , "E"],
        printChart:"打印图表",
        resetZoom:"恢复缩放",
        resetZoomTitle:"恢复图表",
        shortMonths: [ "Jan" , "Feb" , "Mar" , "Apr" , "May" , "Jun" , "Jul" , "Aug" , "Sep" , "Oct" , "Nov" , "Dec"],
        thousandsSep:",",
        weekdays: ["星期一", "星期二", "星期三", "星期三", "星期四", "星期五", "星期六","星期天"]
    },
    colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
});


//拖拽开始
//允许拖拽
function allowDrop(ev)
{
    ev.preventDefault();
}
//监听拖拽
function drag(ev)
{
    var fparentid = $('#'+ev.target.id).parent().attr('id');
    //alert($('input[name=show_type]').val());
    /*if($('input[name=show_type]').val()=='bGraph' || $('input[name=show_type]').val()=='lChart'){
        if (fparentid == 'dlist') {
            $('#yname').removeAttr('ondragover');
            $('#fenlei,#xname').attr('ondragover', 'allowDrop(event)');
        } else {
            $('#fenlei,#xname').removeAttr('ondragover');
            $('#yname').attr('ondragover', 'allowDrop(event)');
        }
    }else {
        if (fparentid == 'dlist') {
            $('#xname,#yname').removeAttr('ondragover');
            $('#fenlei').attr('ondragover', 'allowDrop(event)');
        } else {
            $('#fenlei').removeAttr('ondragover');
            $('#xname,#yname').attr('ondragover', 'allowDrop(event)');
        }
    }*/
    $('#fenlei,#xname,#yname').attr('ondragover', 'allowDrop(event)');
    ev.dataTransfer.setData("Text",ev.target.id);

}
//监听拖拽放置
function drop(ev)
{
    ev.preventDefault();
    var data=ev.dataTransfer.getData("Text"); //拖动的块
    var fparentid = $('#'+data).parent().attr('id'); //源父级
    var parentid = ev.target.getAttribute('id'); //被拖入的块
    if($('input[name=show_type]').val()=='leida'){
        if(parentid == 'xname'){
            /*if ($('#' + parentid).find('div').length > 0) {
             $('#wlist').append($('#' + parentid).html());
             $('#' + parentid).find('div').remove();
             }*/
            $('#fenlei').attr('ondragover','allowDrop(event)');
            ev.target.appendChild(document.getElementById(data));
        }
    }
    else if($('input[name=show_type]').val()=='zuobiao'){
        if (parentid == 'fenlei') {
            if ($('#' + parentid).find('div').length > 0) {
                $('#dlist').append($('#' + parentid).html());
                $('#' + parentid).find('div').remove();
            }
            $('#xname,#yname').attr('ondragover','allowDrop(event)');
            ev.target.appendChild(document.getElementById(data));
        }
        if(parentid == 'xname'){
            /*if ($('#' + parentid).find('div').length > 0) {
             $('#wlist').append($('#' + parentid).html());
             $('#' + parentid).find('div').remove();
             }*/
            $('#fenlei').attr('ondragover','allowDrop(event)');
            ev.target.appendChild(document.getElementById(data));
        }
    }
    else if($('input[name=show_type]').val()=='bGraph' || $('input[name=show_type]').val()=='lChart'){
        if (parentid == 'fenlei' || parentid == 'xname') {
            if ($('#' + parentid).find('div').length > 0) {
                $('#dlist').append($('#' + parentid).html());
                $('#' + parentid).find('div').remove();
            }
            $('#yname').attr('ondragover','allowDrop(event)');
            ev.target.appendChild(document.getElementById(data));
        }
        if(parentid == 'yname'){
            if ($('#' + parentid).find('div').length > 0) {
                $('#dlist').append($('#' + parentid).html());
                $('#' + parentid).find('div').remove();
            }
            $('#fenlei,#xname').attr('ondragover','allowDrop(event)');
            ev.target.appendChild(document.getElementById(data));
        }
    }
    else{
        if (parentid == 'fenlei') {
            if ($('#' + parentid).find('div').length > 0) {
                $('#dlist').append($('#' + parentid).html());
                $('#' + parentid).find('div').remove();
            }
            $('#xname,#yname').attr('ondragover','allowDrop(event)');
            ev.target.appendChild(document.getElementById(data));
        }
        if(parentid == 'xname' || parentid == 'yname'){
            if ($('#' + parentid).find('div').length > 0) {
                $('#dlist').append($('#' + parentid).html());
                $('#' + parentid).find('div').remove();
            }
            $('#fenlei').attr('ondragover','allowDrop(event)');
            ev.target.appendChild(document.getElementById(data));
        }
    }



}