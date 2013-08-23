Ext.define(MyIndo.getNameSpace('controller.Report'), {
	extend: 'MyIndo.app.Controller',

	onButtonClicked: function(record) {
		switch(record.action) {
			/* Search */
			case 'search':
				this.search(record);
				break;
			case 'start-search':
				this.startSearch(record);
				break;
			case 'search-cancel':
				this.SearchCancel(record);
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
				
			/* print */
			case 'print':
				this.print(record);
				break;
			case 'print-cancel':
				this.printCancel(record);
				break;
			
			case 'onManageReportindividual':
				this.onManageReportindividual(record);
				break;
			
			case 'onManageReportcbo':
			this.onManageReportcbo(record);
			break;
		
		}
				
	},

	/* Add */
	
	onManageReportindividual: function(record) {
		var parent = record.up().up();
		var grid = parent.items.items[0];
		var get = grid.getStore().data.items;
		console.log(grid);console.log('aaaa');
		//console.log(get);console.log('aaaa');
		var grid = parent.items.items[0];
		var selected = grid.getSelectionModel().getSelection();
		//console.log(selected);console.log('aaaa');
		var me = this;
		var ID = parent.id;
	  if(selected.length > 0) {
			Ext.Msg.confirm('Print Participant', 'Are you sure want to print ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('report/request/printindividual'),
						params: selected[0].data,
						success: function(r) {
							var json = Ext.decode(r.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								if(me.isSuccess(json)) {
									var mainContent = Ext.getCmp('report-participant-grid');
									var store = mainContent.getStore();
									var ID = store.proxy.extraParams.ID;
									store.proxy.extraParams = {};
									store.proxy.extraParams.ID = ID;
									store.load();
									Ext.Msg.alert('Print', 'Participant successfully Printed.');
									window.open(MyIndo.siteUrl(json.data.path + json.data.fileName));
								}
							}
						}
					})
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any participant.');
		}
	},
	
	onManageReportcbo: function(record) {
	var parent = record.up().up();
	var grid = parent.items.items[0];
	var get = grid.getStore().data.items;
	console.log(grid);console.log('aaaa');
	//console.log(get);console.log('aaaa');
	var grid = parent.items.items[0];
	var selected = grid.getSelectionModel().getSelection();
	//console.log(selected);console.log('aaaa');
	var me = this;
	var ID = parent.id;
  if(selected.length > 0) {
		Ext.Msg.confirm('Print Participant', 'Are you sure want to print ?', function(btn) {
			if(btn == 'yes') {
				me.showLoadingWindow();
				Ext.Ajax.request({
					url: MyIndo.siteUrl('report/request/printcbo'),
					params: selected[0].data,
					success: function(r) {
						var json = Ext.decode(r.responseText);
						me.closeLoadingWindow();
						if(me.isLogin(json)) {
							if(me.isSuccess(json)) {
								var mainContent = Ext.getCmp('report-participant-grid');
								var store = mainContent.getStore();
								var ID = store.proxy.extraParams.ID;
								store.proxy.extraParams = {};
								store.proxy.extraParams.ID = ID;
								store.load();
								Ext.Msg.alert('Print', 'Participant successfully Printed.');
								window.open(MyIndo.siteUrl(json.data.path + json.data.fileName));
							}
						}
					}
				})
			}
		});
	} else {
		Ext.Msg.alert('Application Error', 'You did not select any participant.');
	}
},
	
	aaa: function() {
		alert('asdasd');
	},

	search: function(record) {
		var parent = record.up().up();
		var actions = parent.actions;
		var searchWindow = Ext.create(actions.search);
		searchWindow.show();
	},

	startSearch: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		var mainContent = Ext.getCmp('main-content');
		var store = mainContent.getActiveTab().getStore();
		console.log(store);
		// Reset ExtraParams
		store.proxy.extraParams = {};
		if(form.isValid()) {
			me.showLoadingWindow();
			form.submit({
				success: function(act, res) {
					var json = Ext.decode(res.response.responseText);
					me.closeLoadingWindow();
					if(me.isLogin(json)) {
						//Ext.Msg.alert('Message', 'Data successfully saved.');
						store.proxy.extraParams=  form.getValues();
						store.load();
						//store.load();
						//form.reset();
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
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	},

//	addCancel: function(record) {
//		record.up().up().close();
//	},

	/* End of : Add */

	/* Update */

//	update: function(record) {
//		var panel = Ext.getCmp('main-content');
//		var grid = panel.getActiveTab();
//		var store = grid.getStore();
//		var selected = grid.getSelectionModel().getSelection();
//		var parent = record.up().up();
//		var actions = parent.actions;
//		if(selected.length > 0) {
//			var data = selected[0].data;
//			var editWindow = Ext.create(actions.update);
//			var form = editWindow.items.items[0].getForm();
//			form.setValues(data);
//			editWindow.show();
//		} else {
//			Ext.Msg.alert('Application Error', 'You did not select any items.');
//		}
//	},

//	updateSave: function(record) {
//		var parent = record.up().up();
//		var form = parent.items.items[0].getForm();
//		var me = this;
//		if(form.isValid()) {
//			Ext.Msg.confirm('Save confirmation', 'Are you sure want to save this data ?', function(btn) {
//				if(btn == 'yes') {
//					me.showLoadingWindow();
//					form.submit({
//						success: function(act, res) {
//							var json = Ext.decode(res.response.responseText);
//							if(me.isLogin(json)) {
//								Ext.Msg.alert('Message', 'Data successfully saved.');
//								var mainContent = Ext.getCmp('main-content');
//								var store = mainContent.getActiveTab().getStore();
//								store.load();
//								parent.close();
//							}
//							me.closeLoadingWindow();
//						},
//						failure: function(act, res) {
//							var json = Ext.decode(res.response.responseText);
//							if(me.isLogin(json)) {
//								Ext.Msg.alert('Application Error', '<strong>Error Code</strong>: ' + json.error_code + '<br/><strong>Message</strong>: ' + json.error_message);
//								if(json.error_code == 10082) {
//									parent.close();
//								}
//							}
//							me.closeLoadingWindow();
//						}
//					});
//				}
//			});
//		} else {
//			Ext.Msg.alert('Application Error', 'Please complete form first.');
//		}
//	},

//	updateCancel: function(record) {
//		record.up().up().close();
//	},

	/* End of : Update */

	/* Delete */

//	delete: function(record) {
//		var parent = record.up().up();
//		var selected = parent.getSelectionModel().getSelection();
//		var store = parent.getStore();
//		var me = this;
//		if(selected.length > 0) {
//			var data = selected[0].data;
//			Ext.Msg.confirm('Delete confirmation', 'Are you sure want to delete this data ?', function(btn) {
//				if(btn == 'yes') {
//					me.showLoadingWindow();
//					Ext.Ajax.request({
//						url: parent.url.delete,
//						params: data,
//						success: function(r) {
//							var json = Ext.decode(r.responseText);
//							me.closeLoadingWindow();
//							if(me.isLogin(json)) {
//								if(me.isSuccess(json)) {
//									store.load();
//									Ext.Msg.alert('Delete', 'User successfully deleted.');
//								}
//							}
//						}
//					})
//				}
//			});
//		} else {
//			Ext.Msg.alert('Application Error', 'You did not select any data.');
//		}
//	},

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
});