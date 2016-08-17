import React from 'react';
import AssetStack from './stacks/assetStack.jsx';
import FeeStack from './stacks/feeStack.jsx';
import RiskStack from './stacks/riskStack.jsx';
import ReturnStack from './stacks/returnStack.jsx';
import DashboardStore from '../../js/flux/stores/dashboard/dashboardStore';
import RaisedButton from 'material-ui/RaisedButton';

class DashboardView extends React.Component {

	constructor(props){
		super(props);
		this.state = DashboardStore.getState();
	}

  	componentDidMount() {
		DashboardStore.listen(this.onChange.bind(this));
		DashboardStore.performSearch();     
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
				<div className="row moduleRow">
					<div className="col s12 m6 module orange">
						
						<AssetStack data={this.state.assetStack}/>
						
					</div>
					<div className="col s12 m6 module green">
						
						<ReturnStack data={this.state.returnStack}/>

					</div>
				</div>

				<div className="row moduleRow">
					<div className="col s12 m6 module purple">
						
						<RiskStack data={this.state.riskStack}/>

					</div>
					<div className="col s12 m6 module blue">
						
						<FeeStack data={this.state.costStack} />

					</div>
				</div>
			</div>
		)
	}

    render() {
    	
        return (
        	<div className="moduleContainer">
		  		
		  		{this.getInitialView()}

		  	</div>
        );
    }
}

export default DashboardView;
