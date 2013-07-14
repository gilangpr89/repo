Ext.define('MyIndo.view.Administrator.Groups.View', {
	extend: 'Ext.grid.Panel',
	alias: 'widget.groupsview',
	border: false,
	columns: [{
		text: 'Group Name',
		flex: 1,
		dataIndex: 'NAME'
	},{
		text: 'Total User',
		width: 80,
		align: 'center',
		dataIndex: 'TOTAL_USER'
	}/*,{
		text: 'Active',
		width: 80,
		align: 'center',
		dataIndex: 'ACTIVE'
	}*/,{
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