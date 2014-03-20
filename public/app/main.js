require.config({

	baseUrl: 'public/app',

	paths: {
		'backbone'					: 	'../lib/backbone.min',
		'backbone.babysitter'		:	'../lib/backbone.babysitter.min',
		'backbone.analytics'		:	'../lib/backbone.analytics',
		'underscore'				: 	'../lib/underscore.min',
        'underscore.string'			: 	'../lib/underscore.string.min',
		'jquery'					: 	'../lib/jquery.min',
        'jquery.i18next'			: 	'../lib/i18next.amd.withJQuery-1.7.2.min',
		'jquery.raty'				: 	'../lib/raty/jquery.raty',
		'text'						: 	'../lib/text',
		'bootstrap'					: 	'../lib/bootstrap/js/bootstrap.min',
		'leaflet'					: 	'../lib/leaflet/leaflet',
		'leaflet.awesome'			:	'../lib/leaflet-awesome/leaflet.awesome-markers.min',
		'leaflet.label'				:	'../lib/leaflet.label/leaflet.label'
	},

	shim: {
		'jquery': {
			exports: '$'
		},
		'leaflet.awesome': {
			deps : ['leaflet']	
		},
		'leaflet.label': {
			deps : ['leaflet']	
		},
		'jquery.raty': {
			deps : ['jquery']	
		},
		'jquery.i18next': {
			deps : ['jquery']	
		},
		'underscore': {
			deps: ['underscore.string'],
			exports: '_',
			init: function(underscoreString) {
				_.str = underscoreString;
				_.mixin(_.str.exports());
			}
	    },
		'backbone': {
			deps: ['underscore', 'jquery'],
			exports : 'Backbone'
		},
		'backbone.babysitter': {
			deps: ['backbone']
		},
		'backbone.analytics': {
			deps: ['backbone']
		},
		'bootstrap': {
			deps: [ 'jquery' ],
			exports: 'Bootstrap'
		}
	}

});



require( [ 'app' ], function( App ){

	window.app = new App();
	window.app.render();
	console.log('App started');

});