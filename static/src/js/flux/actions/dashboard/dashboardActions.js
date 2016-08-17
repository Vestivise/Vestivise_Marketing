import alt from '../../alt';

class AppActions{


	dataLoading(){
		return true;
	}

	dataSuccess(data){
		return data;
	}

	dataFail(error){
		return error;
	}

	nextModuleInStack(module){
		return module;
	}

}

export default alt.createActions(AppActions);