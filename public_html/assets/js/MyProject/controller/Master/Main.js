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

			/* Delete */
			case 'delete':
				this.delete(record);
				break;

			/* Filter */
			case 'filter':
				this.filter(record);
				break;
			case 'filter-search':
				this.filterSearch(record);
				break;
			case 'filter-cancel':
				this.filterCancel(record);
				break;
				
			/* Print */
			case 'report':
				this.report(record);
				break;
			case 'report-cancle':
				this.reportCancle(record);
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
					me.showLoadingWindow();
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
	},

	/* End of : Update */

	/* Delete */

	delete: function(record) {
		var parent = record.up().up();
		var selected = parent.getSelectionModel().getSelection();
		var store = parent.getStore();
		var me = this;
		if(selected.length > 0) {
			var data = selected[0].data;
			Ext.Msg.confirm('Delete confirmation', 'Are you sure want to delete this data ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: parent.url.delete,
						params: data,
						success: function(r) {
							var json = Ext.decode(r.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								if(me.isSuccess(json)) {
									store.load();
									Ext.Msg.alert('Delete', 'User successfully deleted.');
								}
							}
						}
					})
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any data.');
		}
	},

	/* End of: Delete */

	/* Filter */
	filter: function(record) {
		var panel = Ext.getCmp('main-content');
		var activePanel = panel.getActiveTab();
		var store = activePanel.getStore();
		var extraParams = store.proxy.extraParams;
		var parent = record.up().up();
		var actions = parent.actions;
		var filterWindow = Ext.create(actions.filter);
		var form = filterWindow.items.items[0].getForm();
		form.setValues(extraParams);
		filterWindow.show();
	},

	filterSearch: function(record) {
		var panel = Ext.getCmp('main-content');
		var parent = panel.getActiveTab();
		var store = parent.getStore();
		var form = record.up().up().items.items[0].getForm();
		var val = form.getValues();
		var filters = parent.filters;
		var params = {};
		for(var i = 0; i < filters.length; i++) {
			var tmp = eval('val.' + filters[i]);
			if(tmp.length > 0) {
				eval('params.' + filters[i] + ' = ' + 'val.' + filters[i] + ';');
			}
		}
		store.proxy.extraParams = params;
		store.load({
			callback: function(eRecord, eOpt) {
				if(eRecord.length == 0) {
					Ext.Msg.alert('Filter', 'No data found, please try another value.');
					record.up().up().on('close', function() {
						store.proxy.extraParams = {};
						store.load();
					});
				} else {
					var json = Ext.decode(eOpt.response.responseText);
					Ext.Msg.alert('Filter', 'Result: [' + json.data.totalCount + '] data(s) found.');
					record.up().up().close();
				}
			}
		});
	},

	filterCancel: function(record) {
		record.up().up().close();
	},
	/* End of : Filter */
	
	/* Print */
	
	print: function(record) {
		var panel = Ext.getCmp('main-content');
		var activePanel = panel.getActiveTab();
		var store = activePanel.getStore();
		var extraParams = store.proxy.extraParams;
		var parent = record.up().up();
		var actions = parent.actions;
		var filterWindow = Ext.create(actions.print);
		var form = filterWindow.items.items[0].getForm();
		form.setValues(extraParams);
		filterWindow.show();
	},
	
	printCancel: function(record) {
		record.up().up().close();
	}
	
	/* End Print */
	
});