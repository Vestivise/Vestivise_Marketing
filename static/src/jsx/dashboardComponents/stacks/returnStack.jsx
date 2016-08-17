import React from 'react';
import ModuleFactory from '../factories/moduleFactory';

class ReturnStack extends React.Component {
    constructor(props) {
        super(props);
        this.displayName = 'ReturnStack';
    }

    getCurrentModule(){
        const stack = this.props.data;
        const currentModule = stack.getCurrentModule();

        console.log('helllooo');

        if(currentModule){
            const name = currentModule.getName();
            const data = currentModule.getData();

            return ModuleFactory.createModule(name, data);
        }
        return null;
    }

    render() {
        return (
        	<div id="greenContent">
				{this.getCurrentModule()}
				<p className="modTitle R">Returns</p>
				<div className="fullScreen BL">
	    			<div className="fullScreen innerBL"></div>
				</div>	
			</div>
        );
    }
}

export default ReturnStack;
