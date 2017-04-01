import React from 'react';


class Loader extends React.Component{

    constructor(props){
        super(props);
    }

    render(){
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

}


export default Loader;
