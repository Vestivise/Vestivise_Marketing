import React from 'react';
import ModuleFactory from '../factories/moduleFactory';

class AssetStack extends React.Component {
    constructor(props) {
        super(props);
        this.displayName = 'AssetStack';
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

        	<div id="orangeContent">
				{this.getCurrentModule()}
				<p className="modTitle L">Assets</p>
				<div className="fullScreen BR">
	    			<div className="fullScreen innerBR"></div>
				</div>
			</div>

        );
    }
}

export default AssetStack;
