Ext.define(MyIndo.getNameSpace('view.Master.Roles.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.rolesview',
	border: false,
	columns: [{
		text: 'Role',
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
				add: MyIndo.getNameSpace('view.Master.Roles.Add'),
				update: MyIndo.getNameSpace('view.Master.Roles.Update'),
				filter: MyIndo.getNameSpace('view.Master.Roles.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('roles/request/destroy')
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