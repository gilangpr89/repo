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
					ORGANIZATION_ID: selected[0].data.ORGANIZATION_ID
			};
			console.log(selected[0].data.TRAINING_ID);
			Ext.create(MyIndo.getNameSpace('view.Report.Organization.Detail'), {
				trainingData: selected[0].data.ORGANIZATION_ID,
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
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('organizations/request/print'),
						params: parent.trainingData,
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