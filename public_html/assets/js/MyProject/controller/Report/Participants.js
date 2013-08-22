Ext.define(MyIndo.getNameSpace('controller.Report.Participants'), {
	extend: MyIndo.getNameSpace('controller.Report'),

	requires: [
	//MyIndo.getNameSpace('view.Report.Participants.Add'),
	//MyIndo.getNameSpace('view.Report.Participants.Update'),
	//MyIndo.getNameSpace('view.Report.Participants.Filter'),
	MyIndo.getNameSpace('view.Report.Participants.View')
	],

	init: function() {
		this.control({
			'reportparticipantsview button': {
				click: this.onButtonClicked
			},
			'reportparticipantsview button[action=report-participants]': {
				click: this.reportParticipants
			},
			'reportparticipantswindow button[action=add]': {
				click: this.onManageReportParticipant
			}
		});
	},
	
	reportParticipants: function(record) {
		var parent = record.up().up();
		var selected = parent.getSelectionModel().getSelection();
		if(selected.length > 0) {
			var store = Ext.create(MyIndo.getNameSpace('store.Report.Participants'));
			var id = selected[0].data.ID;
			store.proxy.extraParams.ID =  selected[0].data.ID;
			var reportParticipantsWindow = Ext.create(MyIndo.getNameSpace('view.Report.Participants.View'),{
				store: store,
				id : id
			});
			store.load();
			reportParticipantsWindow.show();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any Participants.');
		}
	},
	
	onManageReportParticipant: function(record) {
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
						url: MyIndo.siteUrl('participants/request/print'),
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
	}
});