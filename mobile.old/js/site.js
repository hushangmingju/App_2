/*选项卡*/
$(document).ready(function() {
	//返回顶端
//	$("#backtop").click(function() {
//		$("html,body").animate({scrollTop: $("body").offset().top},500);
//  });
	$('.message-send').click(function() {
		alert("提交成功");
	});
	
	//计算器弹窗
	$(".js-kai").click(function(){
		$(".jisuan").fadeIn();
		$(".close-menu").hide();
		$(".open-menu").show();
		$("header .menu,.menu-mask").fadeOut();
	});
	
	$(".js-guan").click(function(){
		$(".jisuan").fadeOut()
	});
	
	//二维码弹窗
	$(".qrcode-kai").click(function(){
		$(".pop-qrcode").fadeIn();
		$(".close-menu").hide();
		$(".open-menu").show();
		$("header .menu,.menu-mask").fadeOut();
	});
	
	$(".qrcode-guan").click(function(){
		$(".pop-qrcode").fadeOut()
	});
	
	$(".open-menu").click(function(){
		$(".open-menu").hide();
		$(".close-menu").show();
		$("header .menu,.menu-mask").fadeIn();
	});
	
	$(".close-menu,.menu-mask").click(function(){
		$(".close-menu").hide();
		$(".open-menu").show();
		$("header .menu,.menu-mask").fadeOut();
	});
	
	
	
	
	
	
	
	
	$('#calculator-price').val($('#calculator-style').children('option:selected').val());
	$('#calculator-style').change(function() {
		$('#calculator-price').val($(this).children('option:selected').val());
	});
	$('#calculator-area').change(function() {
		if($('#calculator-area').val() == "") {
			$('#calculator-total').val("");
		} else {
			//$('#calculator-total').val($('#calculator-price').val() * $('#calculator-area').val());
		}
	});
	$('#calculator-area').keyup(function() {
		if($('#calculator-area').val() == "") {
			$('#calculator-total').val("");
		} else {
			//$('#calculator-total').val($('#calculator-price').val() * $('#calculator-area').val());
		}
	});
	$("#calculator-yuyue").click(function() {
		var $style = $('#calculator-style').children('option:selected').text();
		var $price = $('#calculator-style').children('option:selected').val();
		var $area = $('#calculator-area').val();
		var $total = $price * $area;		var $mobile = $('#calculator-mobile').val();				if($mobile==""){						alert('手机号不能为空');						return false;					}else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){						alert("手机号码格式不正确！"); 						return false;		}				$('#calculator-total').val( $('#calculator-price').val() * $('#calculator-area').val() ); 						var POSTDATA = {"type":'calc2',"calc-style":$style,"calc-area":$area,"calc-price":$price,"calc-total":$total,"tel":$mobile};		
		//window.location.href = "yuyue.html?s=" + $style + "&p=" + $price + "&a=" + $area + "&t=" + $total;		$.ajax({						type: 'POST',						url: "../yuyuesave.php",							data: POSTDATA,						dataType: "json",						success: function(data) { 						},			error: function(data) { 							},					});				
		return false;
	});

	$("#bottomyueyuebutton").click(function() {
		var name = $('#bottomyueyuename').val();
		var tel = $('#bottomyueyuetel').val();
		$.ajax({
			type: 'POST',
			url: "yuyuesave.php",
			data: $("#bottomyuyue").serializeArray(),
			dataType: "json",
			success: function(data) {
				alert("" + data.msg);
			},
			error: function(data) {
				alert("网络错误，请重试。");
			},
		});
		return false;
	});
	
	
	
	
	
	
	
	
	
	//选项卡
    jQuery.jqtab = function(tabtit,tabcon) {
        $(tabcon).hide();
        $(tabtit+" div:first").addClass("active").show();
        $(tabcon+":first").show();
        
        var tabArr = $(tabtit+" div");
		$(tabtit+" div").css("width",(100/tabArr.length)+"%");
    
        $(tabtit+" div").click(function() {
            $(tabtit+" div").removeClass("active");
            $(this).addClass("active");
            $(tabcon).hide();
            var activeTab = $(this).find("a").attr("data-toggle");
            $("#"+activeTab).fadeIn();
            return false;
        });
    };
	
    //调用方法如下
    $.jqtab("#show-tabs",".show-tab");
});