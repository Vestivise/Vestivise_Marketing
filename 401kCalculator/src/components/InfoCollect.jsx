require('normalize.css/normalize.css');
require('styles/App.css');

import React from 'react';
import {InputField} from './InputField.jsx';

class InfoCollect extends React.Component {

  submit(e){
    e.preventDefault();
    const value = this.input.getValue();
    this.props.next(this.props.state, value);
  }

  render() {
    return (
      <form onSubmit={this.submit.bind(this)} className="info-collect">
        <div className="row">
          <div className="col s12">
            <div className="row">
              <div className="col s12">
                <h1>{this.props.itemDescription}</h1>
                <p>{this.props.placeholder}</p>
                <a target="_blank" href={this.props.link} className="underline">{this.props.underline}</a>
              </div>
            </div>
            <div className="row">
              <div className="col s7 m3 offset-m3">
                <InputField ref={c => this.input = c } type={this.props.type} data={this.props.index} defaultValue={this.props.defaultValue}/>
              </div>
              <div className="button-container col s3">
                <input type="submit" className="btn" value="Next"/>
              </div>
            </div>
          </div>
        </div>
      </form>
    );
  }
}


export default InfoCollect;
