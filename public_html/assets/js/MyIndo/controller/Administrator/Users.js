Ext.define('MyIndo.controller.Administrator.Users', {
	extend: 'MyIndo.app.Controller',

	init: function() {
		this.control({
			'usersview button': {
				click: this.onButtonClicked
			},
			'usersaddwindow button': {
				click: this.onButtonClicked
			}
		});
	},

	onButtonClicked: function(record) {
		var action = record.action;
		try {
			switch(action) {
				case 'add':
					this.add();
					break;
				case 'add-save':
					this.addSave(record);
					break;
				case 'update':
					this.update(record);
					break;
				case 'delete':
					this.delete(record);
					break;
				case 'search':
					this.search(record);
					break;
			}
		} catch(e) {
			Ext.Msg.alert('Application Error', e);
		}
	},

	/* Add */

	add: function() {
		var w = Ext.create('MyIndo.view.Administrator.Users.Add');
		w.show();
	},

	/* Add - Save */

	addSave: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		if(form.isValid()) {
			var val = form.getValues();
			if(val.PASSWORD == val.PASSWORD2) {
				Ext.Msg.confirm('Save confirmation', 'Are you sure want to save this data ?', function(btn) {
					if(btn == 'yes') {
						form.submit({
							url: MyIndo.baseUrl('users/request/create'),
							success: function(data, r) {
								var json = Ext.decode(r.response.responseText);
								if(me.isLogin(json)) {
									Ext.Msg.alert('Message', 'Data successfully saved.');
									var mainContent = Ext.getCmp('main-content');
									var store = mainContent.getActiveTab().getStore();
									store.load();
									form.reset();
								}
							},
							failure: function(data, r) {
								var json = Ext.decode(r.response.responseText);
								if(me.isLogin(json)) {
									Ext.Msg.alert('Application Error', '<strong>Error Code</strong>: ' + json.error_code + '<br/><strong>Message</strong>: ' + json.error_message);
								}
							}
						});
					}
				});
			} else {
				Ext.Msg.alert('Application Error', 'Password does not match, please check again.');
			}
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	}
});