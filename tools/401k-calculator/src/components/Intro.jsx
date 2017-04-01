require('normalize.css/normalize.css');
require('styles/App.css');
let logo = require('../images/logo.png');

import React from 'react';

class Intro extends React.Component {


  submit(e){
    e.preventDefault();
    this.props.next();

  }

  render() {
    return (
      <div id="intro">
        <form onSubmit={this.submit.bind(this)}>
          <div className="row">
            <div className="col s12">
              <div className="row valign-wrapper">
                <img id="logo" className="valign center-block" src={logo} alt="Vestivise" />
              </div>
              <div className="row valign-wrapper">
                <div className="col s12">
                  <p>We’re making retirement investing understandable for everyone. This starts with a 401(k) that could offer the opportunity to turn a $1,000 contribution into $1,500 due to company matching. Find out more by getting started below!</p>
                </div>
              </div>
              <div className="row valign-wrapper">
                <div className="col s12">
                  <input type="submit" className="btn" value="Let's Get Started"/>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    );
  }
}


export default Intro;
