<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
        
		<title>用户注册</title>
		<link rel="stylesheet" type="text/css" href="./xiaomi/css/login.css">

	</head>
	<body>
		<form  method="post" action="" id="forms">
		{{csrf_field()}}
		<div class="regist">
			<div class="regist_center">
				<div class="regist_top">
					<div class="left fl">会员注册</div>
					<div class="right fr"><a href="./index.html" target="_self">小米商城</a></div>
					<div class="clear"></div>
					<div class="xian center"></div>
				</div>
				<div class="regist_main center">
					<div class="username">用&nbsp;&nbsp;户&nbsp;&nbsp;名:&nbsp;&nbsp;<input class="shurukuang" type="text" name="username" placeholder="请输入你的用户名"/><span>请不要输入汉字</span></div>
					<div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;&nbsp;<input class="shurukuang" type="password" name="password" placeholder="请输入你的密码"/><span>请输入6位以上字符</span></div>
					
					<div class="username">确认密码:&nbsp;&nbsp;<input class="shurukuang" type="password" name="repassword" placeholder="请确认你的密码"/><span>两次密码要输入一致哦</span></div>
					<div class="username">手&nbsp;&nbsp;机&nbsp;&nbsp;号:&nbsp;&nbsp;<input class="shurukuang" type="text" name="tel" placeholder="请填写正确的手机号"/><span>填写下手机号吧，方便我们联系您！</span></div>
					<div class="username">
						<div class="left fl">验&nbsp;&nbsp;证&nbsp;&nbsp;码:&nbsp;&nbsp;<input class="yanzhengma" id="codeInput" type="text" name="code" placeholder="请输入验证码"/></div>
						<div class="right fl">
						<img src="{{url('admin/code')}}" id="code"  onclick="this.src='{{url('admin/code')}}'">
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="regist_submit">
					<input class="submit" type="button" name="submit" value="立即注册" onclick="register()" >
				</div>
				
			</div>
		</div>
		</form>
	</body>
</html>
<script src="./xiaomi/js/layui.js"></script>
<script src="./xiaomi/js/jquery-1.8.3.min.js"></script>
<script>
function register() {
    $.ajax({
        type:'POST',//提交类型
        dataType:'json',
        url:"{{url('/register')}}",//提交的url
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},       	        
        data:$("#forms").serialize(),//序列化为可以传输的数据
        success:function (res) {//如果成功返回的信息res
            if(res['status']=='1'){
                alert(res['msg']);
                window.location.href="{{url('/login')}}";             
            }else{
                alert(res['msg']);
                $('#code').attr("src","{{url('admin/code')}}");
                $('#codeInput').val("");
             }
                                                       
        }
    });

 } 
</script>

