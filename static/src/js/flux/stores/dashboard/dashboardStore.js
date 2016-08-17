import alt from '../../alt';
import { StackConst } from '../../../const/stack.const';
import AppActions from '../../actions/dashboard/dashboardActions';
import API from '../../../api';

class Module{

    constructor(moduleName, account, isAddOn, endpoint){
        this.moduleName = moduleName;
        this.account = account;
        this.isAddOn = isAddOn;
        this.endpoint = endpoint;
    }

    getName(){
        return this.moduleName;
    }

    getAccount(){
        return this.account;
    }

    getChartJSON(){

    }

    getChartCSS(){

    }

    isAddOn(){
        return this.isAddOn;
    }

    getData(){
        return API.get(Urls.broker(this.endpoint));
    }

}

class Stack{

	constructor(){
		this.index = -1;
		this.modules = [];
	}

    getCurrentModule(){
        if(this.index == -1){
            return null;
        }
        return this.modules[this.index];
    }

	pushModule(module){
        const name = module.moduleName;
        const account = module.account;
        const isAddOn = module.isAddOn;
        const endpoint = module.endpoint;
        const m = new Module(name, account, isAddOn, endpoint);
		this.modules.push(m);
		if(this.index == -1){
			this.index = 0;
		}
	}

	next(){
		if(this.index++ == this.modules.length){
			this.index = 0;
		}
	}

}

class DashboardStore{

	constructor(){
		this.bindListeners({
			nextModuleInStack : AppActions.nextModuleInStack,
			loadDashboard : AppActions.dataLoading,
			loadBasicAccountData : AppActions.dataSuccess,
	    });

	    this.state = {
	    	riskStack : new Stack(),
	    	returnStack : new Stack(),
	    	costStack : new Stack(),
	    	assetStack : new Stack(),
	    	isLoading : false,
            hasLinkedAccount : false
	    };
	}


    loadBasicAccountData(data){

        this.setState({
            isLoading : false,
            hasLinkedAccount: data.linkedAccount
        });

    	var riskStack = this.state.riskStack;

    	var returnStack = this.state.returnStack;

    	var costStack = this.state.costStack;

    	var assetStack = this.state.assetStack;

        if(!data.linkedAccount){
            return;
        }

        for(var i = 0 ; i < data.account_modules.length ; i++){
            const module = data.account_modules[i].module;
            switch(module.category){
                case StackConst.RISK:
                    riskStack.pushModule(module);
                    break;
                case StackConst.ASSET:
                    assetStack.pushModule(module);
                    break;
                case StackConst.RETURN:
                    returnStack.pushModule(module);
                    break;
                case StackConst.COST:
                    costStack.pushModule(module);
                    break;
            }
        }
    	
    	this.setState({
    		riskStack :  riskStack,
    		performanceStack : returnStack,
    		costStack : costStack,
    		assetStack : assetStack 
    	});

    }

    nextModuleInStack(stack){
    	var state;
    	var stack;
    	switch(stack){
    		case StackConst.RISK:
    			stack = this.state.riskStack;
    			stack.next();
    			state = { riskStack : stack};
    			break;
    		case StackConst.RETURN:
    			stack = this.state.returnStack;
    			stack.next();
    			state = { returnStack : stack};
    			break;
    		case StackConst.ASSET:
    			stack = this.state.assetStack;
    			stack.next();
    			state = { assetStack : stack };
    			break;
    		case StackConst.Cost:
    			stack = this.state.costStack;
    			stack.next();
    			state = { costStack : stack };
    			break;
    	}

    	this.setState(state);
    }

}

export default alt.createStore(DashboardStore, 'DashboardStore');
