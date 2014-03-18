define([
	'underscore',
	'core/BaseView',
	'bootstrap',
	'text!templates/results.html',
	'text!templates/results-count.html',
	'text!templates/results-item.html',
	'jquery.raty'
], function(
	_,
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
			this.selectedItem = null;
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
				that.$(".results-items-container").append(that.resultItemTemplate({i : item.toJSON()}));
				$(".item-"+item.get("id")+" .raty").raty({readOnly: true, score : item.get("averagegrade")});
				$(".item-"+item.get("id")).click(function() {
					that.selectItem(this);
					that.trigger("itemselected", $(this).attr("data-ref"));
				});
				$(".item-"+item.get("id")).hover(
					function() {
						that.trigger("itemhoverin", $(this).attr("data-ref"));
					},
					function() {
						that.trigger("itemhoverout", $(this).attr("data-ref"));
					}
				);
			});
		},
		
		selectItem: function(item) {
			if (this.selectedItem) {
				$(this.selectedItem).removeClass("selected");
				$(this.selectedItem).find(".second-infos").hide();
			}
			this.selectedItem = item;
			$(item).find(".second-infos").show();
			$(item).addClass("selected");
		}
			
	});
	
	return ResultView;
});