jQuery(document).ready(function($){

	/*  Header  */

	var navigation_width = function(){
		setTimeout(function(){
			var header_width = $("#header > section").outerWidth();
			if($("#logo").length){
				var header_title_width = $("#header #logo").width();
			}else{
				var header_title_width = $("#header h1").width();
			}
			var header_social_width = $("#header #social").outerWidth();
			var header_navigation_width = header_width - (header_title_width + header_social_width + 30);
			$("#header #navigation").css("max-width",header_navigation_width+"px")
			if($("#submenu").length&&$(window).width() > 600){
				var submenu_width = $("#submenu > section").outerWidth();
				var submenu_title_width = $("#submenu h1").width();
				var submenu_search_width = $("#submenu li.click-search").outerWidth();
				var submenu_navigation_width = submenu_width - (submenu_title_width + submenu_search_width + 30);
				$("#submenu.clone nav.menu").css("max-width",submenu_navigation_width+"px")
			}
		},100);
		setTimeout(function(){
			if($(window).width() > 600){
				$("#header #navigation ul#menu").flexMenu()
			}
		},200);
	}

	$(document).ready(navigation_width)
	$(window).resize(navigation_width)

	$(document).ready(function(){
		$("#header a#click-menu").click(function(){
			$("#header ul#menu").slideToggle("fast");
			$("#header").toggleClass("responsive-slide");
			$("#navigation li.menu-item-has-children").click(function(){
				$(this).siblings("li.menu-item-has-children").children("ul").removeClass("slide");
				$(this).children("ul").toggleClass("slide")
			});
		})
		if($("body").hasClass("single")){
		    $(".original").mouseenter(function(){
		        $("#submenu.original").addClass("slide")
	    	});
		    $("#submenu").mouseleave(function(){
		        $("#submenu.original").removeClass("slide")
	    	});
		}
		if($("body").hasClass("sticked_header")){
			if($("#submenu").length){
				var $header = $("#submenu")
			}else{
				var $header = $("#header")
			}
			$clone = $header.before($header.clone().removeClass("original").addClass("clone"));
			$(window).on("scroll",function(){
				var fromTop = $("body").scrollTop();
				$('body').toggleClass("down",(fromTop > 300));
				$("li.click-search a i.icon-search").click(function(){
					$("body").addClass("search");
					$("body.down.search .clone form input.search-field").focus();
				})
			});
		}
	})

	$("#header li.click-search a i.icon-search").click(function(){
		$("body").addClass("search");
		$("body.search #header form input.search-field").focus();
	})

	$("#submenu.clone li.click-search a i.icon-search").click(function(){
		$("body").addClass("search");
		$("body.search #submenu.clone form input.search-field").focus();
	})

	$(document).mouseup(function(e){
	    var container = $("body.search form");
		if(!container.is(e.target)&&container.has(e.target).length==0){
			$("body").removeClass("search")
	    }
	});

	$("#scroll-top").click(function(){
		$("html,body").animate({
			scrollTop:$("html").offset().top
		},450)
	});

	/*  Slideshow  */

	$("#featured-slides").slick({
		dots:true,
		speed:500,
		slidesToShow:3,
		centerMode:true,
		focusOnSelect:true,
		autoplay:true,
  		autoplaySpeed:4000,
  		responsive:[
  			{
  			breakpoint:1280,
  				settings:{
        			slidesToShow:2
				}
    		},
  			{
  			breakpoint:960,
  				settings:{
        			slidesToShow:1
				}
    		},
    		{
  			breakpoint:700,
  				settings:{
        			slidesToShow:1,
        			centerPadding:'20px'
				}
    		}
    	]
	}).addClass("loaded");

	/*  Container  */

	$("a.scroll-post").click(function(e){ 
	    e.preventDefault(); 
	    $('html,body').animate({
	    	scrollTop: $("#posts-container").offset().top
	    });
	});

	var $container = $("#grid.grid");
	$container.imagesLoaded(function(){
		$container.isotope({
			itemSelector:"article",
	 		resizesContainer:true,
	 		transitionDuration:0,
	 		masonry:{
	 			columnWidth:1
	 		}
		});
	});

	var $widgets = $("#footer #widgets");
	$widgets.isotope({
		itemSelector:".widget",
 		resizesContainer:true,
	});

	$container.infinitescroll({},function(newElements){
		var $newElems = $(newElements).addClass("loading");
		$container.imagesLoaded(function(){
			$container.isotope('insert',$newElems);
			$(newElements).addClass("loaded");
			setTimeout(function(){
				$(newElements).removeClass("loading loaded")
			},900);
		});
	});

	$(window).unbind('.infscr');
	$("a#load").click(function(){
		$container.infinitescroll('retrieve');
		$("a#load span#more").fadeOut("fast").delay(1000).fadeIn();
		$("a#load span#loading").fadeIn("fast").delay(1000).fadeOut("fast");
		$("a#load").addClass("loading");
		setTimeout(function(){
			$("a#load").removeClass("loading")
		},1000);
		return false;
	});

	$(document).ajaxError(function(e,xhr,opt){
		if(xhr.status==404){
			$("a#load").addClass("finished");
			$("a#load span#more").remove();
			$("a#load span#done").delay(500).fadeIn();
		}
	});

	$("#explore-more").click(function(){
		$(this).parent(".explore").addClass("show")
	})

	/*  Single Page  */

	$(document).ready(function(){
		var headerheight = $("header").outerHeight();
		var submenuheight = $("#submenu").outerHeight();
		var featuredheight = $("#featured").outerHeight();
		var footerheight = $("footer").outerHeight();
		var containerheight = $(window).height()-headerheight-submenuheight-featuredheight-footerheight;
		$("#container").css("min-height",containerheight+"px");
		$(window).scroll(function(){
			if($(window).scrollTop()>300){
				$("#scroll-top").addClass("show")
			}
			else if($(window).scrollTop()<300){
				$("#scroll-top").removeClass("show")
			}

			scrollPercentage = 100 * $(this).scrollTop()/(($(".media").height()+$("article").height()-$("#comment").height())-$(this).height()+($(window).height()));
			if(scrollPercentage < 100){
				$("#progressbar").css("width",scrollPercentage.toFixed(2)+"%")
			}else{
				$("#progressbar").css("width",100+"%")
			}

			if($(window).width() > 1280){
				$("#meta.sidebar").css("max-height",$("article").outerHeight()-$("#comments").outerHeight()+"px");
				var length = $("#meta.sidebar").height()-$("#meta.sidebar #share").height()+$("#meta.sidebar").offset().top;
				var scroll = $(this).scrollTop();
				var height = $("#meta.sidebar #share").height() + "px";
				var headerheight = 0;
				if($("body").hasClass("sticked_header")){
					if($("#submenu").length){
						var headerheight = 40
					}else{
						var headerheight = 60
					}
				}
				if(scroll < $("#meta.sidebar").offset().top - headerheight - 40){
					$("#meta.sidebar #share").css({
						"position":"absolute",
						"top":"0"
					});
				}else if(scroll > (length - 160)){
					$("#meta.sidebar #share").css({
						"position":"absolute",
						"bottom":120-headerheight+"px",
						"top":"auto"
					});
				}else{
					$("#meta.sidebar #share").css({
						"position":"fixed",
						"top":headerheight+40+"px",
						"bottom":"auto"
					});
				}
			}

		});
	});

	$("#container.single #posts").imagesLoaded(function(){
		$(".single #slider").slick({
			dots:true,
			speed:500,
			slidesToShow:1,
	  		adaptiveHeight:true,
			focusOnSelect:true,
			autoplay:true,
	  		autoplaySpeed:4000,
	  		responsive:[{
	  			breakpoint:1280,
  				settings:{
			  		adaptiveHeight:false
				}
	    	}]
		}).addClass('loaded');
	});

	$("article p").each(function(){
    	var $p = $(this),
        txt = $p.html();
    	if(txt=='&nbsp;'){
        	$p.remove();   
    	}
	});

	$(".media.video").fitVids().addClass("loaded");

	$(".scroll-comment").click(function(e){ 
	    e.preventDefault();
	    $("#click-comment").fadeOut("fast"); 
	    $("#comments").css({
        	display:'none',
        	position:'relative',
        	visibility:'visible'
    	});
	    $("#comments").slideDown("fast");
	    $('html,body').animate({
	    	scrollTop:$("#comments").offset().top - 40
	    });
	});

	$("#click-comment").click(function(e){ 
	    e.preventDefault(); 
	    $(this).fadeOut("fast");
	    $("#comments").css({
        	display:'none',
        	position:'relative',
        	visibility:'visible'
    	});
	    $("#comments").slideDown("fast")
	});

	$("#comments #respond form textarea").click(function(){
		$(this).blur(function(){
		    if($.trim(this.value).length){
		        $(this).css('min-height','200px')
		    }else{
		        $(this).css('min-height','120px')
		    }
		});
	});

/*  End Jquery  */
});