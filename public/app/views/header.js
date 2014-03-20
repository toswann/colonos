define([
	'core/BaseView',
	'bootstrap',
	'utils/defines',
	'text!templates/header.html'
], function(
	BaseView,
	Bootstrap,
	Defines,
	headerTemplate
){
	var HeaderView = BaseView.extend({
		
		className:	"HeaderView",
		
		initialize: function() {
			cl(this.className+".initialize");
			this.lang = "es";
		},
	
		headerTemplate 		: _.template(headerTemplate),
		
		events: {
			"click .flag"	: 'changeLanguage'
		},
		
		render: function(){
			cl(this.className+".render")
	        this.$el.html(this.headerTemplate());
			return this;
		},
		
		changeLanguage: function(e) {
			cl($(e.currentTarget).attr("data-lang"));
			var newlang = $(e.currentTarget).attr("data-lang");
			// execute change
			this.lang = newlang;
		}
	
	});
	
	return HeaderView;
});