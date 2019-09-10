// JavaScript Document
$(document).ready(function() {
    $("#backtop").click(function() {
		$("html,body").animate({scrollTop: $("body").offset().top},500);
    });
});

//返回顶端收缩
var backtop = new Headroom(document.querySelector("#backtop"),{
	tolerance: 5,
	offset: 200,
});
backtop.init();