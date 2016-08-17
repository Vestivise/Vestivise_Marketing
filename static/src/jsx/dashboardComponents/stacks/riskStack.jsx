import React from 'react';
import ModuleFactory from '../factories/moduleFactory';

class RiskStack extends React.Component {
    constructor(props) {
        super(props);
        this.displayName = 'RiskStack';
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
        	<div id="purpleContent">
                { this.getCurrentModule() }
				<p className="modTitle L">Risks</p>
				<div className="fullScreen TR">
	    			<div className="fullScreen innerTR"></div>
				</div>
			</div>
        );
    }
}

export default RiskStack;
