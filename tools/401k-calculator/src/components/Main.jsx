require('normalize.css/normalize.css');
require('styles/App.css');

import React from 'react';
import Intro from './Intro.jsx';
import InfoCollect from './InfoCollect.jsx';
import ResultChart from './ResultChart.jsx';
import {InputTypes} from './InputField.jsx';

const settings = {
    speed:500,
    infinite:false,
    slidesToShow:1,
    variableWidth:false,
    focusOnSelect:false,
    Autoplay:true,
    autoplaySpeed:1000,
    dots:false,
    arrows:false,
    draggable: false,
};

const collectionItems = [
  {
    "itemDescription" : "What's your age?",
    "placeholder" : "The clock is always ticking on retirement. The more years to save the better— “compound interest is the eighth wonder of the world.” - Albert Einstein",
    "state" : "age",
    "type" : InputTypes.age,
    "underline" : "",
    "link" : ""
  },
  {
    "itemDescription" : "What's your 401k balance?",
    "placeholder" : "Everyone has to start somewhere— whether you’re proud of your current balance or not, it’s just the beginning.",
    "state" : "current401k",
    "type" : InputTypes.dollars,
    "underline" : "The average 401k balance on Vestivise is $91,300.",
    "link" : ""
  },
  {
    "itemDescription" : "What are your returns?",
    "placeholder" : "Does your asset manager make your returns clear to you?",
    "state" : "rateOfReturn",
    "type" : InputTypes.percentage,
    "underline" : "According to Vestivise data, the average return for a 401k is 5% every year.",
    "link" : ""
  },
  {
    "itemDescription" : "What are your fees?",
    "placeholder" : "This is so important because fees compound just like returns.",
    "state" : "fees",
    "type" : InputTypes.percentage,
    "underline" : "According to Vestivise data, the average fee for a 401k is 1% every year.",
    "link" : ""
  },
  {
    "itemDescription" : "What’s your annual income?",
    "placeholder" : "“A penny saved is a penny earned.” No wonder Benjamin Franklin scored the $100 bill. Your ability to save is based on your current income.",
    "state" : "income",
    "type" : InputTypes.dollars,
    "underline" : "",
    "link" : ""
  }
];

class AppContainer extends React.Component {

  constructor(props){
    super(props);
    this.state = {
      age : 21,
      income : 50000,
      current401k: 91300,
      monthlyContrib: 10,
      employeeMatch: 50,
      retirementAge : 67,
      rateOfReturn: 5,
      fees: 1,
      shouldRenderChart: false,
      currentSlide: -1,
    };

  }

  componentDidMount(){
    $('#slick-container').slick(settings);

  }

  next(key, value) {
    const currentSlide = this.state.currentSlide + 1;
    if(currentSlide != collectionItems.length){
      const itemDescription = collectionItems[currentSlide];
      ga('send', 'event', 'input-transition', 'next', itemDescription);
      $('#slick-container').slick('slickNext');
    }
    setTimeout(function(){
      ga('send', 'event', 'input-transition', 'next', "app page");
      this.setState({
        shouldRenderChart: currentSlide == collectionItems.length,
        currentSlide: currentSlide,
        [key] : value
      });
    }.bind(this), currentSlide == collectionItems.length ? 0 : 500);

  }

  getContent(){
    if(this.state.shouldRenderChart){
      return(
        <div>
          <ResultChart data={this.state} next={this.next.bind(this)}/>
        </div>
      );
    }

    var items = [];
    for (let [index, value] of collectionItems.entries()) {
      value['defaultValue'] = this.state[value['state']];
      value['index'] = index;
      items.push(
        <div
          className="slick-container"
          key={index + 1}
        >
          <InfoCollect ref={index} {...value} next={this.next.bind(this)}/>
        </div>
      );
    }

    return(
      <div className="container">
        <div className="row">
          <div className="col s12">
              <div id="slick-container">
                <div className="slick-container" key={0}><Intro next={this.next.bind(this)}/></div>
                {items}
              </div>
            </div>
        </div>
      </div>
    );
  }

  render() {
    return (
      <div>
        {this.getContent()}
      </div>
    );
  }
}

AppContainer.defaultProps = {
};

export default AppContainer;
