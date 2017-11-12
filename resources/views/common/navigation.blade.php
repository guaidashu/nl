<div class="nl_head">
	<div class="nl_navigation_container">
		<div class="nl_navigation">
			<div class="nl_logo"></div>
			<!-- 此处是点击按钮，显示是三条横线，点击就显示侧边栏 -->
			<div class="nl_meun">
				<a data-rel="open" class="doc-oc-js cursor_pointer"><i class="am-menu-toggle-icon am-icon-bars"></i></a>
			</div>
			<div class="nl_login">
@if(empty($name))
				<span><a href="{{url('login/index.html')}}">登录</a></span>
				<span>|</span>
				<span><a href="{{url('login/register.html')}}" target="_blank">注册</a></span>
@else
				<span><a href="#" style="font-size:15px;">{{$name}}</a></span>&nbsp;
				<span><a href="#" class="nl_exit" style="font-size:15px;">退出</a></span>
@endif
			</div>
			<ul class="nl_nav_ul">
				<a href="{{url('index/index.html')}}" target="_blank"><li> 首页 </li></a>
				<a href="{{url('counter/calorie.html')}}" class="nl_kll"><li> 卡路里计算器 </li></a>
				<a href="{{url('counter/counterWeight.html')}}"><li> 标准体重计算 </li></a>
				<a href="#"><li> 热量查询 </li></a>
			</ul>
		</div>
	</div>
	<div class="nl_navigation_carousel_1">
	</div>
	<div class="nl_navigation_carousel_2">
	</div>
	<div class="nl_navigation_carousel_3">
	</div>
	<div class="nl_navigation_mask">
	</div>
	<form method="GET" action="{{url('data/getFoodData.html')}}" autocomplete="off" class="nl_search_container">
		<div class="nl_search_input">
			<input id="nl_search_input" placeholder="输入你想要知道的食物名噢" type="text" name="food" maxlength="60" />
			<button type=“submit” id="nl_search_btn">搜索</button>
			<label class="nl_search_btn" for="nl_search_btn"><i class="am-icon-search" aria-hidden="true"></i></label>
		</div>
	</form>
</div>

<!--mobile header start-->
<div class="ca_m_header">
  <div class="am-g">
    <div class="am-u-sm-2">
      <div class="menu-bars">
        <!-- 侧边栏内容 -->
        <nav data-am-widget="menu" class="am-menu  am-menu-offcanvas1" data-am-menu-offcanvas >
	        <div id="doc-oc-demo1" class="am-offcanvas" >
	          <div class="am-offcanvas-bar nl_nav_mobile_container_background">
		        <div class="nl_spacing_20">
				</div>
				<div class="nl_logo_container">
					<div class="nl_logo_img">
					</div>
				</div>
				<ul class="am-list am-list-self admin-sidebar-list" id="collapase-nav-1">
				  <li  class="am-panel">
				    <a  href="{{url('index/index.html')}}" target="_blank"><i class="am-icon-home am-margin-left-sm"></i> 首页</a>
				  </li>

				  <li  class="am-panel">
				    <a  href="{{url('counter/calorie.html')}}" class="nl_kll"><i class="am-icon-home am-margin-left-sm"></i> 卡路里计算器</a>
				  </li>

				  <li  class="am-panel">
				    <a  href="{{url('counter/counterWeight.html')}}"><i class="am-icon-home am-margin-left-sm"></i> 标准体重计算</a>
				  </li>

				  <li  class="am-panel">
				    <a  href="#"><i class="am-icon-home am-margin-left-sm"></i> 热量查询</a>
				  </li>

				  <div class="nl_spacing_20"></div>
				  <li class="am-panel">
					  <div class="nl_login_container">
@if(empty($name))
						<a href="{{url('login/index.html')}}">登录</a>
						<span>|</span>
						<a href="{{url('login/register.html')}}">注册</a>
@else
						<a href="#" style="font-size:15px;">{{$name}}</a>&nbsp;<a href="#" class="nl_exit" style="font-size:15px;">退出</a>
@endif
					  </div>
				  </li>
				</ul>
	          </div>
	        </div>
	     </nav>
      </div>
    </div>
  </div>
<!--mobile header end-->
</div>