define([
    'backbone',
    'underscore',
    'utils/defines',
    'core/BaseView',
    'collections/items',
    'views/header',
    'views/search',
    'views/map',
    'views/results',
    'text!templates/structure.html',
    'jquery.i18next',
    'backbone.babysitter'
], function(
        Backbone,
        _,
        Defines,
        BaseView,
        ItemsCollection,
        HeaderView,
        SearchView,
        MapView,
        ResultsView,
        structureTemplate,
        i18n
        ) {

    var App = BaseView.extend({
        className: "App",
        el: $('#colonosApp'),
        initialize: function() {
            cl(this.className + ".initialize");
            this.items = new ItemsCollection(); // create ItemsCollection
            this.views = new Backbone.ChildViewContainer(); // ChildViewContainer with Backbone.babysitter
            this.views.add(new HeaderView(), "header"); // create HeaderView
            this.views.add(new SearchView(), "search"); // create SearchView
            this.views.add(new MapView(), "map"); // create MapView
            this.views.add(new ResultsView(), "results"); // create ResultsView
            this.setListener();
        },
        structureTemplate: _.template(structureTemplate),
        render: function() {
            cl(this.className + ".render");
            this.$el.html(this.structureTemplate());

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
        },
        // initial load of all datas
        loadItems: function() {
            var get = this.items.fetchAll();
            var that = this;
            get.done(function(response) {
                that.items.set(JSON.parse(response)); // set the data into items.collection
                items = that.items.toArray(); // convert collection to array
                that.views.findByCustom("map").initializeMarkes(items); // initialize tha array of markers
                that.displayResults(items); // display initial results
            });
        },
        setListener: function() {
            // set MapView listeners
            this.views.findByCustom("map")
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
            });
        },
        applySearch: function(params) {
            var req = null;
            req = {}; // format req object depending on the params object;
            if (params.category != "0")
                req.category = params.category;
            if (params.zone != "0")
                req.zone = params.zone;
            if (params.type != "0")
                req.type = params.type;
            if (params.text != "")
                req.text = params.text;

            // basic Backbone.Collection.filter utilization with 'req' passed in context
            // return an array of items
            var items = this.items.filter(function(item) {
                if (this.category && (this.category != item.get("category")))
                    return false;
                if (this.zone && (this.zone != item.get("zone")))
                    return false;
                if (this.type && (this.type != item.get("type")))
                    return false;
                if (this.text) {
                    var text = _.trim(this.text.toLowerCase());
                    var name = item.get("name");
                    var desc = item.get("description");
                    // if text is include in the 'name' or the 'description'
                    if ((name && _.str.include(_.trim(name.toLowerCase()), text))
                            || (desc && _.str.include(_.trim(desc.toLowerCase()), text)))
                        return true;
                    return false;
                }
                return true;
            }, req);
            this.displayResults(items);
        },
        // call MapView & ResultView display methods with the filtered items Array
        displayResults: function(items) {
            this.views.findByCustom("map").displayItemsMarkers(items);
            this.views.findByCustom("results").displayItemsData(items);
        },
        resizeApp: function() {
            var h = $(window).height(); // window height
            var hsearch = ($(".search").height() + 40); // calculate height of the search div, +40 for padding
            $("#mapView").css("height", (h - hsearch - 51) + "px"); // map = window - search - 51 (for header height)
            $(".datalist").css("height", (h - hsearch - 51 - 41) + "px"); // map = window - search - 51 (for header height)
        }


    });

    return App;
});