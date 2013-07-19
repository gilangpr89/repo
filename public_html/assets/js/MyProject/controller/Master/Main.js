Ext.define(MyIndo.getNameSpace('controller.Master.Main'), {
	extend: 'MyIndo.app.Controller',

	onButtonClicked: function(record) {
		switch(record.action) {
			/* Add */
			case 'add':
				this.add(record);
				break;
			case 'add-save':
				this.addSave(record);
				break;
			case 'add-cancel':
				this.addCancel(record);
				break;

			/* Edit */
			case 'update':
				this.update(record);
				break;
			case 'update-save':
				this.updateSave(record);
				break;
			case 'update-cancel':
				this.updateCancel(record);
				break;
		}
	},

	/* Add */

	add: function(record) {
		var parent = record.up().up();
		var actions = parent.actions;
		var addWindow = Ext.create(actions.add);
		addWindow.show();
	},

	addSave: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		if(form.isValid()) {
			Ext.Msg.confirm('Add Confirmation', 'Are you sure want to save this data ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					form.submit({
						success: function(act, res) {
							var json = Ext.decode(res.response.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								Ext.Msg.alert('Message', 'Data successfully saved.');
								var mainContent = Ext.getCmp('main-content');
								var store = mainContent.getActiveTab().getStore();
								store.proxy.extraParams = {};
								store.load();
								form.reset();
							}
						},
						failure: function(act, res) {
							var json = Ext.decode(res.response.responseText);
							me.closeLoadingWindow();
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

	addCancel: function(record) {
		record.up().up().close();
	},

	/* End of : Add */

	/* Update */

	update: function(record) {
		var panel = Ext.getCmp('main-content');
		var grid = panel.getActiveTab();
		var store = grid.getStore();
		var selected = grid.getSelectionModel().getSelection();
		var parent = record.up().up();
		var actions = parent.actions;
		if(selected.length > 0) {
			var data = selected[0].data;
			var editWindow = Ext.create(actions.update);
			var form = editWindow.items.items[0].getForm();
			form.setValues(data);
			editWindow.show();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any items.');
		}
	},

	updateSave: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		if(form.isValid()) {
			Ext.Msg.confirm('Save confirmation', 'Are you sure want to save this data ?', function(btn) {
				if(btn == 'yes') {
					form.submit({
						success: function(act, res) {
							var json = Ext.decode(res.response.responseText);
							if(me.isLogin(json)) {
								Ext.Msg.alert('Message', 'Data successfully saved.');
								var mainContent = Ext.getCmp('main-content');
								var store = mainContent.getActiveTab().getStore();
								store.load();
								parent.close();
							}
							me.closeLoadingWindow();
						},
						failure: function(act, res) {
							var json = Ext.decode(res.response.responseText);
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
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	},

	updateCancel: function(record) {
		record.up().up().close();
	}

	/* End of : Update */
});