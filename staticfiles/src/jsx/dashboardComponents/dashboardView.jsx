import React from 'react';
import AssetStack from './stacks/assetStack.jsx';
import FeeStack from './stacks/feeStack.jsx';
import RiskStack from './stacks/riskStack.jsx';
import ReturnStack from './stacks/returnStack.jsx';
import DashboardStore from '../../js/flux/stores/dashboard/dashboardStore';
import RaisedButton from 'material-ui/RaisedButton';
import AppActions from '../../js/flux/actions/dashboard/dashboardActions';
import MenuFooter from './menuFooter.jsx'; 

class DashboardView extends React.Component {

	constructor(props){
		super(props);
		this.state = DashboardStore.getState();
	}

  	componentDidMount() {
		DashboardStore.listen(this.onChange.bind(this));
		//DashboardStore.performSearch();  
		AppActions.loadFakeData();

		this.setState({
			topRowHeight : $("#topRow").height()
		});
   		
	}

	componentWillUnmount() {
		DashboardStore.unlisten(this.onChange.bind(this));
	}

	onChange(state){
		this.setState(state);
	}

	getInitialView(){
		if(this.state.isLoading){
			return <h1>Loading</h1>;
		}
		return this.getLoadedView();
	}

	getFullScreenClass(){
		var fClass = "col s12 m12 l6 module";
		if(!this.state.isFullScreen && !this.state.isAnimating){
			fClass  = fClass + " hvr-grow";
		}
		return fClass;
	}

	getLoadedView(){
		if(!this.state.hasLinkedAccount){
			return (
				<div id='linkAccountContainer'>
					<div className='row'>
						
						<a 
							className="waves-effect waves-light btn-large"
							href={Urls.linkAccount()}
						>
						No Linked Accounts. Click Here To Get Started!
						</a>

					</div>
				</div>
			);
		}

		return (
				<div>
					<div id="topRow" className="row moduleRow">
						
						<div id="assetContainer" className={this.getFullScreenClass()}>
							<AssetStack 
								data={this.state.assetStack}
							/>
						</div>
						<div id="returnContainer" className={this.getFullScreenClass()}>
							<ReturnStack 
								data={this.state.returnStack}
							/>
						</div>

					</div>

					<div id="bottomRow" className="row moduleRow">
						
						<div id="riskContainer" className={this.getFullScreenClass()}>
				        	<RiskStack 
								topRowHeight={this.state.topRowHeight}
				        		data={this.state.riskStack}
				        	/>
						</div>
						<div id="feeContainer" className={this.getFullScreenClass()}>
				        	<FeeStack 
								topRowHeight={this.state.topRowHeight}
				        		data={this.state.costStack} 
				        	/>
						</div>
					
					</div>
				</div>
		)
	}

	getMenuFooter(){
		if(this.state.isFullScreen && !this.state.isAnimating){
			return <MenuFooter module={this.state.currentModule}/>
		}
		return null;
	}

    render() {
    	
        return (
        	<div>
	        	<div className="moduleContainer">
			  		
			  		{this.getInitialView()}

			  	</div>

			  	{ this.getMenuFooter() }
			</div>
        );
    }
}

export default DashboardView;
