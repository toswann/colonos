$(function(){

  var Item = Backbone.Model.extend({

    // Default attributes for the todo item.
    defaults: function() {
      return {
        title: "zone"
      };
    },

    // Toggle the `done` state of this todo item.
    toggle: function() {
      this.save({done: !this.get("done")});
    }
  });

  var ItemList = Backbone.QueryCollection.extend({

    // Reference to this collection's model.
    model: Item,
    
    url: "/api",

	getAllItems: function() {
		var that = this;	
		var get = $.ajax({
			url : this.url + '/items',
			type : 'GET'
		});
		return get;
	}
  });

  var ItemView = Backbone.View.extend({

    tagName:  "div",

    // Cache the template function for a single item.
    template: _.template($('#item-template').html()),

    // The DOM events specific to an item.
    events: {
      "click .toggle"   : "toggleDone",
      "dblclick .view"  : "edit",
      "click a.destroy" : "clear",
      "keypress .edit"  : "updateOnEnter",
      "blur .edit"      : "close"
    },

    initialize: function() {
    	// BIND FORM CHANGE TO RENDER FONCTIONS
    },

    // Re-render the titles of the todo item.
    render: function() {
      this.$el.html(this.template(this.model.toJSON()));
      this.$el.toggleClass('done', this.model.get('done'));
      this.input = this.$('.edit');
      return this;
    },


    // Remove the item, destroy the model.
    clear: function() {
      this.model.destroy();
    }

  });

  // The Application
  // ---------------

  var AppView = Backbone.View.extend({

    el: $("#colonosMapApp"),

    searchTypeTemplate: _.template($('#search-type-template').html()),
    resultNumberTemplate: _.template($('#result-template').html()),

    // Delegated events for creating new items, and clearing completed ones.
    events: {
      "keypress #new-todo":  "createOnEnter"
    },

    initialize: function() {
    	console.log("AppView.initialize");
    	this.resultsNumberContainer = this.$(".results-number-container");
    	this.resultsListContainer = this.$(".results-list-container");
    	this.searchTypeContainer = this.$(".search-type-container");
		this.iCollection = new ItemList();
		this.search = {
			category 	: "1",
			type 		: "1",
			city 		: null,
			text 		: null
		};
		this.render();
		this.loadItems();
    },

	loadItems: function() {
		var get = this.iCollection.getAllItems();
		var that = this;
		get.done(function(response) {
			that.iCollection.set(JSON.parse(response));
			that.proceedSearch();
		});
	},
	
	
	
	proceedSearch: function() {
		var fquery = {};
		if (this.search.category)
			fquery.category = this.search.category;
		if (this.search.type)
			fquery.type = this.search.type;
		if (this.search.city)
			fquery.city = this.search.city;
		
		console.log(this.iCollection.toJSON())
		console.log(fquery);
		
//		var res = this.iCollection.whereBy(fquery);
		var res = this.iCollection.query({
			$and : fquery
		});
		
		console.log("___res___");
		console.log(res)
		console.log("___res___");
		return res;
	},
	
	renderItems: function() {
		
	}
	
	renderSearchType: function() {
		console.log("renderSearchType with category: "+ this.search.category);
		this.searchTypeContainer.html(this.searchTypeTemplate());
		return this;
	},

	renderResultsNumber: function() {
		if (this.iCollection.length)
			this.resultsNumberContainer.html(this.resultNumberTemplate());
		return this;
	},
	
	renderResultsList: function() {
		if (this.iCollection.length)
			this.resultsNumberContainer.html(this.resultNumberTemplate());		
		return this;
	},
	
    render: function() {
    	console.log("AppView.render");
		this.renderSearchType()
			.renderResultsNumber()
			.renderResultsList();
				
		return this;
    }

  });

  // Finally, we kick things off by creating the **App**.
  var App = new AppView;

});