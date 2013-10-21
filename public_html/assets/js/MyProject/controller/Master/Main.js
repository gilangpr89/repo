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
				
				/* Trainers Upload */
			case 'upload':
				this.upload(record);
				break;
			case 'do-upload':
				this.doUpload(record);
				break;
				
				/* Doc Detail */
			case 'detail':
				this.detailOrganization(record);
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
									Ext.Msg.alert('Delete', 'Data successfully deleted.');
									
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
	
	/* Upload Doc Trainers */
	upload: function(record) {
		var parent = record.up().up();
		var actions = parent.actions;
		var panel = Ext.getCmp('main-content');
		var grid = panel.getActiveTab();
		var store = grid.getStore();
		var selected = grid.getSelectionModel().getSelection();
		if(selected.length > 0) {
			var data = selected[0].data;
			var uploadWindow = Ext.create(actions.upload);
			var form = uploadWindow.items.items[0].getForm();
			form.setValues({
				ORGANIZATION_ID: selected[0].data.ID
			});
			uploadWindow.show();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any Organizations.');
		}
	},
	
	doUpload: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		var allowedFileExtension = ['ppt', 'pptx', 'doc','docx','xls','xlsx','pdf'];
		var allowed = false;
		if(form.isValid()) {
			Ext.Msg.confirm('Upload Doc', 'Are you sure want to upload this doc ?', function(btn) {
				if(btn == 'yes') {
					var fileNameExploded = Ext.getCmp('upload-organization-file-box').value.split('.');
					var fileExtension = fileNameExploded[fileNameExploded.length-1];
					for(var i = 0; i < allowedFileExtension.length; i++) {
						if(allowedFileExtension[i] == fileExtension) {
							allowed = true;
						}
					}
					if(allowed) {
						form.submit({
							url: MyIndo.baseUrl('organizations/request/upload'),
							waitMsg: 'Uploading file, please wait..',
							success: function(form, record) {
								var json = Ext.decode(record.response.responseText);
								if(me.isLogin(json)) {
									var mainContent = Ext.getCmp('main-content');
									var store = mainContent.getActiveTab().getStore();
									store.load();
//									parent.close();
//									Ext.getCmp('manage-trainer-grid').getStore().load();
									Ext.Msg.alert('Upload Doc', 'File successfully uploaded.');
									parent.close();
								}
							},
							failure: function(form, record) {
								var json = Ext.decode(record.response.responseText);
								if(me.isLogin(json)) {
									Ext.Msg.alert('Application Error', '<strong>Error : </strong>[' + json.error_code + '] ' + json.error_message);
								}
							}
						});
					} else {
						Ext.Msg.alert('Application Error', 'Not allowed file extension \'' + fileExtension + '\'');
					}
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	},
	
	/* End of : Uplaod Module */
	
	/* Detail Document Oranization By Training */
	detailOrganization: function(record) {
		var parent = record.up().up();
		var grid = parent.items.get(0);
		var selected = parent.getSelectionModel().getSelection();
		var store = Ext.create(MyIndo.getNameSpace('store.Master.OrganizationUploads'));
		if(selected.length > 0) {
			store.proxy.extraParams = {
					ORGANIZATION_ID: selected[0].data.ID
			};
			Ext.create(MyIndo.getNameSpace('view.Master.Organizations.Detail'), {
				fileData: selected[0].data,
				store: store
			}).show();
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any organization.');
		}
	},
});