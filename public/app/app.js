define([
	'backbone',
	'utils/defines',
	'core/BaseView',
	'collections/items',
	'views/search',
	'views/map',
	'views/results',
	'text!templates/structure.html',
	'backbone.babysitter'
], function(
	Backbone,
	Defines,
	BaseView,
	ItemsCollection,
	SearchView,
	MapView,
	ResultsView,
	structureTemplate
){

	var App = BaseView.extend({
		
		className:	"App",
		
		el: $('#colonosApp'),
	
		initialize: function() {
			cl(this.className+".initialize");
			this.items = new ItemsCollection();
	 		this.views = new Backbone.ChildViewContainer();
			this.views.add(new SearchView(), "search");
			this.views.add(new MapView(), "map");
			this.views.add(new ResultsView(), "results");

			this.addMapListener();
		},
	
		structureTemplate : _.template(structureTemplate),
	
		render: function(){
			cl(this.className+".render");		
			this.$el.html(this.structureTemplate());
			
			this.assign({
		        '.search'		: this.views.findByCustom("search"),
		        '.mapside'		: this.views.findByCustom("map"),
		        '.dataside'		: this.views.findByCustom("results")
		    });
		    
		    this.resizeApp();
			$(window).resize(this.resizeApp); // bind resize event

		    this.loadItems();
			
		},
		
		loadItems: function() {
			var get = this.items.fetchAll();
			var that = this;
			get.done(function(response) {
				that.items.set(JSON.parse(response));
				that.applySelection(that.items);
			});
		},
		
		addMapListener: function() {
			this.views.findByCustom("map")
			.listenTo(this.views.findByCustom("results"), "itemhoverin", function(id) {
				this.highlightMarker(id, Defines.opacity.high);
			})
			.listenTo(this.views.findByCustom("results"), "itemhoverout", function(id) {
				this.highlightMarker(id, Defines.opacity.low);
			});			
		},
		
		applySelection: function(items) {
			this.views.findByCustom("map").displayItemsMarkers(items);
			this.views.findByCustom("results").displayItemsData(items);
		},
		
		resizeApp: function() {
			var h = $(window).height(); // window height
			var hsearch = ($(".search").height() + 40); // calculate height of the search div, +40 for padding
			$("#mapView").css("height", (h - hsearch - 51) + "px"); // map = window - search - 51 (for header height)
			$(".datalist").css("height", (h - hsearch - 51 - 41) + "px"); // map = window - search - 51 (for header height)
		}


	});
	
	return App;
});