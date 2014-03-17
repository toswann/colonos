define([
	'backbone',
	'core/BaseView',
	'collections/items',
	'views/search',
	'views/map',
	'views/results',
	'text!templates/structure.html',
	'backbone.babysitter'
], function(
	Backbone,
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
		
		applySelection: function(items) {
			var mapView = this.views.findByCustom("map");
			var resultView = this.views.findByCustom("results");
			mapView.displayItemsMarkers(items);
			resultView.displayItemsData(items);
		}

	});
	
	return App;
});