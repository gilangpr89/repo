Ext.define(MyIndo.getNameSpace('view.Master.Positions.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.positionsview',
	border: false,
	columns: [{
		text: 'Position',
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
				add: MyIndo.getNameSpace('view.Master.Positions.Add'),
				update: MyIndo.getNameSpace('view.Master.Positions.Update'),
				filter: MyIndo.getNameSpace('view.Master.Positions.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('positions/request/destroy')
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