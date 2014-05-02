define([
    'core/BaseView',
    'bootstrap',
    'utils/defines',
    'text!templates/header.html',
    'jquery.i18next'
], function(
        BaseView,
        Bootstrap,
        Defines,
        headerTemplate,
        i18n
        ) {
    var HeaderView = BaseView.extend({
        className: "HeaderView",
        initialize: function() {
            cl(this.className + ".initialize");
            this.lang = "es";
        },
        headerTemplate: _.template(headerTemplate),
        events: {
            "click .flag": 'changeLanguage'
        },
        render: function() {
            cl(this.className + ".render")
            this.$el.html(this.headerTemplate());
            return this;
        },
        changeLanguage: function(e) {
            var newlang = $(e.currentTarget).attr("data-lang");
            if (newlang != this.lang) {
                cl(newlang)
                i18n.setLng(newlang, function(t) {
                    $("body").i18n()
                });
                this.lang = newlang;
            }
        }

    });

    return HeaderView;
});