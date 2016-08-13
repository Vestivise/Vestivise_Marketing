var title = {
    	text: 'You lost $5,000 this year so far.',
    	style: {
    		color : "#333366"
    	}
   	};
  
var xAxis = {
  	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
    	'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
   	labels: {
		style: {
			color : "#333366"
		}	
	}
};

var yAxis = {
	title: {
		text: 'Return Amount',
		style: {
			color : "#333366"
		}
	},
	gridLineColor: 'transparent',
	labels: {
		style: {
			color : "#333366"
		}	
	}
};

var plotOptions = {
  	line: {
    	dataLabels: {
        	enabled: true
    	},   
     	enableMouseTracking: true
  	},
};

var chart = {
  	backgroundColor: "#BBDEFB"
};

var dataSource1 = [11.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 21.5, 25.2, 26.5];
var dataSource2 = [3, 12, 5, 26, 17, 3, 12, 5, 26, 17, 3, 12];

var series= [{
        name: '<p style="color : #333366">My Returns</p>',
        data: dataSource2,
        color: "#F24258",
        dataLabels:{
            enabled : false,
        }
    },
    {
        name: '<p style="color : #333366">Benchmark - S&P 500</p>',
        data: dataSource1,
        color: "#333366",
        dataLabels:{
            enabled : false,
        },
        useHTML : true
    }
];

var credits = {
      enabled: false
}
   
var json = {};

json.title = title;
json.chart = chart;
json.xAxis = xAxis;
json.yAxis = yAxis;  
json.series = series;
json.credits = credits;
json.plotOptions = plotOptions;
$('#returnPerYearMod').highcharts(json);