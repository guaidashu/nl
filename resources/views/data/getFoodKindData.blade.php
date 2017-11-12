<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/index.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/data.css')}}">
	<title>{{$foodName}}</title>
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
						{{$foodName}}
					</div>
				</div>
				<div class="nl_spacing_20"></div>
				<div class="nl_recommend_left_1_content">
@foreach($data as $k => $v)
@if($k%2==0)
					<div class="nl_recommend_content">
						<div class="nl_recommend_content_left">
							<div class="nl_recommend_content_left_img">
								<a href="{{url('data/getFoodDataSingle.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">
									<img src="{{url('common/getImg.html')}}?imgurl={{$v->imgurl}}" alt="{{$v->name}}" />
								</a>
							</div>
							<div class="nl_recommend_content_left_content">
								<div class="nl_food_name">
									<a href="{{url('data/getFoodDataSingle.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">{{$v->name}}</a>
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
								<a href="{{url('data/getFoodDataSingle.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">
									<img src="{{url('common/getImg.html')}}?imgurl={{$v->imgurl}}" alt="{{$v->name}}" />
								</a>
							</div>
							<div class="nl_recommend_content_left_content">
								<div class="nl_food_name">
									<a href="{{url('data/getFoodDataSingle.html')}}?url={{$v->url}}" target="_blank" title="{{$v->name}}">{{$v->name}}</a>
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
							<a href="{{url('data/getFoodKindData.html')}}?kind={{$kind}}&name={{$foodName}}&page={{$v}}"><span>{{$v}}</span></a>
	@endif
	@endforeach
							<span>页</span>
						</div>
					</div>
				</div>
			</div>
			
		</div>


		<!-- 右侧栏目 -->
		@include('./../common/right')

	</div>
</div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/data.js')}}"></script>
<script type="text/javascript">
$(function(){
	var data = new data_function();
});
</script>
</body>
</html>