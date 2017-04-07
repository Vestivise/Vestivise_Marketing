import React from 'react';

const InputTypes = {
  age : "ageInput",
  percentage : "percentageInput",
  dollars : "dollarInput"
};

class InputField extends React.Component{

    constructor(props){
      super(props);
      var value = this.props.defaultValue;
      this.state = {
        value : value,
      }
    }

    componentDidMount(){
      $('.' + this.props.type).mask(this.getMask(), {reverse: true});
    }

    getValue(){
      return this.state.value;
    }

    onChange(e){
      var value = e.target.value;
      this.setState({
        value : parseFloat(value.replace(",").replace("%")),
      });
    }

    getMask(){
      var inputType = this.props.type;
      if(inputType == InputTypes.percentage){
        return "00.00%";
      }
      else if(inputType == InputTypes.dollars){
        return "0,000,000";
      }
      return "00";
    }

    handleEmpty(e){
      var value = e.target.value;
      if(value.replace(",").replace("%") == ""){
        this.setState({
          value : 0,
        });
      }
    }

    render(){
        return(
          <div className="input-field">
              <input
                id={this.props.data}
                className={this.props.type}
                type="text"
                defaultValue={this.state.value}
                onChange={this.onChange.bind(this)}
                onBlur={this.handleEmpty.bind(this)}
              />
              <label className="active inputLabel" htmlFor={this.props.data}>{this.props.label}</label>
          </div>
        );
    }

}


export {InputTypes, InputField};
