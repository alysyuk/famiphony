/*
 |---------------------------------------------------
 |  Global App View
 |---------------------------------------------------
 */

App.Views.App = Backbone.View.extend({
    initialize: function() {
        var addContact = new App.Views.AddContact({ collection: App.contacts });
        var allContactsView = new App.Views.Contacts({ collection: App.contacts }).render();
        
        $('#allContacts').append(allContactsView.el);        
    }
});


/*
 |---------------------------------------------------
 | Add Contact View
 |---------------------------------------------------
 */

App.Views.AddContact = Backbone.View.extend({
    
    el: '#addContact',
            
    initialize: function() {
        this.first_name = $('#first_name');
        this.last_name = $('#last_name');
        this.email_address = $('#email_address');
        this.description = $('#description');
    },
            
    events: {
        'submit': 'addContact'
    },
            
    addContact: function(e) {
        e.preventDefault();

        this.collection.create({
            first_name: this.first_name.val(),
            last_name: this.last_name.val(),
            email_address: this.email_address.val(),
            description: this.description.val()
        }, {wait: true});

        this.clearForm();

    },
            
    clearForm: function() {
        this.first_name.val('');
        this.last_name.val('');
        this.email_address.val('');
        this.description.val('');
    }
});

/*
 |---------------------------------------------------
 |  All Contacts View
 |---------------------------------------------------
 */
App.Views.Contacts = Backbone.View.extend({
    tagName: 'tbody',
            
    initialize: function() {
        this.collection.on('add', this.addOne, this);
    },            
            
    render: function() {
        this.collection.each(this.addOne, this);

        return this;
    },
            
    addOne: function(contact) {
        var contactView = new App.Views.Contact({model: contact});
        
        console.log(contactView.render().el);
        this.$el.append(contactView.render().el);
    }
});

/*
 |---------------------------------------------------
 | Single Contact View
 |---------------------------------------------------
 */

App.Views.Contact = Backbone.View.extend({
    tagName: 'tr',
            
    initialize : function() {
        this.template = _.template($('#contactTpl').html())
    },
    
    render: function() {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }

});