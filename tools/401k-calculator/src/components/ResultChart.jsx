/**
 * Created by raylenmargono on 12/15/16.
 */
import React from 'react';
import Highcharts from 'highcharts';
import {InputTypes, InputField} from './InputField.jsx';
let logo = require('../images/logo.png');

var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  minimumFractionDigits: 2,
});

var config = {};

config.title = {
    text: ''
};

config.chart = {
    type: 'column',
    backgroundColor: null
};

config.xAxis = {
    tickmarkPlacement: 'on',
    title: {
        enabled: false
    },
    labels: {
        enabled: true,
        formatter: null
    },
    startOnTick: false,
    endOnTick: false,
    minPadding: 0,
    maxPadding: 0,
    minTickInterval: 5
};

config.yAxis = {
    title: {
        text: ''
    },
    gridLineColor: 'white'
};

config.plotOptions = {
    series : {
        fillOpacity: 1
    },
    column: {
        grouping: false,
        shadow : false
    }
};

config.credits = {
    enabled: false
};

config.series = [];

config.tooltip =  {
    formatter: function () {
        return formatter.format(this.y);
    }
};

const inputMap = [
  {
    data : "age",
    label: "Age",
    placeholder: "Enter in age values from 18-65",
    type: InputTypes.age
  },
  {
    data : "retirementAge",
    label: "Retirement Age",
    placeholder: "What age will you retire?",
    type: InputTypes.age
  },
  {
    data : "current401k",
    label: "Current 401k Balance",
    placeholder: "Enter your 40k Balance",
    type: InputTypes.dollars
  },
  {
    data : "rateOfReturn",
    label: "Rate Of Return",
    placeholder: "Rate Of Return of 401k Plan",
    type: InputTypes.percentage
  },
  {
    data : "fees",
    label: "Fees",
    placeholder: "Fees of 401k Plan",
    type: InputTypes.percentage
  },
  {
    data : "income",
    label: "Income",
    placeholder: "Enter your income",
    type: InputTypes.dollars
  },
  {
    data : "monthlyContrib",
    label: "Monthly Contribution",
    placeholder: "Enter your Monthly Contribution",
    type: InputTypes.percentage
  },
  {
    data : "employeeMatch",
    label: "Employeer Matching",
    placeholder: "% of Income Employeer Will Match",
    type: InputTypes.percentage
  }
];

const themeColor = "white";

const axisStyle = {
  title: {
    style: {
      color : themeColor,
      fontSize : 13
    }
  },
  labels: {
    style: {
      color : themeColor,
      fontSize : 13
    }
  }
};

Highcharts.setOptions({
  chart: {
    style: {
      fontFamily: 'Graphik,Helvetica,Arial,sans-serif'
    }
  },
  legend: {
    itemStyle: {
    fontFamily: 'Graphik,Helvetica,Arial,sans-serif',
    fontWeight: '100',
    color : themeColor,
    fontSize : 15
    },
  },
  xAxis : axisStyle,
  yAxis : axisStyle
});

class ResultChart extends React.Component{

    constructor(props){
        super(props);
        this.state = {
          data : props.data,
          isLoading : true,
          endBalance: 0,
          feeBalance : 0,
          chart : null
        };
    }

    componentDidMount(){
      setTimeout(function(){
        this.setState({
          isLoading: false
        },function(){
          this.initChart();
        }.bind(this));
      }.bind(this), 3000);
    }

    componentDidUpdate(){
      if(!this.state.isLoading){
        $(".button-collapse").sideNav({
          menuWidth: 150, // Default is 300
          edge: 'right', // Choose the horizontal origin
          closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
          draggable: true // Choose whether you can drag to open on touch screens
        });
      }
    }

    compound(rate, numOfCompoundings, principal, numOfPeriods, employeerMatch){
      var result = [principal];
      for(var i = 0; i < numOfPeriods; i++){
        var current = result[result.length - 1] + employeerMatch;
        var CI = current;
        if(rate != 0){
          CI = current * Math.pow((1 + ((rate)/ numOfCompoundings)), numOfCompoundings);
        }
        result.push((Math.round(CI * 100) / 100));
      }
      return result;
    }

    contributionTimeSeries(principle, margin, numOfPeriods){
      var result = [principle];
      for(var i = 0; i < numOfPeriods; i++){
        var current = result[result.length - 1];
        result.push(current + margin);
      }
      return result;
    }

    calculateFees(rate, numOfCompoundings, principal, numOfPeriods, employeerMatch, feePercentage){
      var result = [principal];
      for(var i = 0; i < numOfPeriods; i++){
        var current = result[result.length - 1] + employeerMatch;
        var CI = current;
        if(rate != 0){
          CI = current * Math.pow((1 + ((rate)/ numOfCompoundings)), numOfCompoundings);
        }
        var CIRound = (Math.round(CI * 100) / 100) * (1 - feePercentage);
        result.push(CIRound);
      }
      return result;
    }

