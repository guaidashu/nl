<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/index.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/data.css')}}">
	@if(!empty($info['name']))
	<title>{{$info['name']}}</title>
	@else
	<title>无此结果</title>
	@endif
</head>
<body>
@include('./../common/navigation')

<div class="nl_main_container">
	<div class="nl_spacing_40"></div>
	<div class="nl_recommend_container">
		<div class="nl_recommend_left">
			<div class="nl_recommend_left_container">
				<div class="nl_recommend_left_1">
					<div class="nl_recommend_left_1_span">
@if(!empty($info['name']))
						{{$info['name']}}
@else
						无此结果
@endif
					</div>
				</div>
				<div class="nl_spacing_20"></div>
				<div class="nl_recommend_left_1_content">
					<!-- debug($info) -->
					<div class="nl_main_info_container">
						<div class="nl_main_info_img">
							<img src="{{url('common/getImg.html')}}?imgurl={{$info['imgurl']}}" />
						</div>
						<div class="nl_main_info_content">
@if(!empty($info['bm']))
							<!-- 别名 -->
							<div class="nl_main_info_bm">
								<b style="font-size:15px;">别名：</b>
								{{$info['bm']}}
							</div>
@endif
@if(!empty($info['rldetail']))
							<!-- 热量 -->
							<div class="nl_main_info_bm">
								<b style="font-size:15px;">热量：</b>
								{{$info['rldetail']}}
							</div>
@endif
@if(!empty($info['fl']))
							<!-- 分类 -->
							<div class="nl_main_info_bm">
								<b style="font-size:15px;">分类：</b>
								<a href="{{url('data/getFoodKindData.html')}}?kind={{$info['flurl']}}&name={{$info['fl']}}">{{$info['fl']}}</a>
							</div>
@endif
@if(!empty($info['pj']))
							<!-- 热量 -->
							<div class="nl_main_info_bm">
								<b style="font-size:15px;"><span style="color:red;">{{$info['pj']}}</span>：</b>
								{{$info['pj_content']}}
							</div>
@endif
						</div>
					</div>
				</div>
				<div class=nl_spacing_20></div>
				<div class="nl_main_info_remind">
					<div class="nl_main_info_remind_content">
						<div style="border-bottom:1px solid #d6d9db;width:100%;height:40px;"><b>营养含量(每100克)</b></div>
					</div>
				</div>
				<div class=nl_spacing_10></div>
				<div class="nl_recommend_left_1_content">
					<div class="nl_main_info_nutrition">
						<div class="nl_main_info_nutrition_left">
							<b>热量(大卡)：</b>{{$info['rl']}}
						</div>
						<div class="nl_main_info_nutrition_right">
							<b>碳水化合物(克)：</b>{{$info['tshhw']}}
						</div>
					</div>

					<div class="nl_main_info_nutrition">
						<div class="nl_main_info_nutrition_left">
							<b>脂肪(克)：</b>{{$info['zf']}}
						</div>
						<div class="nl_main_info_nutrition_right">
							<b>蛋白质(克)：</b>{{$info['dbz']}}
						</div>
					</div>

					<div class="nl_main_info_nutrition">
						<div class="nl_main_info_nutrition_left">
							<b>纤维素(克)：</b>{{$info['xws']}}
						</div>
						<div class="nl_main_info_nutrition_right">
							<b>维生素A(微克)：</b>@if(empty($info['wssa'])) —— @else {{$info['wssa']}} @endif
						</div>
					</div>

					<div class="nl_main_info_detail">

						<div class="nl_main_info_nutrition">
							<div class="nl_main_info_nutrition_left">
								<b>维生素C(毫克)：</b>@if(empty($info['wssc'])) —— @else {{$info['wssc']}} @endif
							</div>
							<div class="nl_main_info_nutrition_right">
								<b>维生素E(毫克)：</b>@if(empty($info['wsse'])) —— @else {{$info['wsse']}} @endif
							</div>
						</div>

						<div class="nl_main_info_nutrition">
							<div class="nl_main_info_nutrition_left">
								<b>胡萝卜素(微克)：</b>@if(empty($info['hlbs'])) —— @else {{$info['hlbs']}} @endif
							</div>
							<div class="nl_main_info_nutrition_right">
								<b>硫胺素(毫克)：</b>@if(empty($info['las'])) —— @else {{$info['las']}} @endif
							</div>
						</div>

						<div class="nl_main_info_nutrition">
							<div class="nl_main_info_nutrition_left">
								<b>核黄素(毫克)：</b>@if(empty($info['hhs'])) —— @else {{$info['hhs']}} @endif
							</div>
							<div class="nl_main_info_nutrition_right">
								<b>烟酸(微克)：</b>@if(empty($info['ys'])) —— @else {{$info['ys']}} @endif
							</div>
						</div>

						<div class="nl_main_info_nutrition">
							<div class="nl_main_info_nutrition_left">
								<b>胆固醇(毫克)：</b>@if(empty($info['dgc'])) —— @else {{$info['dgc']}} @endif
							</div>
							<div class="nl_main_info_nutrition_right">
								<b>镁(毫克)：</b>@if(empty($info['mei'])) —— @else {{$info['mei']}} @endif
							</div>
						</div>

						<div class="nl_main_info_nutrition">
							<div class="nl_main_info_nutrition_left">
								<b>钙(毫克)：</b>@if(empty($info['gai'])) —— @else {{$info['gai']}} @endif
							</div>
							<div class="nl_main_info_nutrition_right">
								<b>铁(毫克)：</b>@if(empty($info['tie'])) —— @else {{$info['tie']}} @endif
							</div>
						</div>

						<div class="nl_main_info_nutrition">
							<div class="nl_main_info_nutrition_left">
								<b>锌(毫克)：</b>@if(empty($info['xin'])) —— @else {{$info['xin']}} @endif
							</div>
							<div class="nl_main_info_nutrition_right">
								<b>铜(毫克)：</b>@if(empty($info['tong'])) —— @else {{$info['tong']}} @endif
							</div>
						</div>

						<div class="nl_main_info_nutrition">
							<div class="nl_main_info_nutrition_left">
								<b>锰(毫克)：</b>@if(empty($info['meng'])) —— @else {{$info['meng']}} @endif
							</div>
							<div class="nl_main_info_nutrition_right">
								<b>钾(毫克)：</b>@if(empty($info['jia'])) —— @else {{$info['jia']}} @endif
							</div>
						</div>

						<div class="nl_main_info_nutrition">
							<div class="nl_main_info_nutrition_left">
								<b>磷(毫克)：</b>@if(empty($info['lin'])) —— @else {{$info['lin']}} @endif
							</div>
							<div class="nl_main_info_nutrition_right">
								<b>钠(毫克)：</b>@if(empty($info['na'])) —— @else {{$info['na']}} @endif
							</div>
						</div>

						<div class="nl_main_info_nutrition">
							<div class="nl_main_info_nutrition_left">
								<b>硒(微克)：</b>@if(empty($info['xi'])) —— @else {{$info['xi']}} @endif
							</div>
						</div>

					</div>
					<div class="nl_main_info_detail_btn_container">
						<span class="nl_main_info_detail_btn">>> 全部</span>
					</div>
				</div>


			</div>


			<!-- 对应的食物菜品 -->
			@include('./../common/about')
			
		</div>

		<!-- 右侧栏目 -->
		@include('./../common/right')

	</div>
</div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/dataSingle.js')}}"></script>
<script type="text/javascript">
$(function(){
	var dataSingle = new dataSingle_function();
});
</script>
</body>
</html>