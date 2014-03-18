define([
	'core/BaseView',
	'bootstrap',
	'utils/defines',
	'text!templates/search.html',
	'text!templates/search-type.html'
], function(
	BaseView,
	Bootstrap,
	Defines,
	searchTemplate,
	searchTypeTemplate
){
	var SearchView = BaseView.extend({
		
		className:	"SearchView",
		
		initialize: function() {
			cl(this.className+".initialize");
		},
	
		searchTemplate 		: _.template(searchTemplate),
		searchTypeTemplate 	: _.template(searchTypeTemplate),
	
		events : {
			"click .group-wrapper" :	"updateType"	
		},
			
		render: function(){
			cl(this.className+".render")
	        this.$el.html(this.searchTemplate());
	        this.$('.btn').button();
	        // add active state to category 'All'
	        this.$('.btn-group label').first().addClass("active");
			this.$(".search-type-container").html(this.searchTypeTemplate({type : _.flatten(Defines.types, true)}));
			return this;
		},
	
		updateType: function(e) {
			var cat = e.target.firstElementChild.id;
			this.$(".search-type-container").html(this.searchTypeTemplate({
					type : (cat > 0 ? _.union([[0, "All"]], Defines.types[cat]) : _.flatten(Defines.types, true))
			}));
		}
	});
	
	return SearchView;
});