    initChart(){
      var data = this.prepChart();
      config.series = data;
      var chart = Highcharts.chart('chart-container', config);
      this.setState({
        chart: chart
      });
    }

    reloadChart(){
      var data = this.prepChart();
      for(var i = 0 ; i < data.length ; i++){
        this.state.chart.series[i].setData(data[i].data, true);
      }
    }

    prepChart(){
      var rate = this.state.data.rateOfReturn;
      var numOfCompoundings = 1;
      var principle = this.state.data.current401k;
      var numOfPeriods = this.state.data.retirementAge - this.state.data.age;
      var yearlyContrib = this.state.data.income * this.state.data.monthlyContrib;
      var employeerMatch = this.state.data.employeeMatch * yearlyContrib + yearlyContrib;


      var data = this.compound(rate, numOfCompoundings, principle, numOfPeriods, employeerMatch);
      var employeeMatchData = this.contributionTimeSeries(principle, employeerMatch, numOfPeriods);
      var principleGrowthData = this.contributionTimeSeries(principle, yearlyContrib, numOfPeriods);
      var feeData = this.calculateFees(rate, numOfCompoundings, principle, numOfPeriods, employeerMatch, this.state.data.fees);
      this.setState({
        endBalance: data[data.length - 1],
        feeBalance : feeData[feeData.length - 1]
      });
      var categories = ["Now"];
      var thisYear = new Date().getFullYear();
      for(var i = 1 ; i < numOfPeriods; i++){
          categories.push(i + thisYear);
      }
      config.xAxis.labels.formatter = function () {
          return categories[this.value];
      };
      return([
        {
          name : "Total Balance",
          color : "#C2CFAF",
          data : data
        },
        {
          name : "Total Balance Minus Fees",
          color : "#F79594",
          data : feeData
        },
        {
          name : "Employer Match Plus Contributions",
          color : "#C4DFE9",
          data : employeeMatchData
        },
        {
          name : "Contributions",
          color : "#F9F1CE",
          data : principleGrowthData
        }
      ]);
    }

    genInputs(isMobile){
        var result = [];
        for (let [index, value] of inputMap.entries()) {
          var defaultValue = this.state.data[value.data];
          value['defaultValue'] = defaultValue;
          result.push(
            <div key={index} className="row">
              <div className="input-field col m12">
                <InputField ref={isMobile ? value["data"] + "mobile" : value["data"]} {...value}/>
              </div>
            </div>
          );
        }
        return result;
    }

    trackGAOutBound(url, category){
      ga('send', 'event', category, 'click', url);
    }

    getItemLoses(){
      var loss = this.state.endBalance-this.state.feeBalance;
      const europeTrip = 5000;
      const college = 200000;
      const car = 350000;
      const beachHome = 500000;
      const penthouse = 1000000;
      var map = {
        "Trips To Europe" : 0,
        "College Degrees" : 0,
        "Ferrari Spider" : 0,
        "Beach House" : 0,
        "Pent House In Manhattan" : 0
      };
      if(loss/penthouse > 0){
        map["Pent House In Manhattan"] = Math.floor(loss/penthouse);
        loss -= Math.floor(loss/penthouse) * penthouse;
      }
      if(loss/beachHome > 0){
        map["Beach House"] = Math.floor(loss/beachHome);
        loss -= Math.floor(loss/beachHome) * beachHome;
      }
      if(loss/car > 0){
        map["Ferrari Spider"] = Math.floor(loss/car);
        loss -= Math.floor(loss/car) * car;
      }
      if(loss/college > 0){
        map["College Degrees"] = Math.floor(loss/college);
        loss -= Math.floor(loss/college) * college;
      }
      if(loss/europeTrip > 0){
        map["Trip To Europe"] = Math.floor(loss/europeTrip);
        loss -= Math.floor(loss/europeTrip) * europeTrip;
      }
      var result = "";
      for(var item in map){
        if(map[item] > 0){
          if(result != ""){
            result += " and ";
          }
          result += (map[item].toString() + " " + item + " ");
        }
      }
      return result;
    }

    getForm(isMobile){
      return(
        <form onSubmit={e => {
          e.preventDefault();
          this.handleSubmit(isMobile)
        }}>
          {this.genInputs(isMobile)}
          <div className="row">
            <div className="input-field col m12">
              <button type="submit" className="btn waves-effect waves-light max-width" name="action">
                Submit<i className="material-icons right">send</i>
              </button>
            </div>
          </div>
        </form>
      );
    }

