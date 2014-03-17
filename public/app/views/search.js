define([
	'core/BaseView',
	'bootstrap',
	'text!templates/search.html',
	'text!templates/search-type.html'
], function(
	BaseView,
	Bootstrap,
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
		this.$(".search-type-container").html(this.searchTypeTemplate({type : _.flatten(this.type, true)}));
		return this;
	},
	
	updateType: function(e) {
		var cat = e.target.firstElementChild.id;
		this.$(".search-type-container").html(
			this.searchTypeTemplate({
				type : (cat > 0 ? _.union([[0, "All"]], this.type[cat])
					 			: _.flatten(this.type, true))
			})
		);
	},
	
	type: [
		[
			[0 , "All"]
		],
		[
			[1  , "Hotel"],
			[2  , "Hostel"],
			[3  , "Cabins"],
			[4  , "B&B"],
			[5  , "Camping"],
			[6  , "Lodging"],
			[7  , "Inn"],
			[8  , "Motel"]
		],
		[
			[9  , "Restaurant"],
			[10 , "Café"],
			[11 , "Sandwich Shop"]
		],
		[
			[12 , "Theatre"],
			[13 , "Museum"],
			[14 , "Cinema"],
			[15 , "Events"]
		],
		[
			[16 , "Flora"],
			[17 , "Fauna"],
			[18 , "Birds"],
			[19 , "Geology"],
			[20 , "Beaches"]
		],
		[
			[21 , "Rafting"],
			[22 , "Canopy"],
			[23 , "Horse Riding"],
			[24 , "Lodge"],
			[25 , "Guides"]
		],
		[
			[26 , "Casino"],
			[27 , "Night Club"],
			[28 , "Rodeo"],
			[29 , "Events Centre"],
			[30 , "SPA"]
		],
		[
			[31 , "Terrains"],
			[32 , "Houses"],
			[33 , "Premises"]
		],
		[
			[34 , "Souvenirs"],
			[35 , "Knitwear"],
			[36 , "Food"],
			[37 , "Beer"]
		]
	]

	
});

return SearchView;
});