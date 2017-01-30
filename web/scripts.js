var html = $('html'),
	body = $('body'),
	header = $('#header');

function global_var(){
	window_width = $(window).width(),
	window_height = $(window).height();
}
global_var();

function scroll_to(div){
	$('html,body').animate({
  		scrollTop:$(div).offset().top
	},600)
}

function header_init(){
	var header_clone = $('#header.clone');

	if(!header_clone.length){
		header.after(header.clone(true).addClass('clone'));
		header_clone = $('#header.clone');
	}

	function header_logo_click(event){
		if(body.is('#page-index')){
			event.preventDefault();
			scroll_to('body');
		}
	}
	$('.logo').click(header_logo_click)

	var scroll_top_last = 0;

	function header_scroll(){
		var scroll_top = $(window).scrollTop()
		if(scroll_top_last > scroll_top){
			if(scroll_top > window_height){
				header_clone.addClass('slide_down')
			}else{
				header_clone.removeClass('slide_down')
			}
		}else{
			header_clone.removeClass('slide_down')
		}
		scroll_top_last = scroll_top
	}
	if(window_width > 480){
		header_scroll();
		$(window).scroll(header_scroll)
	}
}
header_init();

function expand_list_click(event){
	event.preventDefault();
	$(this).siblings('.expand-content').slideToggle(200).parent().toggleClass('active').siblings().removeClass('active').children('.expand-content').slideUp(200)
}
$('.expand-click').click(expand_list_click)

function mobile_slide_click(event){
	event.preventDefault();
	html.toggleClass('header_open');
	$('#navigation').slideToggle(200);
}
$('#mobile_slide').click(mobile_slide_click)