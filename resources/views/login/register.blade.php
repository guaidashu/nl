<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=no, width=device-width" name="viewport">
<link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('images/ooopic_1460463927.ico')}}" media="screen" />
<!--[if lt IE9]> 
<script src="http://cdn.static.runoob.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/body.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/common.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/yy.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}" />
<script type="text/javascript" src="{{URL::asset('js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/yy.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/register.js')}}"></script>
<script type="text/javascript">
$(function(){
	var register=new register_function();
});
</script>
<title>
注册帐号
</title>
</head>
<body>
<div class="login_body">
</div>
<div class="login_form_container">
	<div class="login_form">
	<!-- 提示框 -->
	<div class="login_form_remind">
		<span class="login_remind login_remind_bottom" id="login_login" data-remind="0">
			&nbsp;注册
		</span>
		<span class="login_remind" id="login_bound" data-remind="1">
			&nbsp;绑定
		</span>
	</div>
	<!-- 注册 -->
	<div class="login_panel">

		<!-- 手机号码 -->
		<div class="login_phone">
			<input type="text" id="login_name" name="phone" placeholder="用户名" />
		</div>

		<!-- 手机号码 -->
		<div class="login_phone">
			<input type="text" id="login_phone" name="phone" placeholder="手机号码(登录使用)" />
		</div>

		<!-- 密码 -->
		<div class="login_password">
			<input type="password" id="login_password" name="password" placeholder="密码" />
		</div>
		<!-- 确认密码 -->
		<div class="login_repassword">
			<input type="password" id="login_repassword" name="repassword" placeholder="确认密码" />
		</div>


		<!-- 注册按钮 -->
		<div class="login_btn cursor_pointer">
			&nbsp;注册
		</div>
		<!-- 返回按钮 -->
		<a href="{{url('login/index.html')}}">
			<div class="login_back_btn cursor_pointer">
			&nbsp;登录
		</div>
		</a>
		<!-- 底部 -->
		<div class="login_bottom">
			<span class="login_bottom_span">
				<a class="login_direct">
					注册说明
				</a>
			</span>
			<span class="login_bottom_span">
				<a href="{{url('index/index.html')}}">
					返回首页
				</a>
			</span>
		</div>
	</div>
	<!-- 绑定 -->
	<div class="login_bound">
		<!-- 帐号 -->
		<div class="login_user">
			<input type="text" id="login_bound_user" placeholder="要绑定的帐号/手机号" />
		</div>
		<!-- 密码 -->
		<div class="login_password">
			<input type="password" id="login_bound_password" placeholder="密码" />
		</div>
		<!-- 绑定按钮 -->
		<div class="login_bound_btn cursor_pointer">
			&nbsp;绑定
		</div>
	</div>
	</div>
</div>
<!-- 注册声明 -->
<div class="login_statement">
	<div class="login_statement_remind">
		&nbsp;注册声明
	</div>
	<div class="login_statement_close">
	</div>
	<div class="login_statement_content">
		1.信息的录入<br />
		不得填写任何违反有关法律规定信息；<br />
		不得填报任何不完整、虚假的信息； <br />
		用户填报的内容和提供的证件完全真实有效，如有不实，用户承担由此产生的一切后果和相关责任<br />
		<br />
		2.信息的使用<br />
		本网站提供的其它信息，仅与其相应内容有关的目的而被使用； <br />
		不得将任何本系统的信息用作任何商业目的。 <br />
		<br />
		3.信息的公开 <br />
		在本网站所登陆的任何信息，均有可能被任何本网站的访问者浏览，也可能被错误使用。本网站对此将不予承担任何责任。<br />
		<br />
		4.信息的准确性 <br />
		任何在本网站发布的信息，均必须符合合法、准确、及时、完整的原则。但本网站将不能保证所有由第三方提供的信息，或本网站自行采集的信息完全准确。使用者了解，对这些信息的使用，需要经过进一步核实。本网站对访问者未经自行核实误用本网站信息造成的任何损失不予承担任何责任。 <br />
		<br />
		5.信息更改与删除 <br />
		除了信息的发布者外，任何访问者不得更改或删除他人发布的任何信息。本网站有权根据其判断保留修改或删除任何不适信息之权利。 <br />
		<br />
		7.自责 <br />
		所有使用本网站的用户，对使用本网站信息和在本网站发布信息的被使用，承担完全责任。本网站对任何因使用本网站而产生的第三方之间的纠纷，不负任何责任。 <br />
		<br />
		8.服务终止 本网站有权在预先通知或不予通知的情况下终止任何免费服务。 <br />
		<br />
		9.本网站因正常的系统维护、系统升级，或者因网络拥塞而导致网站不能访问，本网站不承担任何责任。 <br />
		<br />
		10.特别声明本协议及其修改权、解释权属怪大叔小分队。<br />
		<br />
	</div>
	<div class="login_statement_btn">
		&nbsp;确定
	</div>
</div>
<div class="login_statement_envelop">
</div>
</body>
</html>