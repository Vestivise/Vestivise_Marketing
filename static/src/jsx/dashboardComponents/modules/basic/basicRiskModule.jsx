import React from 'react';
import { ModuleConst } from '../../const/module.const';

const style = {
    height : "100%"
};  

const config = {};

config.chart = {
	renderTo: 'riskMod',
    plotBackgroundColor: null,
    plotBackgroundImage: null,
    plotBorderWidth: 0,
    plotShadow: false,
    backgroundColor: "#BBDEFB",
    spacingBottom: 40
};

config.title = {
	text: '<p class="tooltipped" data-position="top" data-delay="50" data-tooltip="If you have a portfolio that is making good returns, but is fairly risky, it\'ll end up in the middle end of the gauge">Your risk is characterized as moderate.</p>',
    align: 'center',
    style: {
        color : '#333366'
    },
    verticalAlign: 'bottom',
    useHTML : true
};

config.tooltip = {
	enabled : false
}

config.pane = {
	center: ['50%', '88%'],
    startAngle: -90,
    endAngle: 90,
    background: {
        borderWidth: 0,
        backgroundColor: 'none',
        innerRadius: '60%',
        outerRadius: '100%',
        shape: 'arc'
    }
};

config.yAxis = [{
    lineWidth: 0,
    min: 0,
    max: 90,
    minorTickLength: 0,
    tickLength: 0,
    tickWidth: 0,
    labels: {
        enabled: false
    },
    title: {
        text: '', //'<div class="gaugeFooter">46% Rate</div>',
        useHTML: true,
        y: 80
    },
    pane: 0,
}];

config.credits = {
	enabled : false
};

var pie = {
    dataLabels: {
        enabled: true,
        distance: -50,
        style: {
            fontWeight: 'bold',
            color: 'white',
            textShadow: '0px 1px 2px black'
        }
    },
    startAngle: -90,
    endAngle: 90,
    center: ['50%', '95%'],
    size: "140%"
};

var gauge = {
    dataLabels: {
        enabled: false
    },
    dial: {
        radius: '100%'
    },
}

config.plotOptions = {
	pie: pie,
	gauge : gauge
};

config.series = [{
    type: 'pie',
    name: 'Risk',
    data: [
	        {
	            name: 'Safe',
	            y : 33,
	            color: "#2cc36b"
	        },
	        {
	            name: 'Moderate',
	            y : 33,
	            color: "#f1c40f"
	        },
	        {
	            name: 'Risky',
	            y : 33,
	            color: "#c0392b"
	        },
    	]
	},
	{
	    type: 'gauge',
	    data: [],
	    dial: {
	        rearLength: 0,
	        baseWidth : 1
    }
}];

class BasicRiskModule extends React.Component {
    
    constructor(props) {
        super(props);
        this.displayName = 'BasicRiskModule';
    }

    getData(){

        var gauage = 0;

        if(this.props.data){
            switch(this.props.data.riskLevel){
                case 'safe':
                    gauage = 20;
                    break;
                case 'moderate':
                    gauage = 40;
                    break;
                case 'risky':
                    gauage = 60;
                    break;
            }
        }
        config.series[1].data[0] = gauage;
    }

    componentDidMount() {
        this.getData();
    	$('#' + ModuleConst.BASIC_RISK).highcharts(config)
    }

    render() {
        return <div style={style} id={ ModuleConst.BASIC_RISK }></div>;
    }
}

export default BasicRiskModule;
