var asset = false;
var returnGraph =  false;
var riskGraph = false;
var costGraph = false;

$('#orangeContent').click(function(){
	if(!asset){
		$('.bottommenu-center').html("Assets");
		$('.moduleContainer').css('height', 'calc(92vh - 64px)');
		$("#bmenu-wrapper").css('display','block');
		$('.modTitle').css('display', 'none');
		$('#blueContent').hide();
		$('#purpleContent').hide();
		$('#greenContent').hide();

		$('.module.green').hide();
		$("body").css("background-color", "#BBDEFB");

		$('.module.orange').animate({
			width: "100%",
			height: "100%",
		}, {
			duration: 1000,
			step: function(){
				$("#assetBreakMod").highcharts().reflow();
			},
			done: function(){
				$('.module.purple').hide();
				$('.module.blue').hide();
				document.getElementById("orangeContent").style.height = "100%";
				asset = true;
			}
		});
	}
	else{
		$('.moduleContainer').css('height', 'calc(100% - 64px)');
		document.getElementById("orangeContent").style.height = "100%";
		$('.module.purple').show();
		$('.module.blue').show();
		$("#bmenu-wrapper").css('display','none');

		$('.module.orange').animate({
			width: "50%",
			height: "50%",
		}, {
			duration: 1000,
			step: function(){
				$("#assetBreakMod").highcharts().reflow();
			},
			done:function(){
				$('.module.green').show();
				$('#blueContent').show();
				$('#purpleContent').show();
				$('#greenContent').show();
				$('.modTitle').css('display', 'block');
				asset = false;
			}
		});
	}
});	

$('#greenContent').click(function(){
	if(!returnGraph){
		$('.bottommenu-center').html("Returns");
		$('.moduleContainer').css('height', 'calc(92vh - 64px)');
		$("#bmenu-wrapper").css('display','block');
		$('.modTitle').css('display', 'none');
		$('#blueContent').hide();
		$('#purpleContent').hide();
		$('#orangeContent').hide();
		$('.module.orange').hide();

		$('.module.green').css({
			"marginLeft": "50%",
		});

		$("body").css("background-color", "#BBDEFB");

		$('.module.green').animate({
			width: "100%",
			height: "100%",
			marginLeft : 0
		}, {
			duration: 1000,
			step: function(){
				$("#returnPerYearMod").highcharts().reflow();
			},
			done: function(){
				$('.module.purple').hide();
				$('.module.blue').hide();
				$('.module.orange').hide();
				document.getElementById("greenContent").style.height = "100%";
				returnGraph = true;
			}
		});
		$('.module.orange').animate({
			width: 0,
			height: 0
		}, {
			duration: 900
		})
	}
	else{
		$('.moduleContainer').css('height', 'calc(100% - 64px)');
		document.getElementById("greenContent").style.height = "100%";
		$('.module.purple').show();
		$('.module.blue').show();
		$('.module.orange').show();
		$("#bmenu-wrapper").css('display','none');

		$('.module.green').animate({
			width: "50%",
			height: "50%",
			marginLeft: "50%"
		}, {
			duration: 1000,
			step: function(){
				$("#returnPerYearMod").highcharts().reflow();
			},
			done:function(){
				$('#blueContent').show();
				$('#purpleContent').show();
					$('#orangeContent').show();

				$('.module.orange').css({
					"width": "50%",
					"height": "50%"
				});

				$('.module.green').css({
					"marginLeft": "0",
				});
				$('.modTitle').css('display', 'block');
				returnGraph = false;
			}
		});
	}
});	

