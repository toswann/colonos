define([
	'backbone',
	'underscore',
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
	_,
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

			this.setListener();
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
				items = that.items.toArray();
				that.views.findByCustom("map").initializeMarkes(items);
				that.displaySearchCollection(items);
			});
		},
		
		setListener: function() {
			this.views.findByCustom("map")
			.listenTo(this.views.findByCustom("results"), "itemhoverin", function(id) {
				this.highlightMarker(id, Defines.opacity.high);
			})
			.listenTo(this.views.findByCustom("results"), "itemhoverout", function(id) {
				if (id != this.selectedMarker)
					this.highlightMarker(id, Defines.opacity.low);
			})		
			.listenTo(this.views.findByCustom("results"), "itemselected", function(id) {
				if (this.selectedMarker)
					this.highlightMarker(this.selectedMarker, Defines.opacity.low);
				if (id != "none") { //doesn't highlight marker when id == 'none' 
					this.selectedMarker = id;
					this.highlightMarker(id, Defines.opacity.high);
				}
			});
			
			this.listenTo(this.views.findByCustom("search"), "newsearch", function(params) {
				this.applySearch(params);
			});
		},
		
		applySearch: function(params) {
			cl("> applysearch with params: ");
			cl(params);
			var req = null;
			req = {};
			if (params.category != "0")
				req.category = params.category;
			if (params.city != "0")
				req.city = params.city;
			if (params.type != "0")
				req.type = params.type;
			if (params.text != "")
				req.text = params.text;
			
			
//			var items = (_.isEmpty(req)) ? this.items.toArray() : this.items.where(req);
			var items = this.items.filter(function(item) {
				if (this.category && (this.category != item.get("category")))
					return false;
				if (this.city && (this.city != item.get("city")))
					return false;
				if (this.type && (this.type != item.get("type")))
					return false;
				if (this.text) {
					var text = _.trim(this.text.toLowerCase());
					var name = item.get("name") ;
					var desc = _.trim(item.get("description").toLowerCase());
					cl("text : '"+text+"'");
					cl("name : '"+name+"'");
					cl("desc : '"+desc+"'");
					if (name && _.str.include(_.trim(name.toLowerCase()), text))
						return true;
					if (desc && _.str.include(desc, text))
						return true;
					return false;					
				}
				return true;
			}, req);
			this.displaySearchCollection(items);
		},
		
		displaySearchCollection: function(items) {
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