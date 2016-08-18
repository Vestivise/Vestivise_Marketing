import React from 'react';
import ReactDOM from 'react-dom';
import DashboardView from '../dashboardComponents/dashboardView.jsx'
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import injectTapEventPlugin from 'react-tap-event-plugin';

const app = document.getElementById('app');
injectTapEventPlugin();
ReactDOM.render(
	<MuiThemeProvider>
		<DashboardView />
	</MuiThemeProvider>
, app);
