<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=no, width=device-width" name="viewport">
<!--[if lt IE9]> 
<script src="http://cdn.static.runoob.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
<![endif]-->
<link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('images/ooopic_1460463927.ico')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/body.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/yy.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}" />
</script>
	<title>
		登录
	</title>
</head>
<body>
<div class="log_container">
	<div class="log_form">
		<!-- 登录提示 -->
		<div class="log_remind">
			营养标签
		</div>
		<!-- 用户名 -->
		<div class="log_user_container">
			<label id="log_user_label" for="log_user">
			</label>
			<input type="text" name="name" id="log_user" placeholder="邮箱/手机号" /> 
		</div>
		<!-- 密码 -->
		<div class="log_password_container">
			<label id="log_password_label" for="log_password">
			</label>
			<input type="password" name="password" id="log_password" placeholder="密码/三次输入错误则会有验证码" />
		</div>
		<!-- 登录按钮 -->
		<div class="log_btn cursor_pointer">
			&nbsp;登录
		</div>
		<!-- 其他方式登录 -->
		<div class="log_other">
			<p style="float:left;">
				第三方登录：
			</p>
			<p style="float:left;">
				<a href="/api/qq_login.php" class="cursor_pointer log_qq" title="qq登录"></a>
			</p>
			<p style="float:left;">
				<a href="#" class="cursor_pointer log_weixin" title="微信登录"></a>
			</p>
			<p style="float:left;">
				<a href="#" class="cursor_pointer log_weibo" title="新浪微博"></a>
			</p>
		</div>
		<!-- 底部各种 -->
		<div class="log_bottom">
			<p>
				<a href="{{url('index/index.html')}}"}>返回首页</a>
			</p>
			<p>
				<a href="">忘记密码</a>
			</p>
			<p class="log_login">
				<a href="{{url('login/register.html')}}">注册帐号</a>
			</p>
		</div>
	</div>
</div>
<div class="log_body">
</div>
<script type="text/javascript" src="{{URL::asset('js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/yy.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/login.js')}}"></script>
<script type="text/javascript">
$(function(){
var log=new log_function();
});
</script>
</body>
</html>