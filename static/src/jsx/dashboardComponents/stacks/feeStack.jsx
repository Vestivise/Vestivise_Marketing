import React from 'react';
import ModuleFactory from '../factories/moduleFactory';
import AppActions from '../../../js/flux/actions/dashboard/dashboardActions';
import { StackConst } from '../../../js/const/stack.const';

class FeeStack extends React.Component {
    constructor(props) {
        super(props);
        this.displayName = 'FeeStack';
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
        AppActions.animate(StackConst.COST, currentModule.getModuleID(), currentModule.getName(), this.props.topRowHeight);
    }

    render() {
        return (

        	<div onClick={this.animate.bind(this)}>
				{this.getCurrentModule()}
                <p id="t2" className="modTitle L">Costs</p>
			</div>

        );
    }
}

export default FeeStack;
