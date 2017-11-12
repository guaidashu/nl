;(function($){
	var dataSingle_function = function()
	{
		var self = this;
		this.body = $(document.body);
		this.autoParentHeight();
		this.detail = true;
		$.scrollTo(".nl_main_container", 300);
		this.body.delegate(".nl_main_info_detail_btn", "click", function(){
			if(self.detail){
				self.detail = false;
				$(".nl_main_info_detail").css("display", "block");
				$(".nl_main_info_detail_btn").html(">> 收起");
				setTimeout(function(){
					self.autoParentHeight();
				}, 100);
			}else{
				self.detail = true;
				$(".nl_main_info_detail").css("display", "none");
				$(".nl_main_info_detail_btn").html(">> 全部");
				setTimeout(function(){
					self.autoParentHeight();
				}, 100);
			}
			
		});
		window.onresize = function(){
			self.autoParentHeight();
		}
		// this.test();
	};
	dataSingle_function.prototype = {
		test:function()
		{
			var self = this;
			yy_init($(document).width());
		},
		autoParentHeight:function()
		{
			var self = this;
			var screenWidth = parseInt($(document).width());
			var leftHeight = parseInt($(".nl_recommend_left").css("height"));
			var rightHeight = parseInt($(".nl_recommend_right").css("height"));
			if(screenWidth > 750){
				if(rightHeight > leftHeight){
					$(".nl_recommend_container").css("height", rightHeight + "px");
				}else{
					$(".nl_recommend_container").css("height", leftHeight + "px");
				}
			}else{
				$(".nl_recommend_container").css("height", leftHeight + 30 + rightHeight + "px");
			}
		}
	},
	window['dataSingle_function'] = dataSingle_function;
})(jQuery);