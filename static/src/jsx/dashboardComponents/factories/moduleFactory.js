import { ModuleConst } from '../const/module.const';
import BasicRiskModule from '../modules/basic/basicRiskModule.jsx';
import BasicFeeModule from '../modules/basic/basicFeeModule.jsx';
import BasicAssetModule from '../modules/basic/basicAssetModule.jsx';
import BasicReturnModule from '../modules/basic/basicReturnModule.jsx';

import React from 'react';

export default class ModuleFactory{
	static createModule(moduleName, data){
		var module;
		switch(moduleName){
			case ModuleConst.BASIC_RISK:
				module = (<BasicRiskModule data={data}/>);
				break;
			case ModuleConst.BASIC_RETURN:
				module = (<BasicReturnModule data={data}/>);
				break;
			case ModuleConst.BASIC_ASSET:
				module = (<BasicAssetModule data={data}/>);
				break;
			case ModuleConst.BASIC_FEE:
				module = (<BasicFeeModule data={data}/>);
				break;
			default:
				console.log('error on create module: ' + moduleName);
		}

		return module;
	}
}