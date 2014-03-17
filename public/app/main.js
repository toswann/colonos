require.config({

	baseUrl: 'public/app',

	paths: {
		'backbone'					: 	'../lib/backbone.min',
		'backbone.babysitter'		:	'../lib/backbone.babysitter.min',
		'backbone.analytics'		:	'../lib/backbone.analytics',
		'underscore'				: 	'../lib/underscore.min',
        'underscore.string'			: 	'../lib/underscore.string.min',
		'jquery'					: 	'../lib/jquery.min',
		'text'						: 	'../lib/text',
		'bootstrap'					: 	'../lib/bootstrap/js/bootstrap.min',
		'leaflet'					: 	'../lib/leaflet/leaflet'
	},

	shim: {
		'jquery': {
			exports: '$'
		},
		'underscore': {
			deps: ['underscore.string'],
			exports: '_',
			init: function(underscoreString) {
				_.mixin(underscoreString.exports());
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
		//leaflet: { deps: [ 'jquery' ], exports: 'Leaflet' },
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