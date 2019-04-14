
require('./bootstrap');

// window.Vue = require('vue');
window.React = require('react');
import MapComponent from './components/MapComponent';
import ReactDOM from 'react-dom';
import 'jquery-ui-bundle';
import 'jquery-ui-bundle/jquery-ui.css';
// import Routes from './routes'
import {
    authCheck
  } from './modules/auth/store/actions'  
store.dispatch(authCheck())

import {
    Provider
} from 'react-redux'
import store from './store'

ReactDOM.render(<Provider store={store}>
    <MapComponent regions={{}} WMSStoreNS={'kotabogor'}/>
</Provider>,
    document.getElementById('app'))