$('#purpleContent').click(function(){
	if(!riskGraph){
		$('.bottommenu-center').html("Risks");
		$('.moduleContainer').css('height', 'calc(92vh - 64px)');
		$("#bmenu-wrapper").css('display','block');
		$('.modTitle').css('display', 'none');
		$('#blueContent').hide();
		$('#greenContent').hide();
		$('#orangeContent').hide();

		$("body").css("background-color", "#BBDEFB");

		$('.module.purple').animate({
			width: "100%",
			height: "100%",
		}, {
			duration: 1000,
			step: function(){
				$("#riskMod").highcharts().reflow();
			},
			done: function(){
				$('.module.green').hide();
				$('.module.blue').hide();
				$('.module.orange').hide();
				document.getElementById("purpleContent").style.height = "100%";
				riskGraph = true;
			}
		});

		$('.module.green').animate({
			width: 0,
			height: 0
		}, {
			duration: 900
		})

		$('.module.orange').animate({
			width: 0,
			height: 0
		}, {
			duration: 900
		})
		
	}
	else{
		$('.moduleContainer').css('height', 'calc(100% - 64px)');
		document.getElementById("purpleContent").style.height = "100%";
		$('.module.green').show();
		$('.module.blue').show();
		$('.module.orange').show();
		$("#bmenu-wrapper").css('display','none');

		$('.module.purple').animate({
			width: "50%",
			height: "50%",
		}, {
			duration: 1000,
			step: function(){
				$("#riskMod").highcharts().reflow();
			},
			done:function(){
				$('#blueContent').show();
				$('#greenContent').show();
				$('#orangeContent').show();

				$('.module.orange').css({
					"width": "50%",
					"height": "50%"
				});

				$('.module.green').css({
					"width": "50%",
					"height": "50%"
				});
				$('.modTitle').css('display', 'block');
				returnGraph = false;
			}
		});

		$('.module.green').animate({
			width: "50%",
			height: "50%"
		}, {
			duration: 900
		})

		$('.module.orange').animate({
			width: "50%",
			height: "50%"
		}, {
			duration: 900
		})
	}
});

$('#blueContent').click(function(){
	if(!costGraph){
		$('.bottommenu-center').html("Costs");
		$('.moduleContainer').css('height', 'calc(92vh - 64px)');
		$("#bmenu-wrapper").css('display','block');
		$('.modTitle').css('display', 'none');
		$('#greenContent').hide();
		$('#purpleContent').hide();
		$('#orangeContent').hide();

		$("body").css("background-color", "#BBDEFB");

		$('.module.blue').animate({
			width: "100%",
			height: "100%",
		}, {
			duration: 1000,
			step: function(){
				$("#feeMod").highcharts().reflow();
			},
			done: function(){
				$('.module.purple').hide();
				$('.module.green').hide();
				$('.module.orange').hide();
				document.getElementById("blueContent").style.height = "100%";
				costGraph = true;
			}
		});
		$('.module.green').animate({
			width: 0,
			height: 0
		}, {
			duration: 900
		})

		$('.module.orange').animate({
			width: 0,
			height: 0
		}, {
			duration: 900
		})

		$('.module.purple').animate({
			width: 0,
			height: 0
		}, {
			duration: 900
		})
	}
	else{
		$('.moduleContainer').css('height', 'calc(100% - 64px)');
		document.getElementById("blueContent").style.height = "100%";
		$('.module.purple').show();
		$('.module.green').show();
		$('.module.orange').show();
		$("#bmenu-wrapper").css('display','none');

		$('.module.blue').animate({
			width: "50%",
			height: "50%",
			marginLeft : "50%"
		}, {
			duration: 1000,
			step: function(){
				$("#feeMod").highcharts().reflow();
			},
			done:function(){
				$('#greenContent').show();
				$('#purpleContent').show();
				$('#orangeContent').show();

				$('.module.purple').css({
					"width": "50%",
					"height": "50%"
				});

				$('.module.blue').css({
					"marginLeft": 0,
				});
				$('.modTitle').css('display', 'block');
				costGraph = false;
			}
		});

		$('.module.green').animate({
			width: "50%",
			height: "50%"
		}, {
			duration: 900
		})

		$('.module.orange').animate({
			width: "50%",
			height: "50%"
		}, {
			duration: 900
		})

	}
});

