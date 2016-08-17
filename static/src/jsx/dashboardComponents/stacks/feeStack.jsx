import React from 'react';
import ModuleFactory from '../factories/moduleFactory';


class FeeStack extends React.Component {
    constructor(props) {
        super(props);
        this.displayName = 'FeeStack';
    }

    getCurrentModule(){
        const stack = this.props.data;
        const currentModule = stack.getCurrentModule();

        if(currentModule){
            const name = currentModule.getName();
            const data = currentModule.getData();

            return ModuleFactory.createModule(name, data);
        }
        return null;
    }

    render() {
        return (

        	<div id="blueContent">
				{this.getCurrentModule()}
				<p className="modTitle R">Costs</p>
				<div className="fullScreen TL">
	    			<div className="fullScreen innerTL"></div>
				</div>
			</div>

        );
    }
}

export default FeeStack;
