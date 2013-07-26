Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.trtrainingsview',
	border: false,
	columns: [{
		text: 'Training Name',
		width: 200,
		dataIndex: 'TRAINING_NAME'
	},{
		text: 'Area Level',
		width: 100,
		align: 'center',
		dataIndex: 'AREA_LEVEL_NAME'
	},{
		text: 'Beneficiaries',
		width: 150,
		dataIndex: 'BENEFICIARIES_NAME'
	},{
		text: 'Funding Source',
		width: 150,
		dataIndex: 'FUNDING_SOURCE_NAME'
	},{
		text: 'Venue',
		width: 120,
		dataIndex: 'VENUE_NAME'
	},{
		text: 'Host',
		width: 150,
		dataIndex: 'ORGANIZATION_NAME'
	},{
		text: 'Creator',
		align: 'center',
		width: 80,
		dataIndex: 'USERNAME'
	},{
		text: 'Created Date',
		align: 'center',
		width: 150,
		dataIndex: 'CREATED_DATE'
	},{
		text: 'Modified Date',
		align: 'center',
		width: 150,
		dataIndex: 'MODIFIED_DATE'
	}],

	initComponent: function() {
		Ext.apply(this, {
			actions: {
				add: MyIndo.getNameSpace('view.Transaction.Trainings.Add'),
				update: MyIndo.getNameSpace('view.Transaction.Trainings.Update'),
				filter: MyIndo.getNameSpace('view.Transaction.Trainings.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('trtrainings/request/destroy')
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