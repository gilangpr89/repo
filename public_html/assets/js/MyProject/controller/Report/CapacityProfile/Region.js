Ext.define(MyIndo.getNameSpace('controller.Report.CapacityProfile.Region'), {
	extend: MyIndo.getNameSpace('controller.Report'),
	
	requires: [
	MyIndo.getNameSpace('view.Report.CapacityProfile.Region.View'),
	MyIndo.getNameSpace('view.Report.CapacityProfile.Region.Filter'),
	MyIndo.getNameSpace('view.Report.CapacityProfile.Region.Detail')
	],
	
	init: function() {
		this.control({
			'capacityprofileregionview button': {
				click: this.onButtonClicked
			},
			'capacityprofileregiondetail button': {
				click: this.onButtonClicked
			},
			'capacityprofileregionfilterwindow button':{
				click:this.onButtonClicked
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
	
	printRegion: function(record) {
		var parent = record.up().up();
		var grid = parent.items.get(0)
		var selected = grid.getSelectionModel().getSelection();
		var store = Ext.create(MyIndo.getNameSpace('store.Report.CapacityProfile.RegionTrainings'));
		if(selected.length > 0) {
			store.proxy.extraParams = {
				REGION_ID: selected[0].data.ID
			};
			Ext.create(MyIndo.getNameSpace('view.Report.CapacityProfile.Region.Detail'), {
				regionData: selected[0].data,
				store: store
			}).show();
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any region.');
		}
	},
	
	doPrintRegion: function(record) {
		var parent = record.up().up();
		var me = this;
		Ext.Msg.confirm('Print Region Report', 'Are you sure want to print this data ?', function(btn) {
			if(btn == 'yes') {
				if(typeof(parent.regionData.ID) !== 'undefined') {
					
					if(typeof(Ext.getCmp('region-detail-training-start-date')) !== 'undefined') {
						parent.regionData.START_DATE = Ext.getCmp('region-detail-training-start-date').value;
					}
					
					if(typeof(Ext.getCmp('region-detail-training-end-date')) !== 'undefined') {
						parent.regionData.END_DATE = Ext.getCmp('region-detail-training-end-date').value;
					}
					
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('reports/print/region'),
						params: parent.regionData,
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
					Ext.Msg.alert('Application Error', 'Invalid region.');
				}
			}
		});
	},
	
	filterPeriod: function(record) {
		var store = record.activeStore;
		var form = Ext.getCmp('region-detail-training-period-form');
		if(form.isValid()) {
			store.proxy.extraParams = {
				START_DATE: form.getValues().START_DATE,
				END_DATE: form.getValues().END_DATE,
				REGION_ID: store.proxy.extraParams.REGION_ID
			};
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	}
});