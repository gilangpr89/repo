Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.trtrainingsview',
	border: false,
	columns: [{
		text: 'Training Name',
		flex: 1,
		dataIndex: 'NAME'
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