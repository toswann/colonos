define([
	'core/BaseView',
	'leaflet',
	'utils/defines',
	'text!templates/map.html',
	'leaflet.awesome'
], function(
	BaseView,
	Leaflet,
	Defines,
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
			this.markers = [];
			this.types = _.flatten(Defines.types, true);
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
			items.each(function(item, idx) {
				var marker = Leaflet.marker([item.get("latitude"), item.get("longitude")], {
					icon: that.types[item.get("type")][2],
					title : item.get("name"),
					alt : item.get("name"),
					opacity : 0.5
				});
				/*
				**
				**  DON'T FORGET TO REMOVE THE EVENTS
				**
				*/
				marker.on('mouseover', function(e) {
					this.setOpacity(1);
				}, marker);
				marker.on('mouseout', function(e) {
					this.setOpacity(0.5);
				}, marker);
				that.markers[item.get("id")] = marker;
				marker.addTo(that.map);
			});
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
		},
		
		setMarkerOpacity: function(id, opacity) {
			marker = this.markers[id];
			marker.setOpacity(opacity);
		}
		
	});
	
	return MapView;
});

