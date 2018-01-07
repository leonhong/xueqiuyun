<?php
session_start();
if(isset($_SESSION['adminuser'])||isset($_SESSION['youke'])){
    header("location:/table.php");
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title>雪球云股票平台</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font.css" type="text/css" />
    <link rel="stylesheet" href="css/app.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body>
<section id="content"  class=" wrapper-md animated fadeInUp">
    <div class="">
    	<div class="index-header text-center">
			<h1 class="logo hide-text">雪球云</h1>	
			<!--<h2 class="subtitle">与世界分享你的知识、经验和见解</h2>-->
			<h2 class="subtitle">大数据时代的聪明投资者</h2>
		</div>
        <section id="aui_iwrapper" class="sign-flow">
            <div class="index-tab-navs">
				<div class="navs-slider" data-active-index="1">		
					<a class="active" id="touristbtn"><span>游客</span></a>
					<a class="" id="loginbtn"><span>登录</span></a>		
						
				</div>
			</div>
			<div class="tourist">
				<a href="/youke.php" class="sign-button submit" id="show">进入系统</a>
			</div>
            <form action="#" class="view view-signin" autocomplete="off" style="display: none;" >
                <div class="group-inputs ">
                	<div class="input-wrapper">
	                    <input type="text" name="username" value="" placeholder="请输入账号"/>
	                    <span class="notice notice-username error"></span>
                    </div>
                    <div class="input-wrapper">
	                    <input type="password" name="password" value="" id="inputPassword" placeholder="请输入密码"/>
	                    <span class="notice notice-password error"></span>
	                </div>
                </div>                
                <button type="button" id="login" class="sign-button submit">登录</button>
            </form>
            
        </section>
    </div>
</section>

    <?php
        //数字输出网页计数器
        $max_len = 9;
        $CounterFile = "counter.dat";
        if(!file_exists($CounterFile)){        //如果计数器文件不存在
            $counter = 0;                  
            $cf = fopen($CounterFile,"w");  //打开文件
            fputs($cf,'0');                    //初始化计数器
            fclose($cf);                   //关闭文件
        }
        else{                                       //取回当前计数器的值
            $cf = fopen($CounterFile,"r");
            $counter = trim(fgets($cf,$max_len));
            fclose($cf);
        }
        $counter++;                                    //计数器加一
        $cf = fopen($CounterFile,"w");              //写入新的数据
        fputs($cf,$counter);
        fclose($cf);
    ?>
    <div id="dd" align="center">
        <span>欢迎您,</span>
        <span>您是本站第
            <?php
             echo $counter;                            //输出计数器
            ?>
        位访客</span>
    </div>

<footer id="footer">
© 2016 雪球云 ICP证：辽ICP备16011533号<br>
风险提示：投资决策需要建立在独立思考之上<br>
</footer>
<div id="particles-js"></div>
<!-- / footer -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.js"></script>
<!-- App -->
<script src="js/app.js"></script>
<script src="js/app.plugin.js"></script>
<script src="js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/particles.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/loginjson.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
//  shake('aui_iwrapper', false);
    $('#login').click(function(){
        $('.notice-username').text('');
        $('.notice-password').text('');
        if(!$('input[name=username]').val()){
               $('.notice-username').text('请输入管理员账号！').addClass("is-visible");
//             shake('aui_iwrapper', true);
               return false;
        }
        if(!$('input[name=password]').val()){
            $('.notice-password').text('请输入密码！').addClass("is-visible");
//          shake('aui_iwrapper', true);
            return false;
        }

        $.ajax({
            url:'/adminlogin.php',
            data:{username:$('input[name=username]').val(),password:$('input[name=password]').val()},
            type:'post',
            dataType:'json',
            success:function(data){
                if(data.status=='0'){
                    window.location.href = '/hs_table.php';
                }else{
           //         shake('aui_iwrapper', true);
                    $('.notice-password').text(data.error).addClass("is-visible");
                }
            }
        })
    })
    $("#touristbtn").click(function(){
    	$(this).addClass("active").siblings().removeClass("active");
    	$("form.view").hide();
    	$(".tourist").show()
    })
    $("#loginbtn").click(function(){
    	$(this).addClass("active").siblings().removeClass("active");
    	$("form.view").show();
    	$(".tourist").hide()
    })
    if($(document).height()-400>0){
    	$("#content").css("margin-top",($(document).height()-400)/2);
    }else{
    	$("#content").css("margin-top",0);
    }
    $(window).resize(function(){
    	if($(document).height()-400>0){
	    	$("#content").css("margin-top",($(document).height()-400)/2);
	    }else{
	    	$("#content").css("margin-top",0);
	    }
    })
})
//function shake(obj_id, shake) {
//  var $obj = $("#" + obj_id);
//  var box_left = ($(window).width() - $obj.width()) / 2;
//  $obj.css({'left': box_left, 'position':'absolute'});
//  if (shake == true) {
//      for (var i = 1; i <= 4; i++) {
//          $obj.animate({left:box_left - (40 - 10 * i)}, 50);
//          $obj.animate({left:box_left + 2 * (40 - 10 * i)}, 50);
//      }
//  }
//}

</script>
</body>
</html>
