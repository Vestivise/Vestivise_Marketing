var asset = false;
var returnGraph =  false;
var riskGraph = false;
var costGraph = false;
var lock = false;

var topRowHeight = $("#topRow").height();

$('#assetContainer').click(function(){

	if(lock) return;
	lock = true;

	if(!asset){
		$('.bottommenu-center').html("Assets");
		$('.moduleContainer').css('height', 'calc(92vh - 64px)');
		$("#bmenu-wrapper").css('display','block');
		$('.modTitle').css('display', 'none');
		
		$('#returnContainer').hide();
		$('#riskContainer').hide();
		$('#feeContainer').hide();

		$("body").css("background-color", "#BBDEFB");

		$('#assetContainer').animate({
			width: "100%",
			height: "100%",
		}, {
			duration: 1000,
			step: function(){
				$("#basicAsset").highcharts().reflow();
			},
			done: function(){
				asset = true;
				lock = false;
			}
		});
	}
	else{

		$('.moduleContainer').css('height', 'calc(100% - 64px)');
		
		$("#bmenu-wrapper").css('display','none');
		$('#assetContainer').animate({
			width: "50%",
			height: "50%",
		}, {
			duration: 1000,
			step: function(){
				$("#basicAsset").highcharts().reflow();
			},
			done:function(){
				$('#returnContainer').show();
				$('#riskContainer').show();
				$('#feeContainer').show();
				$('.modTitle').css('display', 'block');
				asset = false;
				lock = false;
			}
		});
	}
});	

$('#returnContainer').click(function(){

	if(lock) return;
	
	lock = true;

	if(!returnGraph){

		$('.bottommenu-center').html("Returns");
		$('.moduleContainer').css('height', 'calc(92vh - 64px)');
		$("#bmenu-wrapper").css('display','block');
		$('.modTitle').css('display', 'none');
		
		$('#assetContainer').hide();
		$('#riskContainer').hide();
		$('#feeContainer').hide();

		$('#returnContainer').css({
			"marginLeft": "50%",
		});

		$("body").css("background-color", "#BBDEFB");

		$('#returnContainer').animate({
			width: "100%",
			height: "100%",
			marginLeft : 0
		}, {
			duration: 1000,
			step: function(){
				$("#basicReturn").highcharts().reflow();
			},
			done: function(){
				returnGraph = true;
				lock = false;
			}
		});
	}
	else{
		$('.moduleContainer').css('height', 'calc(100% - 64px)');

		$("#bmenu-wrapper").css('display','none');
		$('#returnContainer').animate({
			width: "50%",
			height: "50%",
			marginLeft: "50%"
		}, {
			duration: 1000,
			step: function(){
				$("#basicReturn").highcharts().reflow();
			},
			done:function(){
				$('#assetContainer').show();
				$('#riskContainer').show();
				$('#feeContainer').show();

				$('#returnContainer').css({
					"marginLeft": "0",
				});
				$('.modTitle').css('display', 'block');
				returnGraph = false;
				lock = false;
			}
		});
	}
});	

$('#riskContainer').click(function(){
	if(lock) return;

	lock = true;
	
	if(!riskGraph){
		$('.bottommenu-center').html("Risks");
		$('.moduleContainer').css('height', 'calc(92vh - 64px)');
		$("#bmenu-wrapper").css('display','block');
		$('.modTitle').css('display', 'none');

		$('#assetContainer').hide();
		$('#returnContainer').hide();
		$('#feeContainer').hide();

		$("#topRow").hide();

		$("body").css("background-color", "#BBDEFB");

		$("#riskContainer").css({
			marginTop: topRowHeight
		});

		$('#riskContainer').animate({
			width: "100%",
			height: "100%",
			marginTop : 0
		}, 
		{
			duration: 1000,
			step: function(){
				$("#basicRisk").highcharts().reflow();
			},
			done: function(){
				$('#assetContainer').hide();
				$('#returnContainer').hide();
				$('#feeContainer').hide();
				riskGraph = true;
				lock = false;
			}
		});
		
	}
	else{
		$('.moduleContainer').css('height', 'calc(100% - 64px)');
		$("#bmenu-wrapper").css('display','none');
		$('#riskContainer').animate({
			width: "50%",
			height: "50%",
			marginTop : topRowHeight
		}, {
			duration: 1000,
			step: function(){
				$("#basicRisk").highcharts().reflow();
			},
			done:function(){
				$('#assetContainer').show();
				$('#returnContainer').show();
				$('#feeContainer').show();
				$("#topRow").show();

				$('#riskContainer').css({
					"marginTop": 0,
				});
				
				$('.modTitle').css('display', 'block');
				riskGraph = false;
				lock = false;
			}
		});
	}
});

$('#feeContainer').click(function(){

	if(lock) return;

	lock = true;

	if(!costGraph){
		$('.bottommenu-center').html("Costs");
		$('.moduleContainer').css('height', 'calc(92vh - 64px)');
		$("#bmenu-wrapper").css('display','block');
		$('.modTitle').css('display', 'none');
		
		$('#riskContainer').hide();
		$('#returnContainer').hide();
		$('#assetContainer').hide();
		$("#topRow").hide();

		$("body").css("background-color", "#BBDEFB");

		$("#feeContainer").css({
			marginTop: topRowHeight,
			marginLeft : "50%"
		});

		$('#feeContainer').animate({
			width: "100%",
			height: "100%",
			marginTop : 0,
			marginLeft : 0
		}, {
			duration: 1000,
			step: function(){
				$("#basicFee").highcharts().reflow();
			},
			done: function(){
				costGraph = true;
				lock = false;
			}
		});
	}
	else{
		$('.moduleContainer').css('height', 'calc(100% - 64px)');
		$("#bmenu-wrapper").css('display','none');

		$('#feeContainer').animate({
			width: "50%",
			height: "50%",
			marginLeft : "50%",
			marginTop: topRowHeight
		}, {
			duration: 1000,
			step: function(){
				$("#basicFee").highcharts().reflow();
			},
			done:function(){
				$('#riskContainer').show();
				$('#returnContainer').show();
				$('#assetContainer').show();
				$("#topRow").show();

				$('#feeContainer').css({
					"marginTop": 0,
					"marginLeft": 0
				});

				$('.modTitle').css('display', 'block');
				costGraph = false;
				lock = false;
			}
		});
	}
});

