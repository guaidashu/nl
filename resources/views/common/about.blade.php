			<div class=nl_spacing_30></div>
			<div class="nl_recommend_left_container">
				<div class="nl_recommend_left_1">
					<div class="nl_recommend_left_1_span">
						相关菜品
					</div>
				</div>
				<div class="nl_spacing_20"></div>
				<div class="nl_recommend_left_1_content">
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
			</div>