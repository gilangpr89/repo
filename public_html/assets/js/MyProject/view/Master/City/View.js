Ext.define(MyIndo.getNameSpace('view.Master.City.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.cityview',
	border: false,
	columns: [{
		text: 'City',
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
				add: MyIndo.getNameSpace('view.Master.City.Add'),
				update: MyIndo.getNameSpace('view.Master.City.Update'),
				filter: MyIndo.getNameSpace('view.Master.City.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('cities/request/destroy')
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