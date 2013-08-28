Ext.define(MyIndo.getNameSpace('controller.Report.CapacityProfile.Cbo'), {
	extend: MyIndo.getNameSpace('controller.Report'),
	
	requires: [
	MyIndo.getNameSpace('view.Report.CapacityProfile.Cbo.View'),
	MyIndo.getNameSpace('view.Report.CapacityProfile.Cbo.Detail')
	],
	
	init: function() {
		this.control({
			'capacityprofilecboview button': {
				click: this.onButtonClicked
			},
			'capacityprofilecbodetail button': {
				click: this.onButtonClicked
			},
			'capacityprofilecbofilterwindow button':{
				click:this.onButtonClicked
			}
//			'individuview button[action=report-individual]': {
//				click: this.reportParticipants
//			},
//			'individuview button[action=update]': {
//				click: this.onManageReportindividual
//			}
		});
	},
	
	printCbo: function(record) {
		var parent = record.up().up();
		var grid = parent.items.get(0)
		var selected = grid.getSelectionModel().getSelection();
		var store = Ext.create(MyIndo.getNameSpace('store.Report.CapacityProfile.CboTrainings'));
		if(selected.length > 0) {
			store.proxy.extraParams = {
				ORGANIZATION_ID: selected[0].data.ID
			};
			Ext.create(MyIndo.getNameSpace('view.Report.CapacityProfile.Cbo.Detail'), {
				organizationData: selected[0].data,
				store: store
			}).show();
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any organization.');
		}
	},
	
	doPrintCbo: function(record) {
		var parent = record.up().up();
		var me = this;
		Ext.Msg.confirm('Print CBO Report', 'Are you sure want to print this data ?', function(btn) {
			if(btn == 'yes') {
				if(typeof(parent.organizationData.ID) !== 'undefined') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('reports/print/cbo'),
						params: parent.organizationData,
						success: function(r) {
							var json = Ext.decode(r.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								if(me.isSuccess(json)) {
									window.open(MyIndo.siteUrl(json.data.path + json.data.fileName));
								}
							}
						}
					});
				} else {
					Ext.Msg.alert('Application Error', 'Invalid Or.');
				}
			}
		});
	}
});