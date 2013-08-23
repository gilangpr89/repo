Ext.define(MyIndo.getNameSpace('controller.Report.CapacityProfile.Individual'), {
	extend: MyIndo.getNameSpace('controller.Report'),
	
	requires: [
	MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.View'),
	MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.Detail')
	],
	
	init: function() {
		this.control({
			'capacityprofileindividualview button': {
				click: this.onButtonClicked
			},
			'capacityprofileindividualdetail button': {
				click: this.onButtonClicked
			}
//			'individusearchwindow button': {
//				click: this.onButtonClicked
//			},
//			'individuview button[action=report-individual]': {
//				click: this.reportParticipants
//			},
//			'individuview button[action=update]': {
//				click: this.onManageReportindividual
//			}
		});
	},
	
	printIndividual: function(record) {
		var parent = record.up().up();
		var grid = parent.items.get(0)
		var selected = grid.getSelectionModel().getSelection();
		var store = Ext.create(MyIndo.getNameSpace('store.Report.CapacityProfile.IndividualTrainings'));
		
		if(selected.length > 0) {
			store.proxy.extraParams = {
				PARTICIPANT_ID: selected[0].data.ID
			};
			Ext.create(MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.Detail'), {
				participantData: selected[0].data,
				store: store
			}).show();
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any participant.');
		}
	},
	
	doPrintIndividual: function(record) {
		var parent = record.up().up();
		var me = this;
		Ext.Msg.confirm('Print Individual Report', 'Are you sure want to print this data ?', function(btn) {
			if(btn == 'yes') {
				if(typeof(parent.participantData.ID) !== 'undefined') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('reports/print/individual'),
						params: parent.participantData,
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
					Ext.Msg.alert('Application Error', 'Invalid participant.');
				}
			}
		});
	}
});