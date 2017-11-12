	<div class="nl_recommend_right">
			<div class="nl_recommend_right_1">
				<div class="nl_recommend_right_1_span">
					食物分类
				</div>
			</div>
			<div class="nl_spacing_20"></div>
			<!-- 食物分类主显示框 -->
			<div class="nl_recommend_right_kind">
				<!-- 食物分类 -->
				<!-- {{$count = count($foodKind)}} -->
@foreach($foodKind as $k => $v)
				<div class="nl_recommend_right_kind_content">
					<div class="nl_recommend_right_kind_img">
						<a href="{{url('data/getFoodKindData.html')}}?kind={{$v->url}}&name={{$v->name}}" target="_blank" title="{{$v->name}}" >
							<img src="{{$v->imgurl}}" />
						</a>
					</div>
					<div class="nl_recommend_right_kind_content_show">
						<div class="nl_recommend_right_kind_name">
							<a href="{{url('data/getFoodKindData.html')}}?kind={{$v->url}}&name={{$v->name}}" target="_blank" title="{{$v->name}}" >{{$v->name}}</a>
						</div>
						<div class="nl_recommend_right_kind_kind">
@if($count-1 != $k)
@foreach($v->childname as $key => $value)
							<a href="{{url('data/getFoodDataSingle.html')}}?url={{$v->childurl[$key]}}" target="_blank" title="{{$value}}"><span>{{$value}}</span></a>&nbsp;
@endforeach
@else
@foreach($v->childname as $key => $value)
							<a href="{{url('data/getFoodKindData.html')}}?kind={{$v->childurl[$key]}}&name={{$value}}" target="_blank" title="{{$value}}"><span>{{$value}}</span></a>&nbsp;
@endforeach
@endif
						</div>
					</div>
				</div>
@endforeach
			</div>
		</div>