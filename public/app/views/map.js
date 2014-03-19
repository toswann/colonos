define([
	'core/BaseView',
	'leaflet',
	'utils/defines',
	'text!templates/map.html',
	'leaflet.awesome',
	'leaflet.label'
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
			this.map;
			this.markers = [];
			this.types = _.flatten(Defines.types, true); //flatten Defines.types to use it as a one dimension Array
			this.selectedMarker = null;
		},

		mapTemplate 		: _.template(mapTemplate),
				
		render: function(){
			cl(this.className+".render");
	        this.$el.html(this.mapTemplate());
	        
			this.setMapSize();
	
			this.renderMap();
			return this;
		},
		
		initializeMarkes: function(items) {
			var that = this;
			items.forEach(function(item) {
				var marker = Leaflet.marker([item.get("latitude"), item.get("longitude")], {
					icon: Leaflet.AwesomeMarkers.icon(that.types[item.get("type")][2]),
					alt : item.get("name"),
					opacity : Defines.opacity.low
				}).bindLabel(item.get('name'), {
					noHide: true,
					className: "marker-label marker-label-"+item.get('id'),
					direction: 'auto'
				})
				/*
				**
				**  DON'T FORGET TO REMOVE THE EVENTS
				**
				*/
				marker.on('mouseover', function(e) {
					this.setOpacity(Defines.opacity.high);
					this.setZIndexOffset(1000);
					$(".marker-label-"+item.get("id")).css("display", "block");
				}, marker);
				marker.on('mouseout', function(e) {
					if (item.get("id") != that.selectedMarker) {
						this.setOpacity(Defines.opacity.low);
						this.setZIndexOffset(0);
						$(".marker-label-"+item.get("id")).css("display", "none");
					}
				}, marker);
				that.markers[item.get("id")] = marker;
			});			
		},
		
		displayItemsMarkers: function(items) {
			var that = this;
			if (this.markers.length) {
				this.markers.forEach(function(marker) {
					that.map.removeLayer(marker);
				});
			}
			items.forEach(function(item) {
				marker = that.markers[item.get("id")];
				marker.addTo(that.map);
			});
		},
		
		renderMap: function() {
	        this.map = Leaflet.map(Defines.map.container, {
		        center : [Defines.map.Lat, Defines.map.Lng],
		        zoom : Defines.map.zoom
	        }); // initialize the map config
	        Leaflet.tileLayer(Defines.map.layerURL, {
					attribution: Defines.map.copy
			}).addTo(this.map); // apply the layer to the map 
			
			return this;
		},
				
		highlightMarker: function(id, opacity) {
			marker = this.markers[id]; // get the marker from markers array
			marker.setOpacity(opacity); // set opacity
			marker.setZIndexOffset((opacity == Defines.opacity.high) ? 1000 : 0); // set zIndex depending of opacity
			$(".marker-label-"+id).css("display", (opacity == Defines.opacity.high) ? "block" : "none");
		},
		
		setMapSize: function() {
			var h = $(window).height(); // window height
			var hsearch = ($(".search").height() + 40); // calculate height of the search div, +40 for padding
			$("#mapView").css("height", (h - hsearch - 51) + "px"); // map = window - search - 51 (for header height)
		}

		
		
	});
	
	return MapView;
});

