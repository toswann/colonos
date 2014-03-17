define([
	'backbone',
	'core/BaseView',
	'views/search',
	'views/map',
	'text!templates/structure.html',
	'backbone.babysitter'
], function(
	Backbone,
	BaseView,
	SearchView,
	MapView,
	structureTemplate
){

	var App = BaseView.extend({
		
		className:	"App",
		
		el: $('#colonosApp'),
	
		initialize: function() {
			cl(this.className+".initialize");
	 		this.views = new Backbone.ChildViewContainer();
			this.views.add(new SearchView(), "search");
			this.views.add(new MapView(), "map");
		},
	
		structureTemplate : _.template(structureTemplate),
	
		render: function(){
			cl(this.className+".render");		
			this.$el.html(this.structureTemplate());
			
			this.assign({
		        '.search'		: this.views.findByCustom("search"),
		        '.mapside'		: this.views.findByCustom("map")
		    });
		    
			    
		}
	});
	
	return App;
});