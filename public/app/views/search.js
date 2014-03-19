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
			this.searchParams = {
				category	: "0",
				type		: "0",
				city		: "0",
				text		: ""
			}
		},
	
		searchTemplate 		: _.template(searchTemplate),
		searchTypeTemplate 	: _.template(searchTypeTemplate),
	
		events : {
			"click .group-wrapper" :	"categoryChange"	
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
	
		categoryChange: function(e) {
			var cat = e.target.firstElementChild.id;
			cl("> category change to "+cat);
			if (cat != this.searchParams.category) {
				this.updateType(cat);
				this.searchParams.category = cat;
				this.trigger("newsearch", this.searchParams);
			}
		},
	
		updateType: function(cat) {
			this.$(".search-type-container").html(this.searchTypeTemplate({
					type : (cat > 0 ? _.union([[0, "All"]], Defines.types[cat]) : _.flatten(Defines.types, true))
			}));
		}
	});
	
	return SearchView;
});