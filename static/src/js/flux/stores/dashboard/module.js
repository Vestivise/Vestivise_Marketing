class Module{

    constructor(moduleName, account, isAddOn, endpoint, data, moduleID){
        this.moduleName = moduleName;
        this.account = account;
        this.isAddOn = isAddOn;
        this.endpoint = endpoint;
        this.data = data;
        this.moduleID = moduleID;
    }

    getName(){
        return this.moduleName;
    }

    getModuleID(){
        return this.moduleID;
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
        return this.data;
    }

}

export default Module;