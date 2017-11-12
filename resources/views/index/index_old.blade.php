<!DOCTYPE html>
<html>
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/index.css')}}">
	<title>营养标签</title>
</head>
<body>
<!-- 主页面只需要一个搜索框 -->
<div class="nl_search_container">
	<div class="nl_logo">
	</div>
	<div class="nl_start">
		<form action="{{url('data/getFoodData.html')}}" method="GET">
		<input type="text" id="nl_search" name="food" placeholder="无所不知琪童鞋 good night" autocomplete="off" />
		<input type="button" name="nl_btn" value="&nbsp;品一下" class="nl_btn" />
		</form>
	</div>
	<div class="nl_bottom_record">
		<div style="width:100%;padding-left:15px;padding-right:15px;position:relative;">
			Copyright &#169; 2017 Designed by 奕弈   &nbsp; <a target="oo" href="http://www.miitbeian.gov.cn/" style="color:#169ADA;">蜀ICP备16013626号-3</a>
		</div>
    </div>
</div>
<!-- <div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="{{url('index/index.html')}}">计算机技术协会</a>
</div>
<div style="width:100%;height:50px;"></div> -->
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/index.js')}}"></script>
<script type="text/javascript">
	$(function(){
		var index = new index_function();
	});
</script>
</body>
</html>