Ext.define(MyIndo.getNameSpace('controller.Master.Organizations'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Organizations.Add'),
	MyIndo.getNameSpace('view.Master.Organizations.Update'),
	MyIndo.getNameSpace('view.Master.Organizations.Filter'),
	MyIndo.getNameSpace('view.Master.Organizations.Upload'),
	MyIndo.getNameSpace('view.Master.Organizations.Detail'),
	MyIndo.getNameSpace('view.Report.Organizations')
	],

	init: function() {
		this.control({
			'organizationsview button': {
				click: this.onButtonClicked
			},
			'organizationsaddwindow button': {
				click: this.onButtonClicked
			},
			'organizationsupdatewindow button': {
				click: this.onButtonClicked
			},
			'organizationsfilterwindow button': {
				click: this.onButtonClicked
			},
			'organizationsuploadwindow button': {
				click: this.onButtonClicked
			},
			'organizationsuploadwindow button': {
				click: this.onButtonClicked
			},
			'masterorganizationdetailwindow button[action=organization-download-doc]': {
				click: this.doDownload
			},
			'masterorganizationdetailwindow button[action=organization-delete-doc]' : {
				click: this.onDelete
			},
			'reportorganizationswindow button[action=add]': {
				click: this.onManageReportOrganization
			},
			'organizationsview button[action=report-organizations]': {
				click: this.reportOrganization
			}
		});
	},
	
	reportOrganization: function(record) {
		var parent = record.up().up();
		var selected = parent.getSelectionModel().getSelection();
		if(selected.length > 0) {
			var store = Ext.create(MyIndo.getNameSpace('store.Report.Organizations'));
			var id = selected[0].data.ID;
			store.proxy.extraParams.ID =  selected[0].data.ID;
			var reportParticipantsWindow = Ext.create(MyIndo.getNameSpace('view.Report.Organizations'),{
				store: store,
				id : id
			});
			store.load();
			reportParticipantsWindow.show();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any Participants.');
		}
	},
	
	onManageReportOrganization: function(record) {
		var parent = record.up().up();
		var grid = parent.items.items[0];
		var selected = grid.getSelectionModel().getSelection();
		var me = this;
		var ID = parent.id;
	  if(selected.length > 0) {
			Ext.Msg.confirm('Print Participant', 'Are you sure want to print this participant ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('organizations/request/print'),
						params: selected[0].data,
						success: function(r) {
							var json = Ext.decode(r.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								if(me.isSuccess(json)) {
									var mainContent = Ext.getCmp('report-organization-grid');
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
	
	/* Download Organizations Doc */
	doDownload: function(record) {
		try {
			var parent = record.up().up();
			var grid = parent.items.get(0);
			var selected = grid.getSelectionModel().getSelection();
			if(selected.length > 0) {
				if (selected[0].data.FILE_PATH.length > 0) {
					document.location = MyIndo.baseUrl(selected[0].data.FILE_PATH);
				} else {
					Ext.Msg.alert('Message', 'Empty Doc.');
				}
			} else {
				Ext.Msg.alert('Application Error', 'You did not select any module.');
			}
		} catch(e) {
			Ext.Msg.alert('Application Error', e);
		}
	},
	/* End of : Download Traner */
	/* Delete Module */
	onDelete: function(record) {
		var parent = record.up().up();
		var grid = parent.items.get(0);
		var selected = grid.getSelectionModel().getSelection();
		var me = this;
		if(selected.length > 0) {
			Ext.Msg.confirm('Delete Doc', 'Are you sure want to delete this doc ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.baseUrl('organizations/request/delete'),
						params: selected[0].data,
						success: function(r) {
							var json = Ext.decode(r.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								if(me.isSuccess(json)) {
									Ext.getCmp('detail-organization-grid').getStore().load();
									Ext.Msg.alert('Delete Doc', 'Doc successfully deleted.');
								}
							}
						}
					});
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any file Doc.');
		}
	}
});