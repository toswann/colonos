define([
	'underscore',
	'jquery',
	'backbone'
], function(_, $, Backbone){

	var BaseView = Backbone.View.extend({
	
		// called in render, assign subviews to view 
		/* this.assign({
		        '.subview'             : this.subview,
		        '.another-subview'     : this.anotherSubview
		    }); */
		assign : function (selector, view) {
			var selectors;
			if (_.isObject(selector)) {
				selectors = selector;
			}
			else {
				selectors = {};
				selectors[selector] = view;
			}
			if (!selectors) return;
		    _.each(selectors, function (view, selector) {
		        view.setElement(this.$(selector)).render();
		    }, this);
		},
	
		close : function(){
			cl(this.className+".remove");
			this.remove();
		}
		
		
	});

	return BaseView;
});
