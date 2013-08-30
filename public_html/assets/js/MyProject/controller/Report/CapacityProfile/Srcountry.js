Ext.define(MyIndo.getNameSpace('controller.Report.CapacityProfile.Srcountry'), {
	extend: MyIndo.getNameSpace('controller.Report'),
	
	requires: [
	MyIndo.getNameSpace('view.Report.CapacityProfile.Srcountry.View'),
	MyIndo.getNameSpace('view.Report.CapacityProfile.Srcountry.Detail')
	],
	
	init: function() {
		this.control({
			'capacityprofilesrcountryview button': {
				click: this.onButtonClicked
			},
			'capacityprofilesrcountrydetail button': {
				click: this.onButtonClicked
			},
			'capacityprofilesrcountryfilterwindow button':{
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
	
	printSrcountry: function(record) {
		var parent = record.up().up();
		var grid = parent.items.get(0)
		var selected = grid.getSelectionModel().getSelection();
		var store = Ext.create(MyIndo.getNameSpace('store.Report.CapacityProfile.SrcountryTrainings'));
		if(selected.length > 0) {
			store.proxy.extraParams = {
					ORGANIZATION_COUNTRY_ID: selected[0].data.ID
			};
			Ext.create(MyIndo.getNameSpace('view.Report.CapacityProfile.Srcountry.Detail'), {
				countryData: selected[0].data,
				store: store
			}).show();
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any Country.');
		}
	},
	
	doPrintSrcountry: function(record) {
		var parent = record.up().up();
		var me = this;
		Ext.Msg.confirm('Print Sr Report', 'Are you sure want to print this data ?', function(btn) {
			if(btn == 'yes') {
				if(typeof(parent.countryData.ID) !== 'undefined') {
					if(typeof(Ext.getCmp('srcountry-detail-training-start-date')) !== 'undefined') {
						parent.countryData.START_DATE = Ext.getCmp('srcountry-detail-training-start-date').value;
					}
					if(typeof(Ext.getCmp('srcountry-detail-training-end-date')) !== 'undefined') {
						parent.countryData.END_DATE = Ext.getCmp('srcountry-detail-training-end-date').value;
					}
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('reports/print/srcountry'),
						params: parent.countryData,
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
	},
	
	filterPeriod: function(record) {
		var store = record.activeStore;
		var form = Ext.getCmp('srcountry-detail-training-period-form');
		if(form.isValid()) {
		store.proxy.extraParams = {
				START_DATE: form.getValues().START_DATE,
				END_DATE: form.getValues().END_DATE,
				ORGANIZATION_COUNTRY_ID: store.proxy.extraParams.ORGANIZATION_COUNTRY_ID
		};
		store.load();
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	}
});