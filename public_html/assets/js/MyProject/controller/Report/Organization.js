Ext.define(MyIndo.getNameSpace('controller.Report.Organization'), {
	extend: MyIndo.getNameSpace('controller.Report'),

	requires: [
	MyIndo.getNameSpace('view.Report.Organization.Detail'),
	MyIndo.getNameSpace('view.Report.Organization.Filter'),
	MyIndo.getNameSpace('view.Report.Organization.View')
	],

	init: function() {
		this.control({
			'reportorganizationview button': {
				click: this.onButtonClicked
			},
			'reportorganizationdetail button': {
				click: this.onButtonClicked
			},
			'reportorganizationfilterwindow button':{ 
				click:this.onButtonClicked
			}
		});
	},
	
	printOrganization: function(record) {
		var parent = record.up().up();
		var grid = parent.items.get(0);
		var selected = parent.getSelectionModel().getSelection();
		var store = Ext.create(MyIndo.getNameSpace('store.Report.OrganizationTrainings'));
		if(selected.length > 0) {
			store.proxy.extraParams = {
					ORGANIZATION_ID: selected[0].data.ID
			};
			Ext.create(MyIndo.getNameSpace('view.Report.Organization.Detail'), {
				organizationData: selected[0].data,
				store: store
			}).show();
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any participant.');
		}
	},
	
	doPrintOrganization: function(record) {
		var parent = record.up().up();
		var me = this;
		Ext.Msg.confirm('Print Organization Report', 'Are you sure want to print this data ?', function(btn) {
			if(btn == 'yes') {
				if(typeof(parent.organizationData.ID) !== 'undefined') {
					
					if(typeof(Ext.getCmp('organization-detail-training-start-date')) !== 'undefined') {
						parent.organizationData.START_DATE = Ext.getCmp('organization-detail-training-start-date').value;
					}
					
					if(typeof(Ext.getCmp('organization-detail-training-end-date')) !== 'undefined') {
						parent.organizationData.END_DATE = Ext.getCmp('organization-detail-training-end-date').value;
					}
					
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('organizations/request/print'),
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
					Ext.Msg.alert('Application Error', 'Invalid Organization.');
				}
			}
		});
	},
	
	filterPeriod: function(record) {
		var store = record.activeStore;
		var form = Ext.getCmp('organization-detail-training-period-form');
		if(form.isValid()) {
				store.proxy.extraParams = {
					START_DATE: form.getValues().START_DATE,
					END_DATE: form.getValues().END_DATE,
					ORGANIZATION_ID: store.proxy.extraParams.ORGANIZATION_ID
				}
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	}
});