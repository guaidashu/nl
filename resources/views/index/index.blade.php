<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/index.css')}}">
	<title>营养标签</title>
</head>
<body>
@include('./../common/navigation')

<div class="nl_main_container">
	<div class="nl_spacing_40"></div>
	<!-- 推荐 -->
	<!-- 
		对于推荐这一块，我们提取访问最多的前十条
	 -->
	 <!-- recommend 推荐 -->
	<div class="nl_recommend_container">
		<div class="nl_recommend_left">
			<div class="nl_recommend_left_container">
				<div class="nl_recommend_left_1">
					<div class="nl_recommend_left_1_span">
						热搜推荐
					</div>
				</div>
				<div class="nl_spacing_20"></div>
				<div class="nl_recommend_left_1_content">
@foreach($data as $k => $v)
@if($k%2==0)
					<div class="nl_recommend_content">
						<div class="nl_recommend_content_left">
							<div class="nl_recommend_content_left_img">
								<a href="{{url('data/getFoodDataSingle.html')}}?url={{$v->tmpurl}}" target="_blank" title="{{$v->name}}">
									<img src="{{url('common/getImg.html')}}?imgurl={{$v->imgurl}}" alt="{{$v->name}}" />
								</a>
							</div>
							<div class="nl_recommend_content_left_content">
								<div class="nl_food_name">
									<a href="{{url('data/getFoodDataSingle.html')}}?url={{$v->tmpurl}}" target="_blank" title="{{$v->name}}">{{$v->name}}</a>
								</div>
								<div class="nl_food_power">
									{{$v->rl}}(100克)
								</div>
							</div>
						</div>	
@endif
@if($k%2==1)
						<div class="nl_recommend_content_right">
							<div class="nl_recommend_content_left_img">
								<a href="{{url('data/getFoodDataSingle.html')}}?url={{$v->tmpurl}}" target="_blank" title="{{$v->name}}">
									<img src="{{url('common/getImg.html')}}?imgurl={{$v->imgurl}}" alt="{{$v->name}}" />
								</a>
							</div>
							<div class="nl_recommend_content_left_content">
								<div class="nl_food_name">
									<a href="{{url('data/getFoodDataSingle.html')}}?url={{$v->tmpurl}}" target="_blank" title="{{$v->name}}">{{$v->name}}</a>
								</div>
								<div class="nl_food_power">
									{{$v->rl}}(100克)
								</div>
							</div>
						</div>
					</div>		
@endif
@endforeach
@if(count($data)%2 == 1)
					</div>
@endif
				</div>
				<div class="nl_spacing_50"></div>
				<div class="nl_recommend_left_1">
					<div class="nl_recommend_left_1_span">
						{{$date}}菜品推荐
					</div>
				</div>
				<div class="nl_spacing_20"></div>
				<div class="nl_recommend_left_1_content">
					<!-- 季节推荐 -->
@foreach($menu as $k => $v)
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
@if(count($menu)%2 == 1)
					</div>
@endif
				</div>

				<div class="nl_spacing_50"></div>
				<div class="nl_recommend_left_1">
					<div class="nl_recommend_left_1_span">
						养生推荐
					</div>
				</div>
				<div class="nl_spacing_20"></div>
				<div class="nl_recommend_left_1_content">
					<!-- 养生推荐 -->
@foreach($ys as $k => $v)
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
@if(count($ys)%2 == 1)
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

<script type="text/javascript" src="{{URL::asset('js/index.js')}}"></script>
<script type="text/javascript">
	$(function(){
		var index = new index_function();
	});
</script>
</body>
</html>