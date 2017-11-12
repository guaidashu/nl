<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/index.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/weight.css')}}" />
	<title>标准体重计算</title>
</head>
<body>
@include('./../common/navigation')

<div class="nl_main_container">
	<div class="nl_spacing_40"></div>
		<div class="nl_recommend_container">
		<div class="nl_recommend_left">
			<div class="nl_recommend_left_container">
				<div class="nl_main_info_remind" style="padding-top:0px;">
					<div class="nl_main_info_remind_content">
						<div style="border-bottom:1px solid #d6d9db;width:100%;height:40px;"><b>标准体重计算</b></div>
					</div>
				</div>
				<div class="nl_recommend_left_1_content">
					<div class="nl_menu_info_container">

						<div class="nl_weight_counter_container">
							<div style="width:100%;height:69px;">
								<div class="nl_weight_counter_container_1">
									<form class="am-form">
										<label for="height">身高(cm)：</label>
										<input type="text" id="height" placeholder="你的身高" required/>
									</form>
								</div>
								<div class="nl_weight_counter_container_2">
									<form class="am-form">
										<label for="weight">体重(kg)：</label>
										<input type="text" id="weight" placeholder="体重" required/>
									</form>
								</div>
							</div>
						</div>
						<div class="nl_weight_counter_container">
							<label>性别：</label>
							<input type="radio" class="safe_radio" name="sex" value="1" id="nl_male" /><label for="nl_male" id="safe_radio_label" ></label><span class="safe_radio_content">&nbsp;男&nbsp;</span>
							<input type="radio" class="safe_radio" name="sex" value="1" id="nl_female" /><label for="nl_female" id="safe_radio_label" ></label><span class="safe_radio_content">&nbsp;女&nbsp;</span>
						</div>
						
						<div class="nl_weight_counter_container">
							<button type="button" class="counter_weight am-btn am-btn-primary am-btn-block">开始计算</button>
							<div id="nl_status_container">
								<div><b>标准体重应为：</b><span id="std_width" style="color:red;""></span></div>
								<div><b>结果：</b><span id="nl_status"></span></div>
							</div>
						</div>

					</div>
				</div>

			</div>
			

			<!-- 减肥 -->
			<div class="nl_spacing_50"></div>
			<div class="nl_recommend_left_container">
				<div class="nl_recommend_left_1">
					<div class="nl_recommend_left_1_span">
						减肥推荐
					</div>
				</div>
				<div class="nl_spacing_20"></div>
				<div class="nl_recommend_left_1_content">
					<!-- 养生推荐 -->
@foreach($jf as $k => $v)
@if($k%2==0)
					<div class="nl_recommend_content">
						<div class="nl_recommend_content_left">
							<div class="nl_recommend_content_left_img">
								<a href="{{url('data/getMenuData.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">
									<img src="{{$v->imgurl}}" alt="{{$v->name}}" />
								</a>
							</div>
							<div class="nl_recommend_content_left_content">
								<div class="nl_food_name">
									<a href="{{url('data/getMenuData.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">{{$v->name}}</a>
								</div>
								<div class="nl_food_power">
									{{$v->menu_describe}}
								</div>
							</div>
						</div>	
@endif
@if($k%2==1)
						<div class="nl_recommend_content_right">
							<div class="nl_recommend_content_left_img">
								<a href="{{url('data/getMenuData.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">
									<img src="{{$v->imgurl}}" alt="{{$v->name}}" />
								</a>
							</div>
							<div class="nl_recommend_content_left_content">
								<div class="nl_food_name">
									<a href="{{url('data/getMenuData.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">{{$v->name}}</a>
								</div>
								<div class="nl_food_power">
									{{$v->menu_describe}}
								</div>
							</div>
						</div>
					</div>		
@endif
@endforeach
@if(count($jf)%2 == 1)
					</div>
@endif
				</div>
			</div>



			<!-- 增重 -->
			<div class="nl_spacing_50"></div>
			<div class="nl_recommend_left_container">
				<div class="nl_recommend_left_1">
					<div class="nl_recommend_left_1_span">
						营养推荐
					</div>
				</div>
				<div class="nl_spacing_20"></div>
				<div class="nl_recommend_left_1_content">
					<!-- 营养推荐 -->
@foreach($yy as $k => $v)
@if($k%2==0)
					<div class="nl_recommend_content">
						<div class="nl_recommend_content_left">
							<div class="nl_recommend_content_left_img">
								<a href="{{url('data/getMenuData.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">
									<img src="{{$v->imgurl}}" alt="{{$v->name}}" />
								</a>
							</div>
							<div class="nl_recommend_content_left_content">
								<div class="nl_food_name">
									<a href="{{url('data/getMenuData.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">{{$v->name}}</a>
								</div>
								<div class="nl_food_power">
									{{$v->menu_describe}}
								</div>
							</div>
						</div>	
@endif
@if($k%2==1)
						<div class="nl_recommend_content_right">
							<div class="nl_recommend_content_left_img">
								<a href="{{url('data/getMenuData.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">
									<img src="{{$v->imgurl}}" alt="{{$v->name}}" />
								</a>
							</div>
							<div class="nl_recommend_content_left_content">
								<div class="nl_food_name">
									<a href="{{url('data/getMenuData.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">{{$v->name}}</a>
								</div>
								<div class="nl_food_power">
									{{$v->menu_describe}}
								</div>
							</div>
						</div>
					</div>		
@endif
@endforeach
@if(count($yy)%2 == 1)
					</div>
@endif
				</div>
			</div>

		</div>

		<!-- 右侧栏目 -->
		@include('./../common/right')

	</div>
</div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/weight.js')}}"></script>
<script type="text/javascript">
	$(function(){
		var calorie = new calorie_function();
	});
</script>
</body>
</html>