Ext.define('MyIndo.controller.Administrator.Users', {
	extend: 'MyIndo.app.Controller',

	init: function() {
		this.control({
			'usersview button': {
				click: this.onButtonClicked
			},
			'usersaddwindow button': {
				click: this.onButtonClicked
			},
			'usersupdatewindow button': {
				click: this.onButtonClicked
			},
			'usersfilter button': {
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
					this.update();
					break;
				case 'update-save':
					this.updateSave(record);
					break;
				case 'delete':
					this.delete(record);
					break;
				case 'filter':
					this.filter();
					break;
				case 'users-apply-filter':
					this.applyFilter(record);
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
						me.showLoadingWindow();
						form.submit({
							url: MyIndo.baseUrl('users/request/create'),
							success: function(data, r) {
								var json = Ext.decode(r.response.responseText);
								if(me.isLogin(json)) {
									Ext.Msg.alert('Message', 'Data successfully saved.');
									var mainContent = Ext.getCmp('main-content');
									var store = mainContent.getActiveTab().getStore();
									store.proxy.extraParams = {};
									store.load();
									form.reset();
								}
								me.closeLoadingWindow();
							},
							failure: function(data, r) {
								var json = Ext.decode(r.response.responseText);
								if(me.isLogin(json)) {
									Ext.Msg.alert('Application Error', '<strong>Error Code</strong>: ' + json.error_code + '<br/><strong>Message</strong>: ' + json.error_message);
								}
								me.closeLoadingWindow();
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
	},

	/* Update */
	update: function() {
		var panel = Ext.getCmp('main-content');
		var parent = panel.getActiveTab();
		var selected = parent.getSelectionModel().getSelection();
		var updateWindow = Ext.create('MyIndo.view.Administrator.Users.Update');
		var form = updateWindow.items.items[0].getForm();
		if(selected.length > 0) {
			form.setValues(selected[0].data);
			updateWindow.show();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any users.');
		}
	},

	/* Update - Save */

	updateSave: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		if(form.isValid()) {
			var val = form.getValues();
			if(val.PASSWORD == val.PASSWORD2) {
				Ext.Msg.confirm('Save confirmation', 'Are you sure want to save this data ?', function(btn) {
					if(btn == 'yes') {
						me.showLoadingWindow();
						form.submit({
							url: MyIndo.baseUrl('users/request/update'),
							success: function(data, r) {
								var json = Ext.decode(r.response.responseText);
								if(me.isLogin(json)) {
									Ext.Msg.alert('Message', 'Data successfully saved.');
									var mainContent = Ext.getCmp('main-content');
									var store = mainContent.getActiveTab().getStore();
									store.load();
									parent.close();
								}
								me.closeLoadingWindow();
							},
							failure: function(data, r) {
								var json = Ext.decode(r.response.responseText);
								if(me.isLogin(json)) {
									Ext.Msg.alert('Application Error', '<strong>Error Code</strong>: ' + json.error_code + '<br/><strong>Message</strong>: ' + json.error_message);
									if(json.error_code == 10082) {
										parent.close();
									}
								}
								me.closeLoadingWindow();
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
	},

	delete: function(record) {
		var parent = record.up().up();
		var selected = parent.getSelectionModel().getSelection();
		var store = parent.getStore();
		var me = this;
		if(selected.length > 0) {
			var data = selected[0].data;
			if(data.USERNAME != 'admin') {
				Ext.Msg.confirm('Delete Confirmation', 'Are you sure want to delete this user ?', function(btn) {
					if(btn == 'yes') {
						me.showLoadingWindow();
						Ext.Ajax.request({
							url: MyIndo.siteUrl('users/request/destroy'),
							params: data,
							success: function(response) {
								var json = Ext.decode(response.responseText);
								me.closeLoadingWindow();
								if(me.isLogin(json)) {
									if(me.isSuccess(json)) {
										store.load();
										Ext.Msg.alert('Groups', 'User successfully deleted.');
									}
								}
							}
						});
					}
				});
			} else {
				Ext.Msg.alert('Application Error', 'Sorry, you cannot delete this user.');
			}
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any users.');
		}
	},

	filter: function() {
		var filterWindow = Ext.create('MyIndo.view.Administrator.Users.Filter');
		var store = Ext.getCmp('main-content').getActiveTab().getStore();
		var params = store.proxy.extraParams;
		var form = filterWindow.items.items[0].getForm();
		var val = form.setValues(params);
		filterWindow.show();

		filterWindow.on('close', function(){
			var store = Ext.getCmp('main-content').getActiveTab().getStore();
			var params = store.proxy.extraParams;
			if(typeof(params.USERNAME) === 'undefined' && typeof(params.EMAIL) === 'undefined') {
				store.load();
			}
		});
	},

	applyFilter: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		var panel = Ext.getCmp('main-content');
		var store = panel.getActiveTab().getStore();
		var val = form.getValues();
		if(val.USERNAME.length > 0) {
			store.proxy.extraParams.USERNAME = val.USERNAME;
		} else {
			if(typeof(store.proxy.extraParams.USERNAME) !== 'undefined') {
				delete store.proxy.extraParams.USERNAME;
			}
		}
		if(val.EMAIL.length > 0) {
			store.proxy.extraParams.EMAIL = val.EMAIL;
		} else {
			if(typeof(store.proxy.extraParams.EMAIL) !== 'undefined') {
				delete store.proxy.extraParams.EMAIL;
			}
		}
		store.load({
			callback: function(record, opt) {
				if(record.length == 0) {
					Ext.Msg.alert('Users Filter', 'No data found, please try again.');
					store.proxy.extraParams = {};
				} else {
					var json = Ext.decode(opt.response.responseText);
					Ext.Msg.alert('Groups Filter', 'Result: [' + json.data.totalCount + '] data(s) found.');
					parent.close();
				}
				me.closeLoadingWindow();
			}
		});
	}
});