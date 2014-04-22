require.config({

	baseUrl: 'appclient',

	paths: {
		'backbone'					: 	'../public/lib/backbone.min',
		'backbone.babysitter'		:	'../public/lib/backbone.babysitter.min',
		'underscore'				: 	'../public/lib/underscore.min',
        'underscore.string'			: 	'../public/lib/underscore.string.min',
		'jquery'					: 	'../public/lib/jquery.min',
        'jquery.i18next'			: 	'../public/lib/i18next.amd.withJQuery-1.7.3.min',
		'jquery.raty'				: 	'../public/lib/raty/jquery.raty',
		'text'						: 	'../public/lib/text',
		'bootstrap'					: 	'../public/lib/bootstrap/js/bootstrap.min',
		'leaflet'					: 	'../public/lib/leaflet/leaflet',
		'leaflet.awesome'			:	'../public/lib/leaflet-awesome/leaflet.awesome-markers.min',
		'leaflet.label'				:	'../public/lib/leaflet.label/leaflet.label'
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
		'bootstrap': {
			deps: [ 'jquery' ],
			exports: 'Bootstrap'
		}
	}

});



require( [ 'app' ], function( App ){

	window.app = new App();
	window.app.render();
});