<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
		<title>会员登录</title>
		<link rel="stylesheet" type="text/css" href="./xiaomi/css/login.css">
		
	</head>
	<body>
		<!-- login -->
		<div class="top center">
			<div class="logo center">
				<a href="./index.html" target="_blank"><img src="./xiaomi/image/mistore_logo.png" alt=""></a>
			</div>
		</div>
		<form  method="post" id="forms" action="" class="form center">
		{{csrf_field()}}
		<div class="login">
			<div class="login_center">
				<div class="login_top">
					<div class="left fl">会员登录</div>
					<div class="right fr">您还不是我们的会员？<a href="{{url('/register')}}" target="_self">立即注册</a></div>
					<div class="clear"></div>
					<div class="xian center"></div>
				</div>
				<div class="login_main center">
					<div class="username">用户名:&nbsp;<input class="shurukuang" type="text" name="username" placeholder="请输入你的用户名"/></div>
					<div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;<input class="shurukuang"  type="password" name="password" placeholder="请输入你的密码"/></div>
					<div class="username">
						<div class="left fl">验证码:&nbsp;<input class="yanzhengma" id="codeInput" type="text" name="code" placeholder="请输入验证码"/></div>
						<div class="right fl"><img src="{{url('admin/code2')}}" id="code"  onclick="this.src='{{url('admin/code2')}}'"></div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="login_submit">
					<input class="submit" type="button" name="submit" onclick="login()" value="立即登录" >
				</div>
				
			</div>
		</div>
		</form>
		<footer>
			<div class="copyright">简体 | 繁体 | English | 常见问题</div>
			<div class="copyright">小米公司版权所有-京ICP备10046444-<img src="./xiaomi/image/ghs.png" alt="">京公网安备11010802020134号-京ICP证110507号</div>

		</footer>
	</body>
</html>
<script src="./xiaomi/js/layui.js"></script>
<script src="./xiaomi/js/jquery-1.8.3.min.js"></script>
<script>
//写登录。。。。
function login() {
    $.ajax({
        type:'POST',//提交类型
        dataType:'json',
        url:"{{url('/login')}}",//提交的url
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},       	        
        data:$("#forms").serialize(),//序列化为可以传输的数据
        success:function (res) {//如果成功返回的信息res
            if(res['status']=='1'){
                alert(res['msg']);
                window.location.href="{{url('/index')}}";             
            }else{
                alert(res['msg']);
                $('#code').attr("src","{{url('admin/code2')}}");
                $('#codeInput').val("");
             }
                                                       
        }
    });

 } 
</script>
