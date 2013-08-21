Ext.define(MyIndo.getNameSpace('controller.Master.Organizations'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Organizations.Add'),
	MyIndo.getNameSpace('view.Master.Organizations.Update'),
	MyIndo.getNameSpace('view.Master.Organizations.Filter'),
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
	}
});