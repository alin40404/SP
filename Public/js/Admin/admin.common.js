var ia = {};

ia.setcookie = function(name,value,seconds,path,domain) {
	var expires = new Date();
	expires.setTime(expires.getTime() + seconds * 1000);
	document.cookie = escape(name) + '=' + escape(value)
	+ (typeof(seconds) != 'undefined' ? '; expires=' + expires.toGMTString() : '')
	+ (typeof(path) != 'undefined' ? '; path=' + path : '; path=/')
	+ (typeof(domain) != 'undefined' ? '; domain=' + domain : '');
}
ia.getcookie = function(name) {
	var cookie_start = document.cookie.indexOf(name);
	var cookie_end = document.cookie.indexOf(";", cookie_start);
	return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
}
ia.switchbar = function(){
	if(ia.getcookie('ia_admin_left_menu') != 'hide'){
		$('#frame_side').animate({'left':'-230px'},600);
		$('body').animate({'background-position':'-230px'},600);
		$('#body_box').animate({'margin-left':'0px'},600);
		$('#switch').html($lang_openMenu);
		ia.setcookie('ia_admin_left_menu','hide',86400*365); 
	} else {
		$('#frame_side').animate({'left':'0'},600);
		$('body').animate({'background-position':'0px'},600);
		$('#body_box').animate({'margin-left':'230px'},600);
		$('#switch').html($lang_closeMenu);
		ia.setcookie('ia_admin_left_menu','show',86400*365); 
	}
}
ia.topmenu = function(button,element){
	var oTime;
	$(button).click(function(){ 
		$(element).slideDown('fast'); 
	});
	$(element).hover(
		function(){window.clearTimeout(oTime);	}, 
		function(){
			oTime = window.setTimeout(function(){ 
				$(element).fadeOut(300);
			},300);
		}
	);
	$(button).mouseout(function(){
		oTime = window.setTimeout(function(){ 
			$(element).fadeOut(300); 				
		},300);
	});	
};
ia.top_error = function(msg){
	scroll(0,0);
	$('.top_error span').html(msg);
	$('.top_error').css({'opacity':'1'});
	$('.top_error').slideDown(400);
	return false;
};
ia.option = function(){
	$('.advanced_button').click(function(){
		$('.advanced_button').css('background-image','url(../inc/templates/manage/images/switch_bg.png)');
		$('.basic_button').css('background','none');
		$('#basic').fadeOut(600);
		$('#advanced').fadeIn(600);
	});
	$('.basic_button').click(function(){
		$('.basic_button').css('background-image','url(../inc/templates/manage/images/switch_bg.png)');
		$('.advanced_button').css('background','none');
		$('#advanced').fadeOut(600);
		$('#basic').fadeIn(600);		
	});	
}
/*
ia.menu = function(){
	//$('#menu ol ul').hide(); 
	if(ia.getcookie('ia_admin_left_menu') != 'hide'){
		$('#frame_side').css('left','0px'); 
		$('#body_box').css('margin-left','230px'); 
		$('#switch').html($lang_closeMenu);
	} else { 
		$('#frame_side').css('left','-230px'); 
		$('#body_box').css('margin-left','0px'); 
		$('#switch').html($lang_openMenu);
		$('body').css('background-position','-230px');
	}
	$('#menu .item').click(function(){
		$(this).parent().siblings().find('ul').slideUp('normal'); 
		$(this).next().slideToggle('normal'); 
		return false;
	});	
	$('#menu .item').hover(
		function(){
			$(this).stop().animate({'padding-right':'30px'},300);
		}, 
		function(){
			$(this).stop().animate({'padding-right':'10px'},300);
		}
	);	
	ia.topmenu('#lang_button','.header #lang_menu'); 
}
*/