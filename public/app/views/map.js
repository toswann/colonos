define([
	'core/BaseView',
	'leaflet',
	'text!templates/map.html',
	'leaflet.awesome'
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
				Lat 		: -41.243877,
				Lng 		: -73.014291,
				layerURL	: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
				copy		: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
			}
			this.markers = '';
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
		
		
		displayItemsMarkers: function(items) {
			var that = this;
			var redMarker = Leaflet.AwesomeMarkers.icon({
			    icon: 'camera',
			    prefix : 'fa',
			    spin : true,
			    iconColor : "black",
			    markerColor: 'blue'
			});
			items.each(function(item, idx) {
//				cl(item);
				cl("add markers to Lat:"+item.get("latitude")+" Lng:"+item.get("longitude"));
				that.markers.addLayer(Leaflet.marker([item.get("latitude"), item.get("longitude")], {icon: redMarker}))
			});
			this.markers.addTo(this.map);
		},
		
		renderMap: function() {
	        this.map = Leaflet.map(this.mapConfig.container, {
		        center : [this.mapConfig.Lat, this.mapConfig.Lng],
		        zoom : this.mapConfig.zoom
	        });	        
	        Leaflet.tileLayer(this.mapConfig.layerURL, {
					attribution: this.mapConfig.copy
			}).addTo(this.map);
			
			this.markers = Leaflet.layerGroup();
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

