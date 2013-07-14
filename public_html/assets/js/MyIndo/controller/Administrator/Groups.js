Ext.define('MyIndo.controller.Administrator.Groups', {
	extend: 'MyIndo.app.Controller',
	
	init: function() {
		this.control({
			'groupsview button': {
				click: this.onButtonClicked
			},
			'groupsaddwindow button': {
				click: this.onButtonClicked
			},
			'groupsupdatewindow button': {
				click: this.onButtonClicked
			},
			'managegroup button': {
				click: this.onManageGroupButtonClicked
			},
			'manageadduserwindow button': {
				click: this.onManageGroupButtonClicked
			}
		});
	},
	
	onButtonClicked: function(record) {
		try {
			switch(record.action) {
				/* View */
				case 'create':
					this.create();
					break;
				case 'update':
					this.update(record);
					break;
				case 'delete':
					this.delete(record);
					break;
				case 'manage':
					this.manage(record);
					break;
				case 'search':
					this.search(record);
					break;

				/* Add */
				case 'add-save':
					this.addSave(record);
					break;
				case 'add-cancel':
					record.up().up().close();
					break;

				/* Update */
				case 'update-save':
					this.updateSave(record);
					break;
				case 'update-cancel':
					record.up().up().close();
					break;
			}
		} catch(e) {
			Ext.Msg.alert('Application Error', e);
		}
	},

	onManageGroupButtonClicked: function(record) {
		var action = record.action;
		switch(action) {
			case 'add':
				this.manageAdd();
				break;
			case 'manage-add-save':
				this.manageAddSave(record);
				break;
			case 'delete':
				this.manageDelete(record);
				break;
		}
	},

	/* View */
	create: function() {
		var w = Ext.create('MyIndo.view.Administrator.Groups.Add');
		w.show();
	},

	update: function(record) {
		var parent = record.up().up();
		var selected = parent.getSelectionModel().getSelection();
		var me = this;
		if(selected.length > 0) {
			var data = selected[0].data;
				if(data.NAME != 'Administrator') {
				var w = Ext.create('MyIndo.view.Administrator.Groups.Update');
				var form = w.items.items[0].getForm();
				form.setValues({
					GROUP_ID: data.GROUP_ID,
					NAME: data.NAME
				});
				w.show();
			} else {
				Ext.Msg.alert('Application Error', 'Sorry, you cannot update this group.');
			}
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any Groups.');
		}
	},

	delete: function(record) {
		var parent = record.up().up();
		var selected = parent.getSelectionModel().getSelection();
		var me = this;
		if(selected.length > 0) {
			var data = selected[0].data;
			if(data.NAME != 'Administrator') {
				Ext.Msg.confirm('Delete Group Confirmation', 'Are you sure want to delete this group ?', function(btn) {
					if(btn == 'yes') {
						var LW = Ext.create('MyIndo.view.Loading');
						LW.show();
						Ext.Ajax.request({
							url: MyIndo.siteUrl('groups/request/destroy'),
							params: {
								GROUP_ID: data.GROUP_ID,
								NAME: data.NAME
							},
							success: function(r) {
								var json = Ext.decode(r.responseText);
								LW.close();
								if(me.isLogin(json)) {
									if(me.isSuccess(json)) {
										var store = parent.getStore();
										store.load();
										Ext.Msg.alert('Groups', 'Group successfully deleted.');
									}
								}
							}
						});
					}
				});
			} else {
				Ext.Msg.alert('Application Error', 'Sorry, you cannot delete this group.');
			}
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any Groups.');
		}
	},

	manage: function(record) {
		var parent = record.up().up();
		var selected = parent.getSelectionModel().getSelection();
		var me = this;
		if(selected.length > 0) {
			var panel = Ext.getCmp('main-content');
			var id = 'manage-group-' + selected[0].data.GROUP_ID;
			if(!panel.items.get(id)) {
				var store = Ext.create('MyIndo.store.GroupUsers');
				store.proxy.extraParams = {
					GROUP_ID: selected[0].data.GROUP_ID
				};
				panel.add({
					xtype: 'managegroup',
					title: 'Manage Users: ' + selected[0].data.NAME,
					id: id,
					store: store,
					groupName: selected[0].data.NAME
				})
			}
			panel.setActiveTab(id);
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any Groups.');
		}
	},

	/* Add */
	addSave: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		if(form.isValid()) {
			Ext.Msg.confirm('Save confirmation', 'Are you sure want to save this data ?', function(btn) {
				if(btn == 'yes') {
					var LW = Ext.create('MyIndo.view.Loading');
					LW.show();
					form.submit({
						url: MyIndo.baseUrl('groups/request/create'),
						success: function(data, r) {
							var json = Ext.decode(r.response.responseText);
							Ext.Msg.alert('Message', 'Data successfully saved.');
							var mainContent = Ext.getCmp('main-content');
							var store = mainContent.getActiveTab().getStore();
							store.load();
							form.reset();
							LW.close();
						},
						failure: function(data, r) {
							var json = Ext.decode(r.response.responseText);
							LW.close();
							if(me.isLogin(json)) {
								Ext.Msg.alert('Application Error', '<strong>Error Code</strong>: ' + json.error_code + '<br/><strong>Message</strong>: ' + json.error_message);
							}
						}
					});
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	},

	updateSave: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var panel = Ext.getCmp('main-content');
		var store = panel.getActiveTab().getStore();
		var me = this;
		var LW = Ext.create('MyIndo.view.Loading');
		LW.show();
		if(form.isValid()) {
			form.submit({
				url: MyIndo.siteUrl('groups/request/update'),
				success: function(data, r) {
					var json = Ext.decode(r.response.responseText);
					store.load(store.currentPage);
					parent.close();
					Ext.Msg.alert('Groups', 'Group successfully updated.');
					LW.close();
				},
				failure: function(data, r) {
					var json = Ext.decode(r.response.responseText);
					LW.close();
					if(me.isLogin(json)) {
						me.fail(json);
					}
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	},

	/* Manage */

	manageAdd: function() {
		var panel = Ext.getCmp('main-content');
		var parent = panel.getActiveTab();
		var groupId = parent.id.split('-')[2];
		var store = parent.getStore();
		var userStore = Ext.create('MyIndo.store.Users');
		var windowAdd = Ext.create('MyIndo.view.Administrator.Groups.AddUser', {
			userStore: userStore
		});
		var form = windowAdd.items.items[0].getForm();
		form.setValues({
			GROUP_ID: groupId
		});
		windowAdd.show();
	},

	manageAddSave: function(record) {
		var form = record.up().up().items.items[0].getForm();
		var me = this;
		if(form.isValid()) {
			var val = form.getValues();
			if(val.USER_ID.length == 88) {
				Ext.Msg.confirm('Save confirmation', 'Are you sure want to save this data ?', function(btn) {
				if(btn == 'yes') {
					var LW = Ext.create('MyIndo.view.Loading');
					LW.show();
					form.submit({
						url: MyIndo.baseUrl('groupusers/request/create'),
						success: function(data, r) {
							var json = Ext.decode(r.response.responseText);
							Ext.Msg.alert('Message', 'Data successfully saved.');
							var mainContent = Ext.getCmp('main-content');
							var store = mainContent.getActiveTab().getStore();
							store.load();
							record.up().up().close();
							LW.close();
						},
						failure: function(data, r) {
							var json = Ext.decode(r.response.responseText);
							if(me.isLogin(json)) {
								Ext.Msg.alert('Application Error', '<strong>Error Code</strong>: ' + json.error_code + '<br/><strong>Message</strong>: ' + json.error_message);
							}
							LW.close();
						}
					});
				}
			});
			} else {
				Ext.Msg.alert('Application Error', 'Please select username first.');
			}
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	},

	manageDelete: function(record) {
		var parent = record.up().up();
		var store = parent.getStore();
		var selected = parent.getSelectionModel().getSelection();
		var me = this;
		if(selected.length > 0) {
			if(selected[0].data.USERNAME == 'admin' && parent.groupName == 'Administrator') {
				Ext.Msg.alert('Application Error', 'Sorry, you cannot delete this user.');
			} else {
				var groupId = parent.id.split('-')[2];
				var userId = selected[0].data.USER_ID;
				Ext.Msg.confirm('Delete User', 'Are you sure want to delete this user ?', function(btn) {
					if(btn == 'yes') {
						var LW = Ext.create('MyIndo.view.Loading');
						LW.show();
						Ext.Ajax.request({
							url: MyIndo.siteUrl('groupusers/request/destroy'),
							params: {
								GROUP_ID: groupId,
								USER_ID: userId
							},
							success: function(r) {
								var json = Ext.decode(r.responseText);
								LW.close();
								if(me.isLogin(json)) {
									if(me.isSuccess(json)) {
										store.load();
										Ext.Msg.alert('Group User', 'User successfully deleted.');
									}
								}
							}
						});
					}
				});
			}
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any users.');
		}
	}
});