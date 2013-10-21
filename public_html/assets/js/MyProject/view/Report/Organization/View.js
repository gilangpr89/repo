Ext.define(MyIndo.getNameSpace('view.Report.Organization.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.reportorganizationview',
	border: false,
	columns: [{
		text: 'Training Name',
		flex: 1,
		dataIndex: 'TRAINING_NAME'
	},{
		text: 'Organization Name',
		align: 'center',
		flex: 1,
		dataIndex: 'ORGANIZATION_NAME'
	},{
		text: 'Country',
		align: 'center',
		width: 100,
		dataIndex: 'VENUE_COUNTRY_NAME'
	},{
		text: 'Total',
		align: 'center',
		width: 150,
		dataIndex: 'TOTAL'
	}],

	initComponent: function() {
		Ext.apply(this, {
			actions: {
				filter: MyIndo.getNameSpace('view.Report.Organization.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('organizations/request/destroy')
			},
			dockedItems: [{
				xtype: 'pagingtoolbar',
				displayInfo: true,
				dock: 'bottom',
				store: this.store
			}]
		});
		this.callParent(arguments);
	}
});