    getContent(){
      if(this.state.isLoading){
        return(
          <div className="loading-container">
            <div className="sk-wave">
                <div className="sk-rect sk-rect1"></div>
                <div className="sk-rect sk-rect2"></div>
                <div className="sk-rect sk-rect3"></div>
                <div className="sk-rect sk-rect4"></div>
                <div className="sk-rect sk-rect5"></div>
            </div>
          </div>
        );
      }
      var yearlyContrib = this.state.data.income * this.state.data.monthlyContrib;
      var employeerMatch = this.state.data.employeeMatch * yearlyContrib;
      var getForm = this.getForm.bind(this);
      return(
        <div id="app-container">
          <nav>
            <div id="nav" className="nav-wrapper">
              <a href="https://www.vestivise.com"><img id="logo2" src={logo} alt="Vestivise" /></a>
              <a href="#" data-activates="mobile" className="button-collapse"><i className="material-icons">menu</i></a>
              <ul className="right hide-on-med-and-down">
                <li><a onClick={this.trackGAOutBound("https://www.vestivise.com/blog", 'outbound')} href="https://www.vestivise.com/blog" className="waves-effect waves-light">Learn About Investing</a></li>
                <li><a onClick={this.trackGAOutBound("https://app.vestivise.com/demo", 'outbound')} href="https://app.vestivise.com/demo" className="waves-effect waves-light">View the Demo</a></li>
                <li><a onClick={this.trackGAOutBound("https://app.vestivise.com/register", 'outbound')} href="https://app.vestivise.com/register" className="waves-effect waves-light btn">Link Your 401k</a></li>
              </ul>
              <ul className="side-nav" id="mobile">
                <li><a onClick={this.trackGAOutBound("https://www.vestivise.com/blog", 'outbound')} href="https://www.vestivise.com/blog" className="waves-effect waves-light">Learn About Investing</a></li>
                <li><a onClick={this.trackGAOutBound("https://app.vestivise.com/demo", 'outbound')} href="https://app.vestivise.com/demo" className="waves-effect waves-light">View the Demo</a></li>
                <li><a onClick={this.trackGAOutBound("https://app.vestivise.com/register", 'outbound')} href="https://app.vestivise.com/register" className="waves-effect waves-light btn">Link 401k</a></li>
              </ul>
            </div>
          </nav>
          <div className="row">
            <div className="col m3 hide-on-med-and-down">
              <div className="card-panel white z-depth-5 animated fadeInDown pane">
                {getForm(false)}
              </div>
            </div>
            <div className="col m9">
              <div className="row">
                <div className="col m5">
                  <div className="info-panel card-panel white z-depth-5 animated fadeInDown pane">
                    <h5>Your Balance When You Retire</h5>
                    <h5>Total: <b>{formatter.format(this.state.endBalance)}</b></h5>
                    <h5>After Fees: <b>{formatter.format(this.state.feeBalance)}</b></h5>
                  </div>
                </div>
                <div className="col m7">
                  <div className="info-panel card-panel white z-depth-5 animated fadeInDown pane contrib-panel">
                    <h5>Contribution: <b>{formatter.format(yearlyContrib/12)}/month</b></h5>
                    <h5>Employer Matching: <b>{formatter.format(employeerMatch/12)}/month</b></h5>
                    <h5>Total: <b>{formatter.format(employeerMatch/12 + yearlyContrib/12)}/month</b></h5>
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="card-panel white z-depth-5 animated fadeInDown pane">
                  <h5>You've lost <b>{formatter.format(this.state.endBalance-this.state.feeBalance)}</b> in future savings due to fees.</h5>
                  <h5>That's enough to buy <b>{this.getItemLoses()}</b></h5>
                  <h5>
                    <a onClick={this.trackGAOutBound("https://app.vestivise.com/register", 'new data')} className="underline" href="https://app.vestivise.com/register">
                      Sign Up Today
                    </a>:
                    Vestivise will show the fees you are paying today, so that you can have all the information you need to save more for retirement.
                  </h5>
                </div>
              </div>
              <div className="row">
                <div id="chart-container" className="animated zoomInDown">
                  <div id="chart"></div>
                </div>
              </div>
            </div>
          </div>
          <div className="fixed-action-btn">
            <a href="#" data-activates="slide-out" className="button-collapse hide-on-large-only btn-floating btn-large" >
              <i className="large material-icons">mode_edit</i>
            </a>
          </div>
          <ul id="slide-out" className="side-nav">
            {getForm(true)}
          </ul>
        </div>
      );
    }

    handleSubmit(isMobile){
      $(".button-collapse").sideNav("hide");
      ga('send', 'event', 'app', 'click', "new data");

      var state = this.state;
      inputMap.forEach(item=>{
        var value = isMobile ? this.refs[item.data + "mobile"].getValue() : this.refs[item.data].getValue();
        state.data[item.data] = parseFloat(value);
      });
      this.setState(state,()=>this.reloadChart());
    }

    render(){
        return(
          <div>
            {this.getContent()}
          </div>
        );
    }

}


export default ResultChart;
