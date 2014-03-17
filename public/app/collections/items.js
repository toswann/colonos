define([
	'backbone',
	'models/item'
], function(Backbone, ItemModel){

	var ItemsCollection = Backbone.Collection.extend({

		className: "ItemsCollection",

		initialize: function (data) {
			cl(this.className+".initialized");
		},
		
		model: ItemModel,
		
		url: "/api/items",
		
		
		fetchAll: function() {
			var that = this;	
			var get = $.ajax({
						url : this.url,
						type : 'GET'
					});
			return get;
		}


	});

	return ItemsCollection;
});