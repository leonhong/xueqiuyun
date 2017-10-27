<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
     <script src="bootstrap/js/jquery.min.js"></script>
     <link rel="stylesheet" type="text/css" href="css/table.css"/>
   
    <link rel="stylesheet" href="bootstrap/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/font.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/app.css" type="text/css" />
   
    <!--select美化-->
    <link rel="stylesheet" href="js/select2/select2.css" type="text/css">
    <link rel="stylesheet" href="js/select2/theme.css" type="text/css">
    <script src="js/select2/select2.min.js" type="text/javascript"></script>
    <!--<style type="text/css">
        body{overflow:auto;position:relative;overflow-x: hidden;}
        @media (min-width: 375px) and (max-width: 770px) {
            .col1{width:180px;display: inline-block;}
            .col2{width:310px;display: inline-block;}
        }
        #list thead div{white-space: normal;word-wrap: break-word;}
        .list_left{width: 240px;float: left;margin-left: 20px;border-right: none;}
        .list_left td:first-child{box-shadow: inset 5px 0 0 0 #188fff;color: #188fff;text-align: center;}
        .list_left td:first-child a{color: #188fff;}
        .list_left td:nth-child(2) a{color: #188fff;}
        .list_left .position_th{position:absolute;top:0;right:20px;left:20px;z-index: 9;width: 240px;}
        #list{float: left;border-left: none;border-right: none;margin:0px 20px 20px 0;overflow-x: auto;}
        #list .table td:first-child{box-shadow: none;color: #000;text-align: center;}
        #list .position_th{position:absolute;top:0;right:20px;left:260px;overflow: hidden;}
        .table{margin-bottom: 0;}
    </style>-->
</head>
<body>
<section class="vbox">
    <section class="panel panel-default">
        <!--<header class="panel-heading" style="background-color: #3ab0e2;text-align: center;">
            <h4 style="color: #fff0ff;">股票管理</h4>
        </header>
        <form method="get" action="/hs_table.php" id="sou">
            <input type="hidden" name="sort" value="" />
            <input type="hidden" name="name" value=""/>
            <input type="hidden" name="htype" value="<?php echo $_GET['htype']?>">
            <div class="row text-sm wrapper" style="line-height: 45px; margin:0;padding:5px">
                <div class="col-sm-4 m-b-xs col1">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-sm  btn-default">
                            <input type="radio" name="options" id="hs"> 沪深
                        </label>
                        <label class="btn btn-sm btn-default">
                            <input type="radio" name="options" id="gg"> 港股
                        </label>
                        <label class="btn btn-sm  btn-default">
                            <input type="radio" name="options" id="ggt"> 港股通
                        </label>
                        <?php  session_start(); if(isset($_SESSION['adminuser'])){ ?>
                            <label class="btn btn-sm  btn-danger active">
                                <input type="radio" name="options" id="admin"> 股票管理
                            </label>
                        <?php } ?>
                    </div>
                </div>
                <!--<div class="col-sm-5 m-b-xs col2">
                    <span style="display: inline-block;width: 70px;float: left;">筛选公式：</span>
                    <select class=" inline select2-offscreen" id="formula" name="type" style="width: 204px;">
                        <option value="-1">选择公式</option>
                        <option value="0" <?php /*if($_GET['type']=='0'){ */?>selected="selected"<?php /*} */?>>双五组合</option>
                        <option value="1" <?php /*if($_GET['type']=='1'){ */?>selected="selected"<?php /*} */?>>格雷厄姆公式</option>
                        <option value="2" <?php /*if($_GET['type']=='2'){ */?>selected="selected"<?php /*} */?>>净净</option>
                        <option value="3" <?php /*if($_GET['type']=='3'){ */?>selected="selected"<?php /*} */?>>神奇公式</option>
                        <option value="4" <?php /*if($_GET['type']=='4'){ */?>selected="selected"<?php /*} */?>>R15</option>
                    </select>
                </div>

                <div class="col-sm-3 col3">
                    <div class="input-group"  >
                        <input type="text" class="input-sm form-control" placeholder="股票代码/股票名称" name="key" value="<?php /*echo $_GET['key'];*/?>">
                      <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" id="gosearch" type="button">搜索</button>
                      </span>
                    </div>
                </div>-->
            <!--</div>
        </form>-->
       <!-- <div style="clear: both;"></div>-->
       <div class="btn-group" data-toggle="buttons">
            <label class="btn model-nav active">
                <input type="radio" id="addbtn"> 添加股票
            </label>
            <label class="btn model-nav">
                <input type="radio" id="delbtn"> 删除股票
            </label>

        </div>
        <!--<div class="row">
            <div class="col-sm-6">-->
                <section class="panel panel-default" id="addblock">
                    <form class="bs-example form-horizontal modal-form" id="addform">
                    	<div class="form-group">
                            <label  class="col-lg-2 control-label">股票类型</label>
                            <div class="col-lg-5">
	                            <select name="code_type" style="width: 200px;" id="formula">
	                                <option value="-1" selected="selected">选择股票类型</option>
	                                <option value="gg">港股</option>
	                                <option value="ggt">港股通</option>
	                                <option value="ss">深市</option>
	                                <option value="hs">沪市</option>
	                            </select>
	                            <span class="error">&nbsp;</span>
                             </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">股票名称</label>
                            <div class="col-lg-5">
                                <input type="text" name="code_name" class="form-control" placeholder="股票名称">
                                <span class="error">&nbsp;</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">股票代码</label>
                            <div class="col-lg-5">
                                <input type="text" name="code" class="form-control" placeholder="股票代码">
                                <span class="error">&nbsp;</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="m-t-sm col-lg-5">
                                <button type="button" id="add" class="btn">添加</button>
                            </div>
                        </div>
                    </form>
                </section>
            <!--</div>
            <div class="col-sm-6">-->
                <section class="panel panel-default" id="delblock">
                    <form class="bs-example form-horizontal modal-form" id="delform">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">股票代码</label>
                            <div class="col-lg-10">
                                <input type="text" name="del_code" class="form-control" placeholder="股票代码">
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="m-t-sm col-lg-10">
                                <button type="button" id="del" class="btn">删除</button>
                            </div>
                        </div>
                    </form>
                </section>
         <!--   </div>-->
        </div>
    </section>
</section>
</body>
<script>
    $(document).ready(function(){
    	 //美化select
        $("#formula").select2({
        	minimumResultsForSearch: Infinity,
        	width:'200px'
        })
        //添加股票
        $('#add').click(function(){
               $('#addform').find('.error').html('&nbsp;');
               if($('select[name=code_type]').val()=='-1'){
	                $('select[name=code_type]').parent().find('.error').text('请选择股票类型').addClass("is-visible");
	                $('select[name=code_type]').parent().find('.select2-chosen').text('选择股票类型');
	                
	                return false;
	            }
              if($('input[name=code_name]').val()==''){
                  $('input[name=code_name]').parent().find('.error').text('请填写股票名称').addClass("is-visible");
                  return false;
              }
            if($('input[name=code]').val()==''){
                $('input[name=code]').parent().find('.error').text('请填写股票代码').addClass("is-visible");
                return false;
            }
            
            $.ajax({
                url:'/code_add.php',
                type:'post',
                data:{code:$('input[name=code]').val(),code_name:$('input[name=code_name]').val(),code_type:$('select[name=code_type]').val()},
                dataType:'json',
                success:function(data){
                   if(data.status == '1'){
                       $('select[name=code_type]').parent().find('span').text(data.error);
                       return false;
                   }else{
//                     alert('添加成功');
						$('#stockmangement', window.parent.document).removeClass("in").hide();
						$('.modal-backdrop', window.parent.document).removeClass("in").hide();
						$("input[name=del_code],input[name=code_name],input[name=code]").val("");
                   }
                }
            })
        })
        //删除股票
        $('#del').click(function(){
            $('#delform').find('span').html('&nbsp;');
            if($('input[name=del_code]').val()==''){
                $('input[name=del_code]').parent().find('span').text('请填写股票代码').addClass("is-visible");
                return false;
            }
            $.ajax({
                url:'/code_del.php',
                type:'post',
                data:{code:$('input[name=del_code]').val()},
                dataType:'json',
                success:function(data){
                    if(data.status == '1'){
                        $('select[name=code_type]').parent().find('span').text(data.error);
                        return false;
                    }else{
//                      alert('删除成功');
						$('#stockmangement', window.parent.document).removeClass("in").hide();
						$('.modal-backdrop', window.parent.document).removeClass("in").hide();
						$("input[name=del_code],input[name=code_name],input[name=code]").val("");
                    }
                }
            })
        })
        $("#addbtn").click(function(){
        	$("#addblock").show();
        	$("#delblock").hide();
        	$("#addbtn").parent().addClass("active");
        	$("#delbtn").parent().removeClass("active");
        })
        $("#delbtn").click(function(){
        	$("#addblock").hide();
        	$("#delblock").show();
        	$("#delbtn").parent().addClass("active");
        	$("#addbtn").parent().removeClass("active");
        })
    })
</script>
</html>
