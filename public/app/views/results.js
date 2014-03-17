define([
	'core/BaseView',
	'bootstrap',
	'text!templates/results.html',
	'text!templates/results-count.html',
	'text!templates/results-item.html',
	'jquery.raty'
], function(
	BaseView,
	Bootstrap,
	resultTemplate,
	resultCountTemplate,
	resultItemTemplate
){
	var ResultView = BaseView.extend({
		
		className:	"ResultView",
		
		initialize: function() {
			cl(this.className+".initialize");
		},
	
		resultTemplate 			: _.template(resultTemplate),
		resultCountTemplate 	: _.template(resultCountTemplate),
		resultItemTemplate 		: _.template(resultItemTemplate),
			
		render: function(){
			cl(this.className+".render")
	        this.$el.html(this.resultTemplate());
			return this;
		},
		
		displayItemsData: function(items) {
			this.displayItemsCount(items.length);
			this.displayItemsList(items);
		},
		
		displayItemsCount: function(count) {
			this.$(".results-count-container").html(this.resultCountTemplate({count : count}));			
		},
		
		displayItemsList: function(items) {
			var that = this;
			items.each(function(item, idx) {
				cl(item.toJSON());
				that.$(".results-items-container").append(that.resultItemTemplate({i : item.toJSON()}));
				$(".item-"+item.get("id")+" .raty").raty({readOnly: true, score : item.get("averagegrade")});
			});			
		}
			
	});
	
	return ResultView;
});