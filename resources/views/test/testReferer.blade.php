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
	
</div>
<!-- <div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="{{url('index/index.html')}}">计算机技术协会</a>
</div>
<div style="width:100%;height:50px;"></div> -->
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/test.js')}}"></script>
<script type="text/javascript" src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
<script type="text/javascript">
	$(function(){
		var test = new test_function(returnCitySN);
	});
</script>
</body>
</html>