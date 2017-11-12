;(function($){
	var calorie_function = function()
	{
		var self = this;
		this.body = $(document.body);
		this.autoParentHeight();
		window.onresize = function(){
			self.autoParentHeight();
		}
		document.getElementById("nl_calorie_value").focus();
		// this.test();
	};
	calorie_function.prototype = {
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
	window['calorie_function'] = calorie_function;
})(jQuery);