define([
    'backbone',
    'underscore',
    '../appclient/utils/defines',
    'jquery.i18next',
    'backbone.babysitter'
], function(
        Backbone,
        _,
        Defines,
        i18n
        ) {

    var AppAdmin = Backbone.View.extend({
        className: "AppAdmin",
        el: $('#colonosAppAdmin'),
        initialize: function() {
            cl(this.className + ".initialize");
            /*this.items = new ItemsCollection(); // create ItemsCollection
            this.views = new Backbone.ChildViewContainer(); // ChildViewContainer with Backbone.babysitter
            this.views.add(new HeaderView(), "header"); // create HeaderView
            this.views.add(new SearchView(), "search"); // create SearchView
            this.views.add(new MapView(), "map"); // create MapView
            this.views.add(new ResultsView(), "results"); // create ResultsView

            this.setListener(); */
        },

        render: function() {
            cl(this.className + ".render");
            /*this.$el.html(this.structureTemplate());

            // BaseView.assign method
            this.assign({
                '.header': this.views.findByCustom("header"), // render SearchView in $el '.search'
                '.search': this.views.findByCustom("search"), // render SearchView in $el '.search'
                '.mapside': this.views.findByCustom("map"),
                '.dataside': this.views.findByCustom("results")
            });

            this.resizeApp();
            $(window).resize(this.resizeApp); // bind window.resize event

            i18n.init({
                lng: "es",
                resGetPath: 'public/locales/map/__lng__/__ns__.json',
                fallbackLng: 'es'
            }, function() {
                $("body").i18n();
            });
            
            // initial load of all datas
            this.loadItems();
            */
        },
        // initial load of all datas
        loadItems: function() {
            /*var get = this.items.fetchAll();
            var that = this;
            get.done(function(response) {
                that.items.set(JSON.parse(response)); // set the data into items.collection
                items = that.items.toArray(); // convert collection to array
                that.views.findByCustom("map").initializeMarkes(items); // initialize tha array of markers
                that.displayResults(items); // display initial results
            });*/
        },
        setListener: function() {
            // set MapView listeners
            /* this.views.findByCustom("map")
                    // when ResultView throw 'itemhoverin' event
                    .listenTo(this.views.findByCustom("results"), "itemhoverin", function(id) {
                        // highlight corresponding map marker
                        this.highlightMarker(id, Defines.opacity.high);
                    })
                    // when ResultView throw 'itemhoverin' event
                    .listenTo(this.views.findByCustom("results"), "itemhoverout", function(id) {
                        // unhighlight coresponding map marker
                        if (id != this.selectedMarker)
                            this.highlightMarker(id, Defines.opacity.low);
                    })
                    // when ResultView throw 'itemselected' event
                    .listenTo(this.views.findByCustom("results"), "itemselected", function(data) {
                        // unhighlight previous selected marker
                        if (this.selectedMarker)
                            this.highlightMarker(this.selectedMarker, Defines.opacity.low);
                        if (data.id != "none") { //doesn't highlight marker when id == 'none' 
                            // define the new selected marker & highlight it
                            this.selectedMarker = data.id;
                            this.highlightMarker(data.id, Defines.opacity.high);
                            this.map.panTo(data.latLng);
                        }
                    });

            // when SearchView throw 'newsearch' event
            this.listenTo(this.views.findByCustom("search"), "newsearch", function(params) {
                // apply search with the 'params' object build in the search view
                this.applySearch(params);
            });*/
        }

    });
    return AppAdmin;
});