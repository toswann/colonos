define([
    'underscore',
    'core/BaseView',
    'bootstrap',
    'text!templates/results.html',
    'text!templates/results-count.html',
    'text!templates/results-item.html',
    'utils/defines',
    'jquery.raty'
], function(
        _,
        BaseView,
        Bootstrap,
        resultTemplate,
        resultCountTemplate,
        resultItemTemplate,
        Defines
        ) {
    var ResultView = BaseView.extend({
        className: "ResultView",
        initialize: function() {
            cl(this.className + ".initialize");
            this.selectedItem = "none";
        },
        resultTemplate: _.template(resultTemplate),
        resultCountTemplate: _.template(resultCountTemplate),
        resultItemTemplate: _.template(resultItemTemplate),
        render: function() {
            cl(this.className + ".render")
            this.$el.html(this.resultTemplate());
            return this;
        },
        displayItemsData: function(items) {
            this.displayItemsCount(items.length);
            this.displayItemsList(items);
        },
        displayItemsCount: function(count) {
            this.$(".results-count-container").html(this.resultCountTemplate({count: count}));
            $(".results-count-container").i18n();
        },
        displayItemsList: function(items) {
            var that = this;
            that.$(".results-items-container").html(""); // clean the result list content
            that.trigger("itemselected", {id: "none"}); // trigger itemselected with id:none to unhighlight the selectedMarker
            items.forEach(function(item) {
                that.$(".results-items-container").append(that.resultItemTemplate({
                    C: Defines.cities,
                    T: _.flatten(Defines.types, true),
                    CAT: Defines.categories,
                    i: item.toJSON()
                }));
                $(".item-" + item.get("item_id") + " .raty").raty({readOnly: true, score: item.get("averagegrade")});
                $(".item-" + item.get("item_id")).click(function() {
                    that.selectItem(this);
                    var data = {id: $(this).attr("data-ref"), latLng: [item.get("latitude"), item.get("longitude")]};
                    that.trigger("itemselected", data);
                });
                $(".item-" + item.get("item_id")).hover(
                        function() {
                            that.trigger("itemhoverin", $(this).attr("data-ref"));
                        },
                        function() {
                            that.trigger("itemhoverout", $(this).attr("data-ref"));
                        }
                );
            });
            $(".results-items-container").i18n();
        },
        selectItem: function(item) {
            if (this.selectedItem != "none") {
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