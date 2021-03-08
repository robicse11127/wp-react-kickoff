import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';

document.addEventListener( 'DOMContentLoaded', function() {
    var element = document.getElementById( 'wprk-admin-app' );
    if( typeof element !== 'undefined' && element !== null ) {
        ReactDOM.render( <App />, document.getElementById( 'wprk-admin-app' ) );
    }
} )