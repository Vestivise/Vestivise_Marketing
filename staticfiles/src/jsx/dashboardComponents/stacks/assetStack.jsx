import React from 'react';
import ModuleFactory from '../factories/moduleFactory';
import AppActions from '../../../js/flux/actions/dashboard/dashboardActions';
import { StackConst } from '../../../js/const/stack.const';

class AssetStack extends React.Component {
    constructor(props) {
        super(props);
        this.displayName = 'AssetStack';
    }

    getCurrentModule(){
        const stack = this.props.data;
        const currentModule = stack.getCurrentModule();

        if(currentModule){
            const name = currentModule.getModuleID();
            const data = currentModule.getData();

            return ModuleFactory.createModule(name, data);
        }
        return null;
    }

    animate(){

        const stack = this.props.data;
        const currentModule = stack.getCurrentModule();
        AppActions.animate(StackConst.ASSET, currentModule.getModuleID(), currentModule.getName(), null);
    }

    render() {
        return (

        	<div onClick={this.animate.bind(this)}>
				{this.getCurrentModule()}
				<p className="modTitle R">Assets</p>
			</div>

        );
    }
}

export default AssetStack;
