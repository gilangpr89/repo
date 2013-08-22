Ext.define(MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.individuview',
	border: false,
	columns: [{
		text: 'Training Name',
		flex: 1,
		dataIndex: 'TRAINING_NAME'
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
				search: MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.Search'),
				onManageReportindividual: MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.View')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('report/request/destroy')
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