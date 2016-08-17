import React from 'react';
import { ModuleConst } from '../../const/module.const';

const style = {
    height : "100%"
};

var config = {};

config.title = {
	text: '',
	style: {
		color : "white"
	}
};
  
config.xAxis = {
  	categories: [
        "One Month Return",
        "Three Month Return",
        "One Year Return",
        "Three Year Return"
    ],
   	labels: {
		style: {
			color : 'white'
		}	
	}
};

config.yAxis = {
	title: {
		text: 'Return Amount',
		style: {
			color : "white"
		}
	},
	gridLineColor: 'transparent',
	labels: {
		style: {
			color : 'white'
		}	
	}
};

config.plotOptions = {
  	line: {
    	dataLabels: {
        	enabled: true
    	},   
     	enableMouseTracking: true
  	},
};

config.chart = {
  	backgroundColor: "#4CAF50",
    type: 'column'
};

config.series= [{
        name: '<p style="color : #ecf0f1">My Returns</p>',
        data: [1, 1, 1, 1],
        color: "white",
        dataLabels:{
            enabled : false,
        }
    },
    {
        name: '<p style="color : #ecf0f1">Benchmark - S&P 500</p>',
        data: [1,1,1,1],
        color: "#F24258",
        dataLabels:{
            enabled : false,
        },
        useHTML : true
    }
];

config.credits = {
    enabled: false
};
   
class BasicReturnModule extends React.Component {
    constructor(props) {
        super(props);
        this.displayName = 'BasicReturnModule';
    }

    componentDidMount() {
    	// this.getTitle();
    	// this.getTimeScale();
    	// this.getPerformance();
        console.log('test'); 
    	$("#" + ModuleConst.BASIC_RETURN).highcharts(config);
    }

    // getTitle(){
    // 	var title = "";
    // 	if(this.props.data){
    // 		const benchmarked = this.props.data.benchmarked;
    // 		const n = Number(benchmarked);
    // 		var lostOrGain = n < 0 ? "lost" : "gained";
    // 		title = "You have " + lostOrGain + " $" + Math.abs(n) + " this year so far.";

    // 	}
    // 	config.title.text = title;
    // }

    // getTimeScale(){
    // 	if(this.props.data){
    // 		config.xAxis.categories = this.props.data.timeScale.map(function (data) {
    // 									return data.month + " " + data.year;
    // 								});

    // 	}
    // }
    
    // getPerformance(){
    // 	if(this.props.data){
    // 		config.series[0].data = this.props.data.fundPerformance.map(function (data) {
    // 									return Number(data.returns);
    // 								});
    // 		config.series[1].data = this.props.data.benchMarkPerformance.map(function (data) {
    // 									return Number(data.returns);
    // 								});

    // 	}
    // }
    
    render() {
        return <div style={style} id={ModuleConst.BASIC_RETURN}>BasicReturnModule</div>;
    }
}

export default BasicReturnModule;
