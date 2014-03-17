define([
	'core/BaseView',
	'leaflet',
	'text!templates/map.html'
], function(
	BaseView,
	Leaflet,
	mapTemplate
){
	var MapView = BaseView.extend({
	
		className:	"MapView",
		
		initialize: function() {
			cl(this.className+".initialize");
			this.map = '';
			this.mapConfig = {
				container	: "mapView",
				zoom 		: 10,
				Lat 		: -41.327463,
				Lng 		: -72.974466,
				layerURL	: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
				copy		: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
			}
		},
	
		mapTemplate 		: _.template(mapTemplate),
				
		render: function(){
			cl(this.className+".render");
	        this.$el.html(this.mapTemplate());

			this.resizeMap();
			$(window).resize(this.resizeMap);
				
			this.renderMap();
			return this;
		},
		
		createMarkerGroup: function() {
			
		},
		
		renderMap: function() {
	        this.map = Leaflet.map(this.mapConfig.container, {
		        center : [this.mapConfig.Lat, this.mapConfig.Lng],
		        zoom : this.mapConfig.zoom
	        });	        
	        Leaflet.tileLayer(this.mapConfig.layerURL, {
					attribution: this.mapConfig.copy
			}).addTo(this.map);
			return this;
		},
		
		resizeMap: function() {
			var h = $(window).height();
			var hsearch = ($(".search").height() + 40); // 40 for margin
			$("#mapView").css("height", (h - hsearch - 50) + "px"); // 50 for header
		}
		
	});
	
	return MapView;
});

