Ext.define(MyIndo.getNameSpace('view.Master.Venues.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.venuesview',
	border: false,
	columns: [{
		text: 'Venue',
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
				add: MyIndo.getNameSpace('view.Master.Venues.Add'),
				update: MyIndo.getNameSpace('view.Master.Venues.Update'),
				filter: MyIndo.getNameSpace('view.Master.Venues.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('venues/request/destroy')
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