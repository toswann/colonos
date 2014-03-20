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
			"change .categories-radio label" 	:		"categoryChange",
			"change .city-select" 				:		"cityChange",	
			"change .type-select" 				:		"typeChange",
			"keyup 	.keywords"					:		"keywordsChange"
		},
			
		render: function(){
			cl(this.className+".render")
	        this.$el.html(this.searchTemplate());
	        this.$('.btn').button();
	        // add active state to category 'All'
	        this.$('.btn-group label').first().addClass("active");
	        // initialize type select with all the types of define.types (transform in a one dimension array by _.flatten
			this.$(".type-select").html(this.searchTypeTemplate({type : _.flatten(Defines.types, true)}));
			return this;
		},
	
		categoryChange: function(e) {
			var cat = $(e.currentTarget).find("input").val();
			//cl("> category change to "+cat);
			if (cat != this.searchParams.category) {
				this.updateType(cat);
				this.searchParams.category = cat;
				this.trigger("newsearch", this.searchParams);
			}
		},

		cityChange: function() {
			//cl("> city change to "+$(".city-select").val());
			this.searchParams.city = $(".city-select").val();
			this.trigger("newsearch", this.searchParams);
			
		},
		
		typeChange: function(e) {
			//cl("> type change to "+$(".type-select").val());
			this.searchParams.type = $(".type-select").val();
			this.trigger("newsearch", this.searchParams);
		},
		
		keywordsChange: function() {
			//cl("> keywords change to "+$("#keywords").val());
			var text = $("#keywords").val();
			if (text.length == 0 || _.trim(text) != "") {
				this.searchParams.text = _.trim(text);
				this.trigger("newsearch", this.searchParams);
			}
		},
		
		updateType: function(cat) {
			this.$(".type-select").html(this.searchTypeTemplate({
					type : (cat > 0 ? _.union([[0, "All"]], Defines.types[cat]) : _.flatten(Defines.types, true))
			}));
		}
	});
	
	return SearchView;
});