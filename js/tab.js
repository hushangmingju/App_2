/*选项卡*/
$(document).ready(function() {
	$(".js-kai").click(function(){
		$(".jisuan").fadeIn()
	});
	
	$(".js-guan").click(function(){
		$(".jisuan").fadeOut()
	});
	
	//选项卡
    jQuery.jqtab = function(tabtit,tabcon) {
        $(tabcon).hide();
        $(tabtit+" li:first").addClass("active").show();
        $(tabcon+":first").show();
        
        var tabArr = $(tabtit+" li");
		$(tabtit+" li").css("width",(100/tabArr.length)+"%");
    
        $(tabtit+" li").click(function() {
            $(tabtit+" li").removeClass("active");
            $(this).addClass("active");
            $(tabcon).hide();
            var activeTab = $(this).find("a").attr("data-toggle");
            $("#"+activeTab).fadeIn();
            return false;
        });
    };
	
    //调用方法如下
    $.jqtab("#show-tabs",".show-tab-pane");
});