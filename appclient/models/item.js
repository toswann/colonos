define([
    'backbone'
], function(Backbone) {

    var ItemModel = Backbone.Model.extend({
        className: "ItemModel",
        initialize: function(data) {
            //cl(this.className+".initialized");
        }

    });

    return ItemModel;
});