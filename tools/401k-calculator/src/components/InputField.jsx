import React from 'react';

const InputTypes = {
  age : 1,
  percentage : 2,
  dollars : 3
};

var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  minimumFractionDigits: 0,
});

class InputField extends React.Component{

    constructor(props){
      super(props);
      var value = this.props.defaultValue;
      var displayValue = this.getDisplayValue(value);
      this.state = {
        value : value,
        displayValue : displayValue
      }
    }

    getValue(){
      return this.state.value;
    }

    getDisplayValue(value){
      var displayValue = value;
      var inputType = this.props.type;
      if(inputType == InputTypes.percentage){
        displayValue = Math.round((displayValue * 100)).toString() + "%";
      }
      else if(inputType == InputTypes.dollars){
        displayValue = formatter.format(value);
      }
      return displayValue;
    }

    handleChange(event){
      event.preventDefault();
      var inputType = this.props.type;
      var value = event.target.value;

      if(inputType == InputTypes.percentage){
        if(!value.includes("%")){
          value = value.substr(0, value.length - 1);
        }
        value = parseFloat(value.replace("%", "")) / 100;
        if(isNaN(value)) value = 0;
      }
      else if(inputType == InputTypes.dollars){
        value = value.replace(',', '');
        value = value.replace('$', '');
        value = value.replace(/[^0-9]*/, '');
        value = parseFloat(value);
        if(isNaN(value)) value = 0;
      }

      if(isNaN(value)){
        return;
      }
      this.setState({
        value : value,
        displayValue: this.getDisplayValue(value)
      });
    }

    handleEmpty(){
      var inputType = this.props.type;
      var value = this.state.value;
      if(inputType == InputTypes.age && (value < 1 || value > 100)){
        value = 0;
      }
      else if(inputType == InputTypes.percentage && (value < 0 || value > 100)){
        value = 0;
      }
      else if(inputType == InputTypes.dollars && value < 0){
        value = 0;
      }
      this.setState({
        value : value,
        displayValue: this.getDisplayValue(value)
      });
    }

    render(){
        return(
          <div className="input-field">
            <input
              onChange={this.handleChange.bind(this)}
              value={this.state.displayValue}
              id={this.props.data}
              type="text"
              placeholder={this.props.placeholder ? this.props.placeholder : ""}
              onBlur={this.handleEmpty.bind(this)}
            />
            <label className="active inputLabel" htmlFor={this.props.data}>{this.props.label}</label>
          </div>
        );
    }

}


export {InputTypes, InputField};
