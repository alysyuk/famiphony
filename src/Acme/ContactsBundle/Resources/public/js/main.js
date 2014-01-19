//TODO: refactor using require.js, check how it is done in fapcu
(function() {
    window.App = {
        Models: {},
        Collections: {},
        Views: {},
        Router: {}
    };

    window.vent = _.extend({}, Backbone.Events);
}());