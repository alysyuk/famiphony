/*
 |---------------------------------------------------
 |  Global App View
 |---------------------------------------------------
 */

App.Views.App = Backbone.View.extend({
    initialize: function() {
        var addContactView = new App.Views.AddContact({ collection: App.contacts });
    }
});


/*
|---------------------------------------------------
| Add Contact View
|---------------------------------------------------
*/
 
App.Views.AddContact = Backbone.View.extend({
    el: '#addContact',
 
    events: {
        'submit' : 'addContact'
    },
 
    addContact: function(e) {
        e.preventDefault();
 
        console.log( 'add contact now' );
    }
});