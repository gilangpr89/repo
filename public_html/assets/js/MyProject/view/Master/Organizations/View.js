Ext.define(MyIndo.getNameSpace('view.Master.Organizations.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.organizationsview',
	border: false,
	columns: [{
		text: 'Organization',
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
				add: MyIndo.getNameSpace('view.Master.Organizations.Add'),
				update: MyIndo.getNameSpace('view.Master.Organizations.Update'),
				filter: MyIndo.getNameSpace('view.Master.Organizations.Filter')
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