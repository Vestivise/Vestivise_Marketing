import React from 'react';
import { ModuleConst } from '../../const/module.const';

const style = {
    height : "100%"
};

var config = {};

config.chart = {
    backgroundColor: "#BBDEFB"
};

config.title = {
   text: '', 
   style : {
      color : "333366"
   }  
};      

config.tooltip = {
   pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
};

config.plotOptions = {
   pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
         enabled: true,
         format: '<b>{point.name}%</b>: {point.percentage:.1f} %',
         style: {
            textShadow: false 
         }
      }
   }
};

config.series= [{
   type: 'pie',
   name: 'Share',
   allowPointSelect: false,
   data: [],
   dataLabels : {
      color : '#333366'
   }
}];

config.credits = {
    enabled: false
};

var colors = ['#2980b9', '#e74c3c', '#2ecc71', "#8e44ad"];

class BasicAssetModule extends React.Component {
    constructor(props) {
        super(props);
        this.displayName = 'BasicAssetModule';
    }

    createBreakAssetBreakdown(){
    	if(this.props.data){
    		var assets = this.props.data.assets;
    		config.series[0].data = assets.map(function (asset) {
    		    return {
    		    	name : asset.name,
    		    	y : Number(asset.percentage),
    		    	color : colors.pop()
    		    }
    		});
    	} 
    }

    createTitle(){
    	if(this.props.data){
    		config.title.text = 'You have $' + this.props.data.totalAssets + ' invested.';
    	}
    }

    componentDidMount() {
    	this.createTitle();
    	this.createBreakAssetBreakdown();
    	$("#" + ModuleConst.BASIC_ASSET).highcharts(config);
    }

    render() {
        return <div style={style} id={ModuleConst.BASIC_ASSET}></div>;
    }
}

export default BasicAssetModule;
