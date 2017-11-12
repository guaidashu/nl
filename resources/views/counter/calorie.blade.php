<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/index.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/calorie.css')}}">
<style>
.nl_navigation_container{
	background-color:rgba(0, 0, 0, .7);
}
.nl_nav_ul li:hover{
	background-color:rgba(80, 0, 0, 1);
}
.nl_head{
	height:60px;
}
</style>
	<title>卡路里计算器</title>
</head>
<body>
@include('./../common/navigation_single')

<div class="nl_main_container">
	<div class="nl_spacing_40"></div>
	<div class="nl_recommend_container">
		<div class="nl_recommend_left">
			<div class="nl_recommend_left_container">
				<div class="nl_recommend_left_2">
					<form method="GET" action="{{url('counter/calorie.html')}}" autocomplete="off">
						<input type="text" name="food" id="nl_calorie_value" maxlength="60" placeholder="搜索食物" />
						<input type="submit" id="nl_calorie_search">
						<label for="nl_calorie_search" class="nl_calorie_search">
							<i class="am-icon-search" aria-hidden="true"></i>
						</label>
					</form>
				</div>
				<div class="nl_spacing_20"></div>
				<div class="nl_recommend_left_1_content">
@foreach($data as $k => $v)
@if($k%2==0)
					<div class="nl_recommend_content">
						<div class="nl_recommend_content_left">
							<div class="nl_recommend_content_left_img">
								<a class="cursor_pointer" data-name="{{$v->name}}" data-img="{{$v->imgurl}}" data-power="{{$v->power}}" title="{{$v->name}}">
									<img src="{{url('common/getImg.html')}}?imgurl={{$v->imgurl}}" alt="{{$v->name}}" />
								</a>
							</div>
							<div class="nl_recommend_content_left_content">
								<div class="nl_food_name">
									<a class="cursor_pointer" data-name="{{$v->name}}" data-img="{{$v->imgurl}}" data-power="{{$v->power}}" title="{{$v->name}}">{{$v->name}}</a>
								</div>
								<div class="nl_food_power">
									{{$v->power}}
								</div>
							</div>
						</div>	
@endif
@if($k%2==1)
						<div class="nl_recommend_content_right">
							<div class="nl_recommend_content_left_img">
								<a class="cursor_pointer" data-name="{{$v->name}}" data-img="{{$v->imgurl}}" data-power="{{$v->power}}" title="{{$v->name}}">
									<img src="{{url('common/getImg.html')}}?imgurl={{$v->imgurl}}" alt="{{$v->name}}" />
								</a>
							</div>
							<div class="nl_recommend_content_left_content">
								<div class="nl_food_name">
									<a class="cursor_pointer" data-name="{{$v->name}}" data-img="{{$v->imgurl}}" data-power="{{$v->power}}" title="{{$v->name}}">{{$v->name}}</a>
								</div>
								<div class="nl_food_power">
									{{$v->power}}
								</div>
							</div>
						</div>
					</div>		
@endif
@endforeach
@if(count($data)%2 == 1)
					</div>
@endif	
					<div class="nl_spacing_20"></div>
					<div class="nl_search_page">
						<div class="nl_search_page_container">
							<span>第</span>
@foreach($arrPage as $k => $v)
@if($page == $v)
							<span>{{$v}}</span>
@else
							<a href="{{url('counter/calorie.html')}}?food={{$pageFood}}&page={{$v}}"><span>{{$v}}</span></a>
@endif
@endforeach
							<span>页</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 左边容器end -->
		<div class="nl_recommend_right">
			<div class="nl_recommend_right_1">
				<div class="nl_recommend_right_1_span">
					选择的食物
				</div>
			</div>
			<div class="nl_spacing_20"></div>
			<div class="nl_recommend_right_kind">
				<div class="nl_time_container">
					<!-- 早 -->
					<div class="nl_time_morning nl_time_bottom_active">
						早上
						<label class="nl_time_bottom_label_active"></label>
					</div>
					<!-- 中 -->
					<div class="nl_time_noon nl_time_bottom_negative">
						中午
						<label class="nl_time_bottom_label_negative"></label>
					</div>
					<!-- 晚 -->
					<div class="nl_time_night nl_time_bottom_negative">
						晚上
						<label class="nl_time_bottom_label_negative"></label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('./../common/bottom_single')

<script type="text/javascript" src="{{URL::asset('js/calorie.js')}}"></script>
<script type="text/javascript">
	$(function(){
		var calorie = new calorie_function();
	});
</script>
</body>
</html>