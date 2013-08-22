Ext.define(MyIndo.getNameSpace('controller.Report.CapacityProfile.Cbo.Cpcbo'), {
	extend: MyIndo.getNameSpace('controller.Report'),

	requires: [
	       	//MyIndo.getNameSpace('view.Report.Participants.Add'),
	       	//MyIndo.getNameSpace('view.Report.Participants.Update'),
	       	//MyIndo.getNameSpace('view.Report.Participants.Filter'),
	       	MyIndo.getNameSpace('view.Report.CapacityProfile.Cbo.View'),
	       	MyIndo.getNameSpace('view.Report.CapacityProfile.Cbo.Search')
	       	],

	init: function() {
		this.control({
			'cboview button': {
				click: this.onButtonClicked
			},
			'cbosearchwindow button': {
				click: this.onButtonClicked
			},
			'cboview button[action=report-individual]': {
				click: this.reportParticipants
			},
			'cboview button[action=update]': {
				click: this.onReportCapacityProfileCboClicked
			}
		});
	},
	
	onReportCapacityProfileCboClicked: function(record) {
			var parent = record.up().up();
			var grid = parent.items.items[0];
			console.log(grid.getModel);console.log('aaaa');
			var selected = grid.getSelectionModel().getSelection();
			var me = this;
			var ID = parent.id;
		  if(selected.length > 0) {
				Ext.Msg.confirm('Print Participant', 'Are you sure want to print ?', function(btn) {
					if(btn == 'yes') {
						me.showLoadingWindow();
						Ext.Ajax.request({
							url: MyIndo.siteUrl('report/request/print'),
							params: selected[0].data,
							success: function(r) {
								var json = Ext.decode(r.responseText);
								me.closeLoadingWindow();
								if(me.isLogin(json)) {
									if(me.isSuccess(json)) {
										var mainContent = Ext.getCmp('report-cbo-grid');
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