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
				<!-- <div class="nl_recommend_left_1">
					<div class="nl_recommend_left_1_span">
						菜品制作
					</div>
				</div> -->
				<div class="nl_main_info_remind" style="padding-top:0px;">
					<div class="nl_main_info_remind_content">
						<div style="border-bottom:1px solid #d6d9db;width:100%;height:40px;"><b>{{$info['name']}}</b></div>
					</div>
				</div>
				<div class="nl_recommend_left_1_content">
					<div class="nl_menu_info_container">
						<div class="nl_menu_info_stips">
							<b>小提示：</b><br />{!!$info['stips']!!}
						</div>


						<!-- 时间和分量 -->
@if(!empty($info['time']))
						<div class="nl_spacing_10"></div>
						<div class="nl_menu_info_time">
							<b>时间和分量：</b>
@foreach($info['time'] as $k => $v)
@if($k%2==0)
							<div class="nl_menu_info_time_container">
								<div class="nl_menu_info_time_content_left">
									<span>{{$info['timeRemind'][$k]}}{{$v}}</span>
								</div>
@endif
@if($k%2==1)
								<div class="nl_menu_info_time_content_right">
									<span>{{$info['timeRemind'][$k]}}{{$v}}</span>
								</div>
							</div>
@endif
@endforeach
@if(count($info['time'])%2 == 1)
							</div>
@endif
						</div>
@endif

						<!-- 主料 -->
						<div class="nl_spacing_10"></div>
						<div class="nl_menu_info_food">
							<b>主料</b>
@foreach($info['mainFood'] as $k => $v)
@if($k%2 == 0)
							<div class="nl_menu_info_food_container">
								<div class="nl_menu_info_food_left">
									{{$v}}：{{$info['foodContent'][$k]}}
								</div>
@endif
@if($k%2 == 1)
								<div class="nl_menu_info_food_right">
									{{$v}}：{{$info['foodContent'][$k]}}
								</div>
							</div>
@endif
@endforeach
@if(count($info['mainFood'])%2==1)
							</div>
@endif
						</div>


						<!-- 辅料 -->
						<!-- {{$foodNum = count($info['mainFood'])}} -->
						<div class="nl_spacing_10"></div>
						<div class="nl_menu_info_food">
							<b>辅料</b>
@foreach($info['assistFood'] as $k => $v)
@if($k%2 == 0)
							<div class="nl_menu_info_food_container">
								<div class="nl_menu_info_food_left">
									{{$v}}：{{$info['foodContent'][$k+$foodNum]}}
								</div>
@endif
@if($k%2 == 1)
								<div class="nl_menu_info_food_right">
									{{$v}}：{{$info['foodContent'][$k+$foodNum]}}
								</div>
							</div>
@endif
@endforeach
@if(count($info['assistFood'])%2==1)
							</div>
@endif
						</div>


						<!-- 制作步骤 -->
						<div class="nl_spacing_10"></div>
						<div class="nl_menu_info_food">
							<b>制作步骤</b>
@foreach($info['step'] as $k => $v)
							<div class="nl_menu_info_food_step">
								<div class="nl_menu_info_food_step_img">
									<img src="{{$info['stepImg'][$k]}}" />
								</div>
								<div class="nl_menu_info_food_step_content">
									<b>{{$k+1}}</b>.&nbsp;&nbsp;{!!$v!!}
								</div>
							</div>
@endforeach
						</div>